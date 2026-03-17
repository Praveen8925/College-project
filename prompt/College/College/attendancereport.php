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
<script src="JS/datetimepicker_css.js"></script>
</head>
<body>
<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>Attendance Report</h1>
</tr>
<form name="form" method="post" action="#" >
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
           }
?>
           </select></td>
</tr>
<tr>
      <td>Department</td>
      <td> <select name="dept" id="dept">
<?php
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
                    }
              for ($x=1; $x<=10; $x++)
                {
              	echo "<option value=".$x.">".$x."</option>";
                 }

?>
          </select>  
     </td>
 </tr>
  
</form>
</table>
<?php 
                             if($_POST)
                                {
                                   	$batch=$_POST['batch'];
                                	$dept=$_POST['dept']; 
                                	$sem=$_POST['sem'];
                                        $tn=$batch.'attendance';$ch=0;
                                        $SQL= "select * from student where Batch='$batch' and Department='$dept' and status<>'discontinue'" ;
                                	$rp=mysql_query($SQL);
                                         if (mysql_num_rows($rp)>0)
                                 	      {
                                          $SQL= "select * from student,$tn where $tn.Batch='$batch' and student.Batch='$batch' and  student.Department='$dept' and student.status<>'discontinue' and decided='n' and Sem='$sem' ";
                                	  $rs=mysql_query($SQL);
                                 	  $ch=mysql_num_rows($rs);	
                                 	      }
                                                                          
                               		if (mysql_num_rows($rp)==0 or $ch==0)
                                 	      {
                                 		print "<h1><center>No data found</center></h1></a>";
                                 	      }
                               		 else
                                 	 {
                                        $db_field=mysql_fetch_assoc($rs); 
                                        $totday=$db_field['tot_working_days'];
                                        $SQL= "select * from student,$tn where $tn.Batch='$batch' and  student.Department='$dept' and student.status<>'discontinue'" ;
                                	$rs=mysql_query($SQL); 
                                          
                               
                                  
?>
<tr>
<td><br><br><center>
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
<th>
  No of present days<br>( <?php print $totday; ?>) 
</th>
<th>
  Percentage( <?php print "%" ?>) 
</th>
</tr>
<tr>
<?php
			     $i=1;
    	                    while($row=mysql_fetch_assoc($rs))
    	                      {
                                   $reg=$row["RegNo"];
                                   print "<td>$i</td><td>".$row["RegNo"]."";?><input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30"><?php  print "</td><td>".$row["Name"]."</td>";
                                   $SQL="SELECT * FROM  $tn WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                   $rm=mysql_query($SQL);
                                       while($row=mysql_fetch_assoc($rm))
                                           {   
                                                   $twd=$row["tot_working_days"];
                                                   $ndy=$row["no_day_present"];
						   print "<td>".$ndy."</td>";
						   $attmark=($ndy*100)/$twd;
                                                   print "<td>".$attmark."</td>";
                                                    
                                            }
?>	
</tr>                          
<?php
                              $i++;
                             }   
                            }              
                               
                       }
              
?>
</table>
</form>
</div>
</body>
</html>