<?php

include('inc/header.php');
?>
<h1>Adminpage</h1>

<p>All this stuff is without confirmation so tread lightly</p>

<p><a href="?action=reset">Reset the database.</a></p>
<?php
    if(isset($_GET['action'])&&$_GET['action']=="reset"){
        $db = new SQLite3($dbpath);
        $db->querySingle("DELETE FROM 'couples'");
        $db->querySingle("DELETE FROM 'images'");
        }
?>
<p><a href="importer.php">Import batch.</a></p>

<p><a href="couples.php">Add/edit couples.</a></p>

<h2>debug</h2>
<p><a href="db/phpliteadmin.php">Check the database.</a></p>

<?
include('inc/footer.php');

?>