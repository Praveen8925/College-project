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
<tr class="tableth"><td colspan="2" align="center">Class Adjustment Report</td>
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
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</table>
</td>
</tr>
<?php
     if ($_POST) 
        { 
           $fdate=$_POST['fdate'];
           $tdate=$_POST['tdate'];
           $Staffid=$userid;
           

           $_SESSION['$wdfdate'] = $fdate;
	   $_SESSION['$wdtdate'] =$tdate;  
      
    $SQL= "select * from addstaff where SID='$Staffid'" ;
    $rs=mysql_query($SQL);  
      while($row=mysql_fetch_assoc($rs))
        {
         $name=$row["Name"];
         $sid=$row["SID"];
         }
   
    
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"><?php print "$sid <br> $name <br> Work Diary Report $fdate\t\t"."to"."\t\t$tdate"; ?></td>
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
   Class Affected
</th>
<th>
   Hour
</th>
<th>
  Alternate Staff
</th>

</tr>
<?php
               $fdate=date_create($fdate);
              $fdate=date_format($fdate,"y-m-d");
           
             $tdate=date_create($tdate);
             $tdate=date_format($tdate,"y-m-d");
               $SQL= "select * from workdiarys where Asid='$sid' AND DATE >= '$fdate' AND DATE <= '$tdate' and Asid <> ''  ORDER BY DATE ASC,Hour ASC" ;
               $rs=mysql_query($SQL);  
                   $i=1;
    	        while($row=mysql_fetch_assoc($rs))
    	                  {
                             $asid= $row["SID"];
			    $date=$row["DATE"];
                           $date=date_create($date);
                           $date=date_format($date,"d-m-y");
                            
                  print "<td>$i</td><td>".$date."</td><td align='center'>".$row["DayOrder"]."</td><td>".$row["Class"]."</td><td align='center'>".$row["Hour"]."</td>";
                 
                        
                                                
                          $SQL= "select * from addstaff where SID='$asid'" ;
                        $rm=mysql_query($SQL);  
                        while($r=mysql_fetch_assoc($rm))
                          {
                        $name=$r["Name"];
                        $sid=$r["SID"];
                          }
                          print "<td>Adjustment by<br>".$name."<br>(".$sid.")</td></tr>";
                          
                     $i=$i+1;
    	                   }
?>

</table>
<?php
}
?>
</tr>
</table>
</div>
</body>
</html>