<?PHP
  include_once 'Database.php';

 $rs=mysql_query("SELECT * FROM events");
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
<td><div><marquee direction="up" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
<?PHP
 if (mysql_num_rows($rs)>0)
  {
    
     while($row=mysql_fetch_row($rs))
    {
 	print "<br><br>$row[1]";
    }
  }
                  
?> 
</marquee>
</div>
</td>
</tr>
</table>