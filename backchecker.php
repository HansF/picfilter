<?php

include('inc/header.php');
include('inc/ProcessImageFile.php');
$db = new SQLite3($dbpath);

?>
<h1>People in the background</h1>
<h4>Unchecked</h4>


<form action="backchecker.php" method="post">
  <input type="hidden" name="x1" value="" />
  <input type="hidden" name="y1" value="" />
  <input type="hidden" name="x2" value="" />
  <input type="hidden" name="y2" value="" />
  <input type="submit" name="submit" value="All Fine!" />
  <input type="submit" name="Blur" value="Blur!" /><br/>



  <input type="hidden" name="x1" value="" />
  <input type="hidden" name="y1" value="" />
  <input type="hidden" name="x2" value="" />
  <input type="hidden" name="y2" value="" />
</form>


<?php 
    $result = $db->querySingle('select path from images where background=0 limit 0,1');
    echo "<img ID='editpicture' src='./images/medium/$result' />";
    if (isset($_POST['Blur'])&&($_POST['Blur'] == "Blur!")){
          print_r($_POST); 
		 // Makeblur(  $importpath, $result, 10, 20, 20, 20);
    }
   ?>
<?php 

include('inc/footer.php');

?>