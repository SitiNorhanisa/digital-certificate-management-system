<?php

//to update participant data
include('dbConnection.php');

if ($conn) {
    $output = '';

    $rcp_name = mysqli_real_escape_string($conn, $_POST["rcp_name"]);
    $rcp_nric = mysqli_real_escape_string($conn, $_POST["rcp_nric"]);
    $rcp_email = mysqli_real_escape_string($conn, $_POST["rcp_email"]);
    $rcp_id = $_POST["rcp_id"];

    $modified = date("Y-m-d H:i:s");

    $query = "UPDATE recipient SET s_name='$rcp_name',   
           s_nric='$rcp_nric',   
           s_email='$rcp_email'
           WHERE s_id='" . $rcp_id . "'";
    mysqli_query($conn, $query); //Run query

}
