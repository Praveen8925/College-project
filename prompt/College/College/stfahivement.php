<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>
</head>
<body>
<div class="allblur">
<table cellspacing="10" class="table-stylec" width="100%">
<tr>
<td>
<form action="" method="post" onsubmit="">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="4" align="center">Staff Achievement</td></tr>
<tr class="tableth">
     <td colspan="4" align="Center"><h3>
<?php 
  if(isset($_SESSION['stfachiv']))
    print $_SESSION['stfachiv'];
  unset($_SESSION['stfachiv']);
?></h3>
   
</tr>
<tr>
<td colspan="2" align="center">
</td>
</tr>
<td>Achievement</td>
<td><select name="achive" id="achive">
<?php
             if(isset($_POST['achive']))
                {
?>
<option value="<?php print $_POST['achive']; ?>"><?php print $_POST['achive']; ?></option>
<?php
                 }
?>
<option value="Publication" >Publication</option>
<option value="Paper Presentation" >Paper Presentation</option>
<option value="Workshop/Seminar/FDP" >Workshop/Seminar/FDP</option>
<option value="100 % Result Achievement" >100% Result Achievement  </option>
           </select>
</td>
<td align="center" colspan="2"><input type="submit" value="Get" class="bn"></td></tr>
</form>
</table>
</td>
</tr>
<?php
                  if ($_POST) 
                 { 
			                  
                			$achive=$_POST['achive'];      
                                        $_SESSION['$sid'] =$userid; 
                                                                            
    
      if( $achive== 'Publication')
	{
$_SESSION['$achive'] ='Publication';

      ?>

<tr>
<form name="stfpublication" method="post" action="savestfahivement.php" onSubmit="return astfpub();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Publication</td></tr>
<id="achive" name="achive" value="Publication">

<tr>
<td>Type</td>
<td>
<input type="radio" name="jptype" id="jptype" value="Journal" checked="checked">Journal
<input type="radio" name="jptype"  id="jptype" value="Proceeding">Proceeding
</td>
</tr>
<tr>
<td>Title</td>
<td>
<input type="text" name="pubt" id="pubt"  size="30">
</td>
</tr>
<tr>
<td>Journal/Proceeding Name</td>
<td>
<input type="text" name="jpname" id="jpname"  size="30">
</td>
</tr> 
<tr>
<td>ISBN/ISSN No</td>
<td>
<input type="text" name="isno" id="isno"  size="30">
</td>
</tr> 
<tr>
<td>Impact No</td>
<td>
<input type="text" name="imno" id="imno"  size="30" onKeyPress="return isNumberKey(event)" maxlength="12">
</td>
</tr> 
<tr>
<td>Volume</td>
<td>
<input type="text" name="vol" id="vol"  size="30">
</td>
</tr>
<tr>
<td>Issue</td>
<td>
<select name="issuem" id="issuemss">
<option value="Jan" >Jan</option>;
<option value="Feb" >Feb</option>;
<option value="Mar" >Mar</option>;
<option value="Apr" >Apr</option>;
<option value="May" >May</option>; 
<option value="Jun" >Jun</option>;
<option value="Jul" >Jul</option>;
<option value="Aug" >Aug</option>;
<option value="Sep" >Sep</option>;
<option value="Oct" >Oct</option>;
<option value="Nov" >Nov</option>;
<option value="Dec" >Dec</option>;        
</select>Month
<select name="issuey" id="issuey">
    <?php
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
         for ($x=2000; $x<=$y; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>Year
</td>
</tr>
<tr>
<td>Page No</td>
<td>
<input type="text" name="pag" id="pag"  size="30">
</td>
</tr> 
<tr> 
<td>Certificate</td>
<td><input type="file" name="pcer" id="pcer"></td>
</tr>
<tr> 
<td>Paper</td>
<td><input type="file" name="ppaper" id="ppaper"></td>
</tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td></form>
<?php  
}
else if( $achive== 'Paper Presentation')
	{
$_SESSION['$achive'] ='PP';
      ?>
<tr>
<form name="stfpaperpresentation" method="post" action="savestfahivement.php" onSubmit="return astfpp();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Paper Presentation</td></tr>

<tr>
<td>Level</td>
<td>
<input type="radio" name="level" id="level" value="National" checked="checked">National
<input type="radio" name="level"  id="level" value="International">International
</td>
</tr>
<tr>
<td></td>
<td>
<input type="radio" name="prest" id="prest" value="Presentation" checked="checked">Presentation
<input type="radio" name="prest"  id="prest" value="Participation">Participation
</td>
</tr>
<tr>
<td>Program Name</td>
<td>
<input type="text" name="ppprg" id="ppprg"  size="30">
</td>
</tr>
<tr>
<td>Title</td>
<td>
<input type="text" name="pptitle" id="pptitle"  size="30">
</td>
</tr>
<tr>
<td>Institution Name</td>
<td>
<input type="text" name="insname" id="insname"  size="30">
</td>
<tr>
<td>Date</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="Text" id="ppdate" name="ppdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('ppdate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr> 
<td>Certificate</td>
<td><input type="file" name="ppcer" id="ppcer"></td>
</tr>
<tr> 
<td>Paper</td>
<td><input type="file" name="pppaper" id="pppaper"></td>
</tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td></form>
<?php  
}
else if( $achive== 'Workshop/Seminar/FDP')
	{
$_SESSION['$achive'] ='Workshop';
?>
<tr>
<form name="stfworkshop" method="post" action="savestfahivement.php" onSubmit="return astfworkshop();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Workshop/Seminar/FDP</td></tr>
<tr>
<td>Type Of Event</td>
<td><select name="event" id="event">
<option value="Workshop">Workshop</option>;
<option value="Seminar">Seminar</option>;
<option value="FDP">FDP</option>;
            </select>
</td>
</tr>
<tr>
<td>Program Name</td>
<td>
<input type="text" name="wname" id="wname"  size="30">
</td>
</tr>
<tr>
<td>Institution Name</td>
<td>
<input type="text" name="wsins" id="wsins"  size="30">
</td>
</tr>
<tr>
<td>Starting Date</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="Text" id="sdate" name="sdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('sdate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Ending Date</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="Text" id="edate" name="edate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('edate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr> 
<td>Certificate</td>
<td><input type="file" name="wscer" id="wscer"></td>
</tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td></form>
<?php  
}
else if( $achive== '100 % Result Achievement')
	{
$_SESSION['$achive'] ='100%Result';
?>
<tr>
<form name="" method="post" action="savestfahivement.php" onSubmit="return astfresult();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">100% Result Achievement  </td></tr>
<td>Course Code</td>
<td>
<input type="text" name="ccode" id="ccode"  size="30">
</td>
</tr>
<tr>     
<td>Course Name</td>
<td>
<input type="text" name="cname" id="cname"  size="30">
</td>
</tr>
<tr>
<td>Year</td>
<td>
<input type="text" name="year" id="year"  size="30">
</td>
</tr>
<tr>
<td>Semister</td>
<td>
<input type="radio" name="sem" id="sem" value="Odd" checked="checked">Odd
<input type="radio" name="sem"  id="sem" value="Even">Even
</td>
</tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td></form>
<?php  
}

if( $achive== '#')
	{
$_SESSION['$achive'] ='Research';

      ?>
<tr>
<form name="" method="post" action="savestfahivement.php" onSubmit="return astfresearch();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Research</td></tr>
<td>Name</td>
<td>
<input type="text" name="name" id="name"  value=<?php print $name; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td>
<input type="text" name="depart" id="depart" value=<?php print $dept; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Type</td>
<td>
<input type="radio" name="mtype" id="mtype" value="Major" checked="checked">Major
<input type="radio" name="mtype"  id="mtype" value="Minor">Minor
</td>
</tr>
<tr>
<td>Project Title</td>
<td>
<input type="text" name="protitle" id="protitle"  size="30">
</td>
</tr>
<tr>
<td>Date</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="Text" id="sdate" name="sdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('date','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr>
<td>Agency</td>
<td>
<input type="text" name="agency" id="agency"  size="30">
</td>
</tr> 
<tr>
<td>Status</td>
<td><select name="pstatus" id="pststus">
<option value="Begining" >Begining</option>;
<option value="On Going" >On Going</option>;
<option value="Completed" >Completed</option>;
 </select>
</tr> 
<tr>
<td>Fund</td>
<td>
<input type="text" name="fund" id="fund"  size="30">
</td>
</tr>
<tr>
<td >Date of Completion</td>
<td>
<input type="Text" id="datecom" name="datecom" maxlength="20" size="20"  onClick="javascript:NewCssCal('date','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td></form>
<?php  
}

}
?>
       </td>
   </tr>
   <tr>
  </tr>
</table>
</td></center>
</tr>
</table>
</div>
</body>
</html>