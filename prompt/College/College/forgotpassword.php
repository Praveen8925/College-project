<?php
include_once 'database.php';
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
    <td colspan="2" align="Center"><h1>Reset Password</h1>
     <?php
		if(isset($_SESSION['IU']))
		{
    		   print "<div class='font-stylec'>".$_SESSION['IU']."</div>";
		   unset($_SESSION['IU']);
                }
		if(isset($_SESSION['AU']))
		{
    		   print "<div class='font-stylec'>Your User Account Password Details:<br></div><div align='left'>User Name :".$_SESSION['AU']."<BR>Password :".$_SESSION['pwd']." </div>";
		   unset($_SESSION['AU']);
                }
		else
		{
	?>
     </td>
    </tr>
   <form name="forgot" method="post" action="Saveforgotpassword.php" onSubmit="">
   <tr class="font-stylec">
 
      <td>User Name</td>
      <td><input name="loginid" type="text" id="loginid"></td>
   </tr>
   
     <tr class="font-stylec">
    <td>E-mail ID</td>
    <td><input name="email" type="text" id="email"></td>
    </tr>
    <tr>
          <td colspan="2" align="center">
	     <input name="submit" class="btn" type="submit" id="submit" value="Reset">		  
          </td></form>
        </tr>   <?php
}
?>	   
    </table></div>

</body>
</html>