<?php
include("dbConnection.php");

$eventID = $_GET['eventID'];
$sql = "DELETE FROM event WHERE eventID='$eventID'";
if ($conn->query($sql) == TRUE) {
    // echo "Recipient deleted successfully";
    echo 1;
    
} else {
    // echo "Unable to delete Recipient";
    echo 0;
}
