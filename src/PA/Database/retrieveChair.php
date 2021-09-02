<?php
//fetch.php  

include('dbConnection.php');

$action = $_POST["action"];

if ($action == "retrieve") {
    $query = "SELECT * FROM chair";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
