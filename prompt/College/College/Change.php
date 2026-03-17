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
<form action="ChangePass.php" method="post" onsubmit="return pass()">
<table cellspacing="10" class="font-stylec">
<tr class="tableth"><td colspan="2" align="center">Change Password</td>
</tr>
<tr>
<td colspan="2" align="center">
<?php
			if( isset($_SESSION['Save']) ) {
			echo "<B><font color='#CC0000'>".$_SESSION['Save']."</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "; 
			unset($_SESSION['Save']);
			}
?>

</td>
</tr>

<tr class="tableth"><td>
<label> Old Password*</label></td>
        <td><input type="password" name="oldpwd" id="oldpwd"/></td>
      </tr>
        <tr class="tableth">
          <td>New Password*</td>
        <td><input type="password" name="newpwd" id="newpwd" /></td>
      </tr>
        <tr class="tableth">
          <td>Retype the New Password*</td>
        <td><input type="password" name="newrpwd" id="newrpwd"/></td>
      </tr>
            
<tr><td align="right"><input type="submit" value="Submit" class="btn"></td>
<td><input type="reset" value="Reset" class="btn" /></td></tr>
</form>
</table>
</div>
</body>
</html>