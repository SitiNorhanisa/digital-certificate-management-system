<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "dcms";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed");
} else {
    // echo "Successfull";
}
