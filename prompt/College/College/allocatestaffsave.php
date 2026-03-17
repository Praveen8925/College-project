<?php
session_start();
include_once 'database.php';
$uid=$_SESSION['AU'];
   $SQLS="select * from addstaff where SID='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dept=$ress["Department"];
	}

	
$batch=$_POST["batch"];
$sdept=$_POST["sdept"];
$sem=$_POST["sem"];
$courseid=$_POST["cid"];
$staffid=$_POST["sid"];
	
$sql="select * from staffallocation where Batch='$batch'and Sem='$sem' and CourseID='$courseid'";
$res=mysql_query($sql);

 if (mysql_num_rows($res)>0)
  {    
	$_SESSION['as'] = "Staff Allocated already <br> Record Not Saved";
  }
	else
		
	{
		$SQL="insert into  staffallocation  values('$batch','$dept','$staffid','$sem','$courseid','$staffid')";
		
		mysql_query($SQL);
	}		
	header("location: allocatestaff.php");
?>