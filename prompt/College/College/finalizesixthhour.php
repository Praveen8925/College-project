<?php
session_start();
include_once 'database.php';
$userid=$_SESSION['AU'];
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
     <td colspan="2" align="Center"><h1>6th hour Subjects</h1>
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
             for ($x=1; $x<=10; $x++)
                {
              echo "<option value=".$x.">".$x."</option>";
                 }
?>
          </select>  
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
					$batch = $_POST["batch"];
					$dept = $_POST["dept"];
					$sem = $_POST["sem"];
	               				   
?>
<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td></tr>
</table>
</td></tr>
<form name="mark" method="post"  action="#"  onSubmit="return a();">
<tr>
<td>
<input type="hidden" name="batch" id="batch"  value="<?php print $batch; ?>"  size="30">
<input type="hidden" name="dept" id="dept"  value="<?php print $dept; ?>"  size="30">
<input type="hidden" name="sem" id="sem"  value="<?php print $sem; ?>" size="30">


</td>
</tr>
<tr>
<center>
<?php
        $SQL= "select * from sixthhour where Program_Name='$dept'and sem='$sem' and Batch='$batch'";
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
<td>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Course ID
</th>
<th>
   Course_Name
</th>
<th>
   Type
</th>
</tr>
<?php
          $i=1;
    	     while($row=mysql_fetch_assoc($rs1))
    	     {
		     
				 print "<tr><td align='center'>$i</td><td>".$row["CourseID"]."</td><td>".$row["Course_Name"]."</td><td>".$row["Type"]."</td>";
				$i++;
				 }
          }
				 
		
				 
?>
</center>
</table>

<?php
 }
?>

</form>
</div>
</body>
</html>