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
<tr class="tableth"><td colspan="2" align="center">Work Diary Report</td>
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
<td>Class</td>
<td><select name="cls" id="cls">
<?php
  
              if(isset($_POST['cls']))
                  {
?>
                  <option value="<?php print $_POST['cls']; ?>"><?php print $_POST['cls']; ?></option>
                 
<?php
                  }
?>
<option values="I">I</option>
<option values="II">II</option>
<option values="III">III</option>

</select>
<select name="dept" id="dept">
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
</select> 
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
           $cls=$_POST['cls'];
           $dept=$_POST['dept'];
           $class=$cls."-".$dept; 

           $_SESSION['$wdfdate'] = $fdate;
	   $_SESSION['$wdtdate'] =$tdate;  
    
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"><?php print "$class <br> Work Diary Report $fdate\t\t"."to"."\t\t$tdate"; ?></td>
</tr>
</table>
<table width="80%" border="1" align="center">
<tr>
<th>
   SI.No
</th>
<th>
   SID 
</th>
<th>
   Name 
</th>
<th>
   Date
</th>
<th>
   Day Order
</th>
<th>
   Hour
</th>
<th>
  Subject
</th>
<th>
  Topic
</th>
<th>
  Remark
</th>
</tr>
<?php
               $fdate=date_create($fdate);
              $fdate=date_format($fdate,"y-m-d");
             $tdate=date_create($tdate);
             $tdate=date_format($tdate,"y-m-d");
               $SQL= "select * from workdiarys where Class='$class' AND DATE >= '$fdate' AND DATE <= '$tdate'  ORDER BY DATE ASC,Hour ASC" ;
               $rs=mysql_query($SQL);  
                   $i=1;
    	        while($row=mysql_fetch_assoc($rs))
    	                  {
                          $sid1=$row['SID'];
                         $SQL= "select * from addstaff where SID='$sid1'" ;
                        $rm=mysql_query($SQL);  
                        while($r=mysql_fetch_assoc($rm))
                          {
                        $name=$r["Name"];
                        $sid=$r["SID"];
                          }
                            
			    $date=$row["DATE"];
                           $date=date_create($date);
                           $date=date_format($date,"d-m-Y"); 
                 print "<tr><td>$i</td><td>".$sid."</td><td>".$name."</td><td>".$date."</td><td align='center'>".$row["DayOrder"]."</td><td align='center'>".$row["Hour"]."</td>";
                 $sub=$row["subject"];
                 $SQL= "select * from  subjectdetails where trim(CourseID)='$sub'" ;
                 $rm=mysql_query($SQL);
                  if(($r=mysql_num_rows($rm))>0)
                    {
                     $r=mysql_fetch_assoc($rm);
                     print "<td>".$r["Course_Name"]."</td>";
                     }
                   else
                       print  "<td>".$sub."</td>";
                       print "<td>".$row["Topic"]."</td>";
                       $asid= $row["Asid"];
                       $remark=$row["Remark"];
                       if($remark == "OD" or $remark == "CL")
                         {
                          $SQL= "select * from addstaff where SID='$asid'" ; 
                        $rm=mysql_query($SQL);  
                        while($r=mysql_fetch_assoc($rm))
                          {
                        $name=$r["Name"];
                        $sid=$r["SID"];
                          }
                          print "<td>Adjustment by<br>".$name."<br>(".$sid.")</td>";
                          }
                         else
                       print "<td>".$row["Remark"]."</td>";
                 $i=$i+1;
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