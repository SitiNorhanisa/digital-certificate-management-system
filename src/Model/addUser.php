<?php

include("dbConnection.php");

$data = stripslashes(file_get_contents("php://input"));
$userData = json_decode($data, true);
// $id = $userData['id'];
$firstname = $userData['firstname'];
$lastname = $userData['lastname'];
$email = $userData['email'];
$password = $userData['password'];
$role = $userData['role'];
$dateCreated = date("Y-m-d H:i:s");

//Insert or Update Data
if ((!empty($email) && !empty($password))) {

    $sql = "INSERT INTO user (first_name, last_name, email, password, role, created) VALUES (UPPER('$firstname'), UPPER('$lastname'), '$email', '$password', '$role', '$dateCreated')";

    if ($conn->query($sql) == TRUE) {
        echo "OK";
    } else {
        echo "Unable to add event";
    }
} else {
    echo "Fill all fields!";
}
