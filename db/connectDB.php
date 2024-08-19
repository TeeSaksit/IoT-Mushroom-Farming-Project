<?php
date_default_timezone_set("Asia/Bangkok");
$date = date('Y-m-d H:i:s');
$current_day = date('Y-m-d');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mushroom_farm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
