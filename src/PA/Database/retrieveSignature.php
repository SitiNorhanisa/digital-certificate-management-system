<?php
//To retrieve a signature

//include database configuration file
include("dbConnection.php");

$query = "SELECT * FROM chair";

$fire = mysqli_query($conn, $query); //fetching data from chair table

while ($row = mysqli_fetch_array($fire)) {

        header('Content-type:image/jpeg');
        $font = realpath('../assets/font/Raleway-Bold.ttf');
        $image = imagecreatefrompng("../assets/images/custom/" . $row2['eventCert'] . "");
        $color = imagecolorallocate($image, 23, 197, 233);
        $color_date = imagecolorallocate($image, 10, 62, 103);
        $font_size = 36;
        $font_size2 = 46;
        $angle = 0;

        $date = $row2['eventDate']; //Date of event
        $eventName = $row2['eventName'];
        $name = $row['s_name'];
        $ic = $row['s_nric'];
        $venue = "Dewan Kejora";

        // Get image Width and Height
        $image_width = imagesx($image);
        $image_height = imagesy($image);

        // Get Bounding Box Size
        $text_box = imagettfbbox($font_size, $angle, $font, $date);
        $text_box2 = imagettfbbox($font_size2, $angle, $font, $name);
        $text_box3 = imagettfbbox($font_size2, $angle, $font, $ic);
        $text_box4 = imagettfbbox($font_size2, $angle, $font, $eventName);
        $text_box5 = imagettfbbox($font_size2, $angle, $font, $venue);

        // Get your Text Width and Height
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

        // Calculate coordinates of the text
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

        // imagettftext($image, $font_size, 0, 1100, 1997, $color_date, $font, $date);
        imagettftext($image, $font_size, $angle, $x, 1997, $color_date, $font, $date);
        imagettftext($image, $font_size2, $angle, $x2, 1570, $color_date, $font, $name);
        imagettftext($image, $font_size2, $angle, $x3, 1650, $color_date, $font, $ic);
        imagettftext($image, $font_size2, $angle, $x4, 1900, $color_date, $font, $eventName);
        imagettftext($image, $font_size2, $angle, $x5, 2165, $color_date, $font, $venue);

        imagepng($image); //To preview the cert
        imagedestroy($image);
}
