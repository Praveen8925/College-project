<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0">
   <tr>
     <td  align="Center"><h1> Events</h1>
     <td rowspan="5"> <div class="verticalLine"></div></td>
     <td colspan="2" align="Center"><h1>Login</h1>
     <?php
		if(isset($_SESSION['IU']))
    			print "<div class='font-stylec'>".$_SESSION['IU']."</div>";
             unset($_SESSION['IU']);
	?>
      </td>
   </tr>
   <form name="form1" method="post" action="Validate.php" onSubmit="return validateForm();">
   <tr class="font-stylec">
      <td rowspan="4">
      <?php
	include_once 'EventList1.php';
        ?>
      </td>
      <td>User Name    </td>
      <td><input name="loginid" type="text" id="loginid"></td>
   </tr>
   <tr class="font-stylec">
    <td>Password </td>
    <td><input name="pass" type="password" id="pass"></td>
    </tr>
    <tr>
          <td colspan="2" align="center">
	     <input name="submit" class="btn" type="submit" id="submit" value="Login">		  
          </td></form>
        </tr>    
<tr><td colspan="2" align="center"><input type="submit" class="bn" value="Forgot Password" onclick="openWin()"></a></center></td></tr>  
    </table></div>

</body>
</html>