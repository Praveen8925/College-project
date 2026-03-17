<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
?>
<?xml version="1.0" encoding="UTF-8"?> 
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>

<script language="javascript" type="text/javascript">
	function display()
   {
    var fn=document.getElementsByName("fn[]");
	var an=document.getElementsByName("an[]");
	var Ihour=document.getElementsByName("Ihour[]");
	var IIhour=document.getElementsByName("IIhour[]");
	var IIIhour=document.getElementsByName("IIIhour[]");
	var IVhour=document.getElementsByName("IVhour[]");
	var Vhour=document.getElementsByName("Vhour[]");
	var VIhour=document.getElementsByName("VIhour[]");
	var len=fn.length;
	for(var i=0;i<len;i++)
	{
		if(fn[i].value=="AB")
		{
			if((IIhour[i].value==Ihour[i].value) && (IIhour[i].value==IIIhour[i].value) && (Ihour[i].value==IIIhour[i].value))
			{
			   Ihour[i].value=fn[i].value;
			   IIhour[i].value=fn[i].value;
			   IIIhour[i].value=fn[i].value;
			}
			else
			{
			   Ihour[i].value=Ihour[i].value;
			   IIhour[i].value=IIhour[i].value;
			   IIIhour[i].value=IIIhour[i].value;
			}
        }
		else
		{
			if((IIhour[i].value==Ihour[i].value) && (IIhour[i].value==IIIhour[i].value) && (Ihour[i].value==IIIhour[i].value))
			{
			   Ihour[i].value=fn[i].value;
			   IIhour[i].value=fn[i].value;
			   IIIhour[i].value=fn[i].value;
			}
			else
			{
			   Ihour[i].value=Ihour[i].value;
			   IIhour[i].value=IIhour[i].value;
			   IIIhour[i].value=IIIhour[i].value;
			}
        }
	if(an[i].value=="AB")
		{
			if((Vhour[i].value==IVhour[i].value) && (Vhour[i].value==VIhour[i].value) && (IVhour[i].value==VIhour[i].value))
			{
			   IVhour[i].value=an[i].value;
			   Vhour[i].value=an[i].value;
			   VIhour[i].value=an[i].value;
			}
			else
			{
			   IVhour[i].value=IVhour[i].value;
			   Vhour[i].value=Vhour[i].value;
			   VIhour[i].value=VIhour[i].value;
			}
        }
		else
		{
			if((Vhour[i].value==IVhour[i].value) && (Vhour[i].value==VIhour[i].value) && (IVhour[i].value==VIhour[i].value))
			{
			   IVhour[i].value=an[i].value;
			   Vhour[i].value=an[i].value;
			   VIhour[i].value=an[i].value;
			}
			else
			{
				IVhour[i].value=IVhour[i].value;
			   Vhour[i].value=Vhour[i].value;
			   VIhour[i].value=VIhour[i].value;
			}
        }
		
	}
    }
	</script>

</head>


<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h1>ATTENDANCE</h1>
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
             for ($x=1; $x<=6; $x++)
                {
              echo "<option value=".$x.">".$x."</option>";
                 }
?>
          </select>  
     </td>
 </tr>
<tr>
<td>Date</td>
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
  </td>
  </tr>
