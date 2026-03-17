<?php
session_start();
include_once 'database.php';
if(isset($_SESSION['dept']) )
{
    $dept= $_SESSION['dept'];
}
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
<form action="" method="post" onsubmit="">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Student List</td>
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
			 $year=$_POST['batch'];                   
?>
  <td>
      <table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Student List          <?php print $year."<BR>Department of ".$dept; ?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center'>
<?php
          $SQL="SELECT * FROM student where Batch='$year' and Department='$dept' order by RegNo ASC";
          $rs=mysql_query($SQL); 
                         if (mysql_num_rows($rs)==0)
                                         {
                                print "<h1>No Data Found</h1>";
                                         }
                                         else
                                         { 
?>
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
   Reg No
</th>
<th>
   Name
</th>
<th>E-Mail
</th>
<th>Operation
</th>
</tr>
<?php
          $i=1;
    	     while($row=mysql_fetch_assoc($rs))
    	     {
		      print "<tr><td>$i</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td><td>".$row["Email-id"]."</td><td>";
?>
<a href="registerreport.php?action=Edit&id=<?php print $row['RegNo'] ?>"><img src="images/Edit.png" title="Edit" hspace="5" width="25" height="20"></a></td></tr>	
<?php
$i=$i+1;
    	      }
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