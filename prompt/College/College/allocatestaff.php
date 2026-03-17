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
       <td>Year</td>
        <td><select name="year" id="year">
<?php
             if(isset($_POST['year']))
                {
?>
<option value="<?php print $_POST['year']; ?>"><?php print $_POST['year']; ?></option>
<?php
                 }
               
		 $m= date("M");
		 if($m<06)
		 {
			$y= date("Y");
            for ($x=2000; $x<$y; $x++)
                  { 
					$s=$x-1;
					echo "<option value=".$s.">".$s."-".$x."</option>";
                  }
				  echo "<option value=".($x)." selected>".($x-1)."-".($x)."</option>";
		 }
		 else
		 {
			$y= date("Y")+1;
            for ($x=2000; $x<$y; $x++)
                  { 
					$s=$x-1;
					echo "<option value=".$s.">".$s."-".$x."</option>";
                  }
				  echo "<option value=".($x)." selected>".($x-1)."-".($x)."</option>"; 
		 }
?>
		</select></td>
  </tr>
 <tr>
<td></td>
<td>
<input type="radio" name="type" id="status" value="odd" checked="checked">ODD SEM
<input type="radio" name="type"  id="status" value="even">EVEN SEM
</td>
</tr>
  
  <tr>
      <td>Department</td>
      <td> <select name="sdept" id="dept"><?php
             if(isset($_POST['sdept']))
                {
?>
<option value="<?php print $_POST['sdept']; ?>"><?php print $_POST['sdept']; ?></option>
<?php
                 }
           $rs=mysql_query("select * from coursedetails");
              while($row=mysql_fetch_row($rs))
                  {
	print "<option values=$row[0]>$row[0]</option>";
                   }   
?>
            </select> </td>
  </tr>
<tr>
      <td>Sem</td>
      <td><select name="sem" id="sem" onchange='this.form.submit()'>
<?php
      if(isset($_POST['sem']))
      {
?>
<option value="<?php print $_POST['sem']; ?>"><?php print $_POST['sem']; ?></option>
<?php
       
      }
      else
      {
?>	
                 <option value="select">Select</option>
<?php
     
             for ($x=1; $x<=6; $x++)
                {
              	echo "<option value=".$x.">".$x."</option>";
                 } 
  }       
      

?>
          </select>  
     </td>
 </tr>
<tr>
<td colspan="2" align="Center">
<?php 
                             if($_POST)
                                {
                               
                           $sem=$_POST['sem'];
						   $batch=$_POST['batch'];
						   $sdept=$_POST['sdept'];
						   
						$sqls="select * from addstaff where Department='$sdept' order by SID asc";   
						$ress=mysql_query($sqls);
						   
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'and Type='Theory' order by CourseID asc" ;
                       $rs=mysql_query($SQL);
                        $t=mysql_num_rows($rs);
                        
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
                       $rm=mysql_query($SQL);
                          $p=mysql_num_rows($rm);   
                      
                      $i=0;
                      if (mysql_num_rows($rs)==0 && mysql_num_rows($rm) )
                                 {
                                 print "<center><h1>No data found</h1></center>";
                                 }
                      else
                         {
?>
</td></tr>
<tr>
      <td>Course ID</td>
      <td><select name="cid" id="cid" >
<?php
              if(isset($_POST['cid']))
                 {
?>
<option value="<?php print $_POST['cid']; ?>"><?php print $_POST['cid']; ?></option>
<?php
       
                 }
                     
                 while($row=mysql_fetch_assoc($rs))
    	            {
                              echo "<option value=".$row["CourseID"].">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
                               $i++;
      	             }
                 while($row=mysql_fetch_assoc($rm))
    	            {
                            echo "<option value=".$row["CourseID"].">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
                               $i++;
      	         }
                            
                                

?>
          </select>  
     </td>
 </tr>
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
                               $i++;
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

<?php
						 }
								
								
if(isset($_POST["cid"]) && (isset($_POST['sid']))) 								
{					

$year=$_POST["year"];
$type=$_POST["type"];
$sdept=$_POST["sdept"];
$sem=$_POST["sem"];
$courseid=$_POST["cid"];
$staffid=$_POST["sid"];
$sql="select * from addstaff where SID='$staffid'";
$res=mysql_query($sql);
while($row=mysql_fetch_assoc($res))
{
$sdept=$row["Department"];

		$SQL="insert into  staffallocation  values('$batch','$year','$type','$dept','$sdept','$sem','$courseid','$staffid')";
		
		mysql_query($SQL);
			
						 }
} 
												
?>
</tr>
</table>
<?php


                      }        
            
             
?>

</div>
</body>
</html>