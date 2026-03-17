<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
   $SQL= "select * from student where RegNo='$regno'";
   $result=mysql_query($SQL);
   while($row=mysql_fetch_assoc($result))
   {
	   $batch=$row["Batch"];
	   $dept=$row["Department"];
   }
   $dt=date("d-m-Y");
$dt=date_create($dt);
 $dt=date_format($dt,"Y-m-d");
$cmp=$_POST["cmp"];
$to=$_POST["to"];
$descp=$_POST["desc"];
$cls=$_POST["clsno"];
$SQL="select * from complaint";
	$res=mysql_query($SQL);
	$count=mysql_num_rows($res);
	$id;
	if($count==0)
		$id=1;
	else
		$id=$count+1;
	$cid="c".$id;
	
$_POST['to'];  
     foreach($_POST['to'] as $to) {
     //echo $to."-";
	 
	

if($cls==NULL)
{  
	
	$sql="insert into complaint (Complaint_ID,Batch,Department,Type,Complaint_To,Description,Date,Status) values ('$cid','$batch','$dept','$cmp','$to','$descp','$dt','notsolved')";
	$rs=mysql_query($sql);
	//print $sql;
	$_SESSION['complaint'] = "Complaint  saved";
}
else
{
	$sql="insert into complaint (Complaint_ID,Batch,Department,Type,Complaint_To,Description,class_no,Date,Status) values('$cid','$batch','$dept','$cmp','$to','$descp','$cls','$dt','notsolved')";
	$rs=mysql_query($sql);
	//print $sql;
	$_SESSION['complaint'] = "Complaint  saved";
}  
	 } 
   header("location: complaint.php");
   
	 
?>