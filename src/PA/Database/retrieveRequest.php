<?php

include("dbConnection.php");

$sql = "SELECT * FROM recipient INNER JOIN event ON event.eventID=recipient.s_eventID ORDER BY DATE(s_modified) DESC, s_modified ASC";
// $sql = "SELECT * FROM recipient WHERE s_approval_status IN ('Approved', 'Rejected', ) ORDER BY DATE(s_modified) DESC, s_modified ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $eventName = $row['eventName'];
        $id = $row['s_id'];
        $name = $row['s_name'];
        $nric = $row['s_nric'];
        $email = $row['s_email'];

        $approval_status = $row['s_approval_status'];

        $data[] = array("id" => $id, "name" => $name, "nric" => $nric, "email" => $email, "eventName" => $eventName, "approvalStatus" => $approval_status);
    }
    //Returning JSON Format Data as Response to Ajax Call
    echo json_encode($data);
} else {
    echo "You do not have pending request";
}
