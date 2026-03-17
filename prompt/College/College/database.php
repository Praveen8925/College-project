<?php
$user_name = "root";
$password = "";
$database = "collegedetails";
$server = "localhost";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) 
{
    $db = "connected";
}
else 
{
$db="NotConnected";
mysql_close($db_handle);
}
?>
