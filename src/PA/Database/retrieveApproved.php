<?php

include("dbConnection.php");

$sql = "SELECT * FROM recipient INNER JOIN event ON event.eventID = recipient.s_eventID WHERE s_approval_status='approved'";
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
        $eventName = $row['eventName'];
        $eventDate = $row['eventDate'];
        $approval_status = $row['s_approval_status'];

        $data[] = array("id" => $id, "name" => $name, "nric" => $nric, "matricno" => $matricno ,"email" => $email, "eventName" => $eventName, "approvalStatus" => $approval_status, "eventDate" => $eventDate);
    }
    //Returning JSON Format Data as Response to Ajax Call
    echo json_encode($data);
} else {
    echo "0";
}
