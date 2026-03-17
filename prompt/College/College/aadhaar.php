<?php
session_start();
include_once 'database.php';
$regno=$_SESSION['AU'];
?>
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
<td colspan="2" align="Center"><h1>Aadhaar Update</h1>
</tr>
<form name="form" method="post" action="#" >

<table cellspacing="10" class="font-stylec" width="100%">
<tr class="tableth"><td colspan="2" align="center"></td></tr>
<tr>
<td>Aadhaar No</td>
<td><input type="text"name="aadharno"id="aadharno"value="";></td></tr>
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
  
 

</form>
</div>
</body>
</html>