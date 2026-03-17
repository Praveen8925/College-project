<?php
session_start();
include_once 'database.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="JS/Index.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<link href="css/web.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="allblur">
<table cellspacing="10" class="table-stylec" width="100%">
<tr>
<td>
<form action="" method="post" onsubmit="return pass()">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Staff Report</td>
</tr>
<tr>
<td colspan="2" align="center">
</td>
</tr>
<tr>
<td>Year</td>
<td><select name="year" id="year">
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
<td>Month</td>
<td><select name="month" id="month">
    <?php
                  for ($x=1; $x<=12; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>
</td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</table>
</td>
</tr>
<tr>
<?php
                  if ($_POST) 
                 { 
			 $year=$_POST['year'];
                                                     $month=$_POST['month'];                 
?>
  <td>
      <table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Staff Report<?php print $year?></td>
</tr>
</table>

  </td>
</tr>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   SID
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Conference
</th>
<th>Tp
</th>
<th>paper Title
</th>
<th>SDate
</th>
<th>ISBN No
</th>
<th>Impact No</th>
<th>
seminar</th>
<th>
College name</th>
</tr>
<?php
          $SQL="SELECT * FROM staffachivements where YEAR(SDate)='$year' and MONTH(SDate)='$month' ";
          $rs=mysql_query($SQL);  
          $i=1;
    	     while($row=mysql_fetch_assoc($rs))
    	     {
                                 print "<tr><td>$i</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$row["Conference"]."</td><td>".$row["Tp"]."</td><td>".$row["paper Title"]."</td><td>".$row["SDate"]."</td><td>".$row["ISBN No"]."</td><td>".$row["Impact No"]."</td><td>".$row["seminar"]."</td><td>".$row["College name"]."</td><td>";

$i=$i+1;
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