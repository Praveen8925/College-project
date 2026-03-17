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
<div class="allblur">
<table cellspacing="10" class="table-stylec" width="100%">
<tr>
<td>
<form action="demo1.php" method="post" onsubmit="">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="8" align="center">Student Achievement</td>
</tr>
<tr class="tableth">
     <td colspan="8" align="Center"><h3>
<?php 
  if(isset($_SESSION['studachiv']))
    print $_SESSION['studachiv'];
  unset($_SESSION['studachiv']);
?></h3>
   
</tr>
<tr>
<td colspan="5" align="center">
</td>
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
              else
               {
    
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
                }
              $y= date("Y");
         for ($x=2000; $x<=$y; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>
</td>
<td>Department</td>
<td><select name="dept" id="dept">
<?php
             if(isset($_POST['dept']))
                {
?>
<option value="<?php print $_POST['dept']; ?>"><?php print $_POST['dept']; ?></option>
<?php
                 }
   
              $SQL="SELECT Programme FROM coursedetails";
               $rs=mysql_query($SQL);
                              while($row=mysql_fetch_assoc($rs))
    	                      {         
                      echo "<option value=".$row["Programme"]." >".$row["Programme"]."</option>";    
                              } 
?></select><td>
<td>Achievement</td>
<td><select name="stuachive" id="stuachive">
<?php
             if(isset($_POST['stuachive']))
                {
?>
<option value="<?php print $_POST['stuachive']; ?>"><?php print $_POST['stuachive']; ?></option>
<?php
                 }
?>
<option value="Inter college meet" >Inter college meet</option>;
<option value="Workshop" >Workshop</option>;
<option value="Conference" >Conference</option>;
            </select>
</td>
<td align="center" colspan="2"><input type="submit" value="Get" class="bn"></td></tr>
</form>
</table>
</div>
</body>
</html>
