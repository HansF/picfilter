<?php

include('inc/header.php');
?>
<div class="row">
<div class="span4">
<h2>Adminpage</h2>

<p>All this stuff is without confirmation so tread lightly</p>

<p><a href="?action=reset">Reset the database.</a></p>
<?php
    if(isset($_GET['action'])&&$_GET['action']=="reset"){
		ResetDatabase($dbpath);
        }
?>
<p><a href="importer.php">Import batch.</a></p>

<p><a href="couples.php">Add/edit couples.</a></p>

</div>
<div class="span4">
<h2>debug</h2>
<p><a href="db/phpliteadmin.php" target="_blank">Check the database.</a></p>

<?php
// just for handyness... trow in req folder
if (is_dir($rootdir."images")==FAlSE){
		mkdir ($rootdir."images");
		mkdir ($rootdir."images/import");
		mkdir ($rootdir."images/medium");
		mkdir ($rootdir."images/thumbs");
		mkdir ($rootdir."images/tmp");
		mkdir ($rootdir."images/watermark");
		echo "<p class='alert'>Created the needed folders in $rootdir. That's how I do it.</p>";
}

if ( file_exists($dbpath)==FALSE ) ResetDatabase($dbpath);

include('inc/footer.php');
 
function ResetDatabase($dbpath){
		if ( file_exists($dbpath) ) unlink ($dbpath);
		$fp = fopen($dbpath, "a+");
		fclose($fp);
        $db = new SQLite3($dbpath);
        $db->querySingle('CREATE TABLE couples ( id varchar(250), couple varchar(250))');
        //$db->querySingle('CREATE TABLE images ( path varchar(250),couple varchar(250), background INTEGER DEFAULT 0)');
        $db->querySingle("CREATE TABLE images ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, path TEXT, couple TEXT, background INTEGER default 0 )");
        $db->querySingle('CREATE INDEX "pIndex" ON "images" ("path" ASC);');
        $db->querySingle('CREATE INDEX "pIndex2" ON "couples" ("id" ASC);');
        $db->querySingle("DELETE FROM 'couples'");
        $db->querySingle("DELETE FROM 'images'");
		echo "<p class='alert'>You've now got a fresh new clean database. How cool is that?</p>";
}

?>
</div>
</div>