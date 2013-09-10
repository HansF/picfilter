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
    $filename = $importpath.$file;
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

function Makeblur(  $path, $file, $x, $y, $width, $height){
        // The file
	$image = imagecreatefromjpeg($path.$file);
	$imagesizemedium = getimagesize($path.$file);
    //echo "||||Makethumb".$importpath ." -- ".$file."==$filename==";
    $image2 = imagecreate($width, $height);
	imagecopy  ( $image2  , $image  , 0  , 0  , $x  , $y  , $width  , $height);
	$edit = array($x  , $y  , $width  , $height, $imagesizemedium[0], $imagesizemedium[1]);
	imagefilter($image2, IMG_FILTER_PIXELATE,10);
	// imagefilter($image2, IMG_FILTER_GAUSSIAN_BLUR,10);
	// imagefilter($image2, IMG_FILTER_PIXELATE,10);
	imagecopy ($image, $image2, $x, $y, 0, 0, $width, $height);
	$_SESSION['edits'][]=$edit;
    $tmppath = "./images/tmp/";
    // Output
    imagejpeg($image, $tmppath.$file, 100);
    return;
}

function Makebigblur(  $file, $edits){
        // The file
	while ( $edit = array_pop($edits)){
		$image = imagecreatefromjpeg("./images/watermark/".$file);
		$imagesize = getimagesize("./images/watermark/".$file);
		//echo "||||Makethumb".$importpath ." -- ".$file."==$filename==";
		$x = $edit[0]*($imagesize[0]/$edit[4]);
		$y = $edit[1]*($imagesize[1]/$edit[5]);
		$width = $edit[2]*($imagesize[0]/$edit[4]);
		$height = $edit[3]*($imagesize[1]/$edit[5]);
		$image2 = imagecreate($width, $height);
		imagecopy  ( $image2  , $image  , 0  , 0  , $x  , $y  , $width  , $height);
		imagefilter($image2, IMG_FILTER_PIXELATE,10);
		// imagefilter($image2, IMG_FILTER_GAUSSIAN_BLUR,10);
		// imagefilter($image2, IMG_FILTER_PIXELATE,10);
		imagecopy ($image, $image2, $x, $y, 0, 0, $width, $height);
		// Output
		imagejpeg($image, "./images/watermark/".$file, 100);
		}

    return;
}

?>
