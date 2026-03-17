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

<script src="JS/jquery-1.11.3.min.js">
</script>

<script>

    $( document ).ready(function() {

    $( "#at" ).show();
    $( "#as" ).show();
    $("#re").hide();

    $("#lab").hide();
});
    
$(document).ready(function(){
  $('input[type="radio"]').click(function(){
     
       if($(this).attr("value")=="Practical"){
                
         $("#at").hide();

         $("#as").hide();

         $( "#re" ).show();
         $( "#lab" ).show();            }
         
        else
		   {
		     
         $("#at").show();

         $("#as").show();
         $("#re").hide();

         $("#lab").hide();		   }
        });
    });


</script>

</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h1>Add Subject </h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['subject']))
    print $_SESSION['subject'];
  unset($_SESSION['subject']);
?></h3>
   </tr>
<form name="subjectdetails" method="post" action="sixthhoursubjectsave.php" onSubmit="return addsubject();" >
<tr>
<td>Batch</td>
<td><select name="batch" id="batch">
    <?php
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
         for ($x=2000; $x<=$y; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>
</td></tr>
<tr>
<td>Department</td>
<td> <select name="dept" id="dept">
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
<td>Sem</td>
<td>
<select name="sem" id="sem">
<?php
         for ($x=1; $x<=10; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>
</td></tr>
<tr>
<td>Course ID</td>
<td>
<input type="text" name="courseid" id="courseid" size="30">
</td>
</tr>
<tr>
<td>Course Name</td>
<td>
<input type="text" name="coursename" id="coursename" size="30">
</td>
</tr>
<tr>
<td>Type</td>
<td>
<input type="radio" name="tp" id="tp" value="Theory" checked="checked">Theory
<input type="radio" name="tp"  id="tp" value="Lab">Lab
</td>
</tr>
<tr>
<!--<td>External Mark</td>
<td>
<input type="text" name="extmark" id="extmark" size="30">
</td>
</tr>
<tr >
<td>Internal Mark</td>
</tr>
<tr>
<td>Cycle test I</td>
<td>
<input type="text" name="c1mark" id="c1mark" size="3">
</td>
</tr>
<tr >
<td>Cycle test II</td>
<td>
<input type="text" name="c2mark" id="c2mark" size="3">
</td>
</tr>
<tr>
<td>Model Exam</td>
<td>
<input type="text" name="mmark" id="mmark" size="3">
</td> 
</tr>
<tr id="at" name="at">
<td>Attendance Mark</td>
<td>
<input type="text" name="attmark" id="attmark" size="3">
</td> 
</tr>
<tr id="as" name="as">
<td>Assigment</td>
<td>
<input type="text" name="assmark" id="assmark" size="3">
</td> 
</tr>
<tr id="re" name="re">
<td>Record</td>
<td>
<input type="text" name="record" id="record" size="3">
</td> 
</tr>
<tr id="lab" name="lab">
<td>Lab Performance</td>
<td>
<input type="text" name="lab" id="lab" size="3">
</td> 
</tr>
<tr>
<td>Credit</td>
<td>
<select name="credit" id="credit">
        </select>
</td></tr>
<tr>
<td>Part</td>
<td>
<select name="part" id="part">
<?php
         for ($x=1; $x<=5; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>
</td></tr>-->
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="button" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>
</form>
</table></div>
</body>
</html>