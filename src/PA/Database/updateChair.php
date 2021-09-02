<?php
//fetch.php  

include('dbConnection.php');

//to update participant data
$chairName = $_POST['chairName'];

//target directory
$target_dir = '../../assets/images/signature/';

$uniqid = uniqid();
$filename =  "" . $uniqid . "" . basename($_FILES["fileToUpload"]["name"]); //new file name
$target_file = $target_dir . $filename;
$modified = date("Y-m-d h:i:sa");

$uploadStatus = false;
$dbUpdateStatus = false;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $uploadStatus = true;
    //save the image name to db here
    $query = "UPDATE chair SET chair_name = UPPER('$chairName'), signature='$filename', modified='$modified'";

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
