<?php

include('dbConnection.php');

$query = "SELECT * FROM recipient WHERE s_eventID='" . $_POST["eventID"] . "'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        // $data[] = $row;
        $id = $row['s_id'];
        $name = $row['s_name'];
        $nric = $row['s_nric'];
        $email = $row['s_email'];
        $approvalStatus = $row['s_approval_status'];

        $data[] = array(
            "id" => $id, "name" => $name, "nric" => $nric, "email" => $email, "approval_status" => $approvalStatus
        );
    }
    //Returning JSON Format Data as Response to Ajax Call
    echo json_encode($data);
} else {
    echo 0;
}
