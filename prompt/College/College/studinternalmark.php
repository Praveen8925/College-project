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
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
</th>
<th>Max Internal Mark
</th>
<th>Mark
</th>
<th>Internal Mark
</th>
</tr>
<tr>
<td>
  Cycle Test I
</td>
<?php
                                   $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest1'";
                                   $rm=mysql_query($SQL);
                                        if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td>$ic1mark</td><td></td><td></td>";
                                              $c1imar=0;
                                            }
                                         else
                                            {
                                       while($row=mysql_fetch_assoc($rm))
                                           {   print "<td>$ic1mark</td>";
                                                   $c1mark=$row["mark"];
                                                   $c1mark=substr($c1mark,$icid,2);
                                                   print "<td>".$c1mark."</td>";
                                                    $c1imar=($c1mark*$ic1mark)/$c1maxmark;
                                                    $c1imar=round($c1imar,2);
                                                   print "<td>".$c1imar."</td>";
                                            }
                                              }
?>
</tr>
<tr>
<td>
Cycle Test II
</td>
<?php
                                 $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest2'";
                                    $rm=mysql_query($SQL);
                                          if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td>$ic2mark</td><td></td><td></td>";
                                              $c2imar=0;
                                            }
                                         else
                                            {
                                        while($row=mysql_fetch_assoc($rm))
                                             {   print "<td>$ic2mark</td>";
                                                   $c2mark=$row["mark"];
                                                   $c2mark=substr($c2mark,$icid,2);
                                                   print "<td>".$c2mark."</td>";
                                                   $c2imar=($c2mark*$ic2mark)/$c2maxmark;
                                                   $c2imar=round($c2imar,2);
                                                   print "<td>".$c2imar."</td>";
                                             } 
                                             }
?>
</tr>
<tr>
<td>
Model Exam
</td>
<?php
                                  $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='modelexam'";
                                  $rm=mysql_query($SQL);
                                            if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td>$immark</td><td></td><td></td>";
                                              $mimar=0;
                                            }
                                         else
                                            {
                                        while($row=mysql_fetch_assoc($rm))
                                             {     print "<td>$immark</td>";
                                                   $mmark=$row["mark"];
                                                   $mmark=substr($mmark,$icid,2);
                                                   print "<td>".$mmark."</td>";
                                                   $mimar=($mmark*$immark)/$mmaxmark;
                                                   $mimar=round($mimar,2);
                                                   print "<td>".$mimar."</td>";
                                             } 
                                             }
?>
<?php
 if($type=='Theory')
   {
?>
</tr>
<tr>
<td>
Assignment
</td>
<?php
				
                                    $SQL="SELECT * FROM $tablename WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                    $rm=mysql_query($SQL);
                                              if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td>$iassmark</td><td></td><td></td>";$assmark=0;
                                              
                                            }
                                         else
                                            {
				            while($row=mysql_fetch_assoc($rm))
                                              {     print "<td>$iassmark</td>";
                                                   $assmark=$row['ass_mark'];
                                                   $assmark=substr($assmark,$icid,2);
                                                   print "<td>".round($assmark)."</td><td>".round($assmark)."</td>";
                                             
                                               }
                                             }
?>
</tr>
<tr>
<td>
Attendance
</td>
<?php

                                    $SQL="SELECT * FROM $tn WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                      $rm=mysql_query($SQL);
                                              if(mysql_num_rows($rm)==0)
                                               {
                                              print "<td>$iattmark</td><td></td><td></td>";
                                              $attmark=0;
                                               }
                                              else
                                                {
				            while($row=mysql_fetch_assoc($rm))
                                             {     print "<td>$iattmark</td>";
                                                   $twd=$row['tot_working_days'];
                                                   $ndy=$row['no_day_present'];
                                                   $pattmark=($ndy*100)/$twd;
                                                    if($pattmark>=96 && $pattmark<=100)
                                                     $attmark=5;
                                                     else if($pattmark>=91 && $pattmark<=95)
                                                     $attmark=4;
                                                     else if($pattmark>=86 && $pattmark<=90)
                                                     $attmark=3;
                                                      else if($pattmark>=81 && $pattmark<=85)
                                                     $attmark=2;
                                                      else if($pattmark>=75 && $pattmark<=80)
                                                     $attmark=1;
                                                       else if($pattmark>=0 && $pattmark<=75)
                                                     $attmark=0;
                                                   print "<td>".$attmark."</td><td>".$attmark."</td>";
                                             
                                               }
                                           }

    }
   else
    {
?>
</tr>
<tr>
<td>
Record
</td>
<?php
					       $SQL="SELECT * FROM collegedetails.$table WHERE Batch='$batch'  and sem='$sem' and Type='Record' and RegNo='$reg'";
                                               $rm=mysql_query($SQL);
                                                     if(mysql_num_rows($rm)==0)
                                                        {
                                                       print "<td>$iassmark</td><td></td>";
                                                       $assmark=0;
                                                          }
                                                      else
                                                         {
                                                while($row=mysql_fetch_assoc($rm))
                                                { print "<td>$iassmark</td><td></td>";
                                                  $rmark=$row['mark'];
                                                   $assmark=substr($rmark,$a,2);
                                                   print "<td>".round($assmark)."</td>";
                                                 }
                                                           }
?>
</tr>
<tr>
<td>
Lab Performance
</td>
<?php
                                               $SQL="SELECT * FROM collegedetails.$table WHERE Batch='$batch'  and sem='$sem' and Type='Lab Performance' and RegNo='$reg'";
                                               $rm=mysql_query($SQL);
                                                     if(mysql_num_rows($rm)==0)
                                                       {
                                                     print "<td>$iattmark</td><td></td><td></td>";
                                                      $attmark=0;
                                                        }
                                                     else
                                                       {
                                                while($row=mysql_fetch_assoc($rm))
                                                {  print "<td>$iattmark</td><td>";
                                                  $rmark=$row['mark'];
                                                   $attmark=substr($rmark,$a,2);
                                                   print "<td>".round($attmark)."</td>";
                                                 }    }
                                                
    }
?>
</tr>
<tr>
<td>
Total
</td>
<?php
                             print "<td>".$totint."</td><td></td>"; 
                             $total=$c1imar+$c2imar+$mimar+$assmark+$attmark;
                             print "<td>".round($total)."</td>";
                                 

                               }

?>
</tr>
</table>
<?php


                      }        
            
              
?>

</form>
													
</div>
</body>
</html>