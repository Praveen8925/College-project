<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
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
     <td colspan="2" align="Center"><h1> ASSIGNMENT MARK</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['ass']))
     print $_SESSION['ass'];
  unset($_SESSION['ass']);
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
             for ($x=1; $x<=10; $x++)
                {
              echo "<option value=".$x.">".$x."</option>";
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
  </td>
  </tr>
<?php
          if ($_POST) 
                 { 
	               $batch=$_POST['batch'];
                       $tn=$batch.'assignment';
                       $dept=$_POST['dept']; 
                       $sem=$_POST['sem'];
                 $SQL= "select * from classincharge where Batch='$batch' and  Department='$dept' and sem='$sem' and SID='$userid'" ;
		   $rs=mysql_query($SQL);
		   if (mysql_num_rows($rs)==1)
		    {
                 $SQL= "select * from student where Batch='$batch' and  Department='$dept' and status<>'discontinue'" ;
                 $rm=mysql_query($SQL);  
                 $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Theory' order by CourseID asc;" ;
                 $rs=mysql_query($SQL);  
                 $cnt=mysql_num_rows($rs);
                    if (mysql_num_rows($rs)==0 or mysql_num_rows($rm)==0)
                      {
                       print "<center><h1>No data found</h1></center>";
                       }
                    else
                     {
                     $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
                    $rp=mysql_query($SQL);  
                      $db_field=mysql_fetch_assoc($rp);
                     $d=$db_field['decided'];
                     if($d=='n')
                       {
                     
?>
<form name="assiment" method="post" action="assimentSave.php" >
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td></tr>
</table>
</td></tr>
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
   Reg No
</th>
<th>
  Name
</th>
<?php
                   $i=1;
    	          while($row=mysql_fetch_assoc($rs))
    	             {
                               print "<th>".$row["Course_Name"]."</th>";
                               $i=$i+1;
    	              }
?>
</tr>
<tr>
<?php
                $_SESSION['cnt']=$cnt;$cntd=0;
                $SQL= "select * from student where Batch='$batch' and  Department='$dept' and status<>'discontinue' order by RegNo asc" ;
                $rs=mysql_query($SQL);  
                            
                                $i=1;
    	               while($row=mysql_fetch_assoc($rs))
    	                 {
                                   $reg=$row["RegNo"];
	                  print "<td>$i</td><td>".$row["RegNo"]."";?><input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30"><?php  print "</td><td>".$row["Name"]."</td>"; 
                                   $SQL="SELECT * FROM $tn WHERE Batch='$batch' and RegNo='$reg' and sem='$sem'";
                                   $rm=mysql_query($SQL);
                                                $decided="";
                                             while($row=mysql_fetch_assoc($rm))
                                                  {   
                                                  $amark=$row["ass_mark"];
                                                   $decided=$row['decided'];
                                                    }
                                                   if($decided=='y' or $decided=="")
                                                   $d="";
                                                   else if($decided=='n')
                                                    {
                                                   $d="readonly";$cntd++;
                                                      }     
                                                if(mysql_num_rows($rm)==0)
                                            {

?>
<input type="hidden" name="iu[]" id="iu[]"  value="1" size="25">
<?php
                                              }
                                         else
                                              {
?>
<input type="hidden" name="iu[]" id="iu[]"  value="0" size="25">
<?php
                                               } 
                                               for($j=1;$j<=$cnt;$j++)
                                                    {  
                                                        if(mysql_num_rows($rm)==0)
                                                             {
                                                                  
 ?>
<td><input type="text" name="mark[<?php print $i;?>][<?php print $j;?>]" id="mark[<?php print $i;?>][<?php print $j;?>]" size="3" <?php print $d; ?> onKeyPress="return isNumberKey(event)"  maxlength="2"></td>
<?php
                                                                }
                                                          else
                                                                {
                                                                     
                                                                    $mar = explode("-",$amark); 
                                                                    
 ?>
<td><input type="text" name="mark[<?php print $i;?>][<?php print $j;?>]" id="mark[<?php print $i;?>][<?php print $j;?>]" size="3" <?php print $d; ?> onKeyPress="return isNumberKey(event)"  maxlength="2" value="<?php print $mar[$j-1];?>" ></td>
<?php
                                                                    }
                                                           }
                                                    
                       print "</tr>";
                       $i++;
                                         } 
if($cntd>0)
      $decided="n" ; 
 if($decided=='y' or $decided=="")
  {                
                                     
?>
</table>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit"  id="submit"  id="yn" name="yn" class="btn">
<input type="reset" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>
<br>
<br>
<tr>
<td colspan="2" >
<input type="Submit" Value="Finalized" id="yn" name="yn" onClick="location.href='markSave.php'" class="bn">
</td>
</tr>
<?php
  }
                     }
                     else
                       {
                        print "<tr ><td class='font-stylec'><h1><center>Finalize the subject<a href='finalizedsubject.php'>click</a></center></h1></td></tr>";
                        }
           
                     }


                      }
                     else
                       {
                        print "<tr ><td class='font-stylec'><h1><center>Your Not Class Incharge for this Class</center></h1></td></tr>";
                        }           
           }
?>

</form>
</div>
</body>
</html>