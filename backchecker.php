<?php

include('inc/header.php');
$db = new SQLite3($dbpath);

?>
<h1>People in the background</h1>
<h4>Unchecked</h4>


<?php 
    $result = $db->querySingle('select path from images where background=0 limit 0,1');
    echo "<img ID='editpicture' src='./images/medium/$result' />";
    print_r($_POST);
   ?>

<form action="backchecker.php" method="post">
  <input type="hidden" name="x1" value="" />
  <input type="hidden" name="y1" value="" />
  <input type="hidden" name="x2" value="" />
  <input type="hidden" name="y2" value="" />
  <input type="submit" name="submit" value="Submit" />
</form>

<?php 

include('inc/footer.php');

?>