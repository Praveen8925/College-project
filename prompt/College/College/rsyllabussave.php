<?php
session_start();
include_once 'database.php';

$batch=$_POST["batch"];
$dept=$_POST["Dept"];
$syllabus=$_POST["syllabus"];
if(isset($_FILES['syllabus']))
  {
      $file_name = $_FILES['syllabus']['name'];
      $file_size = $_FILES['syllabus']['size'];
      $file_tmp = $_FILES['syllabus']['tmp_name'];
      $file_type = $_FILES['syllabus']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['syllabus']['name'])));
      $expensions= array("pdf");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a pdf file.";
      }      
      if($file_size > 300145728) 
      {
         $_SESSION['error']='File size must be excately 3 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"rsyllabus/".$file_name);
          $syllabus="rsyllabus/".$file_name;
	    rename("rsyllabus/".$file_name,$syllabus);
      }
   } 
   $sql="select * from syllabus where Batch='$batch'and Department='$dept'and Type='r'";
$res=mysql_query($sql);

 if (mysql_num_rows($res)>0)
  {    
	$_SESSION['syllabus'] = "Syllabus  Alredy Exist <br> Record Not Saved";
  }
	else
		
	{
		$SQL="insert into  syllabus  values('$batch','$dept','r','$syllabus')";
		
		mysql_query($SQL);
		$_SESSION['syllabus'] = "Syllabus  saved";
	}
	
	 header("location: syllabus.php");
	 
	 ?>