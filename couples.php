<?php

include('inc/header.php');
$db = new SQLite3($dbpath);

?>

<script type="text/javascript">
    function focusIt()
    {
      var mytext = document.getElementById("name"); 
      mytext.focus(); 
    }
    onload = focusIt;
</script>

<h1>Couples</h1>
<h4>Add Couple</h4>

<p>Add couple's name, this is used in database and filenames, so no funky chars (",',\,...) plz. </p>
    <form method="Post" action="couples.php">
       Couple's name: <input type="text" name="name" id="name">
        <input type="submit">
    </form>

<h4>Available Couples</h4>

<?php

// idf we need to delete one we do it here
    if(isset($_GET['id'])&&$_GET['id']!=""){
        $id = $_GET['id'];
        $name = $_GET['name'];
        $db = new SQLite3($dbpath);
        $db->querySingle("DELETE FROM  \"couples\" WHERE id = \"".$id."\"");
        echo "<p class='alert'>Couple $name is removed from the db.</p>";
        }
// idf we need to add one we do it here
    if(isset($_POST['name'])&&$_POST['name']!=""){
        $name = $_POST['name'];
        $db = new SQLite3($dbpath);
        $db->querySingle("INSERT INTO \"couples\" (\"id\",\"couple\") VALUES (\"".md5($name)."\",\"".$name."\")");
        echo "<p class='alert'>Thank you master, per your request, I've added <strong>$name</strong> to the database.</p>";
        }


    $result = $db->query('select * from couples');
    echo "<ul>";
    while ($row = $result->fetchArray()) {
        echo "<li>".$row['couple']." <a href='couples.php?id=".$row['id']."&name=".$row['couple']."'>(delete) </a></li>";
    }
    echo "</ul>";
    ?>

<p>So uhm , yeah, don't delete couples *after* they've been assigned pictures, that's just asking for troubles.</p>

<?php



include('inc/footer.php');

?>