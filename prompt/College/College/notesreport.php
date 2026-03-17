<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
                             
                             $SQL= "select * from student where RegNo ='$regno' " ;
				$rs=mysql_query($SQL);
				while($row=mysql_fetch_assoc($rs))
   			          {
				$batch=$row["Batch"];   
				$dept=$row["Department"];
   				}
				$reg=$regno;


?>

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
<td colspan="2" align="Center"><h1>Notes</h1>
</tr>
<form name="form" method="post" action="#" >

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
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Theory' order by CourseID asc" ;
                       $rs=mysql_query($SQL);
                        $t=mysql_num_rows($rs);
                        
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
                       $rm=mysql_query($SQL);
                          $p=mysql_num_rows($rm);   
                      
                      $i=0;
                      if (mysql_num_rows($rs)==0 and mysql_num_rows($rm)==0)
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
                              echo "<option value=".$row["CourseID"]."-".$i.">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
                               $i++;
      	             }
                 while($row=mysql_fetch_assoc($rm))
    	            {
                            echo "<option value=".$row["CourseID"]."-".$i.">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
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
</form>
</table>
<?php
                          }
          if ((isset($_POST['sem'])) && (isset($_POST['cid']))) 
                 { 
                    
                        
                               
                             $sem=$_POST['sem'];    
                             
                              
                   if(isset($_POST['cid']))
                     { 
                       $cidv=$_POST['cid'];
                       
                      }
					  $subject=$_POST['cid'];
                            $cidv = explode("-",$cidv);
                            $cid=$cidv[0];$_SESSION['$cid']=$cid;
                            $ici=$cidv[1];
                            $icid=$ici*3;$_SESSION['$icid']=$icid;
                             $a=$ici-$t;
                            
                              $a=$a*3;$_SESSION['$a']=$a;
                              
                           $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);

                      
                       $sem=$_POST['sem'];
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rs); 
                       $type=$db_field['Type'];
                       $cname=$db_field['Course_Name'];
                       
                          
                           
                       $SQL="select * from subjectdetails,cycletest_1 where cycletest_1.Batch='$batch' and cycletest_1.sem='$sem' and cycletest_1.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_1.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       
                       $SQL="select * from subjectdetails,cycletest_2 where cycletest_2.Batch='$batch' and cycletest_2.sem='$sem' and cycletest_2.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_2.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       
                       
                       $SQL="select * from subjectdetails, modelexam where  modelexam.Batch='$batch' and  modelexam.sem='$sem' and  modelexam.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'= modelexam.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       
                       $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and sem='$sem' and exam_type='cycletest1'";
                       $rs=mysql_query($SQL);  
                       
                                    
				 
                  
?>
<BR>
<div class="font-stylec">
<tr>
<td  align="Center" ><Center><?php print $cname;?></Center></td>
</tr>
</div>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
Sl.No
</th>
<th>Topic
</th>
<th>File
</th>
</tr>

<?php
 
				  
				
$i=1;
 
$sql="select *from notes where Batch='$batch' and Dept='$dept' and sem='$sem' and subject='$subject'";
$res=mysql_query($sql);
if(mysql_num_rows($res)>0)
{
while($rows=mysql_fetch_assoc($res))
{
	print "<tr><td>$i</td><td>".$rows['notes']."</td><td>";

?>
 <a href='<?php print $rows['notes'];?>' target='blank'><img src="images/download.ico" title="cer" hspace="15" width="25" height="25"></a></td>


<?php
$i=$i+1;
}
				 
}
else
{
print '<h3 style="color:red"> No data found</h3>';
}	

                      }
					  
								}          
              
?>


													
</div>
</body>
</html>