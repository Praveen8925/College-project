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
     <td colspan="2" align="Center"><h2>Add Student Details</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['stsave']))
    print $_SESSION['stsave'];
  unset($_SESSION['stsave']);
?></h4>
   </tr>
<form name="studdetails" method="post" action="AddStudentSave.php" onSubmit="return AddStuForm();" >
<tr>
<td>Reg.No</td>
<td><input type="text" name="studid" id="studid" size="30">
</td>
</tr>
 <tr>
<td>Batch</td>
<td><input type="text" name="studbat" id="studbat" size="30">
</td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" name="stname" id="stname" size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td> <select name="stDept" id="stDept">
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
<td>Email-id</td>
<td>
<input type="type" name="email" id="email" size="30">
</td>
</tr>
<tr>
<td>Student/Alumni</td>
<td>
<input type="radio" name="status" id="status" value="Student" checked="checked">Student
<input type="radio" name="status"  id="status" value="Alumni">Alumni
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