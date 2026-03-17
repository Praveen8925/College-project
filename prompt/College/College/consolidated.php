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
     <td colspan="2" align="Center"><h1>Consolidate</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['']))
    print $_SESSION[''];
  unset($_SESSION['']);
?></h3>
   </tr>
<form name="markf" method="post" action="#" >
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
      <td><select name="sem" id="sem">
<?php
      if(isset($_POST['sem']))
      {
?>
<option value="<?php print $_POST['sem']; ?>"><?php print $_POST['sem']; ?></option>
<?php
       
      }
             for ($x=1; $x<=6; $x++)
                {
              echo "<option value=".$x.">".$x."</option>";
                 }
?>
          </select>  
     </td>
 </tr>
<tr>
<td>Exam</td>
<td><select name="exam" id="exam">
<?php
      if(isset($_POST['exam']))
      {
?>
<option value="<?php print $_POST['exam']; ?>"><?php print $_POST['exam']; ?></option>
<?php
       
      }
?>
<option value="cycletest1">Cycle Test I</option>;
<option value="cycletest2">Cycle Test II</option>;
<option value="modelexam">Model Exam</option>;
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
</td>
</tr>



<?php
                  if ($_POST) 
                 { 
			 $batch=$_POST['batch'];
                         $dept=$_POST['dept']; 
                         $sem=$_POST['sem']; 
                         $exam=$_POST['exam'];
                         $_SESSION['batch']=$batch;
                         $_SESSION['dept'] = $dept;
                         $_SESSION['sem']=$sem;
                          $_SESSION['exam']=$exam;
                     $rs=mysql_query("select * from coursedetails where Programme='$dept'");
                     $db_field=mysql_fetch_assoc($rs);
                     $short=$db_field['Shortform'];
                          $tablename=$batch.$short.$sem.$exam;
               
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'  and Type='Theory' order by CourseID asc"  ;
               $rs=mysql_query($SQL); 
               $tcnt=mysql_num_rows($rs);
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
               $rm=mysql_query($SQL);
               $pcnt=mysql_num_rows($rm);
?>



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
<?php
               
                    $i=0;
               while($row=mysql_fetch_assoc($rs))
    	            {
                  $cid[$i]=$row["CourseID"];
                  $cname[$i]=$row["Course_Name"];
                   print "<th>".$row["Course_Name"]."</th>";
                   $i++;
                    }
                   while($row=mysql_fetch_assoc($rm))
    	            {
                  $cid[$i]=$row["CourseID"];
                   $cname[$i]=$row["Course_Name"];
                   print "<th>".$row["Course_Name"]."</th>";
                   $i++;
                    } print "</tr>";
                     $j=0;$subcnt=$tcnt+$pcnt;
                        
                      $check="reg varchar(15)";
                       for($sz=1;$sz<=$subcnt;$sz++)
                         {
                          $sub=" ,sub".$sz." varchar(3)";
                         $check=$check.$sub;
                         }
                      $SQL="CREATE TABLE collegedetails.$tablename($check)";
                      $rs=mysql_query($SQL);
                     for($j=0;$j<$subcnt;$j++)
                       {
                       
                       $scid=$cid[$j];
           
                            if($exam=='cycletest1')
                              {
                              $SQL= "SELECT * FROM cycletest_1 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $halfmm[$j]=$passmark[$j]/2; 
                              $markindex[$j]=$j;
                              $date[$j]=$db_field['C1_Date'];
                              }
                             else if($exam=='cycletest2')
                              {
                              $SQL= "SELECT * FROM cycletest_2 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $halfmm[$j]=$passmark[$j]/2;
                              $markindex[$j]=$j;
                              $date[$j]=$db_field['C2_Date'];
                              }
                             else if($exam=='modelexam')
                              {
                              $SQL= "SELECT * FROM  modelexam where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $halfmm[$j]=$passmark[$j]/2;
                              $markindex[$j]=$j;
                              $date[$j]=$db_field['ME_Date'];
                              }
                                                
                          
                       }
                        
                      $SQL= "select * from student where Batch='$batch' and  Department='$dept' order by RegNo asc" ;
                      $rs=mysql_query($SQL);  
                          if(mysql_num_rows($rs)>0)
                           {
                           $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch'  and sem='$sem' and exam_type='$exam'";
                          $rm=mysql_query($SQL);
                        $db_field=mysql_fetch_assoc($rm);
                        $d=$db_field['decided'];
                            }
                          if (mysql_num_rows($rs)==0 or $subcnt==0)
                             {
                              print "<center><h1>No data found</h1></center>";
                             }
                           else if(mysql_num_rows($rm)==0 or $d=='y')
                              {
                              print "<center><h1>Enter the Mark And<br>Finalize</h1></center>";
                              }
                          else
                             {
?>
<?php
                         $i=0;
                             
                         while($row=mysql_fetch_assoc($rs))
    	                      {   
                                   $reg=$row["RegNo"];
                                   $name=$row["Name"];
                                   
                                                                     
	                           $pmark=0;$f=0;$ab=0; 
                                   $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='$exam'";
                                   $rm=mysql_query($SQL);
                                     if(mysql_num_rows($rm)>0)
                                      {
                                     print "<tr><td>".$i."</td><td>".$reg."</td><td>".$name."</td>";
                                      }
                                    $icheck="'$reg'";$ins="";
                                       while($row=mysql_fetch_assoc($rm))
                                           {        
                                                   $tmark=$row["mark"];
                                                    for($j=0;$j<$subcnt;$j++)
                                                         {
                                                        $mi=$markindex[$j];
                                                         $mi=$mi*3;
                                                        $mark=substr($tmark,$mi,2);
                                                         print "<td>".$mark."</td>";
                                                          $ins=" , '$mark'";
                                                          $icheck=$icheck.$ins; 
                                                        
                                                        }
                                           }
                                                   
                                                   
                                                   $SQL="insert into $tablename values($icheck)";
                                                   mysql_query($SQL) or die(mysql_error());       
                                           print "</tr>";         
                                            $i++;          
                                            } 
                             }
?>

<br>
<?php
                         for($j=0;$j<$subcnt;$j++)
                           {$pass=0;$ab=0;$fail=0;$lesst=0;
                           $z=$j+1;
                           $columnname="sub".$z;
                      $SQL= "select $columnname,reg from $tablename  order by reg asc" ;
                      $rs=mysql_query($SQL);
                          $studinclass[$j]=mysql_num_rows($rs); 
                            
                          while($row=mysql_fetch_assoc($rs))
                            {
                             $studmark=$row["$columnname"];
                                if($studmark=="AB")
                                {$ab++;
                                 
                                } 
                               else if($studmark>=$passmark[$j])
                                {$pass++;
                                 
                                }
                               
                               else if($studmark<$passmark[$j])
                                {$fail++;
                                 
                                  if($studmark<$halfmm[$j])
                                   {$lesst++;
                                     
                                    }
                                 }
                                 $nopass[$j]=$pass;
                                 $nofail[$j]=$fail;
                                 $absentees[$j]=$ab;
                                 $lesshalf[$j]=$lesst;
                                 $app[$j]=$studinclass[$j]-$absentees[$j];
                            }
                          $less=$halfmm[$j];
                            }
                          
 
?>
</table>
<br>
<table width="80%" border="1">
<tr>

<td colspan="3">
 NO.OF STUDENTS IN THE CLASS
</td> 
<?php
for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$studinclass[$j]."</td>";
      }

?>
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS APPEARED
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$app[$j]."</td>";
      }
?>
</tr>
<tr>
<td colspan="3">
 NO.OF ABSENTEES
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$absentees[$j]."</td>";
      }
?>
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS PASSED
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$nopass[$j]."</td>";
      }          
?>  
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS SCORE LESS THAN<?php print $less;?> 
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$lesshalf[$j]."</td>";
      }          
?>  
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS FAILED
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
      print "<td align='center'>".$nofail[$j]."</td>";
      }          
?> 
</tr>
<tr>
<td colspan="3">
 PASS PERCENTAGE
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
          $PP =($nopass[$j]*100)/$app[$j];
      print "<td align='center'>".round($PP)."</td>";
      }          
?> 
</tr>
<tr>
<td colspan="3">
 DATE
</td> 
<?php
       for($j=0;$j<$subcnt;$j++)
      {
        $dt=$date[$j];
         $dt=date_create($dt);
         $dt=date_format($dt,"d-m-Y");  
      print "<td align='center'>".$dt."</td>";
      }          
?> 
</tr>
</table>

<table width="100%" border="0" >
<tr>
<?php
     for($j=0;$j<$subcnt;$j++)
      {
       print "<td>".$cname[$j]."</td><td>".$cid[$j]."</td>";
print "</tr>";
       }
     
 		$SQL="drop table $tablename";
                 $rs=mysql_query($SQL);    
 ?>

<tr>
<td><center>
<input type="button" Value="Export"  onClick="location.href='xlconsolidated.php'" class="bn"></center>
</td>
</tr>
<?php  	   
	   }
?>
</table>

<br>
</form>
</div>
</body>
</html>