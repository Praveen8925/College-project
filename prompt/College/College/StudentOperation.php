<?php
   include_once 'Check.php';
   include_once("Database.php"); 
   if(isset($_GET['action']))
   {
      $operation=$_GET['action'];
      $_SESSION['Operation']=$operation;
    }
    else
      $operation=$_SESSION['Operation'];
      if(isset($_SESSION['sstudid']))
       {
      $cusmob=$_SESSION['sstudid'];
      unset($_SESSION['sstudid']);
       }
      else
      $cusmob=$_GET['id'];
   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
<?php
     if($operation=="View")
    {
?>
    <td colspan="2" align="Center"><h1>Student View Details</h1>
   </tr>
<?php
     }
     if($operation=="Edit")
    {
?>
   <td colspan="2" align="Center"><h1>Student Edit Details</h1>
   </tr>
<tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['student']))
    print $_SESSION['student'];
  unset($_SESSION['student']);
 
$regno="$cusmob"; 
  $SQL= "select * from student where RegNo ='$regno' ";
   $rs=mysql_query($SQL); 
     while($row=mysql_fetch_assoc($rs))
    {
         $name=$row["Name"];
         $regno=$row["RegNo"];
         $dept=$row["Department"];
         $email=$row["Email-id"];
		 
     }
      $SQL= "select * from studentpersonal where RegNo='$regno'" ;
      $rs=mysql_query($SQL);  
      $cnt=mysql_num_rows($rs);
     
 ?>
</h3>
   </tr>
   <tr>
<form name="studentDetail" method="post" action="StudentSave.php" onsubmit="return studForm();"  enctype="multipart/form-data">
<tr>
<td>Reg.No</td>
<td><input type="text" name="studid" id="studid" value=<?php print $regno; ?> readonly size="30">
</td>
</tr><td>Name</td>
<td>
<input type="text" name="name" id="name" value=<?php print $name; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Course</td>
<td>
<input type="text" name="course" id="course" value=<?php print $dept; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="text" name="email" id="email" value="<?php print $email;?>" readonly size="30">
</td>  
</tr>

