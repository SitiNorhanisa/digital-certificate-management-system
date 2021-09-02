<?php

include('dbConnection.php');

$eventID = $_GET['eventID'];

//Return recipient information
$sql = "SELECT * FROM recipient WHERE s_eventID='$eventID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        // $data[] = $row;
        $id = $row['s_id'];
        $name = $row['s_name'];
        $nric = $row['s_nric'];
        $matricno = $row['matric_no'];
        $email = $row['s_email'];

        $data[] = array("id" => $id, "name" => $name, "nric" => $nric, "matricno" => $matricno, "email" => $email);
    }
    //Returning JSON Format Data as Response to Ajax Call
    echo json_encode($data);
} else {
    echo 0;
}
