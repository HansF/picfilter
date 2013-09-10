<?php
if (isset($_GET['caption'])){
	setcookie("caption", $_GET['caption'], time()+12*60*60);  /* expire in 12 hour */
}
include('inc/header.php');
include('inc/settings.php');
?>
<script  type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#load').load('uploadprogress.php?id=<?php echo GetNewUploadId($dbpath) ?>&_=' +Math.random()).fadeIn("slow");
}, 2500); // refresh every 10000 milliseconds
</script>
<div id="load"> </div>
<?php
include('inc/ProcessImageFile.php');
ob_start();
$start = time();




if (isset($_GET['caption'])){
    // we've got a caption, so let process some hot pics! 
    $dir    = $importpath;
    $files = scandir($dir);
    $counter = 0;
    $db = new SQLite3($dbpath);
    foreach ($files as $file){ // loop over files 
                if ($file !="." && $file !=".."){  //not a folder 
                    $result = $db->querySingle("SELECT count(*) FROM \"images\" WHERE \"path\" = '$file'");
                    if ($result==0){ // and not allready in the db...
                        ProcessImageFile($importpath,$file,$_GET['caption']); // process it 
                        $db->querySingle("INSERT INTO 'images' ('path','couple') VALUES ('$file',NULL)"); //add it to the database.
                    }
                }
        }
       
    $stop = time();
    $duration = $stop-$start;
    echo "<p class='info'>Pictures finished in ".$duration." seconds, <a href='background.php'>now go edit them</a><em>...if Master Pleases...</p>";
 /*   $db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    while ($row = sqlite_fetch_array($result)){
       echo " <a href='./images/medium/".$row['path']."' title='Image caption' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
       }
       */
}else{
    // we've got NO caption, so let's ask for one! 
    echo "<p class='text-info'>The import folder is : <strong>$importpath</strong></p><p>Can Master please provide me with a caption?</p>";
    ?><script type="text/javascript">
    function focusIt()
    {
      var mytext = document.getElementById("caption"); 
      mytext.focus(); 
    }
    onload = focusIt;
</script>
<?php 

$caption ="";
if (isset($_COOKIE['caption'])) $caption = $_COOKIE['caption'] ;

?>
    <form method="GET" action="">
       Caption: <input type="text" name="caption" id="caption"  value="<?php echo $caption ?>">
        <input type="submit">
    </form>
    <?php
}

include('inc/footer.php');
function GetNewUploadId($dbpath){
	$dbup = new SQLite3($dbpath);
	$result = $dbup->query('SELECT count(id) as newid FROM "images"');
	$row = $result->fetchArray();
	return $row['newid'];
}
?>