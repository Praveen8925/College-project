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
<td colspan="2" align="Center"><h1>Internal Mark</h1>
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
         for ($x=2000; $x<=$y; $x++)
           { 
  	echo "<option value=".$x.">".$x."</option>";
           }
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
               else
                 {
           $rs=mysql_query("select * from coursedetails");
              while($row=mysql_fetch_row($rs))
                  {
			print "<option values=$row[0]>$row[0]</option>";
                   } 
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
                                $batch=$_POST['batch'];
                                $dept=$_POST['dept']; 
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
                    
                        
                               $batch=$_POST['batch'];$_SESSION['$batch']=$batch;
                                $dept=$_POST['dept']; $_SESSION['$dept']=$dept;
                                $sem=$_POST['sem'];    $_SESSION['$sem']=$sem;
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
                           // print $cid;
                              $a=$a*3;$_SESSION['$a']=$a;
                              
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
                       $testatt=1; $testass=1;$testlab=1;$testrecord=1;$testmm=1;$testct=1; $testco=1;
                       $SQL="SELECT * FROM collegedetails.$batch,student WHERE collegedetails.$batch.Batch='$batch' and sem='$sem' and student.Department ='$dept' and exam_type='cycletest1' and collegedetails.$batch.decided='n' and status<>'discontinue'";
                         $rs=mysql_query($SQL);  
                            if (mysql_num_rows($rs)==0)
                                 {
                                 print "<center><h1>Enter Cycle Test I Mark</h1></center>";$testco=0;
                                 }
                            else
                               {
                          $SQL="select * from subjectdetails,cycletest_1 where cycletest_1.Batch='$batch' and cycletest_1.sem='$sem' and cycletest_1.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_1.CourseID ";
                          $rc=mysql_query($SQL);
                          $db_field=mysql_fetch_assoc($rc);
                          $c1maxmark=$db_field['max_mark'];
                                }
                         $SQL="SELECT * FROM collegedetails.$batch,student WHERE collegedetails.$batch.Batch='$batch' and sem='$sem' and student.Department ='$dept' and exam_type='cycletest2' and collegedetails.$batch.decided='n'";
                               $rm=mysql_query($SQL);
                                 if (mysql_num_rows($rm)==0)
                                    {
                                    print "<center><h1>Enter Cycle Test II Mark</h1></center>";$testct=0;
                                    }
                                  else
                                   {
                         $SQL="select * from subjectdetails,cycletest_2 where cycletest_2.Batch='$batch' and cycletest_2.sem='$sem' and cycletest_2.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'=cycletest_2.CourseID ";
                         $rc=mysql_query($SQL);
                         $db_field=mysql_fetch_assoc($rc);
                         $c2maxmark=$db_field['max_mark'];
                                    }
                          $SQL="SELECT * FROM collegedetails.$batch,student WHERE collegedetails.$batch.Batch='$batch' and sem='$sem' and student.Department ='$dept' and exam_type='modelexam' and collegedetails.$batch.decided='n' and status<>'discontinue'";
                          $rm=mysql_query($SQL);
                                  if (mysql_num_rows($rm)==0)
                                   {
                                  print "<center><h1>Enter Model Mark</h1></center>";$testmm=0;
                                   }
                                  else
                                   {
                       $SQL="select * from subjectdetails, modelexam where  modelexam.Batch='$batch' and  modelexam.sem='$sem' and  modelexam.Programme_Name='$dept' and TRIM(subjectdetails.CourseID)='$cid'and '$cid'= modelexam.CourseID ";
                       $rc=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rc);
                       $mmaxmark=$db_field['max_mark'];
                                   }
                       if($type=='Practical')
                          {
                           $SQL="SELECT * FROM collegedetails.$table,student WHERE collegedetails.$table.Batch='$batch' and student.Department ='$dept'  and sem='$sem' and Type='Record' and collegedetails.$table.decided='n' and status<>'discontinue'";
                           $rm=mysql_query($SQL);
                           if (mysql_num_rows($rm)==0)
                               {
                              print "<center><h1>Enter Record Mark</h1></center>";$testrecord=0;
                                }
                              $SQL="SELECT * FROM collegedetails.$table,student WHERE collegedetails.$table.Batch='$batch' and student.Department ='$dept'and sem='$sem' and Type='Lab Performance'and collegedetails.$table.decided='n' and status<>'discontinue'";
                              $rm=mysql_query($SQL);      
                                if (mysql_num_rows($rm)==0)
                                    {
                                print "<center><h1>Enter Lab Performance Mark</h1></center>";$testlab=0;
                                    }
                              
                           }
                         else if($type=='Theory')
                           {
                            
                                    $SQL="SELECT * FROM $tablename,student WHERE collegedetails.$tablename.Batch='$batch' and student.Department ='$dept' and sem='$sem' and $tablename.decided='n' and status<>'discontinue'";
                                    $rm=mysql_query($SQL);                                        
                                   if (mysql_num_rows($rm)==0)
                                        {
                                        print "<center><h1>Enter Assigment Mark</h1></center>";
                                        $testass=0;
                                        }
                                        
                                        $SQL="SELECT * FROM $tn,student WHERE collegedetails.$tn.Batch='$batch' and student.Department ='$dept'  and sem='$sem'and $tn.decided='n' and status<>'discontinue'";
                                      $rm=mysql_query($SQL);  
                                        if (mysql_num_rows($rm)==0)
                                        {
                                        print "<center><h1>Enter Attendance  Mark</h1></center>";
                                        $testatt=0;
                                        }
                           }

                          if($testco==1 and $testct==1 and $testmm==1 and $testrecord==1 and $testlab==1 and $testass==1 and $testatt==1)
                                      {
                                    $totint=$ic1mark+$ic2mark+$immark+$iassmark+$iattmark;                    
                                    

                  
?>
<tr>
<td><center>
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
  Cycle Test I<br>( <?php print $c1maxmark ?>)
</th>
<th>
Cycle Test I<br>( <?php print $ic1mark ?>)
</th>
<th>
Cycle Test II<br>( <?php print $c2maxmark ?>)
</th>
<th>
Cycle Test II<br>( <?php print $ic2mark ?>)
</th>
<th>
Model Exam<br>( <?php print $mmaxmark ?>)
</th>
<th>
Model Exam<br>( <?php print $immark ?>)
</th>
<?php
 if($type=='Theory')
   {
?>
<th>
Assignment<br>( <?php print $iassmark ?>)
</th>
<th>
Attendance<br>( <?php print $iattmark ?>)
</th>
<?php
    }
   else
    {
?>
<th>
Record<br>( <?php print $iassmark ?>)
</th>
<th>
Lab Performance<br>( <?php print $iattmark ?>)
</th>
<?php
    }
?>
<th>
Total<br>( <?php print $totint ?>)
</th>
</tr>
<tr>
<?php 

                              $SQL= "select * from student where Batch='$batch' and  Department='$dept' and status<>'discontinue' order by RegNo asc " ;
                              $rs=mysql_query($SQL); 
                               $i=1;
							   
							   
							   
							   $SQLs= "select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem'";
		$rs1=mysql_query($SQLs);  
        $count=mysql_num_rows($rs1);
		if($count==0)
		{      
	print "<h1>No Data Found</h1>";
		}

		else
		{
$t="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' ";
//print $t;
$r=mysql_query($t);  	
	$num = mysql_num_rows($r);
//echo "<b>Total days : ".$num."</b>";
							   
		}			   
							   
							   
							   
							   
    	                    while($row=mysql_fetch_assoc($rs))
    	                      {
								   $reg=$row["RegNo"];
								  
							$SQL="SELECT * FROM 2015yearattendance WHERE Batch='$batch'  and semester='$sem'and Course='$dept'";
                                      $rm=mysql_query($SQL);
									  //$num=count($rm);
									  //print $num."<br>";
									  
									  while($rows=mysql_fetch_assoc($rm))
									  {
										  	   
								  $fdate1=$rows["Date"];
								  $absent=0;
								  $num=3;
								 $tdate=date_create("30-08-2017");
                   $tdate=date_format($tdate,"Y-m-d"); 
$j=0;
while($j<$num)
{	
		 $t1="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date = '$fdate1' and (Ihour like '%$reg%' or IIhour like '%$reg%' or IIIhour like '%$reg%')";
$r1=mysql_query($t1); 
	$num1 = mysql_num_rows($r1);
	if($num1>0)
		$absent=$absent+0.5;
	$t2="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date = '$fdate1' and (IVhour like '%$reg%' or Vhour like '%$reg%' or VIhour like '%$reg%')";
    $r2=mysql_query($t2);  	
	$num2 = mysql_num_rows($r2);
	if($num2>0)
		$absent=$absent+0.5;
	$fdate1=date('Y-m-d', strtotime($fdate1 .' +1 day'));
	//print $fdate1."-".$absent."<br>";
	$j++;
		}
			//print "<td align='center'>".($num-$absent)."</td><td align='center'>".$absent."</td><td align='center'>".round((($num-$absent)/$num *100))."</td>";		
									  }

								  
	
		
								  
								  
								  
								  
								  
								  
								  
								  
								  
                                  
	                           print "<td>$i</td><td>".$row["RegNo"]."</td><td>".$row["Name"]."</td>"; 
                                   $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest1'";
                                   $rm=mysql_query($SQL);
                                        if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td></td><td></td>";
                                              $c1imar=0;
                                            }
                                         else
                                            {
                                       while($row=mysql_fetch_assoc($rm))
                                           {   
                                                   $c1mark=$row["mark"];
                                                   $c1mark=substr($c1mark,$icid,2);
                                                   print "<td>".$c1mark."</td>";
                                                    $c1imar=($c1mark*$ic1mark)/$c1maxmark;
                                                    $c1imar=round($c1imar,2);
                                                   print "<td>".$c1imar."</td>";
                                            }
                                              } 
                                  $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest2'";
                                  
                                  $rm=mysql_query($SQL);
                                          if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td></td><td></td>";
                                              $c2imar=0;
                                            }
                                         else
                                            {
                                        while($row=mysql_fetch_assoc($rm))
                                             {   
                                                   $c2mark=$row["mark"];
                                                   $c2mark=substr($c2mark,$icid,2);
                                                   print "<td>".$c2mark."</td>";
                                                   $c2imar=($c2mark*$ic2mark)/$c2maxmark;
                                                   $c2imar=round($c2imar,2);
                                                   print "<td>".$c2imar."</td>";
                                             } 
                                             }
                                  $SQL="SELECT * FROM collegedetails.$batch WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='modelexam'";
                                  $rm=mysql_query($SQL);
                                            if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td></td><td></td>";
                                              $mimar=0;
                                            }
                                         else
                                            {
                                        while($row=mysql_fetch_assoc($rm))
                                             {   
                                                   $mmark=$row["mark"];
                                                   $mmark=substr($mmark,$icid,2);
                                                   print "<td>".$mmark."</td>";
                                                   $mimar=($mmark*$immark)/$mmaxmark;
                                                   $mimar=round($mimar,2);
                                                   print "<td>".$mimar."</td>";
                                             } 
                                             }
                                            
  					if($type=='Theory')
  					 {
                                    $SQL="SELECT * FROM $tablename WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                    $rm=mysql_query($SQL);
                                              if(mysql_num_rows($rm)==0)
                                           {
                                              print "<td></td>";$assmark=0;
                                              
                                            }
                                         else
                                            {
				            while($row=mysql_fetch_assoc($rm))
                                             { 
                                                   $assmark=$row['ass_mark'];
                                                   $assmark=substr($assmark,$icid,2);
                                                   print "<td>".round($assmark)."</td>";
                                             
                                               }
                                             }
                                              
                                      $SQL="SELECT * FROM $tn WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                      $rm=mysql_query($SQL);
                                              if(mysql_num_rows($rm)==0)
                                               {
                                              print "<td></td>";
                                              $attmark=0;
                                               }
                                              else
                                                {
				            while($row=mysql_fetch_assoc($rm))
                                             { 
                                                   $twd=$num;
                                                   $ndy=($num-$absent);
                                                   $pattmark=round((($num-$absent)/$num *100));
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
                                                   print "<td>".$attmark."</td>";
                                             
                                               }}
                                              }
                                            else
                                               {
                                                   
                                               $SQL="SELECT * FROM collegedetails.$table WHERE Batch='$batch'  and sem='$sem' and Type='Record' and RegNo='$reg'";
                                               $rm=mysql_query($SQL);
                                                     if(mysql_num_rows($rm)==0)
                                                        {
                                                       print "<td></td>";
                                                       $assmark=0;
                                                          }
                                                      else
                                                         {
                                                while($row=mysql_fetch_assoc($rm))
                                                {
                                                  $rmark=$row['mark'];
                                                   $assmark=substr($rmark,$a,2);
                                                   print "<td>".round($assmark)."</td>";
                                                 }
                                                           }
                                                 $SQL="SELECT * FROM collegedetails.$table WHERE Batch='$batch'  and sem='$sem' and Type='Lab Performance' and RegNo='$reg'";
                                               $rm=mysql_query($SQL);
                                                     if(mysql_num_rows($rm)==0)
                                                       {
                                                     print "<td></td>";
                                                      $attmark=0;
                                                        }
                                                     else
                                                       {
                                                while($row=mysql_fetch_assoc($rm))
                                                {
                                                  $rmark=$row['mark'];
                                                   $attmark=substr($rmark,$a,2);
                                                   print "<td>".round($attmark)."</td>";
                                                 }    }
                                                }
                                           $total=$c1imar+$c2imar+$mimar+$assmark+$attmark;
                                           print "<td>".round($total)."</td></tr>";

  

                                   $i++;
                                 }
									  					
                               }
                         
                          }}




?>
</form>
</div>
</body>
</html>