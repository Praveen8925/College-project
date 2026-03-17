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
     <td colspan="2" align="Center"><h1>Class Attendance Report</h1>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['mark']))
     print $_SESSION['mark'];
  unset($_SESSION['mark']);
?></h3>
   </tr>
<form name="markf" method="post" action="#" >
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
<td>Date From</td>
<td><?php
  $tdt=date("d-m-Y");

             if(isset($_POST['fdate']))
                {
?>
<input type="Text" id="fdate" name="fdate" maxlength="20" size="20" value="<?php print $_POST['fdate']; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>To
<?php
                 }
               else
                {
           
?>
<input type="Text" id="fdate" name="fdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>To
<?php
                }
              if(isset($_POST['tdate']))
                  {
?>
<input type="Text" id="tdate" name="tdate" maxlength="20" size="20" value="<?php print $_POST['tdate']; ?>" onClick="javascript:NewCssCal('tdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
                 }
               else
                {
?>
<input type="Text" id="tdate" name="tdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('tdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
                }
?>
</td></tr>
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
                   $fdate=$_POST['fdate']; 
				   $fdate=date_create($fdate);
                   $fdate=date_format($fdate,"Y-m-d");
				   $tdate=$_POST['tdate'];
				   $tdate=date_create($tdate);
                   $tdate=date_format($tdate,"Y-m-d");
				   
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td></tr>
</table>
</td></tr>
<form name="mark" method="post"  action="ClassAttendanceSave.php"  onSubmit="return a();">
<tr>
<td>
<input type="hidden" name="batch" id="batch"  value="<?php print $batch; ?>"  size="30">
<input type="hidden" name="dept" id="dept"  value="<?php print $dept; ?>"  size="30">
<input type="hidden" name="sem" id="sem"  value="<?php print $sem; ?>" size="30">
<input type="hidden" name="fdate" id="fdate"  value="<?php print $fdate; ?>"  size="30">
<input type="hidden" name="tdate" id="tdate"  value="<?php print $tdate; ?>"  size="30">
</td>
</tr>
<center>
<?php
        $SQL= "select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem'";
		$rs1=mysql_query($SQL);  
        $count=mysql_num_rows($rs1);
		if($count==0)
		{      
	print "<h1>No Data Found</h1>";
		}
		else
		{
$t="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date >= '$fdate' AND Date <= '$tdate'";
//print $t;
$r=mysql_query($t);  	
	$num = mysql_num_rows($r);
echo "<b>Total days : ".$num."</b>";
		
?>
</center>
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
Present Days
</th>
<th>
Absent Days
</th>
<th>
Percentage
</th>


<?php         
        
			$SQL= "select * from student where Batch='$batch' and  Department='$dept' order by RegNo asc" ;
        $rs=mysql_query($SQL); 
		$stcnt=mysql_num_rows($rs);
        $i=1;
		$k1=0;
		$k2=0;
		$k3=0;
		$k4=0;
		$k5=0;
		$k6=0;
		$a=0;
		$absc=0;
    	while($row=mysql_fetch_assoc($rs))
    	{
			
			
            $reg=$row["RegNo"];
	        print "<tr><td>$i</td><td>".$row["RegNo"]."</td>";
			$i++;
?>


<input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30">
<?php 
                                    print "</td><td>".$row["Name"].""; 
								
									
		$SQL= "select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date >= '$fdate' and Date <= '$tdate'";
        
		$rss=mysql_query($SQL);
		
		while($rows=mysql_fetch_assoc($rss))
		{
			$hri=$rows["Ihour"];
			$hrii=$rows["IIhour"];
		$hriii=$rows["IIIhour"];
		$hriv=$rows["IVhour"];
		$hrv=$rows["Vhour"];
		$hrvi=$rows["VIhour"];
		$hri=explode("-",$hri);
		$len1=sizeof($hri);
		$hrii=explode("-",$hrii);
		$len2=sizeof($hrii);
		$hriii=explode("-",$hriii);
		$len3=sizeof($hriii);
		$hriv=explode("-",$hriv);
		$len4=sizeof($hriv);
		$hrv=explode("-",$hrv);
		$len5=sizeof($hrv);
		$hrvi=explode("-",$hrvi);
		$len6=sizeof($hrvi);
		$n=mysql_num_rows($rs);
		$pan=0;
		$pfn=0;
		
		
	if($hri[$k1]==$reg  || $hrii[$k1]==$reg ||  $hriii[$k1]==$reg)
		{
				$absc=0;
				
				$p=0;
				$ab=$num-$p;
				$attmark=($p*100)/$num;
				print "<td>".$p."</td>";
				 print "<td>".$ab."</td>";
				 print "<td>".$attmark."</td>";
				 
											   
			}
			else
			{
				
			 $pfn=0.5;
			}
			
			if($hriv[$k1]==$reg  || $hrv[$k1]!=$reg  && $hrvi[$k1]!=$reg)
			{
				$absc=0;
				
				$ab=$num-$p;
				$attmark=($p*100)/$num;
                 print "<td>".$p."</td>";
				 print "<td>".$ab."</td>";
				 print "<td>".$attmark."</td>";
				 

			}
			else
			{
				
				 $pan=0.5;
			}
			$present=$pfn+$pan;
			$abscent=$present-$num;
			$percent=($present/$num)*100;
			print "<td>".$percent."</td>";
		
		
			
			 
			
			
		}
		 
		}		
		}
				 
		
				 
?>

</table>

<?php
print $len1;
 }
?>

</form>
</div>
</body>
</html>