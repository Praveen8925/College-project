<?php
session_start();
include_once 'database.php';
$association=$_POST["association"];
$dept=$_POST["Dept"];
$year=$_POST["year"];
$president=$_POST["president"];
$vicepresident=$_POST["vicepresident"];
$secretary=$_POST["secretary"];
$treasurer=$_POST["treasurer"];
$editor=$_POST["editor"];


if(isset($_FILES['presidentph']))
  {
      $file_name = $_FILES['presidentph']['name'];
      $file_size = $_FILES['presidentph']['size'];
      $file_tmp = $_FILES['presidentph']['tmp_name'];
      $file_type = $_FILES['presidentph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['presidentph']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $presidentph="upload/".$file_name;
	    rename("upload/".$file_name,$presidentph);
      }
   } 
if(isset($_FILES['vicepresidentph']))
  {
      $file_name = $_FILES['vicepresidentph']['name'];
      $file_size = $_FILES['vicepresidentph']['size'];
      $file_tmp = $_FILES['vicepresidentph']['tmp_name'];
      $file_type = $_FILES['vicepresidentph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['vicepresidentph']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $vicepresidentph="upload/".$file_name;
	    rename("upload/".$file_name,$vicepresidentph);
      }
   } 
if(isset($_FILES['secretaryph']))
  {
      $file_name = $_FILES['secretaryph']['name'];
      $file_size = $_FILES['secretaryph']['size'];
      $file_tmp = $_FILES['secretaryph']['tmp_name'];
      $file_type = $_FILES['secretaryph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['secretaryph']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $secretaryph="upload/".$file_name;
	    rename("upload/".$file_name,$secretaryph);
      }
   } 
if(isset($_FILES['treasurerph']))
  {
      $file_name = $_FILES['treasurerph']['name'];
      $file_size = $_FILES['treasurerph']['size'];
      $file_tmp = $_FILES['treasurerph']['tmp_name'];
      $file_type = $_FILES['treasurerph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['treasurerph']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $treasurerph="upload/".$file_name;
	    rename("upload/".$file_name,$treasurerph);
      }
   } 
if(isset($_FILES['editorph']))
  {
      $file_name = $_FILES['editorph']['name'];
      $file_size = $_FILES['editorph']['size'];
      $file_tmp = $_FILES['editorph']['tmp_name'];
      $file_type = $_FILES['editorph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['editorph']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
		  
		  
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $editorph="upload/".$file_name;
	    rename("upload/".$file_name,$editorph);
      }
   } 



$sql="select * from associationmember where Association_Name='$association'";
$res=mysql_query($sql);

 if (mysql_num_rows($res)>0)
  {    
	$_SESSION['msave'] = "Association member details Alredy Exist";
  }
	else
		
	{
		$SQL="insert into  associationmember  values('$association','$dept','$year','$president','$vicepresident','$secretary','$treasurer','$editor','$presidentph','$vicepresidentph','$secretaryph','$treasurerph','$editorph')";
		
		mysql_query($SQL);
	}
header("location: associationmember.php");
?>	