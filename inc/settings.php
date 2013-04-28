<?php

function sqlite_open($location,$mode) 
{ 
    $handle = new SQLite3($location); 
    return $handle; 
} 
function sqlite_query($dbhandle,$query) 
{ 
    $array['dbhandle'] = $dbhandle; 
    $array['query'] = $query; 
    $result = $dbhandle->query($query); 
    return $result; 
} 
function sqlite_fetch_array(&$result,$type) 
{ 
    #Get Columns 
    $i = 0; 
    while ($result->columnName($i)) 
    { 
        $columns[ ] = $result->columnName($i); 
        $i++; 
    } 
    
    $resx = $result->fetchArray(SQLITE3_ASSOC); 
    return $resx; 
} 
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