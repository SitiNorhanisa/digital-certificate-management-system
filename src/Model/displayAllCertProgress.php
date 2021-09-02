<?php
include("dbConnection.php");

session_start();
$userID = $_SESSION['userID'];

$sql = "SELECT * FROM event WHERE user_id='$userID'ORDER BY eventID DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        // $data[] = $row;
        $eventId = $row['eventID'];
        $eventName = $row['eventName'];
        $eventSession = $row['eventSession'];

        $data[] = array("eventId" => $eventId, "eventName" => $eventName, "eventSession" => $eventSession);
    }
}

//Returning JSON Format Data as Response to Ajax Call
echo json_encode($data);
