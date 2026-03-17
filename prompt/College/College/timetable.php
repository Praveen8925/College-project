<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>

</head>
<body>
<form name="form" method="post" action="#" enctype="multipart/form-data">
<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>TimeTable</h1>
</tr>
<tr>
		<th>Time</th>
        <th>I</th>
        <th>II</th>
        <th>III</th>
        <th>IV</th>
        <th>V</th>
        <th>VI</th>
        
    </tr>
<?php

$batch=$_POST["batch"];
$dept=$_POST["dept"];
$sem=$_POST["sem"];
$sql="select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'";
$result=mysql_query($sql);
while($row=mysql_fetch_assoc($result))
{
	//$row["Course_Name"];

?> 

    <tr>
        <th>09:30 - 10:20</th>
      <td><select name="Iday"> 
       
     <?php
         while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>

<select name="IIday"> 
       <option value="" size="10"> </option> 
     <?php
         while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>
<td><select name="IIIday"> 
       <option value="" size="10"> </option> 
     <?php
        while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>
<td><select name="IVday"> 
       <option value="" size="10"> </option> 
     <?php
        while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>
<td><select name="Vday"> 
       <option value="" size="10"> </option> 
     <?php
         while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>
<td><select name="VIday"> 
       <option value="" size="10"> </option> 
     <?php
while($r=mysql_fetch_assoc($result))
         { 
               echo "<option value=".'$r["Course_Name"]'.">". $r["Course_Name"]." </option>";
         }
     ?>
</select>
</td>
<?php
                        
}
    
?>
    <tr>
        <th>10:20 - 11:20</td>
        
            <td><input type="text" name="t1"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="t2"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="t3"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="t4"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="t5"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="t6"class="form-control border-input" size="10"/></td>
        
    </tr>

    <tr>
        <th>11:30 - 12:30</td>
        
            <td><input type="text" name="w1"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="w2"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="w3"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="w4"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="w5"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="w6"class="form-control border-input" size="10"/></td>

      
    </tr>

    <tr>
        <th>01:15 - 02:10</td>
        
            <td><input type="text" name="th1"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="th2"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="th3"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="th4"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="th5"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="th6"class="form-control border-input" size="10"/></td>

        
    </tr>

    <tr>
        <th>02:10 - 03:05</td>
        
            <td><input type="text" name="f1"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f2"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f3"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f4"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f5"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f6"class="form-control border-input" size="10"/></td>
        
    </tr>
	<tr>
        <th>03:20 - 04:15</td>
        
            <td><input type="text" name="f1"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f2"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f3"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f4"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f5"class="form-control border-input" size="10"/></td>
            <td><input type="text" name="f6"class="form-control border-input" size="10"/></td>
        
    </tr>
	
	
	</form>
</table>
</div>
</body>
</html>