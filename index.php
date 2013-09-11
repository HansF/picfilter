<?php

include('inc/header.php');
$db = new SQLite3($dbpath);
?>
<div class='row'>
	<div class='span3'>
		<h4>Couples</h4>
		<?php
$numbercouples = $db->querySingle('select COUNT(id) as numbercouples from couples ');
	if ($numbercouples==0){
			echo "No couples created yet, <a href='couples.php'>add some</a>";
		}else{
			$results = $db->query('select id, couple from couples ');
			echo "<ul><li><a href='?couple=0'>Untagged</a></li>";
			while ($row = $results->fetchArray()) {
				echo "<li><a href='?couple=".$row['id']."'>".$row['couple']."</a></li> ";
				}
			echo "<ul>";
		}

?>

		
	</div>


	<div class='span9'>
		<h4>Untagged Pictures</h4>
	
<?php
if (!isset($_GET['couple'])){
	$couple = 0;
	}else{
	$couple = $_GET['couple'];
	}

$numberpics = $db->querySingle("select COUNT(id) as numberpics from images where couple = $couple ");
	if ($numberpics==0){
			echo "No Pictures imported yet, <a href='importer.php'>add some</a>";
		}else{
			$result = $db->query("select * from images where couple = $couple ORDER BY id DESC");
			while ($row = $result->fetchArray()) {
				echo " <a href='./images/medium/".$row['path']."' title='".$row['path']."' class='lightbox' data-group='unchecked'><img src='./images/thumbs/".$row['path']."'></a>";
			}
		}
		
?>
	</div>



<?


include('inc/footer.php');

?>