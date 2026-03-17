<?php
session_start();
include_once 'database.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="JS/Index.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script src="JS/datetimepicker_css.js"></script>
<link href="css/web.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
                  if ($_POST) 
                 { 
			 $batch=$_POST['batch']; 
			$dept=$_POST['dept']; 
			$stuachive=$_POST['stuachive'];      
                                                                 
    $SQL= "select * from student where Batch ='$batch' and Department ='$dept' and status='Student'" ;
   $rs=mysql_query($SQL);  
   
   if( $stuachive=='Inter college meet')
	{
$_SESSION['$stuachive'] ='ICM';
      ?>
<tr>
<form name="studicm" method="post" action="SaveStudAchivement.php" onSubmit="return astudicm();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Inter college meet</td></tr>
<tr>
<td>Reg.No</td>
<td><input type="text"name="regno"id="regno"value="";></td></tr>
<tr>
<td>Event</td>
<td>
<input type="text" name="event" id="event"  size="30">
</td>
</tr>
<tr>
<td>Place</td>
<td>
<input type="radio" name="pal" id="pal" value="Participation" checked="checked">Participation
<input type="radio" name="pal"  id="pal" value="I Place">I Place
<input type="radio" name="pal"  id="pal" value="II Place">II Place
<input type="radio" name="pal"  id="pal" value="III Place">III Place
</td>
</tr>
</tr> 
<tr>
<td>College Name</td>
<td>
<input type="text" name="cname" id="cname"  size="30">
</td>
</tr>
<tr>
<td>Date</td>
<td>
<?php
  $tdt=date("d-m-Y");
?>
<input type="Text" id="icmdate" name="icmdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('icmdate','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr> 
<td>Certificate</td>
<td><input type="file" name="icmcer" id="icmcer"></td>
</tr><tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td><tr></form>
<?php  
}
else if( $stuachive== 'Workshop')
	{
$_SESSION['$stuachive'] ='Workshop';
?>
<tr>
<form name="studworkshop" method="post" action="SaveStudAchivement.php" onSubmit="return astudworkshop();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Workshop</td></tr>
<tr>
<td>Reg.No</td>
<td><input type="text"name="regno"id="regno"value="";></td>
</tr>
 <tr>
<td>Program Name</td>
<td>
<input type="text" name="wsname" id="wsname"  size="30">
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
<td>Finished Date</td>
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
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td><tr></form>
<?php
}
else if( $stuachive== 'Conference')	
{
$_SESSION['$stuachive'] ='Conference';
?>
<tr>
<form name="studconference" method="post" action="SaveStudAchivement.php" onSubmit="return astudConference();" enctype="multipart/form-data">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Conference</td></tr>
<tr>
<td>Reg.No</td>
<td><input type="text"name="regno"id="regno"value="";></td></tr>
<tr>
<td>Level</td>
<td>
<input type="radio" name="level" id="level" value="National" checked="checked">National
<input type="radio" name="level"  id="level" value="International">International
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
<input type="Text" id="date" name="date" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('date','DDMMYYYY')" style="cursor:pointer"/>
</td>
</tr>
<tr> 
<td>Certificate</td>
<td><input type="file" name="ccer" id="ccer"></td>
</tr>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Save" id="Save" class="btn">
</center>
</td><tr></form>
<?php
}
else if( $stuachive== 'Sports')	{
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
</body>
</html>