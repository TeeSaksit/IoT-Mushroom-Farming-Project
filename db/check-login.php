<?php
session_start();
include 'connectDB.php';

$func = $_GET['func'];
if ($func == "login") {
    $username = $_GET['username'];
    $password = md5($_GET['password']);

    $sql_login = "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'";
    $result_login = $conn->query($sql_login);

    $sql_checkUsername = "SELECT * FROM admin WHERE admin_username='$username'";
    $result_checkUsername = $conn->query($sql_checkUsername);

    if ($result_login->num_rows > 0) {
        $data = 0;
        $_SESSION["adminID"] = $result_login->fetch_assoc()["adminID"];
    } elseif ($result_checkUsername->num_rows > 0) {
        $data = 1;
    } else {
        $data = 2;
    }

    echo json_encode($data);
} elseif ($func == "logout") {
    session_destroy();
    header("Refresh:0; url=../index.php");
} elseif ($func == "check_username") {
    $username = $_GET['username'];

    $sql_checkUsername = "SELECT * FROM admin WHERE admin_username='$username'";
    $result_checkUsername = $conn->query($sql_checkUsername);

    if ($result_checkUsername->num_rows > 0) {
        $data = 0;
    } else {
        $data = 1;
    }
    echo json_encode($data);
} elseif ($func == "insert_admin") {

    $name = $_GET['name'];
    $tel = $_GET['tel'];
    $level = $_GET['level'];
    $username = $_GET['username'];
    $password = md5($_GET['password']);

    $sql = "INSERT INTO admin (admin_name, admin_level, admin_tel, admin_username, admin_password)
    VALUES ('$name', '$level', '$tel', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $data =  "New record created successfully";
    } else {
        $data =  "Error: " . $sql . "<br>" . $conn->error;
    }

    echo json_encode($data);
} elseif ($func == "delete_admin") {

    $adminID = $_GET['adminID'];

    $sql = "DELETE FROM admin WHERE adminID='$adminID'";

    if ($conn->query($sql) === TRUE) {
        $data =  "Record deleted successfully";
    } else {
        $data =  "Error deleting record: " . $conn->error;
    }

    echo json_encode($data);
} elseif ($func == "fetch-tableAdmin") {

    $sql_Getadmin = "SELECT * FROM admin";
    $result_Getadmin = $conn->query($sql_Getadmin);
    $data_row = array();
    if ($result_Getadmin->num_rows > 0) {
        while ($row = $result_Getadmin->fetch_assoc()) {
            $data_row[] = $row;
        }
    }
    echo json_encode($data_row);
} elseif ($func == "update_admin") {
    $adminID = $_GET['adminID'];
    $name = $_GET['name'];
    $tel = $_GET['tel'];
    $username = $_GET['username'];
    if(isset($_GET['level'])) {
        $level = $_GET['level'];
        $sql_update = "UPDATE admin SET admin_name='$name', admin_level='$level', admin_tel='$tel', admin_username='$username' WHERE adminID = '$adminID'";
    }else{
        $sql_update = "UPDATE admin SET admin_name='$name', admin_tel='$tel', admin_username='$username' WHERE adminID = '$adminID'";
    }

    if ($conn->query($sql_update) === TRUE) {
        $data = "Record updated successfully";
    } else {
        $data = "Error updating record: " . $conn->error;
    }
    echo json_encode($data);
} elseif ($func == "get_adminID") {
    $adminID = $_GET['adminID'];

    $sql_getadmin = "SELECT * FROM admin WHERE adminID = '$adminID'";
    $result_getadmin = $conn->query($sql_getadmin);

    if ($result_getadmin->num_rows > 0) {
        $row = $result_getadmin->fetch_assoc();
        echo json_encode($row);
    }
} elseif ($func == "update_password") {
    $adminID = $_GET['adminID'];
    $password = md5($_GET['password']);

    $sql_update = "UPDATE admin SET admin_password='$password' WHERE adminID = '$adminID'";

    if ($conn->query($sql_update) === TRUE) {
        $data = "Record updated successfully";
    } else {
        $data = "Error updating record: " . $conn->error;
    }
    echo json_encode($data);
}
