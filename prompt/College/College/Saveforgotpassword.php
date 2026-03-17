<?php
session_start();	 
include_once 'database.php';
$lus = $_POST["loginid"];
$email = $_POST["email"];
if(strcasecmp($lus,"admin")==0)
{
  $SQL = "SELECT * FROM admin where Username ='$lus' and Password ='$lpw'";
  $result = mysql_query($SQL);
  $flag=0;
  $count=mysql_num_rows($result);
  if($count==1)
  {
    $_SESSION['AU']=$lus;
    $_SESSION['usertype']="admin";
    session_write_close();
    if(isset($_SESSION['AU']))
	header("location:User.php");
    else
 	echo "Not set";
   }	
 }
 else
 {
      $SQL = "SELECT * FROM addstaff where SID ='$lus' and Emailid ='$email'";
      $result1 = mysql_query($SQL);
      $count=mysql_num_rows($result1);
      if($count==1)
      {
          while($row=mysql_fetch_assoc($result1))
          {      
                     $_SESSION['dept']=$row["Department"];
                     $pwd=$row["Password"];
          }
          $_SESSION['AU']=$lus;
          $_SESSION['usertype']="Staff";
          $_SESSION['pwd']=$pwd;
          session_write_close();
          header("location:forgotpassword.php");
      }	
      else
      {
 	   $_SESSION['IU']="Invalid User Account or email"; 
         session_write_close();
	   header("location:forgotpassword.php");
      }
  }	
?>