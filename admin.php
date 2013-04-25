<?php

include('inc/header.php');
?>
<h1>Adminpage</h1>

<p>All this stuff is without confirmation so tread lightly</p>

<p><a href="?action=reset">Reset the database.</a></p>
<?php
    if(isset($_GET['action'])&&$_GET['action']=="reset"){
        $db = sqlite_open($dbpath, 0666, $sqliteerror);
        sqlite_query($db, "DELETE FROM 'couples'");
        sqlite_query($db, "DELETE FROM 'images'");
        }
?>
<p><a href="importer.php">Import batch.</a></p>


<?
include('inc/footer.php');

?>