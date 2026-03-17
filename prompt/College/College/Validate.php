<?php
session_start();	 
include_once 'database.php';
$lus = $_POST["loginid"];
$lpw = $_POST["pass"];
$s=substr($lus,0,1);
$splacement=substr($lus,0,2);
print $s;
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
    
   }	
         else
      {
 	   $_SESSION['IU']="Invalid User Account or Password"; 
         session_write_close();
	   header("location:index.php");
      }
 }
 
else if($s=='N')
  {
  $SQL = "SELECT * FROM student where RegNo ='$lus' and Password ='$lpw'";
      $result1 = mysql_query($SQL);
      $count=mysql_num_rows($result1);
      if($count==1)
      {
          while($row=mysql_fetch_assoc($result1))
          {      
                     $_SESSION['sdept']=$row["Department"];
                     $_SESSION['usertype']=$row["status"];
          }
          $_SESSION['AU']=$lus;
          
          session_write_close();
            
          if(isset($_SESSION['AU']))
               header("location:User.php");
       }	
      else
      {
 	   $_SESSION['IU']="Invalid User Account or Password"; 
         session_write_close();
	   header("location:index.php");
      }

  }

else if($s=='C')
  {
  $SQL = "SELECT * FROM coe where id ='$lus' and Password ='$lpw'";
      $result1 = mysql_query($SQL);
      $count=mysql_num_rows($result1);
      if($count==1)
      {
          $_SESSION['usertype']="coe";
          $_SESSION['AU']=$lus;
          
          session_write_close();
            
          if(isset($_SESSION['AU']))
               header("location:User.php");
       }	
      else
      {
 	   $_SESSION['IU']="Invalid User Account or Password"; 
         session_write_close();
	   header("location:index.php");
      }

  }
  //-------------------------------------------------------------------------------------------------------------------
  else if($splacement=='tp')
 {
      $SQL = "SELECT * FROM addstaff where SID ='$lus' and Password ='$lpw'";
      $result1 = mysql_query($SQL);
      $count=mysql_num_rows($result1);
	  $SQLS="SELECT * FROM addstaff where SID ='$lus' and Password ='$lpw'and Designation='director'";
      $result2= mysql_query($SQLS);
	  $count2=mysql_num_rows($result2);
      if($count2==1)
      { 
          $_SESSION['AU']=$lus;
          $_SESSION['usertype']="director";
          session_write_close();
          if(isset($_SESSION['AU']))
               header("location:User.php");
      }	
	  else if($count==1)
	  {
          $_SESSION['AU']=$lus;
          $_SESSION['usertype']="assistantstaff";
          session_write_close();
          if(isset($_SESSION['AU']))
               header("location:User.php");
      }	 
		  
		  
      else
      {
 	   $_SESSION['IU']="Invalid User Account or Password"; 
         session_write_close();
	   header("location:index.php");
      }
 }
  //-------------------------------------------------------------------------------------------------------------------

 else 
 {
      $SQL = "SELECT * FROM addstaff where SID ='$lus' and Password ='$lpw'";
      $result1 = mysql_query($SQL);
      $count=mysql_num_rows($result1);
	  $SQLS="SELECT * FROM addstaff where SID ='$lus' and Password ='$lpw'and Designation='HOD'";
      $result2= mysql_query($SQLS);
	  $count2=mysql_num_rows($result2);
      if($count2==1)
      { 
          
		  while($row=mysql_fetch_assoc($result2))
          {      
                     $_SESSION['dept']=$row["Department"];
          }
          $_SESSION['AU']=$lus;
          $_SESSION['usertype']="hod";
          session_write_close();
          if(isset($_SESSION['AU']))
               header("location:User.php");
      }	
	  else if($count==1)
	  {
		  
		 while($row=mysql_fetch_assoc($result1))
          {      
                     $_SESSION['dept']=$row["Department"];
          }
          $_SESSION['AU']=$lus;
          $_SESSION['usertype']="staff";
          session_write_close();
          if(isset($_SESSION['AU']))
               header("location:User.php");
      }	 
		  
		  
      else
      {
 	   $_SESSION['IU']="Invalid User Account or Password"; 
         session_write_close();
	   header("location:index.php");
      }
  }
?>