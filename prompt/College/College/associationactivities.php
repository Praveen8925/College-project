<?php
session_start();
   include_once 'database.php';
   include_once 'database.php';
   $uid=$_SESSION['AU'];
   $SQLS="select * from addstaff where SID='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dep=$ress["Department"];
	}
?>

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
     <td colspan="2" align="Center"><h2>Association Activities</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['associationact']))
    print $_SESSION['associationact'];
  unset($_SESSION['associationact']);
?></h4>
   </tr>
<form name="studdetails" method="post" action="associationactivitysave.php" >
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
<td>Date</td>
<td>
<?php
  $tdt=date("d-m-Y");

             if(isset($_POST['atdate']))
                {
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php print $_POST['atdate']; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
                 }
               else
                {
           
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
				}
?>
</td>
</td>
</tr>
<tr>
<td>Title</td>
<td><input type="text" name="title" id="studbat" size="30">
</td>
</tr>
<tr>
<td>Resource Person</td>
<td><input type="text" name="resourceperson" id="studbat" size="30">
</td>
</tr>
<tr>
<td>Designation</td>
<td><input type="text" name="designation" id="studbat" size="30">
</td>
</tr>
<tr>
<td>Address</td>
<td><textarea type="text" name="address" id="studbat" size="30"maxlength="250" cols="62" rows="6"></textarea>
</td>
</tr>
<tr>
<td>Mobile</td>
<td><input type="text" name="mobile" id="studbat" size="30">
</td>
</tr>
<tr>
<td>Type</td>
<td><select name="type">
<option values="inaguration">inaguration</option>
<option values="workshop">workshop</option>
<option values="expo">expo</option>
</select>
</td>
</tr>
<tr>
 <td>Photos</td>
 <td><input type="file"name="photos"value="choose file" multiple;></td>
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