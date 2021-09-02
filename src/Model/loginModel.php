<?php

include("dbConnection.php");
session_start();

$inputemail = $_GET['inputemail'];
$inputpwd = $_GET['inputpwd'];

//Compare email & password
if ((!empty($inputemail)) && (!empty($inputpwd))) {

    $sql = "SELECT * FROM user WHERE email='$inputemail' AND password='$inputpwd'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $userid = $row['user_id'];
            $userrole = $row['role'];

            $_SESSION['userID'] = $userid;

            if ($userrole == "PERSAKA") {
                echo 'PERSAKA';
            } else if ($userrole == "PA") {
                echo 'PA';
            } else {
                echo 'ADMIN';
            }
        }
        // echo "TRUE";
    } else {
        echo "FALSE";
    }
} else {
    echo "0";
}
