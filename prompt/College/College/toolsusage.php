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
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h1>Tools Usage</h1>
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
					$dept=$_POST['dept'];
	               
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
<form name="mark" method="post"  action="#"  onSubmit="return a();">
<tr>
<td>
<!--<input type="hidden" name="regno" id="regno"  value="<?php print $staffid; ?>"  size="30">-->
<input type="hidden" name="fdate" id="fdate"  value="<?php print $fdate; ?>"  size="30">
<input type="hidden" name="tdate" id="tdate"  value="<?php print $tdate; ?>"  size="30">
</td>
</tr>
<center>
<?php
        $SQL= "select * from addstaff where Department='$dept'";
		$rs1=mysql_query($SQL);  
        $count=mysql_num_rows($rs1);
		if($count==0)
		{      
	print "<h1>No Data Found</h1>";
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
   ID
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Cholk and Talk
</th>
<th>LCD
</th>
</tr>
<?php
          $i=1;
    	     while($row=mysql_fetch_assoc($rs1))
    	     {
		     $id=$row["SID"];
				$sql="select * from workdiarys where SID='$id' and tool='Cholk and talk'and  Date >= '$fdate' AND Date <= '$tdate'";
				$cholk=mysql_query($sql);	
				$cholkcount=mysql_num_rows($cholk);
				$lcd="select * from workdiarys where SID='$id' and tool='LCD'and  Date >= '$fdate' AND Date <= '$tdate'";
				$LCD=mysql_query($lcd);	
				$lcdcount=mysql_num_rows($LCD);
				 print "<tr><td align='center'>$i</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$cholkcount." hours</td><td>".$lcdcount." hours</td>";
				$i++;
				 }
          }
				 
		
				 
?>

</table>

<?php
 }
?>

</form>
</div>
</body>
</html>