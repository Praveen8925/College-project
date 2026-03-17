<?php
   include_once 'Check.php';
   include_once("Database.php"); 
   $regno=$_SESSION['AU'];
  	 
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
   
<?php 
  if(isset($_SESSION['student']))
    print $_SESSION['student'];
  unset($_SESSION['student']);
        $SQL= "select * from studentpersonal where RegNo='$regno'" ;
      $rs=mysql_query($SQL); 
	  $rss=mysql_num_rows($rs);
 if($rss>0)
 {

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
     while($row=mysql_fetch_assoc($rs))
     {
		 $photo=$row['StudentPhoto'];
 ?>
</h3>
   </tr>
   <center>
<table>  
  <tr>
   
<td align="center">
<?php
echo '<img src="'.$photo.'" alt="HTML5 Icon" style="width:128px;height:128px">';
   ?>
   </td>
   </tr>
   </table>
   </center>
   <table width="100%" border="0" class="font-stylec">
   <tr>

    <td colspan="2" align="Center"><h1></h1>
   </tr>

<tr>
     <td colspan="2" align="Center"><h3>
   <tr>
<form name="studentDetail" method="post" action="#" onsubmit="return studForm();"  enctype="multipart/form-data">

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
<input type="text" name="dob" id="dob" maxlength="20" size="20" value="<?php echo $tdt; ?>" readonly />
</td>
</tr>
<tr>
<td>Blood Group</td>
<td>
<input type="text" name="bg" id="bg" value="<?php print $bgroup;?>"readonly size="30">
</td>
</tr>
<tr>
<td>Parent Name</td>
<td>
<input type="text" name="pname" id="pname" value="<?php print $pname;?>"readonly size="30">
</td>
</tr>
<tr>
<td>Occupation</td>
<td>
<input type="text" name="occupation" id="occupation" value="<?php print $occ;?>" readonly size="30">
</td>
</tr>
<tr>
<td>Address</td>
<td>
<textarea name="address" id="address" cols="25" rows="3" readonly><?php print $address;?> </textarea>
</td>
</tr>
<tr>
<td>Pincode</td>
<td>
<input type="text" name="pcode" id="pcode" onKeyPress="return isNumberKey(event)" maxlength="6" value="<?php print $pincode;?>"readonly size="30">
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
<input type="text" name="pmno" id="pmno" onKeyPress="return isNumberKey(event)" maxlength="12" value="<?php print $pmno;?>"readonly size="30">
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
<input type="text" name="mno" id="mno" onKeyPress="return isNumberKey(event)" maxlength="12" value="<?php print $mobno;?>"readonly size="30">
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
<input type="text" name="admdate" id="admdate" value="<?php print $adate; ?>" size="30" readonly />
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
<input type="text" name="admno" id="admno" value="<?php print $an; ?>" onKeyPress="return isNumberKey(event)" maxlength="6"readonly  size="30">
</td>
</tr>
<tr>
<td>Nationality</td>
<td>
<input type="text" name="nation" id="nation" value="<?php print $nat;?>"readonly size="30">
</td>
</tr>
<tr>
<td>Community</td>
<td>
<input type="text" name="community" id="community" value="<?php print $com; ?>"readonly size="30">
</td>
</tr>
<tr>
<td>Caste</td>
<td>
<input type="text" name="caste" id="caste" value="<?php print $caste; ?>"readonly size="30">
</td>
</tr>
<tr>
<td>Gender</td>
<td>
<input type="radio" name="gen" id="gen" value="Male" <?php if($gender=="Male"){ print "checked='checked'";} ?> readonly >Male
<input type="radio" name="gen" id="gen" value="Female" <?php if($gender=="Female"){print "checked='checked'";} ?> readonly>Female
</td>
</tr>
<tr>
<td>10th Mark</td>
<td>
<input type="text" name="tenmark" id="tenmark" value="<?php print $tenmark; ?>" onKeyPress="return isNumberKey(event)" maxlength="5"readonly size="30">
</td>
</tr>
<tr>
<td>12th Mark</td>
<td>
<input type="text" name="tmark" id="tmark" value="<?php print $tmark; ?>" onKeyPress="return isNumberKey(event)" maxlength="5"readonly size="30">
</td>
</tr>
<?php
 }
 else 
	 print '<h1 align="center">No data found</h1>'; 
?>



</form>
    

</body>
</html>