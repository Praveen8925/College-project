<?php
session_start();
   include_once 'database.php';
   $uid=$_SESSION['AU'];
   $SQLS="select * from addstaff where SID='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dep=$ress["Department"];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>

</head>
<body>
<div class="allblur">
   <table width="35%" border="0" class="font-stylec" align="Center">
   <tr>
     <td colspan="2" align="Center"><h2>Association Details</h2></td>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['msave']))
    print $_SESSION['msave'];
  unset($_SESSION['msave']);
?></h4></td>
   </tr>
<form name="studdetails" method="post" action="#" enctype="multipart/form-data">


<tr>
<td>Association Name</td>
<td> <select name="association" id="stDept">
  <option value="Select">Select</option>
  <?php
    $rs=mysql_query("select * from association where Department='$dep'");
    while($row=mysql_fetch_row($rs))
    {
	print "<option values=$row[0]>$row[0]</option>";
    }

   ?>
</select> 
</td>
</tr>
 
<tr>
<td>Department</td>
<td> <select name="Dept" id="stDept">
  <option value="<?php print "$dep" ?>"><?php print "$dep" ?></option>

</select> 
</td>
</tr>

<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
</center>
</td>
</tr>
</form>
</table>
<?php
if($_POST)
{
	$association=$_POST["association"];
	$dept=$_POST["Dept"];
	
	$sqls="select * from association where Department='$dept'";
	$res=mysql_query($sqls);

?>
<table width="80%" border="1" align="Center">
<tr>
<th>
   SI.No
</th>
<th>
   Association Name
</th>
<th>
  Description
</th>
</tr>
<?php
$i=1;
while($row=mysql_fetch_assoc($res))
{
	print '<tr><td>'.$i.'</td><td>'.$row["Association_Name"].'</td><td>'.$row["Description"].'</td>';
	$i++;
}
}

?>
</table></div>
</body>
</html>