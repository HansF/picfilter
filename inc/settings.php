<?php
$password = "admin"; 
$rootdir = "C:/xampp/htdocs/picfilter/"; //use front slashes in windows also , always put a trailing slash :-)
$importpath = $rootdir."images/import/"; //use front slashes in windows also , always put a trailing slash :-)
$importwatermarkpath = $rootdir."images/watermark/"; //use front slashes in windows also , always put a trailing slash :-)
$dbpath = $rootdir."db/mysqlitedb.sqlite"; //use front slashes in windows also , always put a trailing slash :-)
$protected="no";
/*
if (file_exists($dbpath)){
	$db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    var_dump(sqlite_fetch_array($result));
}
*/



?>