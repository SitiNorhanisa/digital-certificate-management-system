<?php

include("dbConnection.php");

$cert_id = $_GET["uniqueID"];

// if ((!empty($cert_id))) {

// $sql = "SELECT * FROM certificate WHERE cert_id='$cert_id'";
$sql = "SELECT  * FROM certificate INNER JOIN recipient ON recipient.cert_id = certificate.cert_id INNER JOIN event ON event.eventID=recipient.s_eventID WHERE certificate.cert_id='$cert_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['cert_id'];
        $name = $row['s_name'];
        $event_name = $row['eventName'];
        $created = $row['date_approved'];
        $approver = $row['approved_by'];

        $data[] = array("id" => $id, "name" => $name, "event" => $event_name, "created" => $created, "approver" => $approver);
    }
    echo json_encode($data);
} else {
    echo '0';
}

//Returning JSON Format Data as Response to Ajax Call
