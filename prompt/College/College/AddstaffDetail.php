<?php
session_start();
include_once 'database.php';
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
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h1>Addstaff Details</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['course']))
    print $_SESSION['course'];
  unset($_SESSION['course']);
?></h3>
   </tr>
<form name="staffdetails" method="post" action="AddStaffSave.php" onSubmit="return AddStfForm();" >
<tr>
<td>Staff ID</td>
<td><input type="text" name="sid" id="sid" size="30">
</td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" name="name" id="name" size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td> <select name="Dept" id="Dept">
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
<td>Designation</td>
<td>
<input type="text" name="desigtn" id="desigtn" size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="type" name="email" id="email" size="30">
</td>
</tr>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Submit" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>