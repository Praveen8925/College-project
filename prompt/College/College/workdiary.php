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
<script src="JS/datetimepicker_css.js"></script>
<script src="JS/Index.js"></script>
<script src="JS/jquery-1.11.3.min.js">
</script>
<script>


    $( document ).ready(function() {

    $( "#c" ).show();
    $( "#hr" ).show();
    $( "#s" ).show();
    $( "#t" ).show();
    $("#at").show();
    $("#fad").hide();
    $("#r").hide();
    
});
    
$(document).ready(function(){
  $('input[type="radio"]').click(function(){
     
       if($(this).attr("value")=="CL"){
                
         $("#c").hide();

         $("#hr").hide();

         $("#s").hide();

         $("#t").hide();

         $("#at").hide();
         $("#fad").show();
         $("#r").show();         
         $("#tool").hide();         
		 }
         
        else
 if($(this).attr("value")=="OD")		   {
		     
         $("#c").hide();

         $("#hr").hide();

         $("#s").hide();

         $("#t").hide();
         $("#at").hide();

         $("#fad").show();
         $("#r").show();
 		   }
        });
    });


</script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="4" align="Center"><h1>Work Diary</h1>
   </tr>
<tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['wd']))
    print $_SESSION['wd'];
  unset($_SESSION['wd']);
?>
</h3>
</td>
</tr>

<form name="workdiary" method="post" action="Saveworkdiary.php" onSubmit="return workdairy();" >
<?php

   $SQL= "select * from addstaff where SID='$userid'" ;
   $rs=mysql_query($SQL);  
    while($row=mysql_fetch_assoc($rs))
       {
         $name=$row["Name"];
         $sid=$row["SID"];     
        }
?>

<tr>
<td>
<input type="hidden" name="sid" id="sid" value=<?php print $sid; ?> readonly size="30">
</td>
</tr>
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
<td>Day Order</td>
<td><select name="do" id="do">
<option values="I">I</option>
<option values="II">II</option>
<option values="III">III</option>
<option values="IV">IV</option>
<option values="V">V</option>
<option values="VI">VI</option>
</select>
</td>
</tr>
<tr>
<td>Remarks</td>
<td>
<input type="radio"  name="remark" id="remark1"  value="CL" >CL
<input type="radio" name="remark" id="remark2" value="OD" >OD
</td>
</tr>
<tr id="fad" name="fad">
<td>Session</td>
<td><select name="session" id="session">
<option values="FD">FD</option>
<option values="FN">FN</option>
<option values="AN">AN</option>
</select>
</td>
<td>
FN-Forenoon <br> AN-Afternoon<br> FD-Full Day
</td>
</tr> 
</tr>
<tr id="r" name="r">
<td>Reason</td>
<td><textarea name="reason"  id="reason" rows="4" cols="40" ></textarea></td>
</tr>
</tr>
 <tr id="c" name="c">
<td>Class</td>
<td><select name="cls" id="cls">
<option values="I">I</option>
<option values="II">II</option>
<option values="III">III</option>
<option values="IV">IV</option>
<option values="V">V</option>
<option values="VI">VI</option>
</select>
<select name="dept" id="dept">
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
<tr id="hr" name="hr">
<td>Hours</td>
<td><select name="hour" id="hour">
<option values="I">I</option>
<option values="II">II</option>
<option values="III">III</option>
<option values="IV">IV</option>
<option values="V">V</option>
<option values="VI">VI</option>
</select>
</td>
</tr>
<tr id="s" name="s">
<td>Subject</td>
<td><select name="sub" id="sub">
<option values="select">Select</option>
<?php
    $rs=mysql_query("select * from  subjectdetails");
    while($row=mysql_fetch_assoc($rs))
    {
	print "<option values=$row[CourseID]>$row[CourseID]</option>";
    }
?>
</select>
</td>
</tr>
<tr id="t" name="t">
<td>Topic covered</td>
<td><textarea name="topic"  id="topic" rows="4" cols="40" ></textarea></td>
</tr>
</tr>
<tr id="at" name="at">
<td>
Adjustment To
<td>
<select name="asid" id="asid">
<option value="Select">Select</option>
<?php
  $tdt=date("d-m-Y");

             if(isset($_POST['Staffid']))
                {
?>
       <option value="<?php print $_POST['Staffid']; ?>"><?php print $_POST['Staffid']; ?></option>
              
<?php
            }
    $rs=mysql_query("select * from  addstaff");
    while($row=mysql_fetch_assoc($rs))
    {
	print "<option values=$row[SID]>$row[SID]</option>";
    }
?>
</select>
</td>
</tr>
<tr id="tool" name="tool">
<td>Tools</td>
<td><select name="tool" id="tool">
<option values="Cholk and talk">Cholk and talk</option>
<option values="LCD">LCD</option>
</select>
</td>
</tr>
<!--<tr id="tool" name="tool">
<td>Activity</td>
<td><select name="activity" id="activity">
<option values="Activity">Activity</option>
</select>
</td>
</tr>-->
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="Submit"  class="btn">
</center>
</td>
</tr>
</form>
    </table></div>
</body>
</html>