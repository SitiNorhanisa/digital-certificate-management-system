<?php
include("dbConnection.php");

$eventID = $_POST["eventid"];
$datemodified = date("Y-m-d H:i:s");

$sql = "UPDATE recipient SET s_approval_status='Pending', s_email_status='0', s_modified='$datemodified' WHERE s_eventID=$eventID AND s_approval_status='No approval'";
if ($conn->query($sql) == TRUE) {
    echo '1';
} else {
    echo '0';
}
