<?php
session_start();
include_once 'database.php';
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
     <td colspan="2" align="Center"><h2>Company Details</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['vcompanies']))
    print $_SESSION['vcompanies'];
  unset($_SESSION['vcompanies']);
?></h4>
   </tr>
</table>
 <form name="vcompanies" method="post" action="#">
   

<?php
$i=1;
$SQL="select * from upcompanies where Recruitment_type='OnCampus' ";    
$res=mysql_query($SQL);
if(mysql_num_rows($res)==0)
	print "<h2>No Companies Registered</h2>";
else
{
	
?>	
	<center>
 <table width="80%" border="1">

<tr>
<td colspan="9"><center>OnCampus<center></td>

  <tr>

<th>
SL.NO
</th>
 <th>
Company Name
</th>
<th>
Date
</th>
<th>
Time
</th>
<th>
Degree
</th>
<th>
Nature of Job
</th>
<th>
Job Location
</th>
<th>
Elegibility
</th>
<th>
Arrears
</th>
</tr>
<?php
	while($row=mysql_fetch_assoc($res))
	{
		print"<tr><td>$i</td><td>".$row["Company_Name"]."</td><td>".$row["Date"]."</td><td>".$row["Time"]."</td><td>".$row["Degree"]."</td><td>".$row["Nature_Job"]."</td><td>".$row["Location"]."</td><td>".$row["Elegibility"]."</td><td>".$row["Arrears"]."</td>";
		$i++;
	}
}


?>


</table>
</center>
<br>
<br>
<?php
$i=1;
$SQL="select * from upcompanies where Recruitment_type='OffCampus' ";    
$res=mysql_query($SQL);

	
?>	
	<center>
 <table width="80%" border="1">

<tr>
<td colspan="10"><center>OffCampus<center></td>

  <tr>

<th>
SL.NO
</th>
 <th>
Company Name
</th>
<th>
Date
</th>
<th>
Time
</th>
<th>
Degree
</th>
<th>
Nature of Job
</th>
<th>
Job Location
</th>
<th>
Venue of College
<th>
Elegibility
</th>
<th>
Arrears
</th>
</tr>

<?php
if(mysql_num_rows($res)==0)
	print '<tr>
<td colspan="10"><center> No Companies Registered <center></td>';
else
{
	while($row=mysql_fetch_assoc($res))
	{
		print"<tr><td>$i</td><td>".$row["Company_Name"]."</td><td>".$row["Date"]."</td><td>".$row["Time"]."</td><td>".$row["Degree"]."</td><td>".$row["Nature_Job"]."</td><td>".$row["Location"]."</td><td>".$row["Venue_college"]."</td><td>".$row["Elegibility"]."</td><td>".$row["Arrears"]."</td>";
		$i++;
	}
}


?>


</table>
</center>
</form>
</body>
</html>   
   