<?php
$rootdir = str_replace("\\","/",str_replace("inc","", realpath(dirname(__FILE__)))); // get true path from location of this file
$password = "shibari"; 
$protected="no";

//$rootdir = "E:/vdrive/web/"; //use front slashes in windows also , always put a trailing slash :-)
$importpath = $rootdir."images/import/"; //use front slashes in windows also , always put a trailing slash :-)
$importwatermarkpath = $rootdir."images/watermark/"; //use front slashes in windows also , always put a trailing slash :-)
$dbpath = $rootdir."db/mysqlitedb.sqlite"; //use front slashes in windows also , always put a trailing slash :-)
/*
if (file_exists($dbpath)){
	$db = sqlite_open($dbpath, 0777, $sqliteerror) ;
    $result = sqlite_query($db, 'select * from images');
    var_dump(sqlite_fetch_array($result));
}
*/



?>