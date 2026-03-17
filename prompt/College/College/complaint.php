<?php
session_start();
   include_once 'database.php';
   
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
    
    
});
    
$(document).ready(function(){
  $('input[type="radio"]').click(function(){
     
       if($(this).attr("value")=="suggestion" |$(this).attr("value")=="other" ){
                
         $("#c").hide();
         

         
         
         
		 }
         
        else
 if($(this).attr("value")=="clean")		   {
		     
        
         $("#c").show();
         
 		   }
        });
    });


</script>
</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h2>Register Complaint</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['complaint']))
    print $_SESSION['complaint'];
  unset($_SESSION['complaint']);
?></h4>
   </tr>
<form name="complaint" method="post" action="complaintsave.php">

 <tr>
<td>Type</td>
<td><input type="radio"  name="cmp"   value="clean" >Clean
<input type="radio" name="cmp"  value="discipline" >Discipline
<input type="radio" name="cmp"  value="other" >Other
</td>
</tr>
<tr id="c">
<td>Class No</td>
<td><input type="text" name="clsno"  size="30">
</td>
</tr>
<tr>
<td>To</td>
<td><input type="checkbox" name="to[]" value="classincharge">Class Incharge<input type="checkbox"  name="to[]" value="hod">Hod<input type="checkbox"  name="to[]" value="dean">Dean<input type="checkbox"  name="to[]" value="principal">Principal<input type="checkbox"  name="to[]" value="maintenance">Maintenance</input>
</td>
</tr>
<!--<tr>
<td>To</td>
<td><select name="to">
<option value="classincharge">Class Incharge</option>
<option value="hod">Hod</option>
<option value="dean">Dean</option>
<option value="principal">Principal</option>
<option value="maintenance">Maintenance</option>
</select>
</td>
</tr>-->
<tr>
<td>Description</td>
<td><textarea type="text" name="desc" rowspan="4"colspan="3" size="30"></textarea>
</td>
</tr>

<tr>
<td colspan="2">
<center>
<input type="Submit" Value="Submit" id="submit" class="btn">
<input type="Reset" Value="Reset" id="Reset" class="btn">
</center>
</td>
</tr>

</form>
    </table></div>
</body>
</html>