<?php
include 'connectDB.php';

$func = $_GET['func'];

if ($func == "fetch-tableDetail") {
    if (isset($_GET['year_id'])) {
        $year = $_GET['year_id'];
    }else {
        $year = date("Y");
    }
    
    $sql_GettableDetail = "SELECT harvestID, havest_date, SUM(havest_product) AS havest_product, mushroom_detail.mushroomID, mushroom_name, mushroom_amount, planting_date FROM mushroom_harvest 
    INNER JOIN mushroom_detail ON mushroom_harvest.mushroomID = mushroom_detail.mushroomID WHERE havest_status = 0 AND YEAR(havest_date) = '$year' GROUP BY mushroom_harvest.mushroomID  ORDER BY harvestID DESC";

    $query_GettableDetail = $conn->query($sql_GettableDetail);

    while ($item = $query_GettableDetail->fetch_object()) {
        $ret["data"][] = $item;
    }
    echo json_encode($ret);
} elseif ($func == "fetch-year") {
    $query_Getyear = "SELECT YEAR(havest_date)  AS Year, YEAR(havest_date)+543  AS textYear FROM mushroom_harvest WHERE YEAR(havest_date) > 0 GROUP BY YEAR(havest_date) ORDER BY YEAR(havest_date) DESC";
    $result_Getyear = $conn->query($query_Getyear);
    $data_row = array();
    if ($result_Getyear->num_rows > 0) {
        while ($row = $result_Getyear->fetch_assoc()) {
            $data_row[] = $row;
        }
    }
    echo json_encode($data_row);
}
