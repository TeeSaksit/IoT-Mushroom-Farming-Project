<?php
include 'connectDB.php';

$func = $_GET['func'];

if ($func == "fetchSensor") {
    $sql_selectsensor = "SELECT sensorTemp_1, sensorHumi_1, sensorCO2_1, sensorTemp_2, sensorHumi_2, sensorCO2_2 FROM mushroom_sensor ORDER BY sensorID DESC LIMIT 1";
    $result_selectsensor = $conn->query($sql_selectsensor);

    $data = array();
    if ($result_selectsensor->num_rows > 0) {
        $row = $result_selectsensor->fetch_assoc();
        echo json_encode($row);
    }
} elseif ($func == "changeSwitch") {
    $sw_pump = $_GET['sw_pump'];
    $sw_fan = $_GET['sw_fan'];
    $sw_valve = $_GET['sw_valve'];
    $sw_led = $_GET['sw_led'];

    $sql_updateSW = "UPDATE mushroom_controller SET switch_pump='$sw_pump',switch_fan='$sw_fan',switch_valve='$sw_valve',switch_led='$sw_led' WHERE controllerID = 1";

    if ($conn->query($sql_updateSW) === TRUE) {
        $status = "Record updated successfully";
    } else {
        $status = "Error updating record: " . $conn->error;
    }
    echo json_encode($status);
} elseif ($func == "fetchController") {
    $sql_selectController = "SELECT * FROM mushroom_controller WHERE controllerID = 1";
    $result_selectController = $conn->query($sql_selectController);

    $data = array();
    if ($result_selectController->num_rows > 0) {
        $row = $result_selectController->fetch_assoc();
        echo json_encode($row);
    }
} elseif ($func == "autoON") {
    $temp = $_GET['temp'];
    $humi = $_GET['humi'];
    $co2 = $_GET['co2'];
    $status = $_GET['status'];


    $sql_config = "UPDATE config SET config_temp = '$temp', config_humi = '$humi', config_co2 = '$co2', config_status ='$status' WHERE configID = 1";

    if ($conn->query($sql_config) === TRUE) {
        $result = "Record updated successfully";
    } else {
        $result = "Error updating record: " . $conn->error;
    }
    echo json_encode($result);
} elseif ($func == "autoOFF") {
    $sql_config = "UPDATE config SET config_status ='0' WHERE configID = 1";

    if ($conn->query($sql_config) === TRUE) {
        $result = "Record updated successfully";
    } else {
        $result = "Error updating record: " . $conn->error;
    }
    echo json_encode($result);
} elseif ($func == "autoFetch") {
    $sql_config = "SELECT * FROM config WHERE configID = 1";
    $result_config = $conn->query($sql_config);

    $data = array();
    if ($result_config->num_rows > 0) {
        $row = $result_config->fetch_assoc();
        echo json_encode($row);
    }
}

$conn->close();
