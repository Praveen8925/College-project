<?php
session_start();
include_once 'database.php';
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
<tr class="tableth"><td colspan="2" align="center">Publication Report</td></tr>
</td>
</tr>
<tr>
<td>From</td>
<td>
<select name="fm" id="fm">
<?php
             if(isset($_POST['fm']))
                {
?>
<option value="<?php print $_POST['fm']; ?>"><?php print $_POST['fm']; ?></option>
<?php
                 }
?>
<option value="jan" >jan</option>;
<option value="feb" >feb</option>;
<option value="mar" >mar</option>;
<option value="apr" >apr</option>;
<option value="may" >may</option>; 
<option value="jun" >jun</option>;
<option value="july" >july</option>;
<option value="aug" >aug</option>;
<option value="sept" >sept</option>;
<option value="oct" >oct</option>;
<option value="nov" >nov</option>;
<option value="dec" >dec</option>;        
</select>Month
<select name="fy" id="fy">
<?php
             if(isset($_POST['fy']))
                {
?>
<option value="<?php print $_POST['fy']; ?>"><?php print $_POST['fy']; ?></option>
<?php
                 }
?>
    <?php
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
         for ($x=2000; $x<=$y; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>Year
</td>
</tr>
<tr>
<td>To</td>
<td>
<select name="tm" id="tm">
<?php
             if(isset($_POST['tm']))
                {
?>
<option value="<?php print $_POST['tm']; ?>"><?php print $_POST['tm']; ?></option>
<?php
                 }
?>
<option value="jan" >jan</option>;
<option value="feb" >feb</option>;
<option value="mar" >mar</option>;
<option value="apr" >apr</option>;
<option value="may" >may</option>; 
<option value="jun" >jun</option>;
<option value="july" >july</option>;
<option value="aug" >aug</option>;
<option value="sept" >sept</option>;
<option value="oct" >oct</option>;
<option value="nov" >nov</option>;
<option value="dec" >dec</option>;        
</select>Month
<select name="ty" id="ty">
<?php
             if(isset($_POST['ty']))
                {
?>
<option value="<?php print $_POST['ty']; ?>"><?php print $_POST['ty']; ?></option>
<?php
                 }
?>
    <?php
         $y= date("Y");
         echo "<option value=".$y.">".$y."</option>";
         for ($x=2000; $x<=$y; $x++)
         {
  	echo "<option value=".$x.">".$x."</option>";
          }?>
        </select>Year
</td>
</tr>
<tr>
<td>Department</td>
<td> <select name="dept" id="dept">
<?php
             if(isset($_POST['dept']))
                {
?>
<option value="<?php print $_POST['dept']; ?>"><?php print $_POST['dept']; ?></option>
<?php
                 }
?>
         <option value="Select">ALL</option>
    <?php
    $rs=mysql_query("select * from coursedetails");
    while($row=mysql_fetch_row($rs))
    {
	print "<option value=$row[0]>$row[0]</option>";
    }
   ?>
</select> 
</td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</table>
</td>
</tr>
<?php
      if ($_POST) 
        { 
           $dept=$_POST['dept'];
           $fm=$_POST['fm'];
           $fy=$_POST['fy'];
           $tm=$_POST['tm'];
           $ty=$_POST['ty'];
        
?>
<td>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td>
</tr>
</table>
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
   SID
</th>
<th>
   Name
</th>
<th>Department
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

                          if($dept=='Select')
                          { 
                                 $a=array('jan','feb','mar','apr','may','jun','july','aug','sept','oct','nov','dec');
                                 $index=$fm;
                                 $key=array_search($index,$a);
                                 for($i=$key;;$i++)
                                     {
                                         $fd=$a[$i].'-'.$fy;
                                         $td=$tm.'-'.$ty;                                         
                                         if($fd==$td)
                                           { 
                                             break;
                                            }
                                          else
                                           {
                                            
                                         $SQL="SELECT * FROM staffpublication,addstaff where staffpublication.SID=addstaff.SID   AND  staffpublication.Issue ='$fd'";
                                         $rs=mysql_query($SQL);
                                         $j=1;
                                       while($row=mysql_fetch_assoc($rs))
    	                                    {
                
                                            print "<tr><td>$j</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$row["jptype"]."</td><td>".$row["Title"]."</td><td>".$row["jpname"]."</td><td>".$row["ISBN/ISSN_No"]."</td><td>".$row["Impact_No"]."</td><td>".$row["Volume"]."</td><td>".$row["Issue"]."</td><td>".$row["Page_No"]."</td><td>";
?>
                                          <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
                                          <a href='<?php print $row['Paper'];?>' target='blank'><img src="images/paper1.png" title="pap" hspace="15" width="25" height="25"></a></td><td>
 <?php
                                         $j=$j+1;
    	                                     }
                                             if($a[$i]=='dec')
                                              {
                                               $key=0;
                                                $fy++;
                                               }
                        
                                              }
                                           }
                                         $SQL="SELECT * FROM staffpublication,addstaff where staffpublication.SID=addstaff.SID   AND  staffpublication.Issue ='$td'";
                                         $rs=mysql_query($SQL);
                                           $j=1; 
                                          while($row=mysql_fetch_assoc($rs))
    	                                    {
                
                                            print "<tr><td>$j</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$row["jptype"]."</td><td>".$row["Title"]."</td><td>".$row["jpname"]."</td><td>".$row["ISBN/ISSN_No"]."</td><td>".$row["Impact_No"]."</td><td>".$row["Volume"]."</td><td>".$row["Issue"]."</td><td>".$row["Page_No"]."</td><td>";
?>	
                                          <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
                                         <a href='<?php print $row['Paper'];?>' target='blank'><img src="images/paper1.png" title="pap" hspace="15" width="25" height="25"></a></td><td>
 <?php
                                   $j=$j+1;
                                              }


                        }
                        else
                         { 
                                 $a=array('jan','feb','mar','apr','may','jun','july','aug','sept','oct','nov','dec');
                                 $index=$fm;
                                 $key=array_search($index,$a);
                                 for($i=$key;$i<12;$i++)
                                     {
                                         $fd=$a[$i].'-'.$fy;
                                         $td=$tm.'-'.$ty;
                                        
                                         if($fd==$td)
                                           { 
                                             break;
                                            }
                                          else
                                           {
                                            
                                         $SQL="SELECT * FROM staffpublication,addstaff where staffpublication.SID=addstaff.SID and addstaff.Department='$dept'   AND  staffpublication.Issue ='$fd'";
                                         $rs=mysql_query($SQL);
                                         $j=1;
                                       while($row=mysql_fetch_assoc($rs))
    	                                    {
                
                                            print "<tr><td>$j</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$row["jptype"]."</td><td>".$row["Title"]."</td><td>".$row["jpname"]."</td><td>".$row["ISBN/ISSN_No"]."</td><td>".$row["Impact_No"]."</td><td>".$row["Volume"]."</td><td>".$row["Issue"]."</td><td>".$row["Page_No"]."</td><td>";
?>
                                          <a href='<?php print $row['Certificate'];?>' target='blank'><img src="images/cer2.jpg" title="cer" hspace="15" width="25" height="25"></a></td><td>
                                         <a href='<?php print $row['Paper'];?>' target='blank'><img src="images/paper1.png" title="pap" hspace="15" width="25" height="25"></a></td><td>
 <?php
                                         $j=$j+1;
    	                                     }
                                             if($a[$i]=='dec')
                                              {
                                               $key=0;
                                                $fy++;
                                               }
                        
                                              }
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