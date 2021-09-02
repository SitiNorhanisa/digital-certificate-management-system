<?php
//instantiate the class
include("dbConnection.php");

$eventid = $_GET['id'];
$sql = "SELECT * FROM recipient INNER JOIN certificate ON certificate.rcp_id=recipient.s_id INNER JOIN event ON event.eventID=recipient.s_eventID WHERE recipient.s_eventID='$eventid'";

$result = $conn->query($sql);
$msg = "";
if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $rcp_name = $row['s_name'];
        $rcp_id = $row['s_id'];
        $cert_id = $row['cert_id'];
        $event = $row['eventName'];

        $cert = imagecreatefrompng("../assets/images/certificate/$cert_id.png"); //retrieve cert
        $tmp_path = "../Certificate-PNG/$cert_id.png"; //save cert to temporary folder
        imagepng($cert, $tmp_path); //Save image to folder
        imagedestroy($cert);
        $zip = new  ZipArchive;
        $tmp_file = $event . '.zip'; //name of ZIP when download
        if ($zip->open($tmp_file, ZipArchive::CREATE)) { //create ZIP file
            $zip->addFile($tmp_path); //add file to archive
            $zip->close(); //to close zip
            // to force browser download
            header('Content-type: application/zip');
            header('Content-disposition: attachment; filename=' . $event . '.zip');
        } else {
            $msg = "0";
        }
    }
    // ob_end_clean();
    ob_clean();
    if (readfile($tmp_file)) {
        unlink($tmp_file); //Delete the file after download it
    }
} else {
    $msg = "0";
}
