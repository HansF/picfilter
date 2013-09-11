<?php
include('inc/settings.php');
$db = new SQLite3($dbpath);
$numbercouples = $db->querySingle('select COUNT(id) as numbercouples from couples ');
if ($numbercouples==0) header('Location: couples.php');

include('inc/header.php');
include('inc/ProcessImageFile.php');
if (isset($_GET['id'])&&($_GET['action']=="assign")){
	$resultupdate = $db->query("UPDATE images SET couple=".$_GET['id']." WHERE path='".$_GET['path']."'");
	}
?>
<h1>Couples</h1>
<p>Remember, you can <a href="couples.php">add/edit couples here</a>.</p>
<?php 

if ((isset($_GET['id']))&&($_GET['action']=="edit")){
		$result = $_GET['id'];
	}else{
		$result = $db->querySingle('select path from images where couple=0 AND background=1 ORDER BY id ASC limit 0,1 ');
	}
	
$imagelink = "<br/><br/><img ID='editpicture' src='./images/medium/".$result."' />";

$results = $db->query('select id, couple from couples ');

while ($row = $results->fetchArray()) {
	echo "<a href='couplechecker.php?id=".$row['id']."&action=assign&path=$result' class='btn'>".$row['couple']."</a> ";
	}

		
if($result==""){
	echo "<br/><div class='alert alert-success'>No more people to recognize, two possibilities:<ul><li> Another job wel done! Or....</li><li> You need to <a href='background.php'>check for people in the background</a> before you can assign them.</li></div>";
	}else{
echo $imagelink;
?>
<h4>Unchecked</h4>
<?php 
}

include('inc/footer.php');

?>