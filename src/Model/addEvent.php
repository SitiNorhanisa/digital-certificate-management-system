<?php
// addEvent.php
include("dbConnection.php");

session_start();
$userID = $_SESSION['userID'];
$data = stripslashes(file_get_contents("php://input"));
$myEvent = json_decode($data, true);
$eventName = $myEvent['eventname'];
$eventDate = $myEvent['eventdate'];
$eventVenue = $myEvent['eventVenue'];
$eventSession = $myEvent['eventSession'];
$dateCreated = date("Y-m-d H:i:s");

$sql = "INSERT INTO event (user_id, eventName, eventDate, eventVenue, eventSession) VALUES (UPPER('$userID'), UPPER('$eventName'), '$eventDate', UPPER('$eventVenue'),'$eventSession')";

if ($conn->query($sql) == TRUE) {
    echo "OK";
} else {
    echo "Unable to add event";
}
