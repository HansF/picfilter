<?php

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "FaceDetector.php";

$face_detect = new Face_Detector('detection.dat');
$dir = "E:/xampp/htdocs/picfilter/img/";
$files = scandir("$dir");

while($file = array_pop($files)){
$face_detect->face_detect("$dir$file");
$face_detect->toJpeg();
}
?>
