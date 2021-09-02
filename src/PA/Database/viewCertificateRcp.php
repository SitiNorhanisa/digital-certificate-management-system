<?php

include("dbConnection.php");

$rcpID = $_GET['rcpid'];

$sql = "SELECT * FROM certificate WHERE rcp_id='$rcpID'";

$fire = mysqli_query($conn, $sql);

if ($fire->num_rows > 0) {
    while ($row = mysqli_fetch_array($fire)) {
        $certID = $row['cert_id'];

        $image = imagecreatefrompng("../../assets/images/certificate/" . $certID . "");

        imagepng($image); //To preview the cert
        imagedestroy($image);
    }
    
} else {
    echo 0;
}
