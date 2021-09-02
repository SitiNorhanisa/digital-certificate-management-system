<?php

//to update participant data
include('dbConnection.php');

if ($conn) {
    $user_id = $_POST['user_id'];
    $newpassword = $_POST['new_password'];

    $query = "UPDATE user SET password='$newpassword' WHERE user_id='$user_id'";
    $res = mysqli_query($conn, $query);

    if($res) {
        echo 1;
    }
    else {
        echo 0;
    }
}