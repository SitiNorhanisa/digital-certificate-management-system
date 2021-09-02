<?php
include('dbConnection.php');

$eventID = $_GET['selectedID'];

$sql = "SELECT * FROM recipient INNER JOIN event ON event.eventID=recipient.s_eventID WHERE s_eventID='$eventID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $eventName = $row['eventName'];
        $id = $row['s_id'];
        $name = $row['s_name'];
        $nric = $row['s_nric'];
        $email = $row['s_email'];
        $status = $row['s_approval_status'];
        $emailstatus = $row['s_email_status'];


        $data[] = array("id" => $id, "name" => $name, "nric" => $nric, "email" => $email, "status" => $status, "emailstatus" => $emailstatus, "eventname" => $eventName);
    }
    echo json_encode($data);
} else {
    echo 0;
}
