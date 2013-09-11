<?php
if (isset($_POST['caption'])){
	setcookie("caption", $_POST['caption'], time()+12*60*60);  /* expire in 12 hour */
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
flush();

include('inc/ProcessImageFile.php');
ob_start();
$start = time();




if (isset($_POST['caption'])){
    // we've got a caption, so let process some hot pics! 
    $dir    = $_POST['path'];
    $importpath= $_POST['path'];
    $files = scandir($dir);
    $counter = 0;
    $db = new SQLite3($dbpath);
    foreach ($files as $file){ // loop over files 
                if ($file !="." && $file !=".."){  //not a folder 
                    $result = $db->querySingle("SELECT count(*) FROM \"images\" WHERE \"path\" = '$file'");
                    if ($result==0){ // and not allready in the db...
                        ProcessImageFile($importpath,$file,$_POST['caption']); // process it 
                        $db->querySingle("INSERT INTO 'images' ('path','couple') VALUES ('$file',0)"); //add it to the database.
                    }
                }
        }
       
    $stop = time();
    $duration = $stop-$start;
    echo "<div class='alert alert-info'>Pictures finished in ".$duration." seconds, <a href='backchecker.php'>now go edit them</a><em>...if Master Pleases...</div>";
 /*   $db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    while ($row = sqlite_fetch_array($result)){
       echo " <a href='./images/medium/".$row['path']."' title='Image caption' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
       }
       */
}else{
    // we've got NO caption, so let's ask for one! 
    echo "<div class='alert alert-info'>Can Master please provide me with a path and a caption?</div>";
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
    <form method="POST" action="" class="form-inline">
		<fieldset class="span6">
		        <legend>Import Path</legend>

		<input type="radio" name="path" value="<?php echo GetCameraPath() ?>" checked><?php echo GetCameraPath() ?><br>
		<input type="radio" name="path" value="<?php echo $importpath; ?>"><?php echo $importpath; ?><br>
		        <legend>Caption:</legend>
				<input type="text" name="caption" id="caption"  value="<?php echo $caption ?>">
        <input type="submit">
		</fieldset>
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

function GetCameraPath(){
for ($ii=66;$ii<92;$ii++){
    $char = chr($ii);
	$CamFileLoc = $char.":/";
    if (file_exists($CamFileLoc)&& file_exists($CamFileLoc."DCIM/")){
		$CamFileLoc = $CamFileLoc."DCIM/";
		// so there's a dcim folder 
		// Open a known directory, and proceed to read its contents
		if (is_dir($CamFileLoc)) {
			if ($dh = opendir($CamFileLoc)) {
				while (($file = readdir($dh)) !== false) {
					//echo "filename: $file : filetype: " . filetype($CamFileLoc . $file) . "\n";
					if ((stristr ($file,".")==false)&&(filetype($CamFileLoc . $file)=="dir")){
						$TrueCamFileLoc = $CamFileLoc. $file;
						}
					}
				closedir($dh);
				}
			}
		return $TrueCamFileLoc."/";
		}
			
	}
	return "No Camera Found! #fail";
}
?>