<?PHP
session_start();
  include_once 'Database.php';
 $rs=mysql_query("SELECT * FROM events order by EventID asc");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Web.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="JS/Index.js"></script>
</head>
<body>
   <table width="100%" border="0" class="font-stylec">
   <tr>
<td><div>
<center>
<table width="80%" border="1">
<tr>
<th>
   SI.No
</th>
<th>
   Event
</th>
<th>
   Delete
</th>
</tr>
<?PHP
 if (mysql_num_rows($rs)>0)
  {
     
     $i=1;
     while($row=mysql_fetch_row($rs))
    {
	print "<tr><td>$i</td><td>".$row[1]."</td><td>";
        $a=$row['0'];
?>

        <a href="deleteevent.php?action=delete&id=<?php print $a;?>"><img src="images/delete3.jpg" title="Delete" hspace="5" width="25" height="20"></a></td>
<?php       
     $i=$i+1;
    }
     
  }
 
?>
</tr>
</table>
</div>
</td>
</tr>
</table>