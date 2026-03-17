<?php
session_start();
   include_once 'database.php';
   $uid=$_SESSION['AU'];
   
   
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h2>Complaints Registered</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['vcomplaint']))
    print $_SESSION['vcomplaint'];
  unset($_SESSION['vcomplaint']);
?></h4>
   </tr>
</table>
 <form name="viewcomplaint" method="post" action="complaintresolved.php">
   
<center>
 <table width="80%" border="1">
  <tr>
  <th>
  </th>
<th>
   ID
</th>
 <th>
Type
</th>
<th>
Description
</th>
<th>
Room No
</th>
<th>
Date
</th>
</tr>
<?php
$sql="select * from classincharge where SID='$uid'";
   $rs=mysql_query($sql);
$sqlh="select * from addstaff where SID='$uid'";
   $rsh=mysql_query($sqlh);   
   
if(mysql_num_rows($rs)!=0)
{	
   while($row=mysql_fetch_assoc($rs))
   {
	   $batch=$row["Batch"];
	   $dept=$row["Department"];
	   
   }
$SQL="select * from complaint where Batch='$batch' and Department='$dept'and Complaint_To='classincharge'";    
$res=mysql_query($SQL);
if(mysql_num_rows($res)==0)
	print "<h2>No complaints Registered</h2>";
else
{
	while($row=mysql_fetch_assoc($res))
	{
		print"<tr><td><input type='radio' name='cid' value=".$row["Complaint_ID"]."></td><td>".$row["Complaint_ID"]."</td><td>".$row["Type"]."</td><td>".$row["Description"]."</td><td>".$row["class_no"]."</td><td>".$row["Date"]."</td>";
		
	}
}
}
elseif(mysql_num_rows($rsh)!=0)
{

	
   while($row=mysql_fetch_assoc($rsh))
   {
	   
	   $dept=$row["Department"];
	   
   }
$SQL="select * from complaint where Department='$dept'and Complaint_To='hod'";    
$res=mysql_query($SQL);
if(mysql_num_rows($res)==0)
	print "<h2>No complaints Registered</h2>";
else
{
	while($row=mysql_fetch_assoc($res))
	{
		print"<tr><td><input type='radio' name='cid' value=".$row["Complaint_ID"]."></td><td>".$row["Complaint_ID"]."</td><td>".$row["Type"]."</td><td>".$row["Description"]."</td><td>".$row["class_no"]."</td><td>".$row["Date"]."</td>";
		
	}
}	

}

?>
<tr>
<td colspan="6">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">

</center>
</td>
</tr>

</table>
</center>
</form>
</body>
</html>