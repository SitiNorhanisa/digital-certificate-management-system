<?php

include("dbConnection.php");

$rcp_id = $_GET["rcpId"];

$sql = "SELECT * FROM recipient INNER JOIN event ON event.eventID = recipient.s_eventID WHERE recipient.s_id='$rcp_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $rcp_id = $row['s_id'];
        $rcpName = $row['s_name'];
        $rcpIC = $row['s_nric'];
        $matricno = $row['matric_no'];
        $program = $row['eventName'];
        $progVenue = $row['eventVenue'];
        $progDate = $row['eventDate'];
        $progSession = $row['eventSession'];
        $rcpEmail = $row['s_email'];

        $data[] = array('rcpID' => $rcp_id, 'rcpName' => $rcpName, 'rcpIC' => $rcpIC, "matricno"=> $matricno ,'program' => $program, 'progVenue' => $progVenue, 'progDate' => $progDate, 'progSession' => $progSession, 'rcpEmail' => $rcpEmail,);
    }

    echo json_encode($data);
} else {
    echo 0;
}
