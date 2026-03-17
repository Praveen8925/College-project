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
<script src="JS/jquery-1.11.3.min.js">
</script>

<script>
    $( document ).ready(function() {
	  
   
    $("#c").hide();
    $("#add").hide();
    
});
    
$(document).ready(function(){
  $('input[type="radio"]').click(function(){
     
       if($(this).attr("value")=="OnCampus"){
                
         $("#c").hide();
         $("#add").hide();

		 }
         
        else
 if($(this).attr("value")=="OffCampus")		   {
		     
        
         $("#c").show();
         $("#add").show();
 		   }
        });
    });
</script>
<script>
    $( document ).ready(function() {
	  
   
    $("#ug").hide();
    $("#pg").hide();
    
});
    
$(document).ready(function(){
  $('input[type="checkbox"]').click(function(){
     
       if($(this).attr("value")=="ug"){
                
         $("#ug").show();
        

		 }
         
        else
 if($(this).attr("value")=="pg")		   {
		     
        
         $("#pg").show();
         
 		   }
        });
    });
</script>

</head>
<body>
<div class="allblur">
   <table width="100%" border="0" class="font-stylec">
   <tr>
     <td colspan="2" align="Center"><h2>Upcoming Companies</h2>
   </tr>
   <tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['uc']))
    print $_SESSION['uc'];
  unset($_SESSION['uc']);
?></h4>
   </tr>
<form name="uc" method="post" action="ucompanysave.php">
<tr>
<td>Company Name</td>
<td><input type="text" name="cname" size="30" required>
</td>
</tr>
 <tr>
<td>Date</td>
<td>
<?php
  $tdt=date("d-m-Y");

             if(isset($_POST['atdate']))
                {
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php print $_POST['atdate']; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
                 }
               else
                {
           
?>
<input type="Text" id="fdate" name="atdate" maxlength="20" size="20" value="<?php echo $tdt; ?>" onClick="javascript:NewCssCal('fdate','DDMMYYYY')" style="cursor:pointer"/>
<?php
				}
?>
</tr>
<tr>
<td>Time</td>
<td><input type="time" name="time" id="stname" size="30">
</td>

</tr>
<tr>
<td>Degree</td>
<td>
    <?php
    $rs=mysql_query("select * from coursedetails where Branchtype='Regular'");
	$i=1;
    while($row=mysql_fetch_row($rs))
    {
		
?>
		<input type="checkbox"name="dept[]" value="<?php print $row[0]?>" id="dept"><?php print $row[0];?>
<?php		
	$i++;
    }

   ?>
</td>
</tr>
<tr>
<td>Nature of Job</td>
<td><input type="text" name="njob" size="30">
</td>
</tr>
<tr>
<td>Location</td>
<td>
<input type="Text" name="location" size="30">
</td>
</tr>
<tr>
<td>Recruitement Type</td>
<td>
<input type="radio" name="status" value="OnCampus" checked="checked">On Campus
<input type="radio" name="status" value="OffCampus">Off Campus
</td>
</tr>
<tr id="c" name="c">
<td>Venue of College</td>
<td>
<input type="Text" id="c" name="venue" size="30">
</td>
</tr>
<tr id="add" name="add">
<td>Address</td>
<td>
<input type="Text" id="add" name="vaddress" size="30">
</td>
</tr>
<tr>
<td>Elegibility</td>
<td>
<input type="checkbox" name="eleg[]" value="ug" size="30">UG</input><input type="checkbox" name="eleg[]" value="pg" size="30">PG</input>
</td>
</tr>
<tr id="ug">
<td>UG Percentage</td>
<td>
<input type="Text"  name="ug" size="30">
</td>
</tr>
<tr id="pg">
<td>PG Percentage</td>
<td>
<input type="Text"  name="pg" size="30">
</td>
</tr>
<tr>
<td>History of Arrears</td>
<td>
<input type="radio" name="ha" value="allowed"checked="checked">Allowed
<input type="radio" name="ha" value="notallowed">Not Allowed
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