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
<td colspan="2" align="Center"><h1>Submit Assignment</h1>
</tr>
<form name="form" method="post" action="#" enctype="multipart/form-data" >
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
									
									$number=$_POST['number'];
                               $table=$batch.'assignmentquestion';
                           $sem=$_POST['sem'];
                       $SQL= "select * from $table where Batch='$batch' and semester='$sem' and Dept='$dept'and anumber='$number'" ;
                       $rs=mysql_query($SQL);
                        $t=mysql_num_rows($rs);
                                             
                      $i=0;
                      if (mysql_num_rows($rs)==0)
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
						$c=$row["Course"];
						
					$sqls="select * from subjectdetails where CourseID='$c'";
					$ret=mysql_query($sqls);
					while($rows=mysql_fetch_assoc($ret))
						{

						echo "<option value=".$row["Course"].">".$row["Course"]."-".$rows["Course_Name"]."</option>";
                               $i++;
      	             }
                 
					}     
                                

?>
          </select>  
     </td>
 </tr>
 <tr>
 <td>Assignment</td>
 <td><input type="file"name="assignment"value="choose file";></td>
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
                             
                              $cid=$_POST['cid'];
                   if(isset($_POST['cid']))
                     { 
                       $cidv=$_POST['cid'];
                       
                      }
					  $subject=$_POST['cid'];
                            
                              
                           $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);

                      
                       $sem=$_POST['sem'];
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rs); 
                       $type=$db_field['Type'];
                       $cname=$db_field['Course_Name'];
                       
                          
                       
                                    
					   
        $tb=$batch.'studassignmentreport'; 
        $check="CREATE TABLE IF NOT EXISTS $tb (Regno VARCHAR(20),Batch INT(5),Dept VARCHAR(20),semester INT(2),Course VARCHAR(20),number INT(10),assignment VARCHAR(100),sdate DATE,review VARCHAR(100),mark INT(10))";
		$data=mysql_query($check);


		
$sdate=date("d-m-Y");
$sdate=date_create($sdate);
$sdate=date_format($sdate,"Y-m-d");


 $subject = $_POST['cid']; 
 $number=$_POST["number"];
$assignment=$_POST["assignment"];

if(isset($_FILES['assignment']))
  {
      $file_name = $_FILES['assignment']['name'];
      $file_size = $_FILES['assignment']['size'];
      $file_tmp = $_FILES['assignment']['tmp_name'];
      $file_type = $_FILES['assignment']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['assignment']['name'])));
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
		  
          move_uploaded_file($file_tmp,"assignment/".$file_name);
          $assignment="assignment/".$file_name;
		 
		  
	    rename("assignment/".$file_name,$assignment);
      }
   } 
$tb=$batch.'studassignmentreport'; 
$SQL = "INSERT into $tb values('$reg','$batch','$dept','$sem','$subject','$number','$assignment','$sdate')";
$result = mysql_query($SQL);
 $_SESSION['submitassignment'] = "Record Saved Successfully";    
header("location: submitassignment.php");


	print $assignments;
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