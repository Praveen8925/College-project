<?php
session_start();	 
include_once 'database.php';
 $batch = $_POST["batch"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $courseid = $_POST["courseid"];
$courseid=strtoupper($courseid);
$coursename = $_POST["coursename"];
$coursename=strtoupper($coursename);
$type = $_POST["tp"];
$extmark = $_POST["extmark"];
$c1mark = $_POST["c1mark"];
$c2mark = $_POST["c2mark"];
$mmark = $_POST["mmark"];
$attmark = $_POST["attmark"];
$assmark = $_POST["assmark"];
$record = $_POST["record"];
$lab = $_POST["lab"];
$SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
 $rs=mysql_query($SQL);
     $db_field=mysql_fetch_assoc($rs);
     $decided=$db_field['decided'];print $decided;
      print mysql_num_rows($rs);
     if($decided=='y' or mysql_num_rows($rs)==0)
         {

if($type =="Theory")
$mark=$extmark."-".$c1mark."-".$c2mark."-".$mmark."-".$attmark."-".$assmark;
else
$mark=$extmark."-".$c1mark."-".$c2mark."-".$mmark."-".$record."-".$lab; 
$d='y';
$credit = $_POST["credit"];
$part = $_POST["part"];
 $rs=mysql_query("select * from  subjectdetails where CourseID='$courseid'");
 if (mysql_num_rows($rs)>0)
  {
	$_SESSION['subject'] = "Course Name Alredy Exist <br> Record Not Saved";
  }
  else
  {    
    mysql_query("insert into subjectdetails values('$batch','$sem','$dept','$courseid','$coursename','$type','$mark','$credit','$part','$d')") or die(mysql_error());
    $_SESSION['subject'] = "Record Saved Successfully";
  }
   }
   else
     $_SESSION['subject'] = " Record Not Saved <br>This Semister was finalized";
  header("location: addsubject.php");
?>