<?php
      if($cnt>0)
     {
     while($row=mysql_fetch_assoc($rs))
     {
		 $aadharno=$row["aadharno"];
         $pname=$row["Parentsname"];
         $dob=$row["Dob"];
         $address=$row["Address"];
         $mobno=$row["Mobileno"];
         $occ=$row["Occupation"];
         $pincode=$row["Pincode"];
         $adate=$row["AdmissionDate"];
         $an=$row["AdmissionNo"];
         $nat=$row["Nationality"];
         $com=$row["Community"];
         $caste=$row["Caste"];
         $gender=$row["Gender"];
         $bgroup=$row["Bgroup"];
         $pmno=$row["Pmobileno"];
         $tenmark=$row["TenthMark"];
         $tmark=$row["TwelvethMark"];
         $Studphoto=$row["StudentPhoto"];
     }
?>
<tr>
<td>Aadhaar no</td>
<td>
<input type="text" name="aadharno" id="aadharno" value="<?php print $aadharno;?>" readonly size="30">
</td>  
</tr>

<tr>
<td>Date Of Birth</td>
<td>
<?php
    $tdt=date_create($dob);
    $tdt=date_format($tdt,"d-m-Y");
$dob;
?>
<input type="text" name="dob" id="dob" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('dob','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Blood Group</td>
<td>
<input type="text" name="bg" id="bg" value="<?php print $bgroup;?>" size="30">
</td>
</tr>
<tr>
<td>Parent Name</td>
<td>
<input type="text" name="pname" id="pname" value="<?php print $pname;?>" size="30">
</td>
</tr>
<tr>
<td>Occupation</td>
<td>
<input type="text" name="occupation" id="occupation" value="<?php print $occ;?>" size="30">
</td>
</tr>
<tr>
<td>Address</td>
<td>
<textarea name="address" id="address" cols="25" rows="3" ><?php print $address;?> </textarea>
</td>
</tr>
<tr>
<td>Pincode</td>
<td>
<input type="text" name="pcode" id="pcode" onKeyPress="return isNumberKey(event)" maxlength="6" value="<?php print $pincode;?>" size="30">
</td>
</tr>
<tr>
<td>
Mobile Number
</td>
</tr>
<tr>
<td>Father/Mother </td>
<td>
<input type="text" name="pmno" id="pmno" onKeyPress="return isNumberKey(event)" maxlength="12" value="<?php print $pmno;?>" size="30">
</td>
</tr>
<tr>
<tr>
<td>Student</td>
<?php
    if($mobno == "0")
        $mobno="";
      
?>
<td>
<input type="text" name="mno" id="mno" onKeyPress="return isNumberKey(event)" maxlength="12" value="<?php print $mobno;?>" size="30">
</td>
</tr>
<tr>
<td>Admission Date</td>
<td>
<?php
    if($adate <> "0000-00-00")
      {
    $adate=date_create($adate);
    $adate=date_format($adate,"d-m-Y");
       }
    else
       $adate="";
?>
<input type="text" name="admdate" id="admdate" value="<?php print $adate; ?>" size="30"  onClick="javascript:NewCssCal('admdate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<?php
    if($an == "0")
      {
            $an="";  
           }     
?>
<td>Admission No</td>
<td>
<input type="text" name="admno" id="admno" value="<?php print $an; ?>" onKeyPress="return isNumberKey(event)" maxlength="6"  size="30">
</td>
</tr>
<tr>
<td>Nationality</td>
<td>
<input type="text" name="nation" id="nation" value="<?php print $nat;?>" size="30">
</td>
</tr>
<tr>
<td>Community</td>
<td>
<input type="text" name="community" id="community" value="<?php print $com; ?>" size="30">
</td>
</tr>
<tr>
<td>Caste</td>
<td>
<input type="text" name="caste" id="caste" value="<?php print $caste; ?>" size="30">
</td>
</tr>
<tr>
<td>Gender</td>
<td>
<input type="radio" name="gen" id="gen" value="Male" <?php if($gender=="Male"){ print "checked='checked'";} ?>  >Male
<input type="radio" name="gen" id="gen" value="Female" <?php if($gender=="Female"){print "checked='checked'";} ?> >Female
</td>
</tr>
<tr>
<td>10th Mark</td>
<td>
<input type="text" name="tenmark" id="tenmark" value="<?php print $tenmark; ?>" onKeyPress="return isNumberKey(event)" maxlength="5" size="30">
</td>
</tr>
<tr>
<td>12th Mark</td>
<td>
<input type="text" name="tmark" id="tmark" value="<?php print $tmark; ?>" onKeyPress="return isNumberKey(event)" maxlength="5" size="30">
</td>
</tr>
<tr>
<td>Student Photo</td>
<td><image src="<?php print $Studphoto;?>" width="80" height="100"><input type="file" name="studph" id="studph" ></td>
</tr>
<?php
}
else
{
?>
<tr>
<tr>
<td>Aadhaar no</td>
<td>
<input type="text" name="aadharno" id="aadharno" size="30">
</td>  
</tr>
<tr>
<td>Date Of Birth</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="text" name="dob" id="dob"  maxlength="20" size="20"  onClick="javascript:NewCssCal('dob','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Blood Group</td>
<td>
<input type="text" name="bg" id="bg"  size="30">
</td>
</tr>
<tr>
<td>Parent Name</td>
<td>
<input type="text" name="pname" id="pname"  size="30">
</td>
</tr>
<tr>
<td>Occupation</td>
<td>
<input type="text" name="occupation" id="occupation"  size="30">
</td>
</tr>
<tr>
<td>Address</td>
<td>
<textarea name="address" id="address" cols="25" rows="3" size="30"></textarea>
</td>
</tr>
<tr>
<td>Pincode</td>
<td>
<input type="text" name="pcode" id="pcode"  size="30" onKeyPress="return isNumberKey(event)" maxlength="6">
</td>
</tr>
<tr>
<td>
Mobile Number
</td>
</tr>
<tr>
<td>Father/Mother </td>
<td>
<input type="text" name="pmno" id="pmno" onKeyPress="return isNumberKey(event)" maxlength="12"  size="30">
</td>
</tr>
<tr>
<tr>
<td>Student</td>
<td>
<input type="text" name="mno" id="mno" onKeyPress="return isNumberKey(event)" maxlength="12"  size="30">
</td>
</tr>
<tr>
<td>Admission Date</td>
<td>
<input type="text" name="admdate" id="admdate"  size="30"  onClick="javascript:NewCssCal('admdate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Admission No</td>
<td>
<input type="text" name="admno" id="admno" onKeyPress="return isNumberKey(event)" maxlength="6"  size="30">
</td>
</tr>
<tr>
<td>Nationality</td>
<td>
<input type="text" name="nation" id="nation"  size="30">
</td>
</tr>
<tr>
<td>Community</td>
<td>
<input type="text" name="community" id="community"  size="30">
</td>
</tr>
<tr>
<td>Caste</td>
<td>
<input type="text" name="caste" id="caste"  size="30">
</td>
</tr>
<tr>
<td>Gender</td>
<td>
<input type="radio" name="gen" id="gen" value="Male" checked="checked">Male
<input type="radio" name="gen" id="gen" value="Female">Female
</td>
</tr>
<tr>
<td>10th Mark</td>
<td>
<input type="text" name="tenmark" id="tenmark"  onKeyPress="return isNumberKey(event)" maxlength="5" size="30">
</td>
</tr>
<tr>
<td>12th Mark</td>
<td>
<input type="text" name="tmark" id="tmark" onKeyPress="return isNumberKey(event)" maxlength="5" size="30">
</td>
</tr>
<tr>
<td>Student Photo</td>
<td><input type="file" name="studph" id="studph" ></td>
</tr>
<?php
}
?>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Update" class="btn">
</center>
</td>
</tr>
</form>
    
<?php
     }
     if($operation=="Delete")
    {
?>
   <td colspan="2" align="Center"><h1>Student Delete Details</h1>
   </tr>
<?PHP
    $regno="$cusmob";
          $SQL="DELETE FROM studentpersonal where RegNo='$regno'";
       $rs=mysql_query($SQL);         
 print "sucessfully delete".$regno;
     }
?>
</body>
</html>