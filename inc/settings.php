<?php
$password = "admin"; 
$rootdir = "C:/xampp/htdocs/picfilter/"; //use front slashes in windows also , always put a trailing slash :-)
$importpath = $rootdir."images/import/"; //use front slashes in windows also , always put a trailing slash :-)
$dbpath = $rootdir."db/mysqlitedb.sqlite"; //use front slashes in windows also , always put a trailing slash :-)

if (fopen($dbpath, "r")){
	$db = sqlite_open($dbpath, 0666, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    var_dump(sqlite_fetch_array($result));
}else{
	$db = sqlite_open($dbpath, 0666, $sqliteerror);
    sqlite_query($db, 'CREATE TABLE images (path varchar(250),couple varchar(250))');
    sqlite_query($db, "INSERT INTO images VALUES ('fnord','more fnord')");
}


?>