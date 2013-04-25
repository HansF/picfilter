<?php

include('inc/header.php');
?>
<h1>Adminpage</h1>

<p>All this stuff is without confirmation so tread lightly</p>

<a href="?action=reset">Reset the database.</a>
<?php
if($_GET['action']=="reset"){
    unlink($filename)
}

?>


<?
include('inc/footer.php');

?>