<?php

include('inc/header.php');
include('inc/settings.php');
include('inc/ProcessImageFile.php');
$start = time();
if (isset($_GET['caption'])){
    $dir    = $importpath;
    $files = scandir($dir);
    $counter = 0;
    foreach ($files as $file){
            if ($file !="." && $file !=".."){ 
                ProcessImageFile($importpath,$file,$_GET['caption']);
                $db = sqlite_open($dbpath, 0777, $sqliteerror) ;
                sqlite_query($db, "INSERT INTO 'images' ('path','couple') VALUES ('$file',NULL)");
                //sqlite_fetch_array($result));
                $counter++;
                }
    }
$stop = time();
$duration = $stop-$start;
echo "process $counter pictures finished in ".$duration." seconds";
}else{
    echo "gimme a caption dude";
    ?>
<form method="GET" action="">
   Caption: <input type="text" name="caption">
    <input type="submit">
</form>

    <?
}



include('inc/footer.php');

?>