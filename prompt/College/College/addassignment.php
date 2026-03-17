<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>

</head>
<body>
<form name="form" method="post" action="#" enctype="multipart/form-data">
<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>Assignment</h1>
</tr>

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
						   $batch=$_POST['batch'];
						   $dept=$_POST['dept'];
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'and Type='Theory' order by CourseID asc" ;
                       $rs=mysql_query($SQL);
                        $t=mysql_num_rows($rs);
                        
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
                       $rm=mysql_query($SQL);
                          $p=mysql_num_rows($rm);   
                      
                      $i=0;
                      if (mysql_num_rows($rs)==0 && mysql_num_rows($rm) )
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
                              echo "<option value=".$row["CourseID"].">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
                               $i++;
      	             }
                 while($row=mysql_fetch_assoc($rm))
    	            {
                            echo "<option value=".$row["CourseID"].">".$row["CourseID"]."-".$row["Course_Name"]."</option>";
                               $i++;
      	         }
                            
                                

?>
          </select>  
     </td>
 </tr>
 <tr>
 <td>Topic</td>
 <td><input type="text"name="topic";></td>
 </tr>
 <tr>
      <td>Assignment No</td>
      <td><select name="number" id="number" onchange="submitsem();">
<?php
      if(isset($_POST['number']))
      {
?>
<option value="<?php print $_POST['number']; ?>"><?php print $_POST['number']; ?></option>
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
 <td>Assignment</td>
 <td><input type="file"name="question"value="choose file";></td>
 </tr>
 <?php
 $sdate=date("d-m-Y");
 ?>
 
 <tr>
<td>Date</td>
<td>
<?php
    $sdate=date_create($sdate);
    $sdate=date_format($sdate,"d-m-Y");
$dob;
?>
<input type="text" name="sdt" id="sdt" maxlength="20" size="20" value="<?php echo $sdate; ?>" readonly />
</td>
</tr>
 <tr>
<td>LastDate</td>
<td>
<?php
  $tdt=date("d-m-Y");

             if(isset($_POST['atdate']))
                {
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php print $_POST['atdate']; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
                 }
               else
                {
           
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
				}
?>
</td>
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
					   
					   
					   
		$batch = $_POST["batch"];			   
        $tb=$batch.'assignmentquestion'; 
        $check="CREATE TABLE IF NOT EXISTS $tb (Batch INT(5),Dept VARCHAR(20),semester INT(2),Course VARCHAR(20),topic VARCHAR(100),question VARCHAR(100),sdate DATE,ldate DATE)";
		$data=mysql_query($check);        
$batch = $_POST["batch"];

$sdate=date("d-m-Y");
$sdate=date_create($sdate);
		$sdate=date_format($sdate,"Y-m-d");
$dt=$_POST['atdate'];
$dt=date_create($dt);
		$dt=date_format($dt,"Y-m-d");
 	 $topic = $_POST["topic"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $anumber=$_POST["number"];
 $subject = $_POST["cid"]; 
$question=$_POST["question"];
if(isset($_FILES['question']))
  {
      $file_name = $_FILES['question']['name'];
      $file_size = $_FILES['question']['size'];
      $file_tmp = $_FILES['question']['tmp_name'];
      $file_type = $_FILES['question']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['question']['name'])));
      $expensions= array("jpeg","jpg","png","ppt","pptx","doc","docx","txt");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 200097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $question="upload/".$file_name;
	    rename("upload/".$file_name,$question);
      }
   } 
$tb=$batch.'assignmentquestion';
$SQL = "INSERT into $tb values('$batch','$dept','$sem','$subject','$topic','$question','$anumber','$sdate','$dt')";
//print $SQL;       
$result = mysql_query($SQL);
 $_SESSION['addassignment'] = "Record Saved Successfully";    
header("location: addassignment.php");

					   
				 }
                  
?>

</tr>
</table>
<?php


                      }        
            
             
?>


													
</div>
</body>
</html>