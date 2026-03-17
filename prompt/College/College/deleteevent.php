<?php
   include_once 'Check.php';
   include_once("Database.php"); 
   if(isset($_GET['action']))
   {
      $operation=$_GET['action'];
         $evtid=$_GET['id'];
   $userid=$_SESSION['AU'];
   }
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
   <?php
     
     if($operation=="delete")
    {
    $EventID="$evtid";
          $SQL="DELETE FROM  events where EventID='$EventID'";
          $rs=mysql_query($SQL); 
?>
<td colspan="2" align="Center"><h1>Event Deleted Sucessfully</h1>
<?php        
       
     }
?>

</body>
</html>