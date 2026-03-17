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
<form action="#" method="post" onsubmit="return stafftransfer1();">

<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"> Staff Transfer</td>
</tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['stafftransfer']))
    print $_SESSION['stafftransfer'];
  unset($_SESSION['stafftransfer']);
?></h4>
   </tr>
<tr>
<td colspan="2" align="center">
</td>
</tr>

<tr>
<td>Staff ID</td>
<td>
<?php
             if(isset($_POST['sid']))
                {
?>

<input type="text" name="sid" id="sid" value="<?php print $_POST['sid']; ?>" >
<?php
                 }
				 else
				 { ?>
<input type="text" name="sid" id="sid" >
<?php				 }?>
</td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" value="Get" class="btn"></td></tr>
</form>
</td>
</tr>

<tr>
<td colspan="2" align="Center">
<?php 
                  if ($_POST) 
                 { 
			 $sid=$_POST['sid'];
?>

<?php
			$SQL= "select * from addstaff where SID='$sid'" ;
			$rs=mysql_query($SQL);
           if (mysql_num_rows($rs)==0)
                    {
                  print "<center><h1>No data found</h1></a></center>";
                          }
                            else
                             {  
						 			while($row=mysql_fetch_assoc($rs))
									{
										$sid=$row["SID"];
									$name=$row["Name"];
									$dept=$row["Department"];
									$designation=$row["Designation"];
									$email=$row["Emailid"];
									}
							 
                   
?>
</td></tr>
<form name="studdetails" method="post" action="stafftransfersave.php" onSubmit="return stafftransfer();" >
<tr>
<td>ID</td>
<td>
<input type="text" name="sid" id="sid"  value=<?php print $sid; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Name</td>
<td>
<input type="text" name="name" id="name"  value=<?php print $name; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Department</td>
<td>
<input type="text" name="dept" id="dept"  value=<?php print $dept; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Designation</td>
<td>
<input type="text" name="desigtn" id="desigtn" value=<?php print $designation; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Email-id</td>
<td>
<input type="type" name="email" id="email" value=<?php print $email; ?> readonly size="30">
</td>
</tr>
<tr>
<td>Transfer To</td>
<td> <select name="transfer" id="transfer">
  <option value="" ></option>
  <?php
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
     <td colspan="2">
                <center>
                        <input type="Submit" Value="Submit" id="submit" class="bn">
               </center>
    </td>
  </tr>
</table>
				 <?php } } ?>
</div>
</body>
</html>