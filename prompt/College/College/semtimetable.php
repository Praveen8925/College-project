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
     <td colspan="2" align="Center"><h1>Sem Exam Time Table</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['table']))
    print $_SESSION['table'];
  unset($_SESSION['table']);
?></h3>
   </tr>
<form name="" method="post" action="" >
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
                  }
             $y= date("Y");
            for ($x=2000; $x<=$y; $x++)
                  { 
  	echo "<option value=".$x.">".$x."</option>";
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
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'" ;
               $rs=mysql_query($SQL);  
                    if (mysql_num_rows($rs)==0)
                      {
                        print "<center><h1>No data Found <br><a href='addsubject.php' target='inlineframe'>Add Subject</h1></a><center>";                       }
                    else
                     {
                     $db_field=mysql_fetch_assoc($rs);
                     $d=$db_field['decided'];
                     if($d=='n')
                       {
?>
<form name="modelexamtimetable" method="post" action="SemExamTimeTableSave.php" >
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td>
</tr>
</table>
  </td>
</tr>
<input type="hidden" name="batch" id="batch"  value="<?php print $batch; ?>"  size="30">
<input type="hidden" name="dept" id="dept"  value="<?php print $dept; ?>"  size="30">
<input type="hidden" name="sem" id="sem"  value="<?php print $sem; ?>" size="30">
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
<th>
   Max Mark
</th>
<th>Pass Mark
</th>
</tr>
<tr>
<?php
           $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
               $rs=mysql_query($SQL);
                      $i=1;
    	     while($row=mysql_fetch_assoc($rs))
    	     {
                   $cid=$row["CourseID"];
                  

	     print "<td>$i</td><td>".$row["CourseID"]."";?><input type="hidden" name="sub[]" id="sub[]"  value=<?php print $row["CourseID"]; ?> size="20"><?php    print" </td>";
?>
<?php
                      print "<td>".$row["Course_Name"]."</td><td>";

                      $SQL="SELECT * FROM  semexam WHERE  CourseID='$cid'";
                       $rm=mysql_query($SQL);
                       $decided="";
                       while($row=mysql_fetch_assoc($rm))
                                                  {   
                                                  $Sem_Date=$row['Sem_Date']; 	
						   $mm=$row['max_mark'];	
                                		   $pm=$row['pass_mark'];
                                                    $decided=$row['decided'];
                                                    $Sem_Date=date_create($Sem_Date);
                                                   $Sem_Date=date_format($Sem_Date,"d-m-Y"); 	
                                                    }
                       
                       
                         if($decided=='y' or $decided=="")
                          $d="";
                          else if($decided=='n')
                          $d="readonly"; 
                                    
                                      if(mysql_num_rows($rm)==0)
                                            {
$tdt=date("d-m-Y");
?>
<input type="Text" id="dat[<?php print $i; ?>]" name="dat[<?php print $i; ?>]" maxlength="10" size="10" value="<?php echo $tdt; ?>"  <?php print $d; if($d==""){?> onClick="javascript:NewCssCal('dat[<?php print $i; ?>]','DDMMYYYY')" style="cursor:pointer"  <?php } ?> /></td><td>
<input type="Text" id="mm[]" name="mm[]" onKeyPress="return isNumberKey(event)" maxlength="5" size="5" value="" <?php print $d; ?> /></td><td>
<input type="Text" id="pm[]" name="pm[]" onKeyPress="return isNumberKey(event)" maxlength="5" size="5" value="" <?php print $d; ?> />
<input type="hidden" name="iu[]" id="iu[]"  value="1" size="25">
<?php
                                              }
                                         else
                                              {

                                                
 
?>
<input type="Text" id="dat[<?php print $i; ?>]" name="dat[<?php print $i; ?>]" maxlength="10" size="10" value="<?php echo $Sem_Date; ?>" <?php print $d; if($d==""){ ?> onClick="javascript:NewCssCal('dat[<?php print $i; ?>]','DDMMYYYY')" style="cursor:pointer" <?php } ?> /></td><td>
<input type="Text" id="mm[]" name="mm[]" onKeyPress="return isNumberKey(event)" maxlength="5" size="5" value="<?php print $mm;?>" <?php print $d; ?> /></td><td>
<input type="Text" id="pm[]" name="pm[]" onKeyPress="return isNumberKey(event)" maxlength="5" size="5" value="<?php print $pm;?>" <?php print $d; ?> />
<input type="hidden" name="iu[]" id="iu[]"  value="0" size="25">
<?php
                                               }

 ?>

<?php
                   print "</td></tr>";
                   $i=$i+1;
    	      }
 if($decided=='y' or $decided=="")
  {
   
?>
</tr>
</table>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="yn" name="yn" class="btn" >
<input type="button" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>
<br>
<br>
<tr>
<td colspan="2" >
<input type="Submit" Value="Finalized" id="yn" name="yn" onClick="location.href='ModelExamTimeTableSave.php'" class="bn">

<?php
  }                  }
                     else
                       {
                        print "<tr ><td class='font-stylec'><h1><center>Finalize the subject<a href='finalizedsubject.php'>click</a></center></h1></td></tr>";
                        }
                    }  
  	      }
?>

</form>
</div>
</body>
</html>