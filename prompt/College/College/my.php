<?php
session_start();
include_once 'database.php';
?>
<?php 

                                   
                                     $SQL="SELECT * FROM 2015yearattendance";
                                    $rs=mysql_query($SQL);
									
									while($row=mysql_fetch_assoc($rs))
									{
										echo "Ihour ".$row["Ihour"]."<br>";
										echo "IIhour ".$row["IIhour"]."<br>";
										echo "IIIhour ".$row["IIIhour"]."<br>";
										echo "IVhour ".$row["IVhour"]."<br>";
										echo "Vhour ".$row["Vhour"]."<br>";
										echo "VIhour ".$row["VIhour"]."<br>";
									}
                                   
 ?>
