<?php
include 'connectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status_pump']) && isset($_POST['status_fan']) && isset($_POST['status_valve']) && isset($_POST['status_led']) && isset($_POST['voltage'])) {
    
    $st_pump = $_POST['status_pump'];
    $st_fan = $_POST['status_fan'];
    $st_valve = $_POST['status_valve'];
    $st_led = $_POST['status_led'];
    $voltage = $_POST['voltage'];
    

    $sql_updatestatus = "UPDATE mushroom_controller SET status_pump='$st_pump',status_fan='$st_fan',status_valve='$st_valve',status_led='$st_led',voltage='$voltage', last_time = '$date' WHERE controllerID = 1";

    if ($conn->query($sql_updatestatus) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['co2_1']) && isset($_POST['temp_1']) && isset($_POST['humi_1']) && isset($_POST['co2_2']) && isset($_POST['temp_2']) && isset($_POST['humi_2'])) {
    $co2_1 = $_POST['co2_1'];
    $temp_1 = $_POST['temp_1'];
    $humi_1 = $_POST['humi_1'];
    $co2_2 = $_POST['co2_2'];
    $temp_2 = $_POST['temp_2'];
    $humi_2 = $_POST['humi_2'];

    $sql_insertsensor = "INSERT INTO mushroom_sensor (sensorDatetime, sensorTemp_1, sensorHumi_1, sensorCO2_1, sensorTemp_2, sensorHumi_2, sensorCO2_2) VALUES ('$date', '$temp_1', '$humi_1', '$co2_1', '$temp_2', '$humi_2', '$co2_2')";

    if ($conn->query($sql_insertsensor) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_insertsensor . "<br>" . $conn->error;
    }
}

$sql_get = "SELECT switch_pump, switch_fan, switch_valve, switch_led, config_temp, config_humi, config_co2, config_status 
            FROM mushroom_controller INNER JOIN config ON mushroom_controller.controllerID = config.configID 
            WHERE configID = 1";
$result_get = $conn->query($sql_get);

$data = array();

if ($result_get->num_rows > 0) {
    $row = $result_get->fetch_assoc();
    echo json_encode($row);
} else{
    echo "ไม่พบข้อมูล";
}

$conn->close();
