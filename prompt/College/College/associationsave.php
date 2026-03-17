<?php
session_start();
include_once 'database.php';
$an=$_POST["associationname"];
$dept=$_POST["Dept"];
$description=$_POST["description"];
$sql="select * from association where Association_Name='$an'";
$res=mysql_query($sql);

 if (mysql_num_rows($res)>0)
  {    
	$_SESSION['asave'] = "Association Name Alredy Exist <br> Record Not Saved";
  }
	else
		
	{
		$SQL="insert into  association  values('$an','$dept','$description')";
		
		mysql_query($SQL);
	}
	
 header("location: association.php");

?>	