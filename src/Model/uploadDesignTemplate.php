<?php
include("dbConnection.php");

session_start();
$eventID = $_SESSION["bgID"];

// targer directory
$target_dir = '../assets/images/custom/sample-latest-4.png';

if ($conn) {
    $query = "UPDATE event SET eventCert='sample-latest-4.png' WHERE eventID='$eventID'";

    $res = mysqli_query($conn, $query);
} else {
    echo '0';
}
