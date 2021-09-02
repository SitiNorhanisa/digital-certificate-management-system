<?php

include("dbConnection.php");

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM user WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo json_encode($row);
