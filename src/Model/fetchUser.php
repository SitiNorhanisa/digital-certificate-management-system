<?php

include("dbConnection.php");

$sql = "SELECT * from user WHERE role='PA' OR role='PERSAKA'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $userid = $row['user_id'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $email = $row['email'];
        $role = $row['role'];

        $data[] = array("userid" => $userid, "fname" => $fname, "lname" => $lname, "email" => $email, "role" => $role);
    }
    echo json_encode($data);
} else {
    echo '0';
}
