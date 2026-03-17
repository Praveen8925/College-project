<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
                             
                             $SQL= "select * from student where RegNo ='$regno' " ;
				$rs=mysql_query($SQL);
				while($row=mysql_fetch_assoc($rs))
   			          {
				$batch="2015";   
				$dept="B.Sc(IT)";
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
<td colspan="2" align="Center"><h1>Internal Mark</h1>
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
                             $tablemark=$batch;
                             $table=$batch.'lab';
                             $tablename=$batch.'assignment';
			     $tn=$batch.'attendance';
                              
                   if(isset($_POST['cid']))
                     { 
                       $cidv=$_POST['cid'];
                       
                      }
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
                       $totmark=$db_field['Total_Mark'];
                       $type=$db_field['Type'];
                       $cname=$db_field['Course_Name'];
                       $totmark = explode("-",$totmark); 
                       $emark=$totmark[0];
                       $ic1mark=$totmark[1];
                       $ic2mark=$totmark[2];
                       $immark=$totmark[3];
                        $iassmark=$totmark[4];
                       $iattmark=$totmark[5];
                       
                          
                           
                       $SQL="select * from subjectdetails,cycletest_1 where cycletest_1.Batch='$batch' and cycletest_1.sem='$sem' and cycletest_1.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_1.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       $c1maxmark=$db_field['max_mark'];
                       $SQL="select * from subjectdetails,cycletest_2 where cycletest_2.Batch='$batch' and cycletest_2.sem='$sem' and cycletest_2.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_2.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       $c2maxmark=$db_field['max_mark'];
                       
                       $SQL="select * from subjectdetails, modelexam where  modelexam.Batch='$batch' and  modelexam.sem='$sem' and  modelexam.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'= modelexam.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       $mmaxmark=$db_field['max_mark'];
                       $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and sem='$sem' and exam_type='cycletest1'";
                       $rs=mysql_query($SQL);  
                       $totint=$ic1mark+$ic2mark+$immark+$iassmark+$iattmark;                    
                                    

                  
?>
<BR>
<div class="font-stylec">
<tr>
<td  align="Center" ><Center><?php print $cname;?></Center></td>
</tr>
</div>

<?php
				 }
								

                      }        
            
              
?>

</form>
													
</div>
</body>
</html>