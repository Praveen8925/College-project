<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
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

<form action="#" method="post" onsubmit="">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Student Achievement   Report</td>
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
<td>Achivement</td>
<td><select name="studachive" id="studachive">
<?php
             if(isset($_POST['studachive']))
                {
?>
<option value="<?php print $_POST['studachive']; ?>"><?php print $_POST['studachive']; ?></option>
<?php
                 }
?>
<option value="Inter college meet" >Inter college meet</option>;
<option value="Workshop" >Workshop</option>;
<option value="Conference" >Conference</option>;
            </select>
</td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</table>
</td>
</tr>
<tr>
<?php
      if ($_POST) 
        {

 $SQL= "select * from student where RegNo ='$regno' " ;
				$rs=mysql_query($SQL);
				while($rows=mysql_fetch_assoc($rs))
   			          {
				$batch=$rows["Batch"];   
				$dept=$rows["Department"];
				$name=$rows["Name"];
   				}
				$reg=$regno;	
           $fdate=$_POST['fdate'];
           $fdate=date_create($fdate);
           $fdate=date_format($fdate,"Y-m-d");
           $tdate=$_POST['tdate'];
           $tdate=date_create($tdate);
           $tdate=date_format($tdate,"Y-m-d"); 
          
          $achive=$_POST['studachive']; 
          $_SESSION['$dept'] = $dept;
          $_SESSION['$fdate'] = $fdate;
	  $_SESSION['$tdate'] =$tdate;               
?>
  
</td>
</tr>
<tr>
<td><center>

<?php
                              if( $achive== 'Inter college meet')
	                        {
?>
<td>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Inter college meet Report</td>
</tr>
</table>
<?php 
                                   
                                    
                                       $SQL="SELECT * FROM studenticm where RegNo='$reg'  AND Date >= '$fdate' AND Date <= '$tdate' ";
                                       $rs=mysql_query($SQL);
                                      
                                      if (mysql_num_rows($rs)==0)
                                         {
                                       print "<h1>No Data Found</h1>";
                                         }
                                         else
                                         {
 ?>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Reg.No
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Event
</th>
<th>Place
</th>
<th>College Name
</th>
<th>Date
</th>
<th>Certificate
</th>
</tr>
<?php
                   $i=1;
    	                 while($row=mysql_fetch_assoc($rs))
    	                  {
                                 $date=$row["Date"];
                                 $date=date_create($date);
                                 $date=date_format($date,"d-m-Y");
                                 print "<tr><td>$i</td><td>".$reg."</td><td>".$name."</td><td>".$dept."</td><td>".$row["Event_Name"]."</td><td>".$row["Place"]."</td><td>".$row["Institution_Name"]."</td><td>".$date."</td><td>";
?>
                                 <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
<?php
                                  
                                  $i=$i+1;
    	                      }
?>
</tr>
</table>
<br>


<?php
                            }
                           }
                        if( $achive== 'Workshop')
	              { 
?>
<td>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Workshop Report</td>
</tr>
</table>
<?php 
                                   
                                       $SQL="SELECT * FROM studentworkshop where RegNo='$reg' ";
                                       $rs=mysql_query($SQL);
                                      
                                       if (mysql_num_rows($rs)==0)
                                         {
                                       print "<h1>No Data Found</h1>";
                                         }
                                         else
                                         {
 ?>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Reg.No
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Program Name
</th>
<th>Institution Name
</th>
<th>Date 	
</th>
<th>No.Of.Days 	
</th>
<th>Certificate
</th>
</tr>
<?php
                   $i=1;
    	                 while($row=mysql_fetch_assoc($rs))
    	                  {
                                       $date1=$row["Starting_Date"];
                                         $date2=$row["Ending_Date"];
                                           $date1=date_create($date1);
                                          $date1=date_format($date1,"d-m-Y");
                                          $date2=date_create($date2);
                                          $date2=date_format($date2,"d-m-Y");
                                         $difference=$date2-$date1;
                                          $difference=$difference+1;
                                        // $difference=ceil(abs($date1 - $date2) / 86400);
                                                                             
                                 print "<tr><td>$i</td><td>".$reg."</td><td>".$name."</td><td>".$dept."</td><td>".$row["Program_Name"]."</td><td>".$row["Institution_Name"]."</td><td>".$date1."</td><td>$difference</td><td>";
?>
                                 <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer.jpg" title="cer" hspace="5" width="15" height="15"></a></td><td>
                                 
 <?php
                                  
                                  $i++;
    	                      }
?>
</tr>
</table>
<br>

<?php
                            }
                         }

                            if( $achive== 'Conference')
	                       {
?>
<td>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Conference Report</td>
</tr>
</table>
<?php  
                                  
                                   
                                       $SQL="SELECT * FROM studentconference where RegNo='$reg'  AND Date >= '$fdate' AND Date <= '$tdate' ";
                                       $rs=mysql_query($SQL);
                                   
                                       if (mysql_num_rows($rs)==0)
                                         {
                                       print "<h1>No Data Found</h1>";
                                         }
                                         else
                                         {
 ?>
<table width="80%" border="1">
<tr>                 
<th>
   SI.No
</th>
<th>
   Reg.No
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Level
</th>
<th>Institution Name
</th>
<th>Date
</th>
<th>Certificate
</th>
</tr>
<?php
                                     $i=1;
    	                 while($row=mysql_fetch_assoc($rs))
    	                  {
                             $date=$row["Date"];
                                 $date=date_create($date);
                                 $date=date_format($date,"d-m-Y");
                                       print "<tr><td>$i</td><td>".$reg."</td><td>".$name."</td><td>".$dept."</td><td>".$row["Level"]."</td><td>".$row["Institution_Name"]."</td><td>".$date."</td><td>";
                                    
?>
                                 <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer.jpg" title="cer" hspace="5" width="15" height="15"></a></td><td>
<?php                     
                                  $i++;  }
?>
</tr>
</table>
<br>

<?php

	                    }
                    }
}
           ?>
       </td>
   </tr>
   <tr>
  </tr>
</table>
</td></center>
</tr>
</table>
</div>
</body>
</html>