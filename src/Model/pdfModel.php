<?php

include("dbConnection.php");
require('../assets/files/fpdf182/fpdf.php');

$event_id = $_GET['id'];

$sql = "SELECT * FROM recipient INNER JOIN certificate ON certificate.rcp_id=recipient.s_id INNER JOIN event ON event.eventID=recipient.s_eventID WHERE recipient.s_eventID='$event_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $rcp_name = $row['s_name'];
        $rcp_id = $row['s_id'];
        $cert_id = $row['cert_id'];
        $event = $row['eventName'];

        #retrieve cert#
        $image = imagecreatefrompng("../assets/images/certificate/$cert_id.png");

        //save to temporary folder
        $tmp_path_png = "../Certificate-PNG/$cert_id.png";
        $tmp_path_pdf = "../Certificate-PDF/$cert_id.pdf";

        imagepng($image, $tmp_path_png); //Save image to folder
        imagedestroy($image);

        #Convert PNG to PDF#

        //default set Potrait, millimeter, A4 
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        //image source, x, y, width, height
        $pdf->Image($tmp_path_png, 0, 0, 210.5, 0);
        //Output(dest, name)
        $pdf->Output('F', $tmp_path_pdf); //F: save to a local file

        #Save PDF as ZIP#

        $zip = new  ZipArchive;
        $tmp_file = $event . '.zip'; //name of ZIP when download
        if ($zip->open($tmp_file, ZipArchive::CREATE)) {
            $zip->addFile($tmp_path_pdf);
            $zip->close();
            header('Content-type: application/zip');
            header('Content-disposition: attachment; filename=' . $event . '.zip');
        } else {
            $msg = "0";
        }
    }
    // ob_end_clean();
    ob_clean(); //Clean output buffer
    if (readfile($tmp_file)) {
        unlink($tmp_file); //Delete the file after download it
    }
} else {
    $msg = "0";
}
