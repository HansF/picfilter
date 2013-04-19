<?php

$main_img       = "source.jpg"; // main big photo / picture
$watermark_img  = "watermark.gif"; // use GIF or PNG, JPEG has no tranparency support
$padding        = 3; // distance to border in pixels for watermark image
$opacity        = 100;  // image opacity for transparent watermark

$watermark  = imagecreatefromgif($watermark_img); // create watermark
$image      = imagecreatefromjpeg($main_img); // create main graphic

if(!$image || !$watermark) die("Error: main image or watermark could not be loaded!");


$watermark_size     = getimagesize($watermark_img);
$watermark_width    = $watermark_size[0];  
$watermark_height   = $watermark_size[1];  

$image_size     = getimagesize($main_img);  
$dest_x         = $image_size[0] - $watermark_width - $padding;  
$dest_y         = $image_size[1] - $watermark_height - $padding;


// copy watermark on main image
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $opacity);
//imagestring($image, 1, 5, 5,  'A Simple Text String', $text_color);
$textcolor = imagecolorallocate($image, 255, 255, 255);
//$fontnr = imageloadfont("COOPBL.TTF");
// Write the string at the top left
//imagettftext($image, 5 , 0 , 200, 200, 'Hello world!', $textcolor, 'font.ttf');
$font = 'C:/Windows/Fonts/arial.ttf';
imagettftext($image, 15 , 0 , 15, $image_size[1]-20, $textcolor, $font, 'Hello world!');

// print image to screen
header("content-type: image/jpeg");   
imagejpeg($image);  
imagedestroy($image);  
imagedestroy($watermark);  
?>