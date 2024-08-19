<?php
include 'connectDB.php';

$func = $_GET['func'];

if ($func == "fetch-row") {
    $setting = $_GET['setting'];
    if ($setting == "have-mushroom") {
        $query_Getrow = "SELECT 
    * 
FROM 
    mushroom_row AS mr
WHERE 
    mr.row_status = 1 
    AND mr.mushroomID != 0 
ORDER BY 
    mr.row_number;
";
    } else if ($setting == "not-mushroom") {
        $query_Getrow = "SELECT 
    * 
FROM 
    mushroom_row AS mr
WHERE 
    mr.row_status = 1 
    AND mr.mushroomID = 0 
ORDER BY 
    mr.row_number;
";
    } else if ($setting == "all-on") {
        $query_Getrow = "SELECT 
    mr.rowID, 
    mr.row_number, 
    mr.mushroomID, 
    md.mushroom_name 
FROM 
    mushroom_row AS mr
LEFT JOIN 
    mushroom_detail AS md ON mr.mushroomID = md.mushroomID 
WHERE 
    mr.row_status = 1 
ORDER BY 
    mr.row_number;
";
    }
    $result_Getrow = $conn->query($query_Getrow);
    $data_row = array();
    if ($result_Getrow->num_rows > 0) {
        while ($row = $result_Getrow->fetch_assoc()) {
            $data_row[] = $row;
        }
    }
    echo json_encode($data_row);
} elseif ($func == "add-row") {
    $query_Addrow = "SELECT MAX(`row_number`) FROM mushroom_row WHERE row_status = 1";
    $result_Addrow = $conn->query($query_Addrow);

    if ($result_Addrow->num_rows > 0) {
        $row = $result_Addrow->fetch_assoc();
        $rowName =  intval($row['MAX(`row_number`)']);
    } else {
        $rowName = 0;
    }
    $rowName = $rowName + 1;

    $sql_Addrow = "INSERT INTO mushroom_row (`row_number`)
            VALUES ('$rowName')";
    if (mysqli_query($conn, $sql_Addrow)) {
        $status = array("status" => "New record created successfully");
    } else {
        $status = array("status" => "Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    echo json_encode($status);
} elseif ($func == "del-row") {
    $id = $_GET['id'];
    $farm_id = $_GET['farm_id'];

    $data_rowID = array();

    if ($farm_id != '0') {
        $sql_Delfarm = "DELETE FROM mushroom_detail WHERE `mushroomID` = '$farm_id'";

        if ($conn->query($sql_Delfarm) === TRUE) {
            $sql_Delharvest = "DELETE FROM mushroom_harvest WHERE `mushroomID` = '$farm_id'";
            if ($conn->query($sql_Delharvest) === TRUE) {
            } else {
                $status = array("status" => "Error deleting record: " .  $conn->error);
            }
        } else {
            $status = array("status" => "Error deleting record: " .  $conn->error);
        }
    }

    $query_Getrowid = "SELECT `rowID` FROM mushroom_row WHERE `row_status` = 1";
    $result_Getrowid = $conn->query($query_Getrowid);
    if ($result_Getrowid->num_rows > 0) {
        while ($row = $result_Getrowid->fetch_assoc()) {
            $data_rowID[] = $row['rowID'];
        }

        foreach ($data_rowID as $x) {
            if ($id < intval($x)) {
                $query_Editrow = "UPDATE mushroom_row SET `row_number` = `row_number`-1 WHERE `rowID` = $x";
                if ($conn->query($query_Editrow) === TRUE) {
                    $status =  array("status" => "Record updated successfully");
                } else {
                    $status =  array("status" => "Error updating record: " . $conn->error);
                }
            }
        }
    }

    $sql_Delrow = "DELETE FROM mushroom_row WHERE rowID = '$id'";

    if ($conn->query($sql_Delrow) === TRUE) {
        $status = array("status" => "Record deleted successfully");
    } else {
        $status = array("status" => "Error deleting record: " .  $conn->error);
    }

    echo json_encode($status);
} elseif ($func == "insert-farm") {
    $m_name = $_GET['m_name'];
    $m_row = $_GET['m_row'];
    $m_date = $_GET['m_date'];
    $m_amount = $_GET['m_amount'];

    $sql_insertFarm = "INSERT INTO mushroom_detail (mushroom_name, mushroom_amount, planting_date)
                        VALUES ('$m_name', '$m_amount', '$m_date')";

    if ($conn->query($sql_insertFarm) === TRUE) {
        $sql_selectLastfarmID = "SELECT MAX(mushroomID) FROM mushroom_detail";
        $result_farmID = $conn->query($sql_selectLastfarmID);
        $row_farmID = $result_farmID->fetch_assoc();
        $farmID = intval($row_farmID['MAX(mushroomID)']);

        $sql_updateRow = "UPDATE mushroom_row SET mushroomID='$farmID' WHERE rowID = $m_row";

        if ($conn->query($sql_updateRow) === TRUE) {
            $sql_insertHarvest = "INSERT INTO mushroom_harvest (mushroomID)
                            VALUES ('$farmID')";
            if ($conn->query($sql_insertHarvest) === TRUE) {
                $status = array("status" => "New record created successfully");
            } else {
                $status = array("status" => "Error: " . $sql . "<br>" . $conn->error);
            }
        } else {
            $status = array("status" => "Error updating record: " . $conn->error);
        }
    } else {
        $status = array("status" => "Error: " . $sql . "<br>" . $conn->error);
    }

    echo json_encode($status);
} elseif ($func == "fetch-rowDetail") {
    $rowID = $_GET['row_id'];

    $sql_GetrowDetail = "SELECT 
    mr.rowID, 
    mr.row_number, 
    md.mushroomID, 
    md.mushroom_name, 
    md.mushroom_amount, 
    hs.havest_status, 
    hs.havest_product,
    DATE_FORMAT(md.planting_date, '%d / %m / %Y') AS plan_date 
FROM 
    mushroom_row AS mr
INNER JOIN 
    mushroom_detail AS md ON mr.mushroomID = md.mushroomID 
LEFT JOIN 
    (SELECT mushroomID, MAX(harvestID) AS harvestID 
     FROM mushroom_harvest 
     WHERE havest_status = 1 
     GROUP BY mushroomID) AS mh ON md.mushroomID = mh.mushroomID
LEFT JOIN 
    (SELECT mushroomID, 
            COUNT(havest_status) AS havest_status, 
            SUM(havest_product) AS havest_product 
     FROM mushroom_harvest 
     WHERE havest_status = 0 
     GROUP BY mushroomID) AS hs ON md.mushroomID = hs.mushroomID 
WHERE 
    mr.row_status = 1 $rowID
ORDER BY 
    mr.row_number;
";
    $result_GetrowDetail = $conn->query($sql_GetrowDetail);
    $data_row = array();
    if ($result_GetrowDetail->num_rows > 0) {
        while ($row = $result_GetrowDetail->fetch_assoc()) {
            $data_row[] = $row;
        }
    }
    echo json_encode($data_row);
} elseif ($func == "fetch-tableDetail") {
    $rowID = $_GET['row_id'];
    $sql_GettableDetail = "SELECT 
    mr.rowID, 
    mr.row_number, 
    mr.row_status, 
    md.mushroomID, 
    md.mushroom_name, 
    md.mushroom_amount, 
    DATE_FORMAT(md.planting_date, '%d / %m / %Y') AS plan_date, 
    mh.harvestID, 
    DATE_FORMAT(mh.havest_date, '%d / %m / %Y') AS havest_date, 
    mh.havest_product, 
    mh.havest_status 
FROM 
    mushroom_row AS mr
INNER JOIN 
    mushroom_detail AS md ON mr.mushroomID = md.mushroomID
INNER JOIN 
    mushroom_harvest AS mh ON md.mushroomID = mh.mushroomID 
WHERE 
    mr.row_status = 1 
    $rowID 
ORDER BY 
    mr.row_number, mh.havest_date DESC;
";

    $query_GettableDetail = $conn->query($sql_GettableDetail);

    while ($item = $query_GettableDetail->fetch_object()) {
        $ret["data"][] = $item;
    }
    echo json_encode($ret);
} elseif ($func == "get-rowedit") {
    $rowID = $_GET['id'];

    $sql_Getrowedit = "SELECT 
    mr.rowID, 
    mr.row_number, 
    md.mushroomID, 
    md.mushroom_name, 
    md.mushroom_amount, 
    md.planting_date 
FROM 
    mushroom_row AS mr
INNER JOIN 
    mushroom_detail AS md ON mr.mushroomID = md.mushroomID WHERE `rowID` = " . $rowID;
    $result_Getrowedit = $conn->query($sql_Getrowedit);

    if ($result_Getrowedit->num_rows > 0) {
        $row = $result_Getrowedit->fetch_assoc();
        echo json_encode($row);
    }
} elseif ($func == "update-rowdetail") {
    $m_id = $_GET['m_id'];
    $m_name = $_GET['m_name'];
    $m_row = $_GET['m_row'];
    $m_date = $_GET['m_date'];
    $m_amount = $_GET['m_amount'];
    $rowID = $_GET['id'];

    if (!empty($m_row)) {
        $sql_removeFarmInRow = "UPDATE mushroom_row SET mushroomID='0' WHERE rowID = " . $rowID;
        $conn->query($sql_removeFarmInRow);

        $sql_addFarmInRow = "UPDATE mushroom_row SET mushroomID='$m_id' WHERE rowID = " . $m_row;
        $conn->query($sql_addFarmInRow);
    }

    $sql_updateRow = "UPDATE mushroom_detail SET mushroom_name='$m_name',mushroom_amount='$m_amount',planting_date='$m_date' WHERE mushroomID = " . $m_id;

    if ($conn->query($sql_updateRow) === TRUE) {
        $status = array("Record updated successfully");
    } else {
        $status = array("Error updating record: " . $conn->error);
    }

    echo json_encode($status);
} elseif ($func == "add-harvestNo") {
    $h_id = $_GET['h_id'];
    $h_date = $_GET['h_date'];
    $h_amount = $_GET['h_amount'];
    $rowID = $_GET['row_id'];
    $row_name = $_GET['row_name'];

    $sql_updateRowstatus = "UPDATE mushroom_row SET row_status='0' WHERE rowID = " . $rowID;
    $conn->query($sql_updateRowstatus);

    $sql_addnewRow = "INSERT INTO mushroom_row(row_number) VALUES ('$row_name')";
    $conn->query($sql_addnewRow);

    $sql_updateHarvest = "UPDATE mushroom_harvest SET havest_date='$h_date',havest_product='$h_amount',havest_status='0' WHERE harvestID = " . $h_id;

    if ($conn->query($sql_updateHarvest) === TRUE) {
        $status = array("Record updated successfully");
    } else {
        $status = array("Error updating record: " . $conn->error);
    }

    echo json_encode($status);
} elseif ($func == "add-harvestYes") {
    $h_id = $_GET['h_id'];
    $h_date = $_GET['h_date'];
    $h_amount = $_GET['h_amount'];
    $m_id = $_GET['m_id'];

    $sql_updateHarvestY = "UPDATE mushroom_harvest SET havest_date='$h_date',havest_product='$h_amount',havest_status='0' WHERE harvestID = " . $h_id;

    if ($conn->query($sql_updateHarvestY) === TRUE) {
        $status = array("Record updated successfully");
    } else {
        $status = array("Error updating record: " . $conn->error);
    }

    $sql_insertHarvestY = "INSERT INTO mushroom_harvest (mushroomID)
                            VALUES ('$m_id')";
    if ($conn->query($sql_insertHarvestY) === TRUE) {
        $status = array("status" => "New record created successfully");
    } else {
        $status = array("status" => "Error: " . $sql . "<br>" . $conn->error);
    }



    echo json_encode($status);
} elseif ($func == "get-harvestedit") {
    $harvestID = $_GET['id'];

    $sql_Getharvestedit = "SELECT harvestID, havest_date, havest_product FROM mushroom_harvest WHERE harvestID = " . $harvestID;
    $result_Getharvestedit = $conn->query($sql_Getharvestedit);

    if ($result_Getharvestedit->num_rows > 0) {
        $row = $result_Getharvestedit->fetch_assoc();
        echo json_encode($row);
    }
} elseif ($func == "update-harvest") {
    $harvestID = $_GET['id'];
    $h_date = $_GET['h_date'];
    $h_amount = $_GET['h_amount'];

    $sql_updateHarvestA = "UPDATE mushroom_harvest SET havest_date='$h_date',havest_product='$h_amount' WHERE harvestID = " . $harvestID;

    if ($conn->query($sql_updateHarvestA) === TRUE) {
        $status = array("Record updated successfully");
    } else {
        $status = array("Error updating record: " . $conn->error);
    }

    echo json_encode($status);
} elseif ($func == "delete-harvest") {
    $harvestID = $_GET['id'];

    $sql_deleteHarvest = "DELETE FROM mushroom_harvest WHERE harvestID = " . $harvestID;

    if ($conn->query($sql_deleteHarvest) === TRUE) {
        $status = array("Record deleted successfully");
    } else {
        $status = array("Error deleting record: " . $conn->error);
    }
    echo json_encode($status);
}

$conn->close();
