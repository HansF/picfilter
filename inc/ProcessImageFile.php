<?php

// make sure output buffering is off before we start it
// this will ensure same effect whether or not ob is enabled already
while (ob_get_level()) {
    ob_end_flush();
}
// start output buffering
if (ob_get_length() === false) {
    ob_start();
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ProcessImageFile( $importpath, $file,  $caption){
    //echo $importpath ." -- ".$file."====";
    ResizeTheImage  ($importpath, $file);
    WaterMark       ($importpath, $file, $caption);
    Makethumb       ($importpath, $file);
    MakeMedium       ($importpath, $file);
    DeletePicture       ($importpath, $file);
}
function DeletePicture($importpath, $file){
    $main_img = $importpath.$file; // main big photo / picture
    unlink($main_img);
    return;
}

function WaterMark($importpath, $file, $caption){
    $main_img = $importpath.$file; // main big photo / picture
    //echo "||||WaterMark".$importpath ." -- ".$file."==$main_img==";
    $image      = imagecreatefromjpeg($main_img); // create main graphic
    $image_size     = getimagesize($main_img);  
    $textcolor = imagecolorallocate($image, 255, 255, 255);
    $font = 'C:/Windows/Fonts/arial.ttf';
    imagettftext($image, 15 , 0 , 15, $image_size[1]-20, $textcolor, $font, $caption);
    $importwatermarkpath = "./images/watermark/";
    if (imagejpeg($image,$importwatermarkpath.$file)) //echo "this is win - $importwatermarkpath.$file - ";  
    imagedestroy($image); 
    return; 
}

function ResizeTheImage(  $importpath, $file){
    $filename = $importpath.$file;
    //echo "||||ResizeTheImage".$importpath ." -- ".$file."==$filename==";
    // Set a maximum height and width
    $width = 1280;
    $height = 1280;
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($filename);
   $ratio_orig = $width_orig/$height_orig;
    if ($width/$height > $ratio_orig) {
       $width = $height*$ratio_orig;
    } else {
       $height = $width/$ratio_orig;
    }
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    // Output
    imagejpeg($image_p, $filename, 100);
    return;
}

function Makethumb(  $importpath, $file){
        // The file
    $filename = $importpath.$file;
    //echo "||||Makethumb".$importpath ." -- ".$file."==$filename==";

    // Set a maximum height and width
    $width = 128;
    $height = 128;
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($filename);

    $ratio_orig = $width_orig/$height_orig;

    if ($width/$height > $ratio_orig) {
       $width = $height*$ratio_orig;
    } else {
       $height = $width/$ratio_orig;
    }

    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    $importthumbpath = "./images/thumbs/";
    // Output
    imagejpeg($image_p, $importthumbpath.$file, 60);
    return;
}
function MakeMedium(  $importpath, $file){
        // The file
    $filename = $importpath.$file;
    //echo "||||Makethumb".$importpath ." -- ".$file."==$filename==";

    // Set a maximum height and width
    $width = 640;
    $height = 640;
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($filename);

    $ratio_orig = $width_orig/$height_orig;

    if ($width/$height > $ratio_orig) {
       $width = $height*$ratio_orig;
    } else {
       $height = $width/$ratio_orig;
    }

    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    $importthumbpath = "./images/medium/";
    // Output
    imagejpeg($image_p, $importthumbpath.$file, 60);
    return;
}
?>
