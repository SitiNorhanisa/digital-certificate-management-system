<?php

include('dbConnection.php');
//Session start
session_start();

//get event id from uploadCSV.php
$eventID = $_SESSION['eventID'];

if ($conn) {

    $file = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($file, "r"); //open file at temp_file and read the file
    $csv_created = date("Y-m-d H:i:s");
    $csv_modified = date("Y-m-d H:i:s");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {

        $tableName = rtrim($_FILES['csvfile']['name'], ".csv");

        if ($i == 0) {
            $i++;
        } else {

            //Add csv data to recipient table
            $query = "INSERT INTO recipient ( 
                s_name, 
                s_nric, 
                matric_no,
                s_email, 
                s_eventID,
                s_approval_status,
                s_email_status, 
                s_email_date, 
                s_created, 
                s_modified ) 
                VALUES (
                    UPPER('$cont[1]'),  
                    '$cont[2]',  
                    UPPER('$cont[3]'), 
                    '$cont[4]', 
                    '$eventID', 
                   'No approval', 
                    '0', 
                    '', 
                    '$csv_created', 
                    '$csv_modified' 
                    )"; //end INSERT statement

            echo $query . "</br>";
            mysqli_query($conn, $query); //Run query

        } // end else
    } //end while
} else {
    echo "0";
}