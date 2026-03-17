 <?php
session_start();
   include_once 'database.php';
?>

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
     <td colspan="2" align="Center"><h2>Add Association</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['asave']))
    print $_SESSION['asave'];
  unset($_SESSION['asave']);
?></h4>
   </tr>
<form name="studdetails" method="post" action="associationsave.php" >
<tr>
<td>Association Name</td>
<td><input type="text" name="associationname" id="studid" size="30">
</td>
</tr>
 
<tr>
<td>Department</td>
<td> <select name="Dept" id="stDept">
  <option value="Select">Select</option>
  <?php
    $rs=mysql_query("select * from coursedetails");
    while($row=mysql_fetch_row($rs))
    {
	print "<option values=$row[0]>$row[0]</option>";
    }

   ?>
</select> 
</td>
</tr>
<tr>
<td>Description</td>
<td><textarea type="text" name="description" id="studbat" size="30"maxlength="250" cols="62" rows="6"></textarea>
</td>
</tr>

<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Reset" Value="Reset" id="Reset" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>