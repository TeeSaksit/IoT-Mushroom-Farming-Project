<?php
include 'connectDB.php';

$func = $_GET['func'];

if ($func == "fetch-datachart") {
    // Fetch data from the table
    // $result_sensor = $conn->query("SELECT * FROM(SELECT  sensorID, sensorTemp, sensorHumi, sensorCO2,  DATE_FORMAT(sensorDatetime, '%d/%m/%Y %H:%i:%s') as chartDatetime 
    //     FROM mushroom_sensor ORDER BY sensorID DESC LIMIT 10) mushroom_sensor ORDER BY mushroom_sensor.sensorID");
    
    $result_sensor = $conn->query("
    SELECT DATE_FORMAT(
        DATE_SUB(sensorDatetime, INTERVAL MINUTE(sensorDatetime) % 10 MINUTE),
        '%Y-%m-%d %H:%i'
    ) AS chartDatetime,
    ROUND(AVG(sensorTemp_1), 2) AS sensorTemp,
    ROUND(AVG(sensorHumi_1), 2) AS sensorHumi,
    ROUND(AVG(sensorCO2_1), 0) AS sensorCO2
    FROM  mushroom_sensor
    WHERE DATE(sensorDatetime) = '$current_day'
    GROUP BY FLOOR(UNIX_TIMESTAMP(sensorDatetime) / (10 * 60))
    ORDER BY chartDatetime");
    
    // Convert the result to an array
    $data = array();
    while ($row = $result_sensor->fetch_assoc()) {
        $data[] = $row;
    }

    // Close connection
    $conn->close();

    // Return data as JSON
    echo json_encode($data);
} elseif ($func == "fetch-dataProduct") {
    if (isset($_GET['year_id'])) {
        $year = $_GET['year_id'];
    } else {
        $year = date("Y");
    }

    $result_product = $conn->query("SELECT months.year, months.month, COALESCE(SUM(CASE WHEN mushroom_harvest.havest_status = 0 THEN mushroom_harvest.havest_product ELSE 0 END), 0) AS sum_product FROM
    (
        SELECT '$year' AS year, 1 AS month
        UNION SELECT '$year', 2
        UNION SELECT '$year', 3
        UNION SELECT '$year', 4
        UNION SELECT '$year', 5
        UNION SELECT '$year', 6
        UNION SELECT '$year', 7
        UNION SELECT '$year', 8
        UNION SELECT '$year', 9
        UNION SELECT '$year', 10
        UNION SELECT '$year', 11
        UNION SELECT '$year', 12
    ) AS months LEFT JOIN mushroom_harvest ON months.year = YEAR(mushroom_harvest.havest_date) AND months.month = MONTH(mushroom_harvest.havest_date)
        GROUP BY months.year, months.month ORDER BY months.year, months.month");

    // $result_product = $conn->query("SELECT  YEAR(havest_date), MONTH(havest_date), SUM(havest_product) AS sum_product FROM mushroom_harvest WHERE havest_status = 0 GROUP BY YEAR(havest_date), MONTH(havest_date) ");

    $data = array();
    while ($row = $result_product->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    echo json_encode($data);
}
