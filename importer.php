<?php

include('inc/header.php');
if (isset($_GET['caption'])){
    $dir    = $importpath;
    $files = scandir($dir);
    foreach ($files as $file){
            if ($file !="." && $file !="..") ProcessImageFile($importpath.$file);
    }   
}else{
    echo "gimme a caption dude";
    ?>
<form method="GET" action="">
    <input type="text" name="caption">
    <input type="submit">
</form>

    <?
}


function ProcessImageFile( $file){
echo $file; 
}
include('inc/footer.php');

?>