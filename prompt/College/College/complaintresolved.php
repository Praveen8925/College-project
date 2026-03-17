<?php
session_start();
   include_once 'database.php';
   
$cid=$_POST["cid"];

?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>

<script src="JS/jquery-1.11.3.min.js">
</script>
<script>


    $( document ).ready(function() {
	  
   
    $("#c").hide();
    $("#t").hide();
    $("#d").show();
    
});
    
$(document).ready(function(){
  $('input[type="radio"]').click(function(){
     
       if($(this).attr("value")=="solved"){
                
         $("#c").hide();
         $("#t").hide();
         $("#d").show();
         $("#s").show();

         
         
         
		 }
         
        else
 if($(this).attr("value")=="transfer")		   {
		     
        
         $("#c").show();
         $("#t").show();
         $("#d").hide();
         $("#s").hide();
 		   }
        });
    });


</script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h2>Complaint Resolve</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['recomplaint']))
    print $_SESSION['recomplaint'];
  unset($_SESSION['recomplaint']);
?></h4>
   </tr>
<form name="complaint" method="post" action="complaintresolvedsave.php">
<tr>
<td>Complaint_ID</td>
<td><input type="text" name="cid" value="<?php print $cid; ?>" size="30" readonly>
</td>
</tr>
<?php
$dt=date("d-m-Y");
$dt=date_create($dt);
 $dt=date_format($dt,"d-m-Y");
 ?>
 <tr>
<td>Date</td>
<td><input type="text" name="date" value="<?php print $dt; ?>" size="30" readonly>
</td>
</tr>
<tr>
<td>Type</td>
<td><input type="radio"  name="cmp"   value="solved" checked>Solved
<input type="radio" name="cmp"  value="transfer" >Transfer

</td>
</tr>
<tr id="c">
<td>Transfer To</td>
<td><input type="radio" name="to" value="classincharge">Class Incharge<input type="radio"  name="to" value="hod">Hod<input type="radio"  name="to" value="dean">Dean<input type="radio"  name="to" value="principal">Principal<input type="radio"  name="to" value="maintenance">Maintenance</input>
</td>
</tr>
<tr id="d">
<td>Description</td>
<td><textarea type="text" name="desc" rowspan="4"colspan="3" size="30"></textarea>
</td>
</tr>

<tr id="s">
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Reset" Value="Reset" id="Reset" class="btn">
</center>
</td>
</tr>
<tr id="t">
<td colspan="2">
<center>
<input type="Submit" Value="Transfer" id="submit" class="btn">
<input type="Reset" Value="Reset" id="Reset" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>