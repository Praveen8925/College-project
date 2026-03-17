<?php
session_start();
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
     <td colspan="2" align="Center"><h1>Programme Details</h1>
   </tr>
<tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['course']))
    print $_SESSION['course'];
  unset($_SESSION['course']);
?></h3>
   </tr>
<tr>
<form name="Programmedetails" method="post" action="ProgrammeSave.php" onSubmit="return courseForm();" >
<td>Programme Name</td>
<td><input type="text" name="cname" id="cname" size="30"> (E.g: B.Sc(IT))
</td>
</tr>
<tr>
<td>Department</td>
<td>
<input type="text" name="bname" id="bname" size="30">
</td>
</tr>
<tr>
<td>Short Form</td>
<td>
<input type="text" name="sform" id="sform" size="30">
</td>
</tr>
<tr>
<td>Branch Type</td>
<td>
<input type="radio" name="btype" id=" btype" value="Regular" checked="checked">Regular
<input type="radio" name="btype"  id="btype" value="PartTime">PartTime
</td>
</tr>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="sub" class="btn">
<input type="Submit" Value="Cancel" id="can" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>