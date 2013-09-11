<?php
include('inc/header.php');
include('inc/settings.php');
$db = new SQLite3($dbpath);
?>
<div class="row">
<div class="span4">
<h2>Adminpage</h2>

<p>All this stuff is without confirmation and undo so tread lightly!</p>

<p><a href="?action=resetdb">Reset the database (delete and recreate empty).</a></p>
<?php

?>
<p><a href="?action=resetfiles">Reset the pictures (delete folders/contents, and recreate empty).</a></p>
<?php
    if(isset($_GET['action'])&&$_GET['action']=="resetfiles"){
		destroy_dir($rootdir."images");
		//CreateDir($rootdir);
        }
?>
<p><a href="importer.php">Import batch.</a></p>

<p><a href="couples.php">Add/edit couples.</a></p>

</div>
<div class="span4">
<h2>debug</h2>
<p><a href="db/phpliteadmin.php" target="_blank">Check the database.</a></p>
<h4>Export Pictures</h4>
<?php
$numbercouples = $db->querySingle('select COUNT(id) as numbercouples from couples ');
	if ($numbercouples==0){
			echo "No couples created yet, so nothing to export.";
		}else{
			$results = $db->query('select id, couple from couples ');
			echo "<ul>";
			while ($row = $results->fetchArray()) {
				echo "<li><a href='export.php?couple=".$row['id']."'>".$row['couple']."</a></li> ";
				}
			echo "<ul>";
		}

if(isset($_GET['action'])&&$_GET['action']=="resetdb"){
		ResetDatabase($dbpath);
        }
// just for handyness... trow in req folder
if (is_dir($rootdir."images")==FAlSE) CreateDir($rootdir); 

function CreateDir($rootdir){
		mkdir ($rootdir."images");
		mkdir ($rootdir."images/import");
		mkdir ($rootdir."images/medium");
		mkdir ($rootdir."images/thumbs");
		mkdir ($rootdir."images/tmp");
		mkdir ($rootdir."images/watermark");
		mkdir ($rootdir."images/export");
		echo "<p class='alert'>Created the needed folders in $rootdir. That's how I do it.</p>";
}

if ( file_exists($dbpath)==FALSE ) ResetDatabase($dbpath);

include('inc/footer.php');
 
function ResetDatabase($dbpath){
		if ( file_exists($dbpath) ) unlink ($dbpath);
		$fp = fopen($dbpath, "a+");
		fclose($fp);
        $db = new SQLite3($dbpath);
        $db->querySingle('CREATE TABLE couples ( id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, couple varchar(250))');
        //$db->querySingle('CREATE TABLE images ( path varchar(250),couple varchar(250), background INTEGER DEFAULT 0)');
        $db->querySingle("CREATE TABLE images ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, path TEXT,  'couple' INTEGER NOT NULL DEFAULT 0, background INTEGER default 0 )");
        $db->querySingle('CREATE INDEX "pIndex" ON "images" ("path" ASC);');
        $db->querySingle('CREATE INDEX "pIndex2" ON "couples" ("id" ASC);');
        $db->querySingle("DELETE FROM 'couples'");
        $db->querySingle("DELETE FROM 'images'");
		echo "<p class='alert'>You've now got a fresh new clean database. How cool is that?</p>";
}

function destroy_dir($dir) { 
    if (!is_dir($dir) || is_link($dir)) return unlink($dir); 
        foreach (scandir($dir) as $file) { 
            if ($file == '.' || $file == '..') continue; 
            if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) { 
                chmod($dir . DIRECTORY_SEPARATOR . $file, 0777); 
                if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) return false; 
            }; 
        } 
        return rmdir($dir); 
    } 
?>
</div>
</div>