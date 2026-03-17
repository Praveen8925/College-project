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
      <td>Assignment No</td>
      <td><select name="number" id="number" onchange="submitsem();">
<?php
      if(isset($_POST['number']))
      {
?>
<option value="<?php print $_POST['number']; ?>"><?php print $_POST['number']; ?></option>
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

 <!--<tr>
     <td colspan="2">
                <center>
                        <input type="Submit" Value="Submit" id="submit" class="bn">
               </center>
    </td>
  </tr>-->

</table>
<?php
       }
	   if(isset($_POST['cid']))
	   {
		   $subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			$number=$_POST['number'];
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
view
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
			$number=$_POST['number'];
$tbs=$batch.'studassignmentmark'; 
        $check="CREATE TABLE IF NOT EXISTS $tbs (Regno VARCHAR(20),Batch INT(5),Dept VARCHAR(20),semester INT(2),Course VARCHAR(20),number INT(10),mark INT(10))";
		$data=mysql_query($check);
		$sql="select *from $tbs where Course='$subject' and Dept='$dept' and semester='$sem'and number='$number'";
$rs=mysql_query($sql);
$nums=mysql_num_rows($rs);
if($nums==0)
{
		
		
		
		
		$subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			$number=$_POST['number'];
		
	$SQL="select *from student where Batch='$batch' and Department='$dept' ";
$rss=mysql_query($SQL);
$countss=mysql_num_rows($rss);
$i=1;
while($rows=mysql_fetch_assoc($rss))
{	
$i=1;
$reg=$rows['RegNo'];
$numb=count($rows['RegNo']);

	
	$SQL="insert into $tbs values('$reg','$batch','$dept','$sem','$subject','$number','0')";
$res=mysql_query($SQL);
$i=$i+1;
}
}
$i=1;
$tb=$batch.'studassignmentreport';
$sql="select *from $tb where Course='$subject' and Dept='$dept' and semester='$sem'and number='$number'";
$rs=mysql_query($sql);
if($rs>0)
{
//$nums=mysql_num_rows($rs);

while($row=mysql_fetch_assoc($rs))
{
	$reg=$row['Regno'];
	
	
$SQL="select *from student where Batch='$batch' and Department='$dept' and RegNo='$reg'";
$rss=mysql_query($SQL);
$sql="select *from $tbs where Batch='$batch' and Dept='$dept' and semester='$sem' and Course='$subject' and number='$number'and Regno='$reg'";
$rsss=mysql_query($sql);
while($rowss=mysql_fetch_assoc($rsss))
{
while($rows=mysql_fetch_assoc($rss))
{
print "<tr><td>$i</td><td>".$row['Regno']."</td><td>".$rows['Name']."</td><td>";
?>
<input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["Regno"]; ?>"  size="30">
<a href='<?php print $row['assignment'];?>' target='blank'><img src="images/download.ico" title="cer" hspace="15" width="25" height="25"></a></td>
<td><input type="text"name="mark[<?php print $i?>]" value="<?php print $rowss['mark']; ?>"> </td>
<?php
$i++;
}
}
}
?>
</table>

<tr>
     <td colspan="2">
                <center>
                        <input type="Submit" name="yn"Value="Submit" id="submit" class="bn" onsubmit="submitdetail();">
               </center>
    </td>
  </tr>
                       
 <?php

	
	
	
	
	
	
$subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			$number=$_POST['number'];


		
$sqls="select *from $tb where Course='$subject' and Dept='$dept' and semester='$sem'and number='$number'";
$rss=mysql_query($sqls);
$num=mysql_num_rows($rss);
$i=1;
if(isset($_POST["mark"]))
{
while($rows=mysql_fetch_assoc($rss))
{
	
	  
	$val[$i]=$rows['Regno'];
	$mark[$i]=$_POST["mark"][$i];
	//print "".$val[$i]."".$mark[$i]."<br>"; 

//$SQL="insert into $tbs values('$val[$i]','$batch','$dept','$sem','$subject','$number','$mark[$i]')";

$SQL="update $tbs set Regno='$val[$i]',Batch='$batch',Dept='$dept',semester='$sem',Course='$subject',number='$number',mark='$mark[$i]' where Regno='$val[$i]'and Batch='$batch'and Dept='$dept'and semester='$sem'and Course='$subject'and number='$number'";	
$re=mysql_query($SQL);
	
$i=$i+1;			   			   
		   
}

}


				   }
else 
  print "<h1>No Assignment Submitted</h1>";	
								}
								
								}			  

             
?>


	</table>												
</div>
</body>
</html>