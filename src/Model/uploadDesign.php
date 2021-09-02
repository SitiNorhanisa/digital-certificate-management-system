<?php

session_start();
//include database configuration file
include("dbConnection.php");
$eventID = $_SESSION["bgID"];

ini_set("date.timezone", "Asia/Kuala_Lumpur");

header('Access-Control-Allow-Origin: *');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// targer directory
$target_dir = '../assets/images/custom/';

$uniqid = uniqid();
$filename =  "" . $uniqid . "" . basename($_FILES["fileToUpload"]["name"]); //new file name
$target_file = $target_dir . $filename;

$uploadStatus = false;
$dbUpdateStatus = false;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $uploadStatus = true;

    //save the image name to db here
    $query = "UPDATE event SET eventCert = '$filename' WHERE eventID='$eventID'";

    $res = mysqli_query($conn, $query);
} else {
    $uploadStatus = false;
}

if ($uploadStatus) {
    $info = "OK";
} else {
    $info = "ERROR";
}

echo json_encode($info);
