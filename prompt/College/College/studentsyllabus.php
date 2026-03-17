<?php
session_start();
include_once 'database.php';
$uid=$_SESSION['AU'];
   $SQLS="select * from student where RegNo='$uid'";
   $results=mysql_query($SQLS);
	while($ress=mysql_fetch_assoc($results))
	{
		$dept=$ress["Department"];
		$batch=$ress["Batch"];
	}
	
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
<script src="JS/datetimepicker_css.js"></script>

</head>
<body>
<form name="form" method="post" action="#" enctype="multipart/form-data">
<div class="allblur">
<table width="100%" border="0" class="font-stylec">
<tr>
<td colspan="2" align="Center"><h1>Syllabus Detail</h1>
</tr>
<tr>
     <td colspan="2" align="Center"><h4>
<?php 
  if(isset($_SESSION['viewsyllabus']))
    print $_SESSION['viewsyllabus'];
  unset($_SESSION['viewsyllabus']);
?></h4>
   </tr>
   
</form>
</table>
<?php 

	
	$SQL="select * from syllabus where Batch='$batch' and Department='$dept'";
	$rs=mysql_query($SQL);
if (mysql_num_rows($rs)==0)
  {    
	$_SESSION['viewsyllabus'] = "<h3>No data found</h3>";
  }
  else
  {
	?>

<center>
 <table width="80%" border="1">
  <tr>
<th>
   SI.No
</th>
 <th>
Batch
</th>
<th>
Department
</th>
<th>
  Type
</th>
<th>
File
</th>

</tr>
<?php

$i=1;
	while($row=mysql_fetch_assoc($rs))
	{
		if($row["Type"]=="n")
		{
		print"<tr><td>$i</td><td>".$row["Batch"]."</td><td>".$row["Department"]."</td><td>Normal</td><td>";
?>
		<a href='<?php print $row['file'];?>' target='blank'><img src="images/download.ico" title="cer" hspace="15" width="25" height="25"></a></td>
		
<?php		
		$i++;
		}
		else
		{
			print"<tr><td>$i</td><td>".$row["Batch"]."</td><td>".$row["Department"]."</td><td>Retified</td><td>";
?>
		<a href='<?php print $row['file'];?>' target='blank'><img src="images/download.ico" title="cer" hspace="15" width="25" height="25"></a></td>
			
<?php			
			
		$i++;
		}
		
	}
}

?>
</table>
</center>
</body>
</html>