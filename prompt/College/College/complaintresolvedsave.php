<?php
session_start();
include_once 'database.php';
if(isset($_POST['cid']))
$cid=$_POST["cid"];

$date=$_POST["date"];

$to=$_POST["to"];
$desc=$_POST["desc"];
$dt=date_create($date);
 $dt=date_format($dt,"Y-m-d");
if($to==NULL)
{
$SQL="update complaint set Status='resolved',solved_description='$desc',rdate='$dt' where Complaint_ID='$cid'";
$_SESSION['recomplaint'] = "Complaint solved Successfully";
//print $SQL;
}
else
{
	$SQL="update complaint set Complaint_To='$to',rdate='$dt' where Complaint_ID='$cid'";
	$_SESSION['recomplaint'] = "Complaint Transfered to $to  Successfully";
	//print $SQL;
}
mysql_query($SQL);
header("location: complaintresolved.php");
?>

