<?php
session_start();
include_once 'database.php';
$cname=$_POST['cname'];
$date=$_POST['atdate'];
$time=$_POST['time'];
$dept=$_POST['dept'];  
$depts=implode("-",$dept);
$eleg=$_POST['eleg'];  
$elegs=implode("-",$eleg);
	 	 
$njob=$_POST['njob'];
$location=$_POST['location'];
$status=$_POST['status'];
$venue=$_POST['venue'];
$vaddress=$_POST['vaddress'];

$arrear=$_POST['ha'];
$ugper=$_POST['ug'];
$pgper=$_POST['pg'];
$dt=date_create($date);
 $dt=date_format($dt,"Y-m-d");
 if($status=="OffCampus")
 {
      $SQL = "insert into  upcompanies values('$cname','$dt','$time','$depts','$njob','$location','$status','$venue','$vaddress','$elegs','$arrear','$ugper','$pgper')";
	  //print $SQL;
      $result = mysql_query($SQL);
	  $_SESSION['uc'] = "Record  saved";
	  
 }  
 
 else
 {
	
	 $SQL = "insert into  upcompanies(Company_Name,Date,Time,Degree,Nature_Job,Location,Recruitment_type,Elegibility,Arrears,ugpercentage,pgpercentage) values('$cname','$dt','$time','$depts','$njob','$location','$status','$elegs','$arrear','$ugper','$pgper')";
	 $result = mysql_query($SQL);
	  $_SESSION['uc'] = "Record  saved";
 }
	  header("location: ucompanies.php");


?>