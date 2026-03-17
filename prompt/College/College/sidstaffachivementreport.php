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
<tr class="tableth"><td colspan="2" align="center">Staff Achivement Report</td>
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
<td><select name="achive" id="achive">
<?php
             if(isset($_POST['achive']))
                {
?>
<option value="<?php print $_POST['achive']; ?>"><?php print $_POST['achive']; ?></option>
<?php
                 }
?>
<option value="Publication" >Publication</option>;
<option value="Paper Presentation" >Paper Presentation</option>;
<option value="Workshop/Seminar/FDP" >Workshop/Seminar/FDP</option>;
<option value="100% Result Achivement" >100% Result Achivement</option>;
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
           $fdate=$_POST['fdate'];
           $fdate=date_create($fdate);
           $fdate=date_format($fdate,"Y-m-d");
           $tdate=$_POST['tdate'];
           $tdate=date_create($tdate);
           $tdate=date_format($tdate,"Y-m-d"); 
          
          $achive=$_POST['achive']; 
          
          $_SESSION['$fdate'] = $fdate;
	  $_SESSION['$tdate'] =$tdate;            
?>
  <td>

</td>
</tr>

<?php
                               if( $achive== 'Publication')
	                               { 
                                 $fdate=date_create($fdate);
           			$fdate=date_format($fdate,"M-Y");
           			$tdate=date_create($tdate);
           			$tdate=date_format($tdate,"M-Y");
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Publication Report <?PHP PRINT $fdate."TO".$tdate ?></td>
</tr>
</table>
<?php
                                
                                $fdate="1-".$fdate;
                                $tdate="10-".$tdate;
                                $fdate=date_create($fdate);
           			$fdate=date_format($fdate,"Y-m-d");
           			$tdate=date_create($tdate);
           			$tdate=date_format($tdate,"Y-m-d");
                                   
                                     $SQL="SELECT * FROM  staffpublication where staffpublication.SID='$userid'  AND Issue >= '$fdate' AND Issue <= '$tdate' ";
                                    $rs=mysql_query($SQL);
                                    
                                                                           
                                      if (mysql_num_rows($rs)==0)
                                         {
                                       print "<center><h1>No Data Found</h1></center>";
                                         }
                                         else
                                         {
 ?>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>Type
</th>
<th>Title
</th>
<th>Journal/Proceeding Name
</th>
<th>ISBN/ISSN No
</th>
<th>Impact No
</th>
<th>Volume
</th>
<th>Issue
</th>
<th>Page No
</th>
<th>Certificate
</th>
<th>Paper
</th>
</tr>
<?php
                   $i=1;
    	                 while($row=mysql_fetch_assoc($rs))
    	                  {
                                  $issue=$row["Issue"];
                                  $issue=date_create($issue);
           			  $issue=date_format($issue,"M-Y");
                                  print "<tr><td>$i</td><td>".$row["jptype"]."</td><td>".$row["Title"]."</td><td>".$row["jpname"]."</td><td>".$row["ISBN/ISSN_No"]."</td><td>".$row["Impact_No"]."</td><td>".$row["Volume"]."</td><td>".$issue."</td><td>".$row["Page_No"]."</td><td>";
?>
                                          <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
                                          <a href='<?php print $row['Paper'];?>' target='blank'><img src="images/paper1.png" title="pap" hspace="15" width="25" height="25"></a></td>
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

                                   if( $achive== 'Paper Presentation')
	                               { 
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Paper Presentation Report</td>
</tr>
</table>
<?php
                                   
                                     $SQL="SELECT * FROM staffpp where staffpp.SID='$userid'  AND Date >= '$fdate' AND Date <= '$tdate' ";
                                    $rs=mysql_query($SQL);
                                        
                                      if (mysql_num_rows($rs)==0)
                                         {
                                       print "<center><h1>No Data Found</h1></center>";
                                         }
                                         else
                                         {
 ?>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>Level
</th>
<th>Presentation/Participation
</th>
<th>Program Name
</th>
<th>Title
</th>
<th>Institution Name
</th>
<th>Date 	
</th>
<th>Certificate
</th>
<th>Paper
</th>
</tr>
<?php
                   $i=1;
    	                 while($row=mysql_fetch_assoc($rs))
    	                  {      $date=$row["Date"];
                                 $date=date_create($date);
                                 $date=date_format($date,"d-m-Y");
                                 print "<tr><td>$i</td><td>".$row["Level"]."</td><td>".$row["Presentation_Participation"]."</td><td>".$row["Program Name"]."</td><td>".$row["Title"]."</td><td>".$row["Institution Name"]."</td><td>".$date."</td><td>";
?>
                                 <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
                                 <a href='<?php print $row['Paper'];?>' target='blank'><img src="images/paper1.png" title="pap" hspace="15" width="25" height="25"></a></td></tr>
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
                        if( $achive== 'Workshop/Seminar/FDP')
	                   { 
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">Workshop/Seminar/FDP Report</td>
</tr>
</table>
<?php
                                   
                                    $SQL="SELECT * FROM staffworkshop where staffworkshop.SID='$userid'  AND Sdate >= '$fdate' AND Sdate <= '$tdate' ";
                                    $rs=mysql_query($SQL);
                                    
                                     if (mysql_num_rows($rs)==0)
                                         {
                                       print "<center><h1>No Data Found</h1></center>";
                                         }
                                         else
                                         {                 
 ?>
<table width="80%" border="1" align='center'>
<tr>
<th>
   SI.No
</th>
<th>Event
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
                                       $date1=$row["Sdate"];
                                         $date2=$row["Edate"];
                                           $date1=date_create($date1);
                                          $date1=date_format($date1,"d-m-Y");
                                          $date2=date_create($date2);
                                          $date2=date_format($date2,"d-m-Y");
                                         $difference=$date2-$date1;
                                          $difference=$difference+1;
                                        // $difference=ceil(abs($date1 - $date2) / 86400);
                                                                             
                                 print "<tr><td>$i</td><td>".$row["Event"]."</td><td>".$row["Program Name"]."</td><td>".$row["Institution Name"]."</td><td>".$date1."</td><td>$difference</td><td>";
?>
                                 <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer.jpg" title="cer" hspace="5" width="15" height="15"></a></td><td>
                                 
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

                            if( $achive== '100% Result Achivement')
	                        { 
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center">100% Result Achivement Report</td>
</tr>
</table>
<?php
                                  $fdate=date_create($fdate);
                                      $fdate=date_format($fdate,"Y"); 
                                      $tdate=date_create($tdate);
                                      $tdate=date_format($tdate,"Y"); 
                                   
                                    $SQL="SELECT * FROM staffresult where staffresult.SID='$userid'  AND  Year >=$fdate AND Year <= '$tdate'";
                                    $rs=mysql_query($SQL);                                    
                                     if (mysql_num_rows($rs)==0)
                                         {
                                       print "<center><h1>No Data Found</h1></center>";
                                         }
                                         else
                                         {                

?>
<table width="80%" border="1" align='center'>
<tr>
<th>
   SI.No
</th>
<th>Course Name
</th>
<th>Year
</th>
<th>Semister
</th>
</tr>
<?php
                                     $i=1;
    	                   while($row=mysql_fetch_assoc($rs))
    	                              {
                                       print "<tr><td>$i</td><td>".$row["Course Name"]."</td><td>".$row["Year"]."</td><td>".$row["Semister"]."</td><td>";
                                     $i=$i+1;        
                          
                                        }
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