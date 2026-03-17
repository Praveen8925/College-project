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
<tr>
<td>
<?php
          if ((isset($_POST['sem'])) && (isset($_POST['dept']))) 
                 { 
                    $batch=$_POST['batch'];
                                $dept=$_POST['dept']; 
                                $sem=$_POST['sem'];  
                   if(isset($_POST['cid']))
                     { 
                       $cidv=$_POST['cid'];
                       
                      }

                            $cidv = explode("-",$cidv);
                            $cid=$cidv[0];
                            $icid=$cidv[1];
                            $icid=$icid*3;
                            $batch=$_POST['batch'];
                       $dept=$_POST['dept']; 
                       $sem=$_POST['sem'];
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rs); 
                       $totmark=$db_field['Total_Mark'];
                       $totmark = explode("-",$totmark); 
                       $emark=$totmark[0];print $emark.
                       $ic1mark=$totmark[1];
                       $ic2mark=$totmark[2];
                       $immark=$totmark[3];
                       $iattmark=$totmark[4];
                       $iassmark=$totmark[5];
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
                       $SQL= "select * from student where Batch='$batch' and  Department='$dept'" ;
                       $rs=mysql_query($SQL);  
                            if (mysql_num_rows($rs)==0)
                                 {
                                 print "<h1>No data found</h1></a>";
                                 }
                             else
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
<th>
Assiment<br>( <?php print $iassmark ?>)
</th>
<th>
Attandance<br>( <?php print $iattmark ?>)
</th>
<th>
Total<br>( <?php print $totint ?>)
</th>
</tr>
<tr>
<?php 
                               $i=1;
    	                    while($row=mysql_fetch_assoc($rs))
    	                      {
                                   $reg=$row["RegNo"];
	                           print "<td>$i</td><td>".$row["RegNo"]."";?><input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30"><?php  print "</td><td>".$row["Name"]."</td>"; 
                                   $SQL="SELECT * FROM mark WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest1'";
                                   $rm=mysql_query($SQL);
                                       while($row=mysql_fetch_assoc($rm))
                                           {   
                                                   $c1mark=$row["mark1"];
                                                   $c1mark=substr($c1mark,$icid,2);
                                                   print "<td>".$c1mark."</td>";
                                                    $c1imar=($c1mark*$ic1mark)/$c1maxmark;
                                                    $c1imar=round($c1imar,2);
                                                   print "<td>".$c1imar."</td>";
                                            } 
                                  $SQL="SELECT * FROM mark WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='cycletest2'";
                                  $rm=mysql_query($SQL);
                                        while($row=mysql_fetch_assoc($rm))
                                             {   
                                                   $c2mark=$row["mark1"];
                                                   $c2mark=substr($c2mark,$icid,2);
                                                   print "<td>".$c2mark."</td>";
                                                   $c2imar=($c2mark*$ic2mark)/$c2maxmark;
                                                   $c2imar=round($c2imar,2);
                                                   print "<td>".$c2imar."</td>";
                                             } 
                                  $SQL="SELECT * FROM mark WHERE Batch='$batch' and RegNo='$reg' and sem='$sem' and exam_type='modelexam'";
                                  $rm=mysql_query($SQL);
                                        while($row=mysql_fetch_assoc($rm))
                                             {   
                                                   $mmark=$row["mark1"];
                                                   $mmark=substr($mmark,$icid,2);
                                                   print "<td>".$mmark."</td>";
                                                   $mimar=($mmark*$immark)/$mmaxmark;
                                                   $mimar=round($mimar,2);
                                                   print "<td>".$mimar."</td>";
                                             } 
                                    $SQL="SELECT * FROM assiment WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                    $rm=mysql_query($SQL);
				            while($row=mysql_fetch_assoc($rm))
                                             { 
                                                   $assmark=$row['ass_mark'];
                                                   $assmark=substr($assmark,$icid,2);
                                                   print "<td>".round($assmark)."</td>";
                                             
                                               }
                                      $SQL="SELECT * FROM attandance WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                      $rm=mysql_query($SQL);
				            while($row=mysql_fetch_assoc($rm))
                                             { 
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
                                                   print "<td>".$attmark."</td>";
                                             
                                               }
                                           $total=$c1imar+$c2imar+$mimar+$assmark+$attmark;
                                           print "<td>".round($total)."</td>";

  

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