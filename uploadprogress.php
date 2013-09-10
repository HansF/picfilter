<?php
include('inc/settings.php');

//echo "--".$_GET['id']."--";

$db = new SQLite3($dbpath);
$result = $db->query('select * from images where id>'.$_GET['id']);
    while ($row = $result->fetchArray()) {
       echo "<img src='./images/thumbs/".$row['path']."'>";
    }
   ?>