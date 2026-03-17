<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="JS/Index.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script src="JS/datetimepicker_css.js"></script>
<link href="css/web.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="allblur">
<table cellspacing="10" class="table-stylec" width="100%">
<tr>
<td>
<form action="" method="post" onsubmit="">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Staffwise Leave Report</td>
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
</td>
</tr>
<tr>
<td>
Staff ID
</td>
<td>
<select name="Staffid" id="Staffid">
<?php
  $tdt=date("d-m-Y");

             if(isset($_POST['Staffid']))
                {
?>
       <option value="<?php print $_POST['Staffid']; ?>"><?php print $_POST['Staffid']; ?></option>
              
<?php
            }
    $rs=mysql_query("select * from  addstaff");
    while($row=mysql_fetch_assoc($rs))
    {
	print "<option values=$row[SID]>$row[SID]</option>";
    }
?>
</select>
</td>
</tr>
<tr>
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</table>
</td>
</tr>
<tr>
<td>
<center>
<?php
     if ($_POST) 
        { 
           $fdate=$_POST['fdate'];
           $tdate=$_POST['tdate'];
           $Staffid=$_POST['Staffid'];
           

           $_SESSION['$wdfdate'] = $fdate;
	   $_SESSION['$wdtdate'] =$tdate;  
      
    $SQL= "select * from addstaff where SID='$Staffid'" ;
    $rs=mysql_query($SQL);  
      while($row=mysql_fetch_assoc($rs))
        {
         $name=$row["Name"];
         $sid=$row["SID"];
         }
              $fdate=date_create($fdate);
              $fdate=date_format($fdate,"y-m-d");
           
             $tdate=date_create($tdate);
             $tdate=date_format($tdate,"y-m-d");
               $SQL= "select * from workdiarys where SID='$sid' AND DATE >= '$fdate' AND DATE <= '$tdate'  and Remark='CL'  ORDER BY DATE ASC,Hour ASC" ;
               $rs=mysql_query($SQL);
                if(mysql_num_rows($rs)==0)
                  {
                   print "<center><h1>No Leave Availed</h1></center>";
                  }
                else
                  {
    
?>
</center>
</td>
</tr>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"><?php print "$sid <br> $name <br> Leave Report $fdate\t\t"."to"."\t\t$tdate"; ?></td>
</tr>
</table>
<table width="80%" border="1" align="center">
<tr>
<th>
   SI.No
</th>
<th>
   Date
</th>
<th>
   Day Order
</th>
<th>
   Session
</th>
<th>
   Reason
</th>
</tr>
<?php
                
                   $i=1;
    	        while($row=mysql_fetch_assoc($rs))
    	                  {
			    $date=$row["DATE"];
                           $date=date_create($date);
                           $date=date_format($date,"d-m-y"); 
                  print "<tr><td>$i</td><td>".$date."</td><td align='center'>".$row["DayOrder"]."</td><td>".$row["session"]."</td><td>".$row["reason"]."</td></tr>";                       
                 $i=$i+1;
    	                   }
                   }
?>
</tr>
</table>
<?php
}
?>
</tr>
</table>
</div>
</body>
</html>