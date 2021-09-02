<?php

include('dbConnection.php');

$rcpID = $_GET['id'];

$sql = "UPDATE recipient SET s_approval_status='rejected' WHERE s_id=$rcpID";
//$result = $conn->query($sql);

if ($conn->query($sql) == TRUE) {
    echo "OK";
} else {
    echo "Unable to add recipient";
}
