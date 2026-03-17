<?php
session_start();
include_once 'database.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
     <td colspan="2" align="Center"><h1>Alumni</h1>
   </tr>
   
<form name="alumni" method="post" action="#" >
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
<tr>
<td>
<?php
          if ($_POST) 
                 { 
	               $batch=$_POST['batch'];
                       $dept=$_POST['dept'];
                     $SQL= "select * from student where Batch='$batch' and  Department='$dept' and status='Student' order by RegNo asc" ;
                     $rs=mysql_query($SQL);
                     $db_field=mysql_fetch_assoc($rs); 
                     $status=$db_field['status'];
                    if (mysql_num_rows($rs)==0)
                      {
                       print "<center><h1>No data found</h1></center>";
                       } 
                    else if($status=='alumni')
                       {
                       print "<center><h1>Alredy Exist <br> Record Not Saved</h1></center>";
                       }
                     else
                      {  
                       $SQL= "update student set status='Alumni' where Batch='$batch' and  Department='$dept'and status='Student'" ;
                       $rs=mysql_query($SQL); 
                        if($rs==1)
                          print "<center><h1>".$batch."Batch".$dept."Department"."Successfully Changed as Alumni </h1></center>";  
                       }
                  }
?>
</td>
</tr>
</div>
</body>
</html>