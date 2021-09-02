<?php
//To preview a cert

//include database configuration file
include("dbConnection.php");
$eventID = $_GET["id"];

$query = "SELECT * FROM recipient WHERE s_eventID='$eventID'";
$query2 = "SELECT * FROM event WHERE eventID='$eventID'";
$query3 = "SELECT * FROM chair";

$fire = mysqli_query($conn, $query); //fetching data from recipent table
$fire2 = mysqli_query($conn, $query2); //fetching data from event table
$fire3 = mysqli_query($conn, $query3); //fetching data from chair table

while ($row = mysqli_fetch_array($fire)) {
    while ($row2 = mysqli_fetch_array($fire2)) {
        while ($row3 = mysqli_fetch_array($fire3)) {

            $sign = $row3["signature"];
            $chairname = $row3["chair_name"];

            header('Content-type:image/png');

            // Font type
            $font_header = realpath('../assets/font/EdwardianScriptITC.ttf');
            $font = realpath('../assets/font/Garamond.ttf');

            // Image

            $image = imagecreatefrompng("../assets/images/custom/" . $row2['eventCert'] . "");
            $utmlogo =  imagecreatefrompng("../assets/images/logo-utm.png");
            $persakalogo = imagecreatefrompng("../assets/images/logo-persaka.png");
            $imgsign = imagecreatefrompng("../assets/images/signature/" . $sign . "");

            // Font color
            $color = imagecolorallocate($image, 23, 197, 233); // imagecolorallocate($image, $red, $green, $blue)
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
            $header = "Certificate of Participation";
            $sub_header1 = "This is to certify that";
            $sub_header2 = "has participated in";
            $sub_header3 = "at";
            $sub_header4 = "Organized by";
            $chairdetail = "Chair";
            $chairdetail2 = "School of Computing";
            $chairdetail3 = "Faculty of Engineering";
            $chairdetail4 = "Universiti Teknologi Malaysia";

            $date = $row2['eventDate']; //Date of event
            $eventName = $row2['eventName'];
            $name = $row['s_name'];
            $ic = $row['s_nric'];
            $venue = $row2['eventVenue'];
            $uniqid = uniqid();
            $certID = $ic . $uniqid;

            // Get image Width and Height
            $image_width = imagesx($image);
            $image_height = imagesy($image);

            $resized = imagecreatetruecolor(2481, 3510);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, 2481, 3510, $image_width, $image_height);
            imagepng($resized, "../assets/images/custom/" . $row2['eventCert'] . "");
            $resizedname = "" . $row2['eventCert'] . "";

            $sqlUpdate = "UPDATE event 
                SET eventCert='$resizedname'
               WHERE eventID='$eventID'";
            $fire = mysqli_query($conn, $sqlUpdate);

            $imgresized = imagecreatefrompng("../assets/images/custom/" . $row2['eventCert'] . "");
            $resized_width = imagesx($imgresized);
            $resized_height = imagesy($imgresized);

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

            $text_box2 = imagettfbbox($font_size2, $angle, $font, $name);
            $text_box3 = imagettfbbox($font_size2, $angle, $font, $ic);
            $text_box4 = imagettfbbox($font_size2, $angle, $font, $eventName);
            $text_box = imagettfbbox($font_size, $angle, $font, $date);
            $text_box5 = imagettfbbox($font_size2, $angle, $font, $venue);
            $text_box6 = imagettfbbox($font_size, $angle, $font, $certID);
            $text_box7 = imagettfbbox($font_size2, $angle, $font, $chairname);


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
            $x_header = ($resized_width / 2) - ($text_widthHeader / 2);
            $y_header = ($resized_height / 2) - ($text_heightHeader / 2);

            $x_subHeader1 = ($resized_width / 2) - ($text_widthSubHeader1 / 2);
            $y_subHeader1 = ($resized_height / 2) - ($text_heightSubHeader1 / 2);

            $x_subHeader2 = ($resized_width / 2) - ($text_widthSubHeader2 / 2);
            $y_subHeader2 = ($resized_height / 2) - ($text_heightSubHeader2 / 2);

            $x_subHeader3 = ($resized_width / 2) - ($text_widthSubHeader3 / 2);
            $y_subHeader3 = ($image_height / 2) - ($text_heightSubHeader3 / 2);

            $x_subHeader4 = ($resized_width / 2) - ($text_widthSubHeader4 / 2);
            $y_subHeader4 = ($resized_height / 2) - ($text_heightSubHeader4 / 2);

            $x_chairDtl = ($resized_width / 2) - ($text_widthChairDtl / 2);
            $y_chairDtl = ($resized_height / 2) - ($text_widthChairDtl / 2);

            $x_chairDtl2 = ($resized_width / 2) - ($text_widthChairDtl2 / 2);
            $y_chairDtl2 = ($resized_height / 2) - ($text_widthChairDtl2 / 2);

            $x_chairDtl3 = ($resized_width / 2) - ($text_widthChairDtl3 / 2);
            $y_chairDtl3 = ($resized_height / 2) - ($text_widthChairDtl3 / 2);

            $x_chairDtl4 = ($resized_width / 2) - ($text_widthChairDtl4 / 2);
            $y_chairDtl4 = ($resized_height / 2) - ($text_widthChairDtl4 / 2);

            $x = ($resized_width / 2) - ($text_width / 2);
            $y = ($resized_height / 2) - ($text_height / 2);

            $x2 = ($resized_width / 2) - ($text_width2 / 2);
            $y2 = ($resized_height / 2) - ($text_height2 / 2);

            $x3 = ($resized_width / 2) - ($text_width3 / 2);
            $y3 = ($resized_height / 2) - ($text_height3 / 2);

            $x4 = ($resized_width / 2) - ($text_width4 / 2);
            $y4 = ($resized_height / 2) - ($text_height4 / 2);

            $x5 = ($resized_width / 2) - ($text_width5 / 2);
            $y5 = ($resized_height / 2) - ($text_height5 / 2);

            $x6 = ($resized_width / 2) - ($text_width6 / 2);
            $y6 = ($resized_height / 2) - ($text_height6 / 2);

            $x7 = ($resized_width / 2) - ($text_width7 / 2);
            $y7 = ($resized_height / 2) - ($text_height7 / 2);

            imagettftext($imgresized, $font_sizeHeader, $angle, $x_header, 920, $color_header, $font_header, $header);
            imagettftext($imgresized, $font_size, $angle, $x_subHeader1, 1055, $color_main, $font, $sub_header1);
            imagettftext($imgresized, $font_size2, $angle, $x2, 1200, $color_main, $font, $name);
            imagettftext($imgresized, $font_size2, $angle, $x3, 1300, $color_main, $font, $ic);
            imagettftext($imgresized, $font_size, $angle, $x_subHeader2, 1405, $color_main, $font, $sub_header2);
            imagettftext($imgresized, $font_size2, $angle, $x4, 1550, $color_main, $font, $eventName);
            imagettftext($imgresized, $font_size, $angle, $x, 1650, $color_main, $font, $date);
            imagettftext($imgresized, $font_size, $angle, $x_subHeader3, 1720, $color_main, $font, $sub_header3);
            imagettftext($imgresized, $font_size2, $angle, $x5, 1820, $color_main, $font, $venue);
            imagettftext($imgresized, $font_size, $angle, $x_subHeader4, 1920, $color_main, $font, $sub_header4);
            imagettftext($imgresized, $font_size2, $angle, $x7, 2560, $color_main, $font, $chairname);
            imagettftext($imgresized, $font_size, $angle, $x_chairDtl, 2660, $color_header, $font, $chairdetail);
            imagettftext($imgresized, $font_size, $angle, $x_chairDtl2, 2720, $color_header, $font, $chairdetail2);
            imagettftext($imgresized, $font_size, $angle, $x_chairDtl3, 2780, $color_header, $font, $chairdetail3);
            imagettftext($imgresized, $font_size, $angle, $x_chairDtl4, 2840, $color_header, $font, $chairdetail4);
            imagettftext($imgresized, $font_size, $angle, $x6, 3300, $color_main, $font, $certID);

            // Get UTM, PERSAKA logo and signature size
            list($utmwidth, $utmheight) = getimagesize("../assets/images/logo-utm.png");
            list($persakawidth, $persakaheight) = getimagesize("../assets/images/logo-persaka.png");
            list($signwidth, $signheight) = getimagesize("../assets/images/signature/" . $sign . "");

            // center of UTM logo, PERSAKA logo and signature image
            $utmx = ($resized_width / 2) - ($utmwidth / 2);
            $persakax = ($resized_width / 2) - ($persakawidth / 2);
            $signx = ($resized_width / 2) - ($signwidth / 2); //center the signature

            // Save transparency
            imagealphablending($imgresized, false);
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
            imagecopymerge($imgresized, $utmlogo, $utmx, 350, 0, 0, $utmwidth, $utmheight, 100);
            imagecopymerge($imgresized, $persakalogo, $persakax, 2000, 0, 0, $persakawidth, $persakaheight, 100);
            imagecopymerge($imgresized, $imgsign, $signx, 2250, 0, 0, $signwidth, $signheight, 100);

            imagepng($imgresized); //To preview the cert
            // imagejpeg($image, "certificate/$name.jpg"); //Location to store cert
            imagedestroy($imgresized);
            imagedestroy($utmlogo);
            imagedestroy($persakalogo);
            imagedestroy($imgsign);
        }
    }
}
