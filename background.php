<?php

include('inc/header.php');
$db = new SQLite3($dbpath);

?>
<h1>People in the background</h1>
<h4>Unchecked</h4>

<div class='alert alert-info'><a href="backchecker.php">Check and blur people now!</a></div>

<?php 
    $result = $db->query('select * from images where background=0');
    while ($row = $result->fetchArray()) {
       echo " <a href='./images/medium/".$row['path']."' title='".$row['path']."' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
    }
   ?>

<h4>Checked</h4>

<div class='alert alert-info'>There should be no people on the background of these pictures, or they should be blurred out.</div>

<?php 
    $result = $db->query('select * from images where background=1');
    while ($row = $result->fetchArray()) {
       echo " <a href='./images/medium/".$row['path']."' title='Image caption' class='lightbox' data-group='set'><img src='./images/thumbs/".$row['path']."'></a>";
    }



include('inc/footer.php');

?>