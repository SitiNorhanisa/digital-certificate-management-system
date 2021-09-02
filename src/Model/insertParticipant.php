<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

include('dbConnection.php');

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['id'];
$eventID = $mydata['eventID'];
$eventName = $mydata['eventName'];
$name = $mydata['name'];
$nric = $mydata['nric'];
$matricno = $mydata['matricNo'];
$email = $mydata['email'];

$dateCreated = date("Y-m-d H:i:s");
$dateModified = date("Y-m-d H:i:s");

$sql = "INSERT INTO recipient (s_id, s_name, s_nric, matric_no, s_email, s_eventID ,s_approval_status, s_created) VALUES ('$id', UPPER('$name'), '$nric', '$matricno', '$email', '$eventID' , 'No approval', '$dateCreated')";

if ($conn->query($sql) == TRUE) {
    echo "OK";
} else {
    echo "Unable to save recipient";
}