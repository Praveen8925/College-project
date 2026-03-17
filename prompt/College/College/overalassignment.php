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
<script>
function submitsem() {
    document.forms.detail.submit();
}

function submitdetail() {
    document.forms.form.submit();
}
</script>
</head>
<body>
<form name="detail"method="post" action="#">


<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>Assignment</h1>
</tr>
<form name="form" method="post" action="#">
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
      <td> <select name="dept" id="dept"><?php
             if(isset($_POST['dept']))
                {
?>
<option value="<?php print $_POST['dept']; ?>"><?php print $_POST['dept']; ?></option>
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
      <td><select name="sem" id="sem" onchange="submitsem();">
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
     
             for ($x=1; $x<=10; $x++)
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
						   $dept=$_POST['dept'];
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
     <td colspan="2">
                <center>
                        <input type="Submit" Value="Submit" id="submit" class="bn">
               </center>
    </td>
  </tr>

</table>
<?php
       }
	   if(isset($_POST['cid']))
	   {
		   $subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			
	?>   
<tr>
<td><center>

<table width="80%" border="1">
<tr>
<th>
Sl.No
</th>
<th>Regno
</th>
<th>Name
</th>
<th>
Mark
</th>

</tr>	   
	   



<?php
$subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			
$tbs=$batch.'studassignmentmark'; 
        
$i=1;
	

$sql="select *from $tbs where Batch='$batch' and Dept='$dept' and semester='$sem' and Course='$subject'";
$rsss=mysql_query($sql);
while($row=mysql_fetch_assoc($rsss))
{
	$reg=$row['Regno'];
	$SQL="select *from student where Batch='$batch' and Department='$dept' and RegNo='$reg'";
$rss=mysql_query($SQL);
while($rows=mysql_fetch_assoc($rss))
{
print "<tr><td>$i</td><td>".$row['Regno']."</td><td>".$rows['Name']."</td><td>".$row["mark"]."</td>";
?>
<?php
$i++;
}
}

								
?>
</table>

<?php
	   }
								}
?>								
</div>
</body>
</html>