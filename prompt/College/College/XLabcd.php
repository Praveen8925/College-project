<?php
          session_start();	
	 
          $batch=$_SESSION['$batch'];
          $dept=$_SESSION['$dept'];
          $sem=$_SESSION['$sem'];
          $exam=$_SESSION['$exam'];
		  $filename = $batch.$exam."abcd";
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$filename.doc");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
include_once 'database.php';						 
echo "<center><b>SREE SARASWATHI THAYAGARAJA COLLEGE<br>An Autonomous, NAAC Re-Accredited with 'A' Grade, ISO 9001:2008 Certified Institution,
Affiliated to Bharathiar University, Coimbatore</b><br>
<br></center>";	

 
          $rs=mysql_query("select * from coursedetails where Programme='$dept'");
                     $db_field=mysql_fetch_assoc($rs);
                     $short=$db_field['Shortform'];
                          $tablename=$batch.$short.$sem.$exam;
                 
               $SQL="CREATE TABLE collegedetails.$tablename(Name varchar(35),RegNo varchar(10),percentage varchar(30))";
               $rs=mysql_query($SQL);
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'  and Type='Theory' order by CourseID asc"  ;
               $rs=mysql_query($SQL); 
               $tcnt=mysql_num_rows($rs);
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
               $rm=mysql_query($SQL);
               $pcnt=mysql_num_rows($rm);
                    $i=0;
               while($row=mysql_fetch_assoc($rs))
    	            {
                  $cid[$i]=$row["CourseID"]."-".$i;
                   $i++;
                    }
                   while($row=mysql_fetch_assoc($rm))
    	            {
                  $cid[$i]=$row["CourseID"]."-".$i;
                   $i++;
                    } 
                     $j=0;$partcnt=0;$subcnt=$tcnt+$pcnt;
                     for($i=0;$i<$tcnt+$pcnt;$i++)
                       {
                       
                       $ecid = explode("-",$cid[$i]);
                       $scid=$ecid[0];
                       $indexcid=$ecid[1];
                  
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' and Part='3' "  ;
                       $rs=mysql_query($SQL);
                         if(mysql_num_rows($rs)>0)
                          {$p=1;$partcnt++;
                          }
                         else
                          {
							  $p=0;
                          }
                            if($exam=='cycletest1')
                              {
                              $SQL= "SELECT * FROM cycletest_1 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $markindex[$j]=$i;
                              $sp[$j]=$p;
                              }
                             else if($exam=='cycletest2')
                              {
                              $SQL= "SELECT * FROM cycletest_2 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $markindex[$j]=$i;
                              $sp[$j]=$p;
                              }
                             else if($exam=='modelexam')
                              {
                              $SQL= "SELECT * FROM  modelexam where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $markindex[$j]=$i;
                              $sp[$j]=$p;
                              }
							  else if($exam=='semexam')
                              {
                              $SQL= "SELECT * FROM  semexam where Batch='$batch' and Sem='$sem' and Programme_Name='$dept' and CourseID='$scid' ";
                              $rs=mysql_query($SQL);
                              $db_field=mysql_fetch_assoc($rs);
                              $maxmark[$j]=$db_field['max_mark'];
                              $passmark[$j]=$db_field['pass_mark'];
                              $markindex[$j]=$i;
                              $sp[$j]=$p;
                              }
                            $j=$j+1;                      
                          
                       }
                       
                       
                      $ac=1;
                      $bc=1;
                      $cc=1;
                      $dc=1; 
                      $SQL= "select * from student where Batch='$batch' and  Department='$dept' order by RegNo asc" ;
                      $rs=mysql_query($SQL);  
                          if(mysql_num_rows($rs)>0)
                           {
                           $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch'  and sem='$sem' and exam_type='$exam'";
                          $rm=mysql_query($SQL);
                        $db_field=mysql_fetch_assoc($rm);
                        $d=$db_field['decided'];
                            }
                          if (mysql_num_rows($rs)==0 or $partcnt==0)
                             {
                              echo "<center><h1>No data found</h1></center>";
                             }
                           else if(mysql_num_rows($rm)==0 or $d=='y')
                              {
                              echo "<center><h1>Enter the Mark And<br>Finalize</h1></center>";
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
                                    
                                       while($row=mysql_fetch_assoc($rm))
                                           {        
                                                   $tmark=$row["mark"];
                                                   for($j=0;$j<$subcnt;$j++)
                                                      { 
                                                        $mi=$markindex[$j];
                                                         $mi=$mi*3;
                                                        $mark=substr($tmark,$mi,2);
                                                        
                                                           {
                                                        if($mark<$passmark[$j])
                                                          {
                                                            $f=$f+1;
                                                          }
                                                         if($mark=='AB')
                                                          {
                                                            $ab=$ab+1;
                                                          }
                                                        else if($sp[$j]==1)
                                                          {  
                                                           $pmark=$pmark+(($mark*100)/$maxmark[$j]);
                                                                                                              
                                                          }
                                                             }
                                                          
                                                       }
                                                   if($f==0 and $ab==0)
                                                    $percentage=round($pmark/$partcnt,2);
                                                      else if($f <> 0 and $ab <> 0)
                                                      $percentage=$ab.'A,'.$f.'F';
                                                      else if($f <> 0 and $ab == 0) 
                                                      $percentage=$f.'F';
                                                      else if($f == 0 and $ab <> 0)
						      $percentage=$ab.'A';
                                                  $SQL="insert into $tablename values('$name','$reg','$percentage')";
                                                   mysql_query($SQL) or die(mysql_error());
                                                    
                                                      
                                             }
                                          $i++;
                                                      
                               }
                        $SQL= "select * from $tablename where percentage>=70 order by percentage desc"  ;
                        $rs=mysql_query($SQL);
                         if(mysql_num_rows($rs)==0)           
                             {
                             }
                          else
                             {

                                  
echo'
<tr>
<td><center>Category A (Above 70%)</td><tr>
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
  Percentage
</th>
</tr>';


                                   while($row=mysql_fetch_assoc($rs))
    	                                  {
                                        echo "<tr><td>".$ac."</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td><td>".round($row["percentage"])."</td></tr>";
                                        $ac++;
                                          }
                              }
                                              
