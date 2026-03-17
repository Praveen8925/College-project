
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>

<script src="JS/jquery-1.11.3.min.js">
</script>
<script>


var intTextBox = 0;

/**
* Function to add textbox element dynamically
* First we incrementing the counter and creating new div element with unique id
* Then adding new textbox element to this div and finally appending this div to main content.
*/
function addElement() {
    intTextBox++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox);
    objNewDiv.innerHTML = '<h1 class="font1">Objective ' + intTextBox + ': <textarea type="text" id="tb_' + intTextBox + '" name="tb_' + intTextBox + '"/>';
    document.getElementById('content').appendChild(objNewDiv);
}
function removeElement() {
    if(0 < intTextBox) {
        document.getElementById('content').removeChild(document.getElementById('div_' + intTextBox));
        intTextBox--;
    } else {
        alert("No Objective to remove");
    }
}

</script>

</head>
<style>
.font
{
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	color: #BF2828;
	font-size: 28;
	padding: 5;
	font-weight: bold;
}
.font1
{
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	color: #BF2828;
	font-size: 20;
	padding: 5;
	font-weight: bold;
}
</style>
<body>

    <h1 class="font"align="Center">Add objective </h1>

  


<p>
    <a href="javascript:void(0);" onclick="addElement();" class="btn">Add</a>
    <a href="javascript:void(0);" onclick="removeElement();"class="btn">Remove</a>
</p>

<div id="content"></div>


</body>
</html>  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 <?php
/* 
 $batch = $_POST["batch"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $courseid = $_POST["courseid"];
$courseid=strtoupper($courseid);
$coursename = $_POST["coursename"];
$coursename=strtoupper($coursename);
$type = $_POST["tp"];
$extmark = $_POST["extmark"];
$c1mark = $_POST["c1mark"];
$c2mark = $_POST["c2mark"];
$mmark = $_POST["mmark"];
$attmark = $_POST["attmark"];
$assmark = $_POST["assmark"];
$record = $_POST["record"];
$lab = $_POST["lab"];
$SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
 $rs=mysql_query($SQL);
     $db_field=mysql_fetch_assoc($rs);
     $decided=$db_field['decided'];print $decided;
      print mysql_num_rows($rs);
     if($decided=='y' or mysql_num_rows($rs)==0)
         {

if($type =="Theory")
$mark=$extmark."-".$c1mark."-".$c2mark."-".$mmark."-".$attmark."-".$assmark;
else
$mark=$extmark."-".$c1mark."-".$c2mark."-".$mmark."-".$record."-".$lab; 
$d='y';
$credit = $_POST["credit"];
$part = $_POST["part"];
 $rs=mysql_query("select * from  subjectdetails where CourseID='$courseid'");
 if (mysql_num_rows($rs)>0)
  {
	$_SESSION['subject'] = "Course Name Alredy Exist <br> Record Not Saved";
  }
  else
  {    
    mysql_query("insert into subjectdetails values('$batch','$sem','$dept','$courseid','$coursename','$type','$mark','$credit','$part','$d')") or die(mysql_error());
    $_SESSION['subject'] = "Record Saved Successfully";
  }
   }
   else
     $_SESSION['subject'] = " Record Not Saved <br>This Semister was finalized";
  header("location: addsubject.php");
*/?>