<?php
session_start();
include_once 'database.php';
$uid=$_SESSION['AU'];
$SQLS="select * from addstaff where SID='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dept=$ress["Department"];
	}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>

</head>
<body>
<div>
<form name="form" method="post" action="rsyllabussave.php" enctype="multipart/form-data">
<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>Retified Syllabus</h1>
</tr>
<tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['syllabus']))
    print $_SESSION['syllabus'];
  unset($_SESSION['syllabus']);
?></h4>
   </tr>
<tr>
       <td>Batch</td>
        <td><select name="batch" id="batch">
<?php
             if(isset($_POST['batch']))
                {
?>
<option value="<?php print $_POST['batch']; ?>"><?php print $_POST['batch']; ?></option>
<?php
                 }
               
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
            for ($x=2000; $x<=$y; $x++)
                  { 
  	echo "<option value=".$x.">".$x."</option>";
                  }
				  
?>
        </select></td>
  </tr>
<tr>
<td>Department</td>
<td> <select name="Dept" id="stDept">
  <option value="<?php print "$dept" ?>"><?php print "$dept" ?></option>

</select> 
</td>
</tr>

 <tr>
 <td> Retified Syllabus</td>
 <td><input type="file"name="syllabus"value="choose file";></td>
 </tr>
 <tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">

</center>
</td>
</tr>
 </table>
 </form>
 </body>
 </html>