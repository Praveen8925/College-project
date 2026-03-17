<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
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
<td colspan="2" align="Center"><h1>Attendance Datewise Report</h1>
</tr>
<form name="form" method="post" action="#" >

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
			  
                             $SQL= "select * from student where RegNo ='$regno' " ;
				$rs=mysql_query($SQL);
				while($row=mysql_fetch_assoc($rs))
   			          {
				$batch=$row["Batch"];   
				$dept=$row["Department"];
   				}
				$reg=$regno;
				
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
<!--<tr>
<td>
<input type="hidden" name="batch" id="batch"  value="<?php print $batch; ?>"  size="30">
<input type="hidden" name="dept" id="dept"  value="<?php print $dept; ?>"  size="30">
<input type="hidden" name="sem" id="sem"  value="<?php print $sem; ?>" size="30">
<input type="hidden" name="fdate" id="fdate"  value="<?php print $fdate; ?>"  size="30">
<input type="hidden" name="tdate" id="tdate"  value="<?php print $tdate; ?>"  size="30">
</td>
</tr>-->
<center>
<?php
        $SQL= "select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem'and Date >= '$fdate' AND Date <= '$tdate'";
		$rs1=mysql_query($SQL);  
        $count=mysql_num_rows($rs1);
		if($count==0)
		{      
	print "<h1>No Data Found</h1>";
		}

		else
		{
$t="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date >= '$fdate' AND Date <= '$tdate'and (Ihour like '%$reg%' or IIhour like '%$reg%' or IIIhour like '%$reg%' or IVhour like '%$reg%' or Vhour like '%$reg%' or VIhour like '%$reg%')";
//print $t;
$r=mysql_query($t);  	
	$num = mysql_num_rows($r);
//echo "<b>Total days : ".$num."</b>";
		
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
   Date
</th>
</tr>




<?php         
        
			$SQL= "select * from student where RegNo='$reg'" ;
			
			
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
		$absent=0;
    	
			
			
           
                                   
								

		 $t1="select * from 2015yearattendance where Batch='$batch' and Course='$dept' and semester='$sem' and Date >= '$fdate' AND Date <= '$tdate' and (Ihour like '%$reg%' or IIhour like '%$reg%' or IIIhour like '%$reg%' or IVhour like '%$reg%' or Vhour like '%$reg%' or VIhour like '%$reg%')";
$r1=mysql_query($t1); 
	while($rows=mysql_fetch_assoc($r1))
	{
		print "<tr><td align='center'>$i</td><td align='center'>".$rows["Date"]."</td>";

	$i++;
		}

		}	 
		
				 
?>

</table>

<?php
//print $len1;
 }
				 
				 
?>

</form>
</div>
</body>
</html>