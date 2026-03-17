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
     <td colspan="2" align="Center"><h1>Time Table</h1>
   </tr>
   
<form name="markf" method="post" action="#" >

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
<option value="sem">Sem</option>;
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
	                $sem=$_POST['sem']; 
                        $exam=$_POST['exam'];
                         if($exam=='cycletest1')
                          {
                          $SQL= "select * from  cycletest_1 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
                          $rp=mysql_query($SQL);
                   
                          $db_field=mysql_fetch_assoc($rp);
                          $d=$db_field['decided'];
                       $SQL="SELECT * FROM cycletest_1 WHERE Batch='$batch' and sem='$sem' and Programme_Name='$dept'  order by C1_Date";
                       $rm=mysql_query($SQL);
                           if (mysql_num_rows($rm)==0 or $d=='y')
                           {
                       print "<center><h1> Time Table is not uploaded </h1></center>";
                       }
                    else
                     {
?>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Course ID
</th>
<th>
   Course Name
</th>
<th>
   Date
</th>
<th>Max Mark
</th>
<th>Pass Mark
</th>
</tr>
<tr>
<?php
                       $i=1;
                       while($row=mysql_fetch_assoc($rm))
                                   {   
                                $c1date=$row['C1_Date']; 
                                $cid=$row['CourseID'];
                                $SQL= "select * from subjectdetails where  CourseID='$cid' " ;
                                $rs=mysql_query($SQL);
                                $db_field=mysql_fetch_assoc($rs);
                                $cidname=$db_field['Course_Name'];	
			        $mm=$row['max_mark'];	
                                 $pm=$row['pass_mark'];
                                 $c1date=date_create($c1date);
                                 $c1date=date_format($c1date,"d-m-Y"); 	
                                 print "<td>$i</td><td>".$cid."</td><td>".$cidname."</td><td>".$c1date."</td><td>".$mm."</td><td>".$pm."</td></tr>";                   
                                   $i++;
                                     }  
                          }
                 }
               else if($exam=='cycletest2')
                 {
                          $SQL= "select * from  cycletest_2 where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
                          $rp=mysql_query($SQL);
                   
                          $db_field=mysql_fetch_assoc($rp);
                          $d=$db_field['decided'];
                       $SQL="SELECT * FROM cycletest_2 WHERE Batch='$batch' and sem='$sem' and Programme_Name='$dept'  order by C2_Date";
                       $rm=mysql_query($SQL);
                           if (mysql_num_rows($rm)==0 or $d=='y')
                           {
                       print "<center><h1> Time Table is not uploaded </h1></center>";
                       }
                    else
                     {
?>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Course ID
</th>
<th>
   Course Name
</th>
<th>
   Date
</th>
<th>Max Mark
</th>
<th>Pass Mark
</th>
</tr>
<tr>
<?php
                       $i=1;
                       while($row=mysql_fetch_assoc($rm))
                                   {   
                                $c2date=$row['C2_Date']; 
                                $cid=$row['CourseID'];
                                $SQL= "select * from subjectdetails where  CourseID='$cid' " ;
                                $rs=mysql_query($SQL);
                                $db_field=mysql_fetch_assoc($rs);
                                $cidname=$db_field['Course_Name'];	
			        $mm=$row['max_mark'];	
                                 $pm=$row['pass_mark'];
                                 $c2date=date_create($c2date);
                                 $c2date=date_format($c2date,"d-m-Y"); 	
                                 print "<td>$i</td><td>".$cid."</td><td>".$cidname."</td><td>".$c2date."</td><td>".$mm."</td><td>".$pm."</td></tr>";                   
                                   $i++;
                                     }  
                          }
                 }
                 else if($exam=='modelexam')
                 {
                          $SQL= "select * from  modelexam where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
                          $rp=mysql_query($SQL);
                   
                          $db_field=mysql_fetch_assoc($rp);
                          $d=$db_field['decided'];
                       $SQL="SELECT * FROM modelexam WHERE Batch='$batch' and sem='$sem' and Programme_Name='$dept'  order by ME_Date";
                       $rm=mysql_query($SQL);
                           if (mysql_num_rows($rm)==0 or $d=='y')
                           {
                       print "<center><h1> Time Table is not uploaded </h1></center>";
                       }
                    else
                     {
?>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Course ID
</th>
<th>
   Course Name
</th>
<th>
   Date
</th>
<th>Max Mark
</th>
<th>Pass Mark
</th>
</tr>
<tr>
<?php
                       $i=1;
                       while($row=mysql_fetch_assoc($rm))
                                   {   
                                $ME_Date=$row['ME_Date']; 
                                $cid=$row['CourseID'];
                                $SQL= "select * from subjectdetails where  CourseID='$cid' " ;
                                $rs=mysql_query($SQL);
                                $db_field=mysql_fetch_assoc($rs);
                                $cidname=$db_field['Course_Name'];	
			        $mm=$row['max_mark'];	
                                 $pm=$row['pass_mark'];
                                 $ME_Date=date_create($ME_Date);
                                 $ME_Date=date_format($ME_Date,"d-m-Y"); 	
                                 print "<td>$i</td><td>".$cid."</td><td>".$cidname."</td><td>".$ME_Date."</td><td>".$mm."</td><td>".$pm."</td></tr>";                   
                                   $i++;
                                     }  
                          }
                 }
				 
				 else if($exam=='sem')
                 {
                          $SQL= "select * from  semexam where Batch='$batch' and sem='$sem' and Program_Name='$dept' order by CourseID asc" ;
                          $rp=mysql_query($SQL);
                   
                          $db_field=mysql_fetch_assoc($rp);
                          $d=$db_field['decided'];
                       $SQL="SELECT * FROM semexam WHERE Batch='$batch' and sem='$sem' and Program_Name='$dept'  order by Sem_Date";
                       $rm=mysql_query($SQL);
                           if (mysql_num_rows($rm)==0 or $d=='y')
                           {
                       print "<center><h1> Time Table is not uploaded </h1></center>";
                       }
                    else
                     {
?>
<tr>
<td><center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Course ID
</th>
<th>
   Course Name
</th>
<th>
   Date
</th>
<th>Max Mark
</th>
<th>Pass Mark
</th>
</tr>
<tr>
<?php
                       $i=1;
                       while($row=mysql_fetch_assoc($rm))
                                   {   
                                $Sem_Date=$row['Sem_Date']; 
                                $cid=$row['CourseID'];
                                $SQL= "select * from subjectdetails where  CourseID='$cid' " ;
                                $rs=mysql_query($SQL);
                                $db_field=mysql_fetch_assoc($rs);
                                $cidname=$db_field['Course_Name'];	
			        $mm=$row['max_mark'];	
                                 $pm=$row['pass_mark'];
                                 $Sem_Date=date_create($Sem_Date);
                                 $Sem_Date=date_format($Sem_Date,"d-m-Y"); 	
                                 print "<td>$i</td><td>".$cid."</td><td>".$cidname."</td><td>".$Sem_Date."</td><td>".$mm."</td><td>".$pm."</td></tr>";                   
                                   $i++;
                                     }  
                          }
                 }

              }
			  
?>