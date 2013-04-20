<?php

include('inc/header.php');
// On Windows:
$dir    = $importpath;
$files = scandir($dir);

foreach ($files as $file){
	if ($file !="." && $file !="..") ProcessImageFile($importpath.$file);
}

function ProcessImageFile( $file){
echo $file; 
}
include('inc/footer.php');

?>