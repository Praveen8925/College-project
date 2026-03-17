<?php
   include_once 'Check.php';
   include_once("Database.php"); 
   if(isset($_GET['action']))
   {
      $operation=$_GET['action'];
      $_SESSION['Operation']=$operation;
    }
    else
      $operation=$_SESSION['Operation'];
      if(isset($_SESSION['sstudid']))
       {
      $cusmob=$_SESSION['sstudid'];
      unset($_SESSION['sstudid']);
       }
      else
      $cusmob=$_GET['id'];
  
   
?>
<!DOCTYPE HTML>
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
     <td colspan="2" align="Center"><h1>ACADEMIC REGISTER</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['mark']))
     print $_SESSION['mark'];
  unset($_SESSION['mark']);
  $regno="$cusmob";
?></h3>
   </tr>
 <form name="markf" method="post" action="#" >
 <tr>
<td>Reg.No</td>
<td><input type="text"name="regno"id="regno"value="<?php print $regno; ?>";></td>
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
     <td colspan="2">
                <center>
                        <input type="Submit" Value="Submit" id="submit" class="bn">
               </center>
    </td>
  </tr>
 </form>
 </table>
 <?php
          if ($_POST) 
                 { 
	               $regno=$_POST['regno'];
                   $sem=$_POST['sem']; 

?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td></tr>
</table>
</td></tr>
<form name="mark" method="post"  action="#"  onSubmit="return a();">
<tr>
<td>
<input type="hidden" name="regno" id="regno"  value="<?php print $regno; ?>"  size="30">
<input type="hidden" name="sem" id="sem"  value="<?php print $sem; ?>" size="30">
</td>
</tr>
<center>
<?php
        $SQL= "select * from student where RegNo='$regno'";
		$rs1=mysql_query($SQL);  
		while($rows=mysql_fetch_assoc($rs1))
		{
			$batch=$rows['Batch'];
			$dept=$rows['Department'];
echo "<b>NAME : ".$rows['Name']."</b>";
		$SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept'  and Type='Theory' order by CourseID asc"  ;
               $rs=mysql_query($SQL); 
               $tcnt=mysql_num_rows($rs);
               $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and Type='Practical' order by CourseID asc" ;
               $rm=mysql_query($SQL);
               $pcnt=mysql_num_rows($rm); 
		$CYC1="select mark from collegedetails.$batch where sem='$sem' and RegNo='$regno' and exam_type='cycletest1'";
		$cyc1=mysql_query($CYC1); 
		$CYC2="select * from collegedetails.$batch where sem='$sem' and RegNo='$regno' and exam_type='cycletest2'";
		$cyc2=mysql_query($CYC2); 
		$MODEL="select * from collegedetails.$batch where sem='$sem' and RegNo='$regno' and exam_type='modelexam'";
		$model=mysql_query($MODEL);
		$SEM="select * from collegedetails.$batch where sem='$sem' and RegNo='$regno' and exam_type='semexam'";
		$sem=mysql_query($SEM);
		}
?>
</center>
<tr>
     <td><center>
     <table width="80%" border="1">
  <tr>
<th>
   SUBJECT
</th>
 <th>
   CYCLE-I
</th>
<th>
  CYCLE-II
</th>
<th>
  MODEL
</th>

<th>
  SEMESTER
</th>

<?php
$i=0;
while($row1=mysql_fetch_assoc($cyc1))
{
$i=0;
	$mar=$row1['mark'];
	$mar=explode("-",$mar);
	$len=sizeof($mar);

while($row2=mysql_fetch_assoc($cyc2))
{
$i=0;
	$mars=$row2['mark'];
	$mars=explode("-",$mars);
	$lens=sizeof($mars);	
	
	
while($row3=mysql_fetch_assoc($model))
{
$i=0;
	$marks=$row3['mark'];
	$marks=explode("-",$marks);
	$lens=sizeof($marks);	
	
while($row4=mysql_fetch_assoc($sem))
{
$i=0;
	$marks1=$row4['mark'];
	$marks1=explode("-",$marks1);
	$lens=sizeof($marks1);	

               while($row=mysql_fetch_assoc($rs))
    	            {
						
                  $cid[$i]=$row["CourseID"];
                  $cname[$i]=$row["Course_Name"];
					
                   print "<tr><td>".$row["Course_Name"]."</td><td>".$mar[$i]."</td><td>".$mars[$i]."</td><td>".$marks[$i]."</td><td>".$marks1[$i]."</td>";
                   $i++;
                    }
                   while($row=mysql_fetch_assoc($rm))
    	            {
                  $cid[$i]=$row["CourseID"];
                   $cname[$i]=$row["Course_Name"];
				  
                   print "<tr><td>".$row["Course_Name"]."</td><td>".$mar[$i]."</td><td>".$mars[$i]."</td><td>".$marks[$i]."</td><td>".$marks1[$i]."</td>";
                   $i++;
				  
					}
					
}
}
	}
				 	
}	
		
?>
<?php
				 }
				 ?>
</form>
</div>
</body>
</html>