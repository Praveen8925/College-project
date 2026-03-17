<?php
session_start();


                         $batch=$_SESSION['batch'];
                         $dept=$_SESSION['dept'];
                         $sem=$_SESSION['sem'];
                         $exam=$_SESSION['exam'];
						 $filename = $batch.$exam."consolidate";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=$filename.xls");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
include_once 'database.php';						 
echo "<center><b>SREE SARASWATHI THAYAGARAJA COLLEGE<br>An Autonomous, NAAC Re-Accredited with 'A' Grade, ISO 9001:2008 Certified Institution,
Affiliated to Bharathiar University, Coimbatore<b></center>";						 
						 
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
echo '
<body>
<table border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Reg No
</th>
<th>
  Name
</th>';

               
                    $i=0;
               while($row=mysql_fetch_assoc($rs))
    	            {
                  $cid[$i]=$row["CourseID"];
                  $cname[$i]=$row["Course_Name"];
                   echo "<th>".$row["Course_Name"]."</th>";
                   $i++;
                    }
                   while($row=mysql_fetch_assoc($rm))
    	            {
                  $cid[$i]=$row["CourseID"];
                   $cname[$i]=$row["Course_Name"];
                   echo "<th>".$row["Course_Name"]."</th>";
                   $i++;
                    } echo "</tr>";
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
                              echo "<center><h1>No data found</h1></center>";
                             }
                           else if(mysql_num_rows($rm)==0 or $d=='y')
                              {
                              echo "<center><h1>Enter the Mark And<br>Finalize</h1></center>";
                              }
                          else
                             {

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
                                     echo "<tr><td>".$i."</td><td>".$reg."</td><td>".$name."</td>";
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
                                                         echo "<td>".$mark."</td>";
                                                          $ins=" , '$mark'";
                                                          $icheck=$icheck.$ins; 
                                                        
                                                        }
                                           }
                                                   
                                                   
                                                   $SQL="insert into $tablename values($icheck)";
                                                   mysql_query($SQL) or die(mysql_error());       
                                           echo "</tr>";         
                                            $i++;          
                                            } 
                             }


echo'<br>';

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
                          
 
echo '
</table>
<br>
<table border="1">
<tr>

<td colspan="3">
 NO.OF STUDENTS IN THE CLASS
</td> ';

for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$studinclass[$j]."</td>";
      }

echo'
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS APPEARED
</td> ';

       for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$app[$j]."</td>";
      }
echo'
</tr>
<tr>
<td colspan="3">
 NO.OF ABSENTEES
</td> ';

       for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$absentees[$j]."</td>";
      }
echo'
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS PASSED
</td> ';

       for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$nopass[$j]."</td>";
      }          
echo' 
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS SCORE LESS THAN<?php echo $less;?> 
</td> ';

       for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$lesshalf[$j]."</td>";
      }          
echo' 
</tr>
<tr>
<td colspan="3">
 NO.OF STUDENTS FAILED
</td>'; 

       for($j=0;$j<$subcnt;$j++)
      {
      echo "<td align='center'>".$nofail[$j]."</td>";
      }          
echo' 
</tr>
<tr>
<td colspan="3">
 PASS PERCENTAGE
</td>'; 

       for($j=0;$j<$subcnt;$j++)
      {
          $PP =($nopass[$j]*100)/$app[$j];
      echo "<td align='center'>".round($PP)."</td>";
      }          
echo'
</tr>
<tr>
<td colspan="3">
 DATE
</td>'; 

       for($j=0;$j<$subcnt;$j++)
      {
        $dt=$date[$j];
         $dt=date_create($dt);
         $dt=date_format($dt,"d-m-Y");  
      echo "<td align='center'>".$dt."</td>";
      }          
echo' 
</tr>
</table>

<table border="1">
<tr>';

     for($j=0;$j<$subcnt;$j++)
      {
       echo "<td>".$cname[$j]."</td><td>".$cid[$j]."</td>";
echo "</tr>";
       }
     
 		$SQL="drop table $tablename";
                 $rs=mysql_query($SQL);    


  	   
	   
	   echo'</table>

<br>

</body>
</html>';
?>