<?php

include("dbConnection.php");

$rcp_id = $_GET["rcpId"];

$sql = "SELECT * FROM certificate INNER JOIN recipient ON recipient.s_id = certificate.rcp_id INNER JOIN event ON event.eventID = recipient.s_eventID WHERE certificate.rcp_id='$rcp_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $certID = $row['cert_id'];
        $rcpName = $row['s_name'];
        $rcpIC = $row['s_nric'];
        $matricno = $row['matric_no'];
        $rcpCreated = $row['s_created'];
        $dateApproved = $row['date_approved'];
        $eventName = $row['eventName'];
        $eventDate = $row['eventDate'];
        $approver = $row['approved_by'];

        $data[] = array('certID' => $certID, 'rcpName' => $rcpName, 'rcpIC' => $rcpIC, "matricno" => $matricno, 'eventName' => $eventName, 'created' => $rcpCreated, 'dateApproved' => $dateApproved, 'approver' => $approver, "eventDate" => $eventDate);
    }

    echo json_encode($data);
} else {
    echo 0;
}