echo'
</table>
<br>';


                        $SQL= "select * from $tablename where percentage>=50 and percentage<=69  order by percentage desc"  ;
                        $rs=mysql_query($SQL);
                         if(mysql_num_rows($rs)==0)           
                             {
                             }
                          else
                             {
echo'
<tr>
<td><center>Category B ( 50% to 69%)</td><tr>
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
  Percentage
</th>
</tr>';


                                  while($row=mysql_fetch_assoc($rs))
    	                                  {
                                        echo "<tr><td>".$bc."</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td><td>".round($row["percentage"])."</td></tr>";
                                        $bc++;
                                          }
                              }                                         
                                            
echo'
</table>
<br>';


                        $SQL= "select * from $tablename where percentage>=40 and percentage<=49  order by percentage desc"  ;
                        $rs=mysql_query($SQL);
                         if(mysql_num_rows($rs)==0)           
                             {
                             }
                          else
                             {
echo'
<tr>
<td><center>Category C ( 40% to 49%)</td><tr>
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
  Percentage
</th>
</tr>';



                                  while($row=mysql_fetch_assoc($rs))
    	                                  {
                                        echo "<tr><td>".$cc."</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td><td>".round($row["percentage"])."</td></tr>";
                                        $cc++;
                                          }
                              }                                         
                                            
echo'
</table>
<br>';


                        $SQL= "select * from $tablename where  percentage<40  order by RegNo"  ;
                        $rs=mysql_query($SQL);
                         if(mysql_num_rows($rs)==0)           
                             {
                             }
                          else
                             {
echo'
<tr>
<td><center>Category D ( ARREARS AND ABSENTEES)</td><tr>
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
  Percentage
</th>
</tr>';


                                  while($row=mysql_fetch_assoc($rs))
    	                                  {
                                        echo "<tr><td>".$dc."</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td><td>".$row["percentage"]."</td></tr>";
                                        $dc++;
                                          }
                              }                                         
                                            
                         } 


                             
                            
if($ac>1 or$bc>1 or$cc>1 or$dc>1 )
{                             
      
echo' 
</tr>
</table>';

}
                 $SQL="drop table $tablename";
                 $rs=mysql_query($SQL);
                      
  	         

echo'
</body>
</html>';
?>