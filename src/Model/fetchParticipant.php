<?php
//fetch.php  

include('dbConnection.php');

if (isset($_POST["rcpID"])) {
    $query = "SELECT * FROM recipient WHERE s_id = '" . $_POST["rcpID"] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
