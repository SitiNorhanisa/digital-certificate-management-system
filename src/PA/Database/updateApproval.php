<?php

include('dbConnection.php');
$path = "";
$dateModified = date("Y-m-d H:i:s");
$rcpID = $_GET['id'];
$approvalStatus = $_GET['status'];

if ($approvalStatus == "approved") {
    // echo ("Button approve clicked");

    $queryRcp = "SELECT * FROM recipient WHERE s_id='$rcpID'"; //retrieve recipient table
    $fire = mysqli_query($conn, $queryRcp);

    while ($rowRcp = mysqli_fetch_array($fire)) {
        $eventID = $rowRcp['s_eventID'];

        $queryEvent = "SELECT * FROM event WHERE eventID='$eventID'"; //retrieve event table
        $fireEvent = mysqli_query($conn, $queryEvent);

        while ($rowEvent = mysqli_fetch_array($fireEvent)) {
            $certImage = $rowEvent['eventCert']; //to get image from event table

            $queryChair = "SELECT * FROM chair"; //retrieve chair table

            $fireChair = mysqli_query($conn, $queryChair);

            while ($rowChair = mysqli_fetch_array($fireChair)) {

                $sign = $rowChair["signature"]; //get signature
                $chairName = $rowChair["chair_name"];

                //Write the details on cert
                header('Content-type:image/jpeg');

                // Font type
                $font_header = realpath('../../assets/font/EdwardianScriptITC.ttf');
                $font = realpath('../../assets/font/Garamond.ttf');

                // Image
                $image = imagecreatefrompng("../../assets/images/custom/" . $certImage . ""); //retrieve cert background
                $utmlogo =  imagecreatefrompng("../../assets/images/logo-utm.png");
                $persakalogo = imagecreatefrompng("../../assets/images/logo-persaka.png");
                $imgsign = imagecreatefrompng("../../assets/images/signature/" . $sign . ""); //retrieve signature image

                // Font color
                $color = imagecolorallocate($image, 23, 197, 233);
                $color_date = imagecolorallocate($image, 10, 62, 103);
                $color_header = imagecolorallocate($image, 0, 0, 0);
                $color_main = imagecolorallocate($image, 128, 102, 51);

                // Font size
                $font_sizeHeader = 150;
                $font_size = 36;
                $font_size2 = 55;
                $font_size3 = 26;
                $angle = 0;

                // Script
                // Script
                $header = "Certificate of Participation";
                $sub_header1 = "This is to certify that";
                $sub_header2 = "has participated in";
                $sub_header3 = "at";
                $sub_header4 = "Organized by";
                $chairdetail = "Chair";
                $chairdetail2 = "School of Computing";
                $chairdetail3 = "Faculty of Engineering";
                $chairdetail4 = "Universiti Teknologi Malaysia";

                // $date = date('d F, Y'); //Current date
                $eventDate = $rowEvent['eventDate'];
                $name = $rowRcp['s_name'];
                // $name = "Siti Nabilah Siti Nurbayah binti Nordin"; //Single recipient
                $ic = $rowRcp['s_nric'];
                $eventName = $rowEvent['eventName'];
                $venue = $rowEvent['eventVenue'];
                $uniqid = uniqid();
                $certName = "$ic" . $uniqid . ".png";
                $certID = $ic . $uniqid;

                // Get image Width and Height
                $image_width = imagesx($image);
                $image_height = imagesy($image);

                // Get Bounding Box Size
                $text_boxHeader = imagettfbbox($font_sizeHeader, $angle, $font_header, $header);
                $text_boxSubHeader1 = imagettfbbox($font_size, $angle, $font, $sub_header1);
                $text_boxSubHeader2 = imagettfbbox($font_size, $angle, $font, $sub_header2);
                $text_boxSubHeader3 = imagettfbbox($font_size, $angle, $font, $sub_header3);
                $text_boxSubHeader4 = imagettfbbox($font_size, $angle, $font, $sub_header4);
                $text_boxChairdetail = imagettfbbox($font_size, $angle, $font, $chairdetail);
                $text_boxChairdetail2 = imagettfbbox($font_size, $angle, $font, $chairdetail2);
                $text_boxChairdetail3 = imagettfbbox($font_size, $angle, $font, $chairdetail3);
                $text_boxChairdetail4 = imagettfbbox($font_size, $angle, $font, $chairdetail4);

                $text_box = imagettfbbox($font_size, $angle, $font, $eventDate);
                $text_box2 = imagettfbbox($font_size2, $angle, $font, $name);
                $text_box3 = imagettfbbox($font_size2, $angle, $font, $ic);
                $text_box4 = imagettfbbox($font_size2, $angle, $font, $eventName);
                $text_box5 = imagettfbbox($font_size2, $angle, $font, $venue);
                $text_box6 = imagettfbbox($font_size, $angle, $font, $certID);
                $text_box7 = imagettfbbox($font_size2, $angle, $font, $chairName);

                // Get your Text Width and Height
                $text_widthHeader = $text_boxHeader[2] - $text_boxHeader[0];
                $text_heightHeader = $text_boxHeader[7] - $text_boxHeader[1];

                $text_widthSubHeader1 = $text_boxSubHeader1[2] - $text_boxSubHeader1[0];
                $text_heightSubHeader1 = $text_boxSubHeader1[7] - $text_boxSubHeader1[1];

                $text_widthSubHeader2 = $text_boxSubHeader2[2] - $text_boxSubHeader2[0];
                $text_heightSubHeader2 = $text_boxSubHeader2[7] - $text_boxSubHeader2[1];

                $text_widthSubHeader3 = $text_boxSubHeader3[2] - $text_boxSubHeader3[0];
                $text_heightSubHeader3 = $text_boxSubHeader3[7] - $text_boxSubHeader3[1];

                $text_widthSubHeader4 = $text_boxSubHeader4[2] - $text_boxSubHeader4[0];
                $text_heightSubHeader4 = $text_boxSubHeader4[7] - $text_boxSubHeader4[1];

                $text_widthChairDtl = $text_boxChairdetail[2] - $text_boxChairdetail[0];
                $text_heightChairDtl = $text_boxChairdetail[7] - $text_boxChairdetail[1];

                $text_widthChairDtl2 = $text_boxChairdetail2[2] - $text_boxChairdetail2[0];
                $text_heightChairDtl2 = $text_boxChairdetail2[7] - $text_boxChairdetail2[1];

                $text_widthChairDtl3 = $text_boxChairdetail3[2] - $text_boxChairdetail3[0];
                $text_heightChairDtl3 = $text_boxChairdetail3[7] - $text_boxChairdetail3[1];

                $text_widthChairDtl4 = $text_boxChairdetail4[2] - $text_boxChairdetail4[0];
                $text_heightChairDtl3 = $text_boxChairdetail4[7] - $text_boxChairdetail4[1];

                $text_width = $text_box[2] - $text_box[0];
                $text_height = $text_box[7] - $text_box[1];

                $text_width2 = $text_box2[2] - $text_box2[0];
                $text_height2 = $text_box2[7] - $text_box2[1];

                $text_width3 = $text_box3[2] - $text_box3[0];
                $text_height3 = $text_box3[7] - $text_box3[1];

                $text_width4 = $text_box4[2] - $text_box4[0];
                $text_height4 = $text_box4[7] - $text_box4[1];

                $text_width5 = $text_box5[2] - $text_box5[0];
                $text_height5 = $text_box5[7] - $text_box5[1];

                $text_width6 = $text_box6[2] - $text_box6[0];
                $text_height6 = $text_box6[7] - $text_box6[1];

                $text_width7 = $text_box7[2] - $text_box7[0];
                $text_height7 = $text_box7[7] - $text_box7[1];

                // Calculate coordinates of the text
                $x_header = ($image_width / 2) - ($text_widthHeader / 2);
                $y_header = ($image_height / 2) - ($text_heightHeader / 2);

                $x_subHeader1 = ($image_width / 2) - ($text_widthSubHeader1 / 2);
                $y_subHeader1 = ($image_height / 2) - ($text_heightSubHeader1 / 2);

                $x_subHeader2 = ($image_width / 2) - ($text_widthSubHeader2 / 2);
                $y_subHeader2 = ($image_height / 2) - ($text_heightSubHeader2 / 2);

                $x_subHeader3 = ($image_width / 2) - ($text_widthSubHeader3 / 2);
                $y_subHeader3 = ($image_height / 2) - ($text_heightSubHeader3 / 2);

                $x_subHeader4 = ($image_width / 2) - ($text_widthSubHeader4 / 2);
                $y_subHeader4 = ($image_height / 2) - ($text_heightSubHeader4 / 2);

                $x_chairDtl = ($image_width / 2) - ($text_widthChairDtl / 2);
                $y_chairDtl = ($image_height / 2) - ($text_widthChairDtl / 2);

                $x_chairDtl2 = ($image_width / 2) - ($text_widthChairDtl2 / 2);
                $y_chairDtl2 = ($image_height / 2) - ($text_widthChairDtl2 / 2);

                $x_chairDtl3 = ($image_width / 2) - ($text_widthChairDtl3 / 2);
                $y_chairDtl3 = ($image_height / 2) - ($text_widthChairDtl3 / 2);

                $x_chairDtl4 = ($image_width / 2) - ($text_widthChairDtl4 / 2);
                $y_chairDtl4 = ($image_height / 2) - ($text_widthChairDtl4 / 2);

                $x = ($image_width / 2) - ($text_width / 2);
                $y = ($image_height / 2) - ($text_height / 2);

                $x2 = ($image_width / 2) - ($text_width2 / 2);
                $y2 = ($image_height / 2) - ($text_height2 / 2);

                $x3 = ($image_width / 2) - ($text_width3 / 2);
                $y3 = ($image_height / 2) - ($text_height3 / 2);

                $x4 = ($image_width / 2) - ($text_width4 / 2);
                $y4 = ($image_height / 2) - ($text_height4 / 2);

                $x5 = ($image_width / 2) - ($text_width5 / 2);
                $y5 = ($image_height / 2) - ($text_height5 / 2);

                $x6 = ($image_width / 2) - ($text_width6 / 2);
                $y6 = ($image_height / 2) - ($text_height6 / 2);

                $x7 = ($image_width / 2) - ($text_width7 / 2);
                $y7 = ($image_height / 2) - ($text_height7 / 2);

                // For custom design
                if ($certImage != "sample-latest-4.png") {
                    // imagettftext($image, $font_size, 0, 1100, 1997, $color_date, $font, $date);
                    imagettftext($image, $font_sizeHeader, $angle, $x_header, 920, $color_header, $font_header, $header);
                    imagettftext($image, $font_size, $angle, $x_subHeader1, 1055, $color_main, $font, $sub_header1);

                    imagettftext($image, $font_size2, $angle, $x2, 1200, $color_main, $font, $name);
                    imagettftext($image, $font_size2, $angle, $x3, 1300, $color_main, $font, $ic);
                    imagettftext($image, $font_size, $angle, $x_subHeader2, 1405, $color_main, $font, $sub_header2);
                    imagettftext($image, $font_size2, $angle, $x4, 1550, $color_main, $font, $eventName);
                    imagettftext($image, $font_size, $angle, $x, 1650, $color_main, $font, $eventDate);
                    imagettftext($image, $font_size, $angle, $x_subHeader3, 1720, $color_main, $font, $sub_header3);
                    imagettftext($image, $font_size2, $angle, $x5, 1820, $color_main, $font, $venue);
                    imagettftext($image, $font_size, $angle, $x_subHeader4, 1920, $color_main, $font, $sub_header4);
                    imagettftext($image, $font_size2, $angle, $x7, 2560, $color_main, $font, $chairName);
                    imagettftext($image, $font_size, $angle, $x_chairDtl, 2660, $color_header, $font, $chairdetail);
                    imagettftext($image, $font_size, $angle, $x_chairDtl2, 2720, $color_header, $font, $chairdetail2);
                    imagettftext($image, $font_size, $angle, $x_chairDtl3, 2780, $color_header, $font, $chairdetail3);
                    imagettftext($image, $font_size, $angle, $x_chairDtl4, 2840, $color_header, $font, $chairdetail4);
                    imagettftext($image, $font_size, $angle, $x6, 3300, $color_main, $font, $certID);

                    // Get UTM, PERSAKA logo and signature size
                    list($utmwidth, $utmheight) = getimagesize("../../assets/images/logo-utm.png");
                    list($persakawidth, $persakaheight) = getimagesize("../../assets/images/logo-persaka.png");
                    list($signwidth, $signheight) = getimagesize("../../assets/images/signature/" . $sign . "");

                    // center of UTM logo, PERSAKA logo and signature image
                    $utmx = ($image_width / 2) - ($utmwidth / 2);
                    $persakax = ($image_width / 2) - ($persakawidth / 2);
                    $signx = ($image_width / 2) - ($signwidth / 2);

                    // Save transparency
                    imagealphablending($image, false);
                    imagesavealpha($utmlogo, true);
                    imagesavealpha($persakalogo, true);
                    imagesavealpha($imgsign, true);

                    // Prepare alpha channel for transparent background
                    $colorutm = imagecolorallocatealpha($utmlogo, 0, 0, 0, 127);
                    imagecolortransparent($utmlogo, $colorutm);
                    $alpha_channel_persaka = imagecolorallocatealpha($persakalogo, 0, 0, 0, 127);
                    imagecolortransparent($persakalogo, $alpha_channel_persaka);
                    $alpha_channel_sign = imagecolorallocatealpha($imgsign, 0, 0, 0, 127);

                    // Fill image
                    imagefill($utmlogo, 0, 0, $colorutm);
                    imagefill($persakalogo, 0, 0, $alpha_channel_persaka);
                    // imagefill($imgsign, 0, 0, $alpha_channel_sign);

                    // Copy and merge
                    imagecopymerge($image, $utmlogo, $utmx, 350, 0, 0, $utmwidth, $utmheight, 100);
                    imagecopymerge($image, $persakalogo, $persakax, 2000, 0, 0, $persakawidth, $persakaheight, 100);
                    imagecopymerge($image, $imgsign, $signx, 2250, 0, 0, $signwidth, $signheight, 100);

                    $targetDir = "../../assets/images/certificate/"; //To store rcp cert
                    $certRcpPath = $targetDir . $certName; //To store rcp cert
                    imagepng($image, $certRcpPath); //location to store cert
                    // imagejpeg($image, "certificate/$name.jpg"); //Location to store cert
                    imagedestroy($image);
                    imagedestroy($utmlogo);
                    imagedestroy($persakalogo);
                    imagedestroy($imgsign);
                }
                // for ready-made template 
                else {
                    imagettftext($image, $font_size2, $angle, $x2, 1200, $color_main, $font, $name);
                    imagettftext($image, $font_size2, $angle, $x3, 1300, $color_main, $font, $ic);
                    imagettftext($image, $font_size2, $angle, $x4, 1550, $color_main, $font, $eventName);
                    imagettftext($image, $font_size, $angle, $x, 1650, $color_main, $font, $eventDate);
                    imagettftext($image, $font_size2, $angle, $x5, 1820, $color_main, $font, $venue);
                    imagettftext($image, $font_size2, $angle, $x7, 2560, $color_main, $font, $chairName);
                    imagettftext($image, $font_size, $angle, $x6, 3300, $color_main, $font, $certID);

                    // Get UTM, PERSAKA logo and signature size
                    list($signwidth, $signheight) = getimagesize("../../assets/images/signature/" . $sign . "");

                    // center of UTM logo, PERSAKA logo and signature image
                    $signx = ($image_width / 2) - ($signwidth / 2);

                    imagealphablending($image, false);
                    imagesavealpha($imgsign, true);

                    // Copy and merge
                    imagecopymerge($image, $imgsign, $signx, 2250, 0, 0, $signwidth, $signheight, 100);

                    $targetDir = "../../assets/images/certificate/"; //To store rcp cert
                    $certRcpPath = $targetDir . $certName; //To store rcp cert
                    imagepng($image, $certRcpPath); //location to store cert
                    imagedestroy($image);
                    imagedestroy($imgsign);
                }

                $sql = "UPDATE recipient 
                SET 
                s_approval_status='Approved', cert_id='$certID', s_modified='$dateModified' 
                WHERE s_id=$rcpID;
                INSERT INTO certificate 
                (cert_id, date_created, approved_by, date_approved, approval_status, rcp_id) 
                VALUES ('$certID', '$dateModified', '$chairName', '$dateModified', 'Approved', '$rcpID')";
                //$result = $conn->query($sql);

                if ($conn->multi_query($sql) == TRUE) {
                    echo "OK";
                } else {
                    echo "Fail to approve the certificate";
                }
            }
        }
    }
} else if ($approvalStatus == "rejected") {
    $sql = "UPDATE recipient SET s_approval_status='Rejected', s_modified='$dateModified' WHERE s_id=$rcpID;
            INSERT INTO certificate (date_created, date_approved, approval_status, rcp_id) VALUES ('$dateModified', '$dateModified', 'Rejected', '$rcpID')";
    //$result = $conn->query($sql);

    if ($conn->multi_query($sql) == TRUE) {
        echo "OK";
    } else {
        echo "Fail to approve certificate";
    }
} else {
    echo ("ERROR");
}