<?php
          if ($_POST) 
                 { 
	               $batch=$_POST['batch'];
                   $dept=$_POST['dept']; 
                   $sem=$_POST['sem']; 
                   $dt=$_POST['atdate'];
					$tb=$batch.'yearattendance';
					$SQL= "select * from classincharge where Batch='$batch' and  Department='$dept' and sem='$sem' and SID='$userid'" ;
		   $rs=mysql_query($SQL);
		   if (mysql_num_rows($rs)==1)
		    {
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
<input type="hidden" name="atdate" id="icmdate"  value="<?php print $dt; ?>"  size="30">

</td>
</tr>
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
 FN
</th>
<th>
 AN
</th>
<th>   </th>
<th>
  I hour
</th>

<th>
  II hour
</th>
<th>
  III hour
</th>
<th>
  IV hour
</th>
<th>
  V hour
</th>
<th>
  VI hour
</th>


<?php                
		$dt=date_create($dt);
		$dt=date_format($dt,"Y-m-d");
		$check="CREATE TABLE IF NOT EXISTS $tb (Batch INT(5),Course VARCHAR(20),semester INT(2),Date DATE,Ihour BLOB,IIhour BLOB,IIIhour BLOB,IVhour BLOB,Vhour BLOB,VIhour BLOB)";
		$data=mysql_query($check);
		/*if($data!==FALSE)
		{*/
		$SQL= "select * from $tb where Date='$dt' and Batch='$batch' and Course='$dept' and semester='$sem'";
		$rs=mysql_query($SQL);  
        $count=mysql_num_rows($rs);
		if($count==0)
		{
?>


  


<?php			
			
			
			
			
		$SQL= "select * from student where Batch='$batch' and  Department='$dept' and status<>'discontinue' order by RegNo asc" ;
        $rs=mysql_query($SQL);  
        $i=1;
    	while($row=mysql_fetch_assoc($rs))
    	{
			
            $reg=$row["RegNo"];
	        print "<tr><td>$i</td><td>".$row["RegNo"]."";
			$i++;
?>


<input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30">
<?php 





                                    print "</td><td>".$row["Name"]."</td>"; 
									
									
									print '<td>
												<select  name="fn[]" id="fn[]" onChange="display()">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									
									print '<td>
												<select name="an[]" id="an[]" onChange="display()">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td><td></td>';
									
									print '<td>
												<select name="Ihour[]" >
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									print '<td>
												<select name="IIhour[]">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									print '<td>
												<select name="IIIhour[]">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
										        </select>
											</td>';
									print '<td>
												<select name="IVhour[]">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									print '<td>
												<select name="Vhour[]">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									print '<td>
												<select name="VIhour[]">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									
		}
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
<?php
		
		}
		
		
		else
		{
			
			
			?>


  


<?php			
			
			
			
			
			
			
			
			
			$SQL= "select * from student where Batch='$batch' and  Department='$dept' and status<>'discontinue' order by RegNo asc" ;
        $rs=mysql_query($SQL); 
		$stcnt=mysql_num_rows($rs);
        $i=1;
		$k1=0;
		$k2=0;
		$k3=0;
		$k4=0;
		$k5=0;
		$k6=0;
    	while($row=mysql_fetch_assoc($rs))
    	{
			
            $reg=$row["RegNo"];
	        print "<tr><td>$i</td><td>".$row["RegNo"]."";
			$i++;
?>


<input type="hidden" name="regno[]" id="regno[]"  value="<?php print $row["RegNo"]; ?>"  size="30">
<?php 
                                    print "</td><td>".$row["Name"]."</td>"; 
									
		$SQL= "select * from $tb where Batch='$batch' and Course='$dept' and Date='$dt' and semester='$sem'";
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
		
		print "<td></td>";
		print "<td></td>";
		print "<td></td>";
									/*		print '<td>
												<select  name="fn[]" id="fn[]" onChange="display()">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td>';
									
									print '<td>
												<select name="an[]" id="an[]" onChange="display()">
												<option value="PR">PR</option>
												<option value="AB">AB</option>
												</select>
											</td><td></td>';*/
		
		if($k1<$len1 && $hri[$k1]==$reg)
			{
				print '<td>
					<select name="Ihour[]" style="color:red">
						<option value="AB" >AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k1=$k1+1;
			}
			else
				print '<td>
						<select name="Ihour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';	
		if($k2<$len2 && $hrii[$k2]==$reg)
			{
				print '<td>
					<select name="IIhour[]" style="color:red">
						<option value="AB">AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k2=$k2+1;
			}
			else
				print '<td>
						<select name="IIhour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';
		if($k3<$len3 && $hriii[$k3]==$reg)
			{
				print '<td>
					<select name="IIIhour[]" style="color:red">
						<option value="AB">AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k3=$k3+1;
			}
			else
				print '<td>
						<select name="IIIhour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';
		if($k4<$len4 && $hriv[$k4]==$reg)
			{
				print '<td>
					<select name="IVhour[]" style="color:red">
						<option value="AB">AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k4=$k4+1;
			}
			else
				print '<td>
						<select name="IVhour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';
		if($k5<$len5 && $hrv[$k5]==$reg)
			{
				print '<td>
					<select name="Vhour[]" style="color:red">
						<option value="AB">AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k5=$k5+1;
			}
			else
				print '<td>
						<select name="Vhour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';
		if($k6<$len6 && $hrvi[$k6]==$reg)
			{
				print '<td>
					<select name="VIhour[]" style="color:red">
						<option value="AB">AB</option>
						<option value="PR">PR</option>
					</select>
					</td>';
					$k6=$k6+1;
			}
			else
				print '<td>
						<select name="VIhour[]">
						<option value="PR">PR</option>
						<option value="AB">AB</option>
						</select>
						</td>';
		}
		}
		
		
		
				
?>

</table>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Update"  id="submit"  id="yn" name="yn" class="btn">
<input type="reset" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>
<?php
		}
		?>
<?php
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