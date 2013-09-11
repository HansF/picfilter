<?php

include('inc/header.php');
include('inc/ProcessImageFile.php');
$db = new SQLite3($dbpath);

?>
<h1>People in the background</h1>


<?php 
	if (isset($_POST['submit'])&&($_POST['submit'] == "All Fine!")&&($_POST['result']!="")){
			if (file_exists("./images/tmp/".$_POST['result'])) rename ("./images/tmp/".$_POST['result'],"./images/medium/".$_POST['result']);
			$db->querySingle("UPDATE 'images' SET 'background'='1' WHERE path = '".$_POST['result']."'");
			if (isset($_SESSION['edits'])){ 		  
				Makebigblur( $_POST['result'], $_SESSION['edits']);
			}
			unset($_SESSION['edits']); 
    }
    $result = $db->querySingle('select path from images where background=0 limit 0,1');
	if (file_exists("./images/tmp/".$result)){
		$imagelink = "<img ID='editpicture' src='./images/tmp/".$result."' />";
		$editpath = "tmp";
		}else{
		$imagelink = "<img ID='editpicture' src='./images/medium/".$result."' />";
		$editpath = "medium";
		}
	if (isset($_POST['Blur'])&&($_POST['Blur'] == "Blur!")){
          // print_r($_SESSION['edits']); 
		  Makeblur(  './images/'.$editpath.'/', $result, $_POST['x1'], $_POST['y1'], $_POST['x2']-$_POST['x1'], $_POST['y2']-$_POST['y1']);
		  $imagelink = "<img ID='editpicture' src='./images/tmp/".$result."' />";
    }
	if (isset($_POST['Reset'])&&($_POST['Reset'] == "Reset!")){
			if (file_exists("./images/tmp/".$result)) unlink("./images/tmp/".$result);
			unset($_SESSION['edits']); 
			$imagelink = "<img ID='editpicture' src='./images/medium/".$result."' />";
    }

	if($result==""){
		echo "<br/><div class='alert alert-success'>No more people to blur. Another job wel done!</div>";
		}else{
		?>
		<h4>Unchecked</h4>


<form action="backchecker.php" method="post">
  <input type="hidden" name="x1" value="" />
  <input type="hidden" name="y1" value="" />
  <input type="hidden" name="x2" value="" />
  <input type="hidden" name="y2" value="" />
  <input type="submit" name="submit" value="All Fine!" />
  <input type="submit" name="Blur" value="Blur!" />
  <input type="submit" name="Reset" value="Reset!" /><br/>

<?php
		echo $imagelink;
		}
   ?>
     <input type="hidden" name="result" value="<?php echo $result ?>" />

   </form>
<?php 

include('inc/footer.php');

?>