<?php

include("dbConnection.php");

$matric_no = $_GET['matric_no'];

$sql = "SELECT * FROM recipient INNER JOIN event ON event.eventID=recipient.s_eventID WHERE matric_no='$matric_no' ORDER BY s_modified DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {

        $id = $row['s_id'];
        $name = $row['s_name'];
        $program = $row['eventName'];
        $progress = $row['s_approval_status'];
        $date = $row['s_modified'];

        $data[] = array("id" => $id, "name" => $name, "program" => $program, "progress" => $progress, "date" => $date);
    }
    //Returning JSON Format Data as Response to Ajax Call
    echo json_encode($data);
} else {
    echo '0';
}
