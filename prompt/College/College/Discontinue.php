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
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h2>Discontinue</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['dissave']))
    print $_SESSION['dissave'];
  unset($_SESSION['dissave']);
?></h4>
   </tr>
<form name="markf" method="post" action="#" >
   <tr>

<td>Reg.No</td>
<td>
<?php
 if(isset($_POST['studid']))
                {
?>
<input type="text" name="studid" id="studid" value="<?php print $_POST['studid']; ?>" size="30">
<?php
                 }
 else
    {
?>
<input type="text" name="studid" id="studid"  size="30">
<?php
     }
?>
</td>
     <td><input type="Submit" Value="Submit" id="submit" class="bn">
    </td>
  </tr>
</form>
<tr>
<td colspan="2">
 <?php
     if($_POST)
       {
      $regno=$_POST['studid'];
$regno=strtoupper($regno);
       $_SESSION['studid']=$regno;
$regno=strtoupper($regno);
    $SQL= "select * from student where RegNo ='$regno' and status='Student' ";
   $rs=mysql_query($SQL); 
   if(mysql_num_rows($rs)==0)
      {print "<center><h1>No data found</h1></center>";
       }
     else
       {
     while($row=mysql_fetch_assoc($rs))
    {
         $name=$row["Name"];
         $regno=$row["RegNo"];
         $dept=$row["Department"];
         $email=$row["Email-id"];
         $batch=$row["Batch"];
     }
?>
</td>
</tr>
<form name="studdetails" method="post" action="discontinueSave.php"  >
 <tr>
<td>Batch</td>
<td><input type="text" name="studbat" id="studbat" value="<?php print $batch; ?>" readonly size="30">
</td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" name="stname" id="stname" value="<?php print $name; ?>" readonly size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td>
<input type="text" name="stDept" id="stDept" value="<?php print $dept; ?>" readonly size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="type" name="email" id="email" value="<?php print $email;?>" readonly size="30">
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
<?php
      }
}
?>

</form>
    </table></div>
</body>
</html>