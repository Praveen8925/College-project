<?php
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$tb=$batch.'yearattendance';

$dept = $_POST["dept"];
$sem = $_POST["sem"];
$dt=$_POST['atdate'];   
$num = count($_POST["regno"]);
$fn=$_POST["fn"];
$an=$_POST["an"];
$Ihour=$_POST['Ihour'];
$IIhour=$_POST['IIhour'];
$IIIhour=$_POST['IIIhour'];
$IVhour=$_POST['IVhour'];
$Vhour=$_POST['Vhour'];
$VIhour=$_POST['VIhour'];
$yn=$_POST['yn'];
$dt=date_create($dt);
 $dt=date_format($dt,"Y-m-d");
 $Ihourab="";
 $IIhourab="";
 $IIIhourab="";
 $IVhourab="";
 $Vhourab="";
 $VIhourab="";
for($i=1;$i<=$num;$i++)
{
	
	$val[$i]=$_POST['regno'][$i-1];
	
	if($_POST['Ihour'][$i-1]=="AB")
	if($Ihourab=="")
		$Ihourab=$_POST['regno'][$i-1];
	else
		$Ihourab=$Ihourab."-".$_POST['regno'][$i-1];
	if($_POST['IIhour'][$i-1]=="AB")
	if($IIhourab=="")
		$IIhourab=$_POST['regno'][$i-1];
	else
		$IIhourab=$IIhourab."-".$_POST['regno'][$i-1];
	if($_POST['IIIhour'][$i-1]=="AB")
	if($IIIhourab=="")
		$IIIhourab=$_POST['regno'][$i-1];
	else
		$IIIhourab=$IIIhourab."-".$_POST['regno'][$i-1];
	
	
	
	if($_POST['IVhour'][$i-1]=="AB")
	if($IVhourab=="")
		$IVhourab=$_POST['regno'][$i-1];
	else
		$IVhourab=$IVhourab."-".$_POST['regno'][$i-1];
	if($_POST['Vhour'][$i-1]=="AB")
	if($Vhourab=="")
		$Vhourab=$_POST['regno'][$i-1];
	else
		$Vhourab=$Vhourab."-".$_POST['regno'][$i-1];
	if($_POST['VIhour'][$i-1]=="AB")
		if($VIhourab=="")
			$VIhourab=$_POST['regno'][$i-1];
		else
			$VIhourab=$VIhourab."-".$_POST['regno'][$i-1];
	


if($yn=="Submit")

$SQL="insert into $tb values('$batch','$dept','$sem','$dt','$Ihourab','$IIhourab','$IIIhourab','$IVhourab','$Vhourab','$VIhourab')";

else

$SQL = "update $tb set Ihour='$Ihourab',IIhour='$IIhourab',IIIhour='$IIIhourab',IVhour='$IVhourab',Vhour='$Vhourab',VIhour='$VIhourab' where Batch='$batch' and Semester='$sem' and  Date='$dt'";
//print $SQL;
}
mysql_query($SQL);


$_SESSION['mark'] = "Record Saved Successfully";
header("location: ClassAttendance.php");
?>