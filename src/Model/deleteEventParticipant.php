<?php

//connect database
include("dbConnection.php");

$event_id = $_GET['eventID'];

if (!empty($event_id)) {
    $sqlRcp = "DELETE FROM recipient WHERE s_eventID='$event_id'";
    $sqlEvent = "DELETE FROM event WHERE eventID='$event_id'";

    if (($conn->query($sqlRcp) == TRUE) && ($conn->query($sqlEvent) == TRUE)) {
        // echo "Recipient and event deleted successfully";
        echo 1;
    } else {
        // echo "Unable to delete Recipient";
        echo 0;
    }
}
