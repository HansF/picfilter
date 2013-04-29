<?php
include('inc/header.php');
include('inc/settings.php');
include('inc/ProcessImageFile.php');
$start = time();
if (isset($_GET['caption'])){
    // we've got a caption, so let process some hot pics! 
    $dir    = $importpath;
    $files = scandir($dir);
    $counter = 0;
    $db = new SQLite3($dbpath);
    foreach ($files as $file){ // loop over files 
                if ($file !="." && $file !=".."){  //not a folder 
                    "SELECT count(*) FROM \"images\" WHERE \"path\" = '$file'";
                    $result = $db->querySingle("SELECT count(*) FROM \"images\" WHERE \"path\" = '$file'");
                    var_dump($result);
                    print_r($result);  
                    if ($result==0){ // and not allready in the db...
                        ProcessImageFile($importpath,$file,$_GET['caption']); // process it 
                        $db->querySingle("INSERT INTO 'images' ('path','couple') VALUES ('$file',NULL)"); //add it to the database.
                        $counter++;   
                    }
                }
        }
       
    $stop = time();
    $duration = $stop-$start;
    echo "<p>Process $counter pictures finished in ".$duration." seconds</p><p>s";
 /*   $db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    while ($row = sqlite_fetch_array($result)){
       echo " <a href='./images/medium/".$row['path']."' title='Image caption' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
       }
       */
}else{
    // we've got NO caption, so let's ask for one! 
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