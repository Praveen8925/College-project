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
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h3>Event Details</h3>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h3>
<?php 
  if(isset($_SESSION['Event']))
  {
      print $_SESSION['Event'];
      unset($_SESSION['Event']);
   }
?></h3>
   </tr>
<form name="eventdetails" method="post" action="EventsSave.php" onSubmit="return eventForm();" >
<tr>
<tr>
<td>Event Name</td>
<td><textarea name="eve" id="eve" rows="3" cols="50"></textarea>
</td>
</tr>
<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Submit" Value="Cancel" id="cancel" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>