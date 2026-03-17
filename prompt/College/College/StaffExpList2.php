<?php
session_start();
include_once 'database.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="JS/Index.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<link href="css/web.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="allblur">
<table cellspacing="10" class="table-stylec" width="100%">
<tr>
<td>
<form action="" method="post" onsubmit="return pass()">
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"> Department wise Experience Report</td>
</tr>
<tr>
<td colspan="2" align="center">
</td>
</tr>
<tr>
<td>Department</td>
<td><select name="dept" id="dept">
<?php
             if(isset($_POST['dept']))
                {
?>
<option value="<?php print $_POST['dept']; ?>"><?php print $_POST['dept']; ?></option>
<?php
                 }
    
              $SQL="SELECT Programme FROM coursedetails";
               $rs=mysql_query($SQL);
?>
<option value="ALL">Select</option>
<?php
                              while($row=mysql_fetch_assoc($rs))
    	     {         
         echo "<option value=".$row["Programme"]." >".$row["Programme"]."</option>";
         
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
?>

<?php
          $SQL="SELECT * FROM staffdetail,addstaff where staffdetail.SID= addstaff.SID ";
          $rs=mysql_query($SQL);
           if (mysql_num_rows($rs)==0)
                    {
                  print "<center><h1>No data found</h1></a></center>";
                          }
                            else
                                {  
?>
<tr>
<td>
      <table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"><?php print $dept;?>             Department Experience Report</td>
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
   Staff Id
</th>
<th>
   Name
</th>
<th>Department
</th>
<th>Designation
</th>
<th>Experience@Stc
</th>
<th>UG Experience
</th>
<th>PG Experience
</th>
<th>Industry Experience
</th>
<th>Total Experience
</th>
</tr>
<?php
       
         if($dept=="ALL")
            {
            $SQL="SELECT * FROM staffdetail,addstaff where staffdetail.SID= addstaff.SID";
            $rs=mysql_query($SQL);
            }
          else
            {
          $SQL="SELECT * FROM staffdetail,addstaff where staffdetail.SID= addstaff.SID and addstaff.Department= '$dept'";
          $rs=mysql_query($SQL);
             }  
          $i=1;
    	     while($row=mysql_fetch_assoc($rs))
    	     {
                 $date2=date("Y-m-d");
	         $date1= $row["DOJ"];
                 $ts1=strtotime($date1);
                 $ts2=strtotime($date2);
                 $year1=date('Y',$ts1);
                 $year2=date('Y',$ts2);
                 $month1=date('m',$ts1);
                 $month2=date('m',$ts2);
                 $diffy=$year2-$year1;
                 $diffm=$month2-$month1;
                 
                    if($diffm<0)
                      {
                    $f=12-$month1;
		    $diffm=$f+$month2;
                    $diffy=$diffy-1;
                     }
                  
                    $ugexp = explode("-",$row["UGExp"]);
                    $pgexp = explode("-",$row["PGExp"]);
                     $indexp = explode("-",$row["Industryexp"]);
                    $toty=$ugexp[0]+$pgexp[0]+$indexp[0]+$diffy;
                    $totm=$ugexp[1]+$pgexp[1]+$indexp[1]+$diffm;
                      if($totm>11)
                     {
                    $y=$totm/12;
                    $m=$totm%12;
		    $totm=$m;
                    $toty=$toty+$y;
                     }
                    
                      
          print "<tr><td>$i</td><td>".$row["SID"]."</td><td>".$row["Name"]."</td><td>".$row["Department"]."</td><td>".$row["Designation"]."</td><td>".$diffy."-".$diffm."</td><td>".$row["UGExp"]."</td><td>".$row["PGExp"]."</td><td>".$row["Industryexp"]."</td><td>".intval($toty)."-".$totm."</td><td>";
?>
<?php
$i=$i+1;
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