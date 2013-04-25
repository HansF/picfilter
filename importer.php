<?php

include('inc/header.php');
include('inc/settings.php');
include('inc/ProcessImageFile.php');
$start = time();
if (isset($_GET['caption'])){
    $dir    = $importpath;
    $files = scandir($dir);
    $counter = 0;
    $db = sqlite_open($dbpath, 0777, $sqliteerror) ;
foreach ($files as $file){
            if ($file !="." && $file !=".."){ 
                $result = sqlite_query($db, "SELECT * FROM 'images' WHERE 'path' = '$file'");
                echo "SELECT * FROM 'images' WHERE 'path' = '$file'";
                if (sqlite_num_rows($result)==0){
                    ProcessImageFile($importpath,$file,$_GET['caption']);
                    sqlite_query($db, "INSERT INTO 'images' ('path','couple') VALUES ('$file',NULL)");
                    //sqlite_fetch_array($result));
                    $counter++;   
                }
            }
    }
$stop = time();
$duration = $stop-$start;
echo "<p>Process $counter pictures finished in ".$duration." seconds</p><p>s";
	$db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    while ($row = sqlite_fetch_array($result)){
       // print_r($row);
        echo " <a href='./images/medium/".$row['path']."' title='Image caption' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
    }

}else{
    echo "gimme a caption dude";
    ?>
<form method="GET" action="">
   Caption: <input type="text" name="caption">
    <input type="submit">
</form>

    <?php
}



include('inc/footer.php');

?>