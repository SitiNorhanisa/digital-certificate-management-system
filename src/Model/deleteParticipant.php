<?php

include('dbConnection.php');

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['rcpid'];

//Deleting Recipient
if (!empty($id)) {
    $sql = "DELETE FROM recipient WHERE s_id = {$id}";
    if ($conn->query($sql) == TRUE) {
        // echo "Recipient deleted successfully";
        echo 1;
    } else {
        // echo "Unable to delete Recipient";
        echo 0;
    }
}
