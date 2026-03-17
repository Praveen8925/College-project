<?php
session_start();
   include_once 'database.php';
   $uid=$_SESSION['AU'];
   $SQLS="select * from addstaff where SID='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dep=$ress["Department"];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script>
function generateRow() {

var d=document.getElementById("div");
d.innerHTML+="<p><input type='text' name='food'>";

}
</script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="3" align="Center"><h2>Add Association</h2></td>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['msave']))
    print $_SESSION['msave'];
  unset($_SESSION['msave']);
?></h4>
   </tr>
<form name="studdetails" method="post" action="amembersave.php" enctype="multipart/form-data">


<tr>
<td>Association Name</td>
<td> <select name="association" id="stDept">
  <option value="Select">Select</option>
  <?php
    $rs=mysql_query("select * from association where Department='$dep'");
    while($row=mysql_fetch_row($rs))
    {
	print "<option values=$row[0]>$row[0]</option>";
    }

   ?>
</select> 
</td>
</tr>
 
<tr>
<td>Department</td>
<td> <select name="Dept" id="stDept">
  <option value="<?php print "$dep" ?>"><?php print "$dep" ?></option>

</select> 
</td>
</tr>
<tr>
       <td>Year</td>
        <td><select name="year" id="batch">
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
<td>President</td>
<td><input type="text" name="president" id="studid" size="30"></td><td><input type="file" name="presidentph[]" value="choose Photo" multiple></td>
</td>
</tr>
<tr>
<td>Vice President</td>
<td><input type="text" name="vicepresident" id="studid" size="30"><td><input type="file"name="vicepresidentph" value="choose Photo"multiple></td>
</td>
</tr>  
<tr>
<td>Secretary</td>
<td><input type="text" name="secretary" id="studid" size="30"><td><input type="file"name="secretaryph" value="choose Photo"multiple></td>
</td>
</tr>  

<tr>
<td>Treasurer</td>
<td>
<input type="text" name="treasurer" id="studid" size="30"><td><input type="file"name="treasurerph" value="choose Photo" multiple>
</td>
</tr>  

<tr>
<td>Editor's</td>
<td><input type="text" name="editor" id="studid" size="30"><td><input type="file"name="editorph" value="choose Photo"multiple></td>
</td>
</tr>  

<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Reset" Value="Reset" id="Reset" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>