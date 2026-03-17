<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
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
     <td colspan="2" align="Center"><h1>Staff Details</h1>
   </tr>
<tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['staff']))
    print $_SESSION['staff'];
  unset($_SESSION['staff']);
  $SQL= "select * from addstaff where SID='$userid'" ;
   $rs=mysql_query($SQL);  
    while($row=mysql_fetch_assoc($rs))
    {
         $name=$row["Name"];
         $sid=$row["SID"];
         $dept=$row["Department"];
         $des=$row["Designation"];
          $mail=$row["Emailid"];         
     }
     $SQL= "select * from staffdetail where SID='$userid'" ;
     $rs=mysql_query($SQL);  
     $cnt=mysql_num_rows($rs)
 ?>
</h3>
   </tr>
   <tr>
<form name="staffdetail" method="post" action="StaffSave.php" onSubmit="return staffForm();" enctype="multipart/form-data">
<td>Name</td>
<td>
<input type="text" name="name" id="name"  value=<?php print $name; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Staff id</td>
<td>
<input type="text" name="sid" id="sid" value=<?php print $sid; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td>
<input type="text" name="depart" id="depart" value=<?php print $dept; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Designation</td>
<td>
<input type="text" name="desigtn" id="desigtn" value=<?php print $des; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="text" name="email" id="email" value=<?php print $mail; ?> readonly size="30">
</td>
</tr>
<?php
      if($cnt>0)
     {
     while($row=mysql_fetch_assoc($rs))
     {
         $qua=$row["Qualification"];
         $dob=$row["DOB"];
         $Address=$row["Address"];
         $mobno=$row["Mobileno"];
         $doj=$row["DOJ"];
         $ugexp=$row["UGExp"];
         $pgexp=$row["PGExp"];
         $iexp=$row["Industryexp"];
         $domain=$row["Domain"];
         $StfPho=$row["StaffPhoto"];
         $Stfsig=$row["staffsign"];
          
         $_SESSION['StfPho']=$StfPho;
         $_SESSION['Stfsig']=$Stfsig;
     }
?>
<tr>
<td>Qualification</td>
<td>
<input type="text" name="qual" id="qual" size="30" value=<?php print $qua; ?>>
</td>
</tr>
<tr>
<td>DOB</td>
<td>
<?php
    $tdt=date_create($dob);
    $tdt=date_format($tdt,"d-m-Y");
$dob;
?>
<input type="Text" id="dob" name="dob" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('dob','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<td>Address</td>
<td>
<textarea name="address" id="address" cols="25" rows="3"><?php print $Address;?></textarea>
</td>
</tr>
<tr>
<td>Mobile No</td>
<td>
<input type="text" name="mno" id="mno" size="30" onKeyPress="return isNumberKey(event)" maxlength="12" value="<?php print $mobno;?>">
</td>
</tr>
<tr>
<td>Joining Date</td>
<td>
<?php
  $tdt=date_create($doj);
  $tdt=date_format($tdt,"d-m-Y");
?>
<input type="Text" id="date" name="date" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('date','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>UG Experience</td>
<?php
   $Exp = explode("-",$ugexp);
?>
<td>
<input type="text" name="ugexpy" id="ugexpy" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[0]?>">Years
<input type="text" name="ugexpm" id="ugexpm" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[1]?>">Months
</td>
</tr>
<tr>
<?php
   $Exp = explode("-",$pgexp);
?>
<td>PG Experience</td>
<td>
<input type="text" name="pgexpy" id="pgexpy" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[0]?>">Years
<input type="text" name="pgexpm" id="pgexpm" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[1]?>">Months
</td>
</tr>
<tr>
<?php
   $Exp = explode("-",$iexp);
?>
<td>Industry Experience</td>
<td>
<input type="text" name="iexpy" id="iexpy" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[0]?>">Years
<input type="text" name="iexpm" id="iexpm" size="3" onKeyPress="return isNumberKey(event)" value="<?php print $Exp[1]?>">Months
</td>
</tr>
<tr>
<td>Domain</td>
<td>
<textarea name="domain" id="domain" cols="25" rows="3"><?php print $domain;?></textarea>
</td>
</tr>
<tr>
<td>Staff Photo</td>
<td><image src="<?php print $StfPho;?>" width="80" height="100"><input type="file" name="stfph" id="stfph" value="aaaaaaaaaaa" ></td>
</tr>

<tr>
<td>Staff Sign</td>
<td><image src="<?php print $Stfsig;?>" width="150" height="20"><input type="file" name="stfsgn" id="stfsgn" ></td>
</tr>
<tr>
<?php
}
else
{
$_SESSION['StfPho']="";
$_SESSION['Stfsig']="";
?>
 <tr>
<td>Qualification</td>
<td>
<input type="text" name="qual" id="qual" size="30">
</td>
</tr>
<tr>
<td>DOB</td>
<td>
<input type="Text" id="dob" name="dob" maxlength="20" size="20"  onClick="javascript:NewCssCal('dob','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Address</td>
<td>
<textarea name="address" id="address" cols="25" rows="3"></textarea>
</td>
</tr>
<tr>
<td>Mobile No</td>
<td>
<input type="text" name="mno" id="mno" size="30" onKeyPress="return isNumberKey(event)" maxlength="12">
</td>
</tr>
<tr>
<td>Joining Date</td>
<td>
<input type="Text" id="date" name="date" maxlength="20" size="20"  onClick="javascript:NewCssCal('date','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>UG Experience</td>
<td>
<input type="text" name="ugexpy" id="ugexpy" size="3" onKeyPress="return isNumberKey(event)" value="0">Years
<input type="text" name="ugexpm" id="ugexpm" size="3" onKeyPress="return isNumberKey(event)" value="0">Months
</td>
</tr>
<tr>
<td>PG Experience</td>
<td>
<input type="text" name="pgexpy" id="pgexpy" size="3" onKeyPress="return isNumberKey(event)" value="0">Years
<input type="text" name="pgexpm" id="pgexpm" size="3" onKeyPress="return isNumberKey(event)" value="0">Months
</td>
</tr>
<tr>
<td>Industry Experience</td>
<td>
<input type="text" name="iexpy" id="iexpy" size="3" onKeyPress="return isNumberKey(event)" value="0">Years
<input type="text" name="iexpm" id="iexpm" size="3" onKeyPress="return isNumberKey(event)" value="0">Months
</td>
</tr>
<tr>
<td>Domain</td>
<td>
<textarea name="domain" id="domain" cols="25" rows="3"></textarea>
</td>
</tr>
<tr>
<td>Staff Photo</td>
<td><input type="file" name="stfph" id="stfph" ></td>
</tr>
<tr>
<td>Staff Sign</td>
<td><input type="file" name="stfsgn" id="stfsgn"></td>
</tr>
<?php
}
?>
<td colspan="2">
<center>
<input type="Submit" Value="Update" id="Update" class="btn">
</center>
</td>
</tr></form>
    </table></div>

</body>
</html>