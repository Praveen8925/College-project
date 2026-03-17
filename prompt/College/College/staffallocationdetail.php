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
	$sqls="select * from addstaff where Department='$dept' order by SID asc";   
						$ress=mysql_query($sqls);
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
<td colspan="2" align="Center"><h1>Allocate Staff</h1>
</tr>
<tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['as']))
    print $_SESSION['as'];
  unset($_SESSION['as']);
?></h4>
   </tr>
   
     <tr>
       <td>Year</td>
        <td><select name="year" id="year">
<?php
             if(isset($_POST['year']))
                {
?>
<option value="<?php print $_POST['year']; ?>"><?php print $_POST['year']; ?></option>
<?php
                 }
               
         $y= date("Y");
         echo "<option>Select</option>";
            for ($x=2000; $x<=$y; $x++)
                  { 
			  $s=$x-1;
  	echo "<option value=".$s." selected>".$s."-".$x."</option>";
                  }
?>
        </select></td>
  </tr>
 <tr>
 <tr>
      <td>Staff ID</td>
      <td><select name="sid" id="sid" >
<?php
              if(isset($_POST['sid']))
                 {
?>
<option value="<?php print $_POST['sid']; ?>"><?php print $_POST['sid']; ?></option>
<?php
       
                 }
                     
                 while($rowss=mysql_fetch_assoc($ress))
    	            {
                              echo "<option value=".$rowss["SID"].">".$rowss["SID"]."-".$rowss["Name"]."</option>";
                              
      	             }
                
                            
                        
						
								
?>
          </select>  
     </td>
 </tr>
 
 <tr>
     <td colspan="2">
                <center>
                        <input type="Submit" Value="Submit" id="submit" class="bn">
               </center>
    </td>
  </tr>
</form>
</table>
<?php 
if($_POST)
{
	$year=$_POST["year"]+1;
	$sid=$_POST["sid"];
	
	$SQL="select * from staffallocation where Academic_year='$year' and StaffID='$uid'";
	$rs=mysql_query($SQL);
?>
<center>
 <table width="80%" border="1">
  <tr>
<th>
   SI.No
</th>
 <th>
StaffID
</th>
<th>
Batch
</th>
<th>
  Academic_year
</th>
<th>
Semester
</th>
<th>
 CourseID
</th>
</tr>
<?php
$years=$year-1;
$i=1;
	while($row=mysql_fetch_assoc($rs))
	{
		print"<tr><td>$i</td><td>".$row["StaffID"]."</td><td>".$row["Batch"]."</td><td>".$row["Academic_year"]."-".$years."</td><td>".$row["Type"]."</td><td>".$row["CourseID"]."</td>";
		$i++;
	}
}
?>
</table>
</center>
</body>
</html>