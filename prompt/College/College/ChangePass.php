<?php
  session_start();	 
  include_once 'database.php';
  $oldpwd = $_POST["oldpwd"];
  $npwd = $_POST["newpwd"];
  if( isset($_SESSION['AU']) ) 
  {
	$usid=$_SESSION['AU']; 
  }
  else
  {
	header("location:Change.php");
  }
  //$str=substr($usid,0,4);
  if(strcasecmp($usid,"admin")==0)
  {
  	$SQL = "SELECT * FROM admin where Username='".$usid."' And Apassword='".$oldpwd."'";
	$result = mysql_query($SQL);
	$count=mysql_num_rows($result);
	if($count==1)
	{
		$SQL = "UPDATE admin SET Password='".$npwd."' WHERE Username='".$usid."'";
		$result = mysql_query($SQL);
		$_SESSION['Save'] = "Password Updated Successfully";
            session_write_close();			
            header("location:Change.php");
	}
	else
	{
      	$_SESSION['Save'] = "Invalid Existing Password";
		session_write_close();
            header("location:Change.php");
	}
   }
   else
   {
		$SQL = "SELECT * FROM addstaff where SID='$usid' AND Password='$oldpwd'";
            print $SQL;
		$result = mysql_query($SQL);
		$count=mysql_num_rows($result);
		if($count==1)
		{
			$SQL = "UPDATE addstaff SET Password='".$npwd."' WHERE SID='".$usid."'";
			print $SQL;
			$result = mysql_query($SQL);
			$_SESSION['Save'] = "Password Updated Successfully";
			header("location:Change.php");
		}
		else
		{
			$_SESSION['Save'] = "Invalid Existing Password";
			header("location:Change.php");
		}
	}
?>