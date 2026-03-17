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
     <td colspan="2" align="Center"><h1>Student Details</h1>
   </tr>
<tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['student']))
    print $_SESSION['student'];
  unset($_SESSION['student']);
?></h3>
   </tr>
<form name="studentDetail" method="post" action="StudentSave.php" onsubmit="return studForm();">
<tr>
<td>Name</td>
<td>
<input type="text" name="Name" id="name" size="30">
</td>
</tr>
<tr>
<td>Reg.No</td>
<td><input type="text" name="studid" id="studid" size="30">
</td>
</tr>
<tr>
<td>Course</td>
<td>
<input type="text" name="Course" id="course" size="30">
</td>
</tr>
<tr>
<td>Aadhar no</td>
<td>
<input type="text" name="aadharno" id="aadharno" size="30">
</td>
</tr>
<tr>
<td>Phone no</td>
<td>
<input type="text" name="studphone" id="studphone" size="30">
</td>
</tr>
<tr>
<td>Date Of Birth</td>
<td>
<input type="text" name="Date Of Birth" id="dob" size="30">
</td>
</tr>
<tr>
<td>Blood Group</td>
<td>
<input type="text" name="Blood Group" id="bg" size="30">
</td>
</tr>
<tr>
<td>Parent Name</td>
<td>
<input type="text" name="Parent Name" id="pname" size="30">
</td>
</tr>
<tr>
<td>Occupation</td>
<td>
<input type="text" name="Occupation" id="occupation" size="30">
</td>
</tr>
<tr>
<td>Address</td>
<td>
<input type="text" name="Address" id="address" size="30">
</td>
</tr>
<tr>
<td>Pincode</td>
<td>
<input type="text" name="Pincode" id="pcode" size="30">
</td>
</tr>
<tr>
<td>Mobile No</td>
<td>
<input type="text" name="Mobile No" id="mno" size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="text" name="Email-id" id="email" size="30">
</td>
</tr>
<tr>
<td>Admission Date</td>
<td>
<input type="text" name="Admission Date" id="admdate" size="30">
</td>
</tr>
<tr>
<td>Admission No</td>
<td>
<input type="text" name="Admission No" id="admno" size="30">
</td>
</tr>
<tr>
<td>Nationality</td>
<td>
<input type="text" name="Nationality" id="nation" size="30">
</td>
</tr>
<tr>
<td>Community</td>
<td>
<input type="text" name="Community" id="community" size="30">
</td>
</tr>
<tr>
<td>Caste</td>
<td>
<input type="text" name="Caste" id="caste" size="30">
</td>
</tr>
<tr>
<td>Gender</td>
<td>
<input type="radio" name="Gender" id="gen" value="Male">Male
<input type="radio" name="Gender" id="gen" value="Female">Female
</td>
</tr>
<td>Co-Curricular Activities</td>
<td>
<input type="text" name="CCA" id="cca" size="30">
</td>
</tr>
<tr>
<td>Student Photo</td>
<td><input type="file" name="stuph" id="studph">
</tr>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" class="btn">
<input type="Submit" Value="Add" class="btn">
<input type="Submit" Value="Update" class="btn">
<input type="Submit" Value="Delete" class="btn">
</center>
</td>
</tr>
</form>
    </table></div>

</body>
</html>