<?php
include("dbConnection.php");

session_start();
$userID = $_SESSION['userID'];

//Return recipient information
$sql = "SELECT * FROM event WHERE user_id='$userID' ORDER BY eventID DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {

        // $data[] = $row;
        $eventId = $row['eventID'];
        $eventName = $row['eventName'];
        $date = $row['eventDate']; //yyyy-mm-dd
        $eventVenue  = $row['eventVenue'];
        $eventSession = $row['eventSession'];

        //Row count for each event
        $sqlRcp = "SELECT * FROM recipient WHERE s_eventID='$eventId'";
        $resultRcp = $conn->query($sqlRcp);
        $rowCount = $resultRcp->num_rows;

        // Creating timestamp from given date
        $timestamp = strtotime($date);
        $new_date = date("d-m-Y", $timestamp); //dd-mm-yyyy
        $arrayDate = explode("-", $new_date);
        $date = $arrayDate[0];
        $monthNum = $arrayDate[1];
        $year = $arrayDate[2];
        // Use mktime() and date() function to
        // convert number to month name
        $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
        $eventDate = $date . " " . $monthName . " " . $year;

        $data[] = array("eventId" => $eventId, "eventName" => $eventName, "eventDate" => $eventDate, "eventVenue" => $eventVenue, "eventSession" => $eventSession, "rowCount" => $rowCount);
    }
}

//Returning JSON Format Data as Response to Ajax Call
echo json_encode($data);
