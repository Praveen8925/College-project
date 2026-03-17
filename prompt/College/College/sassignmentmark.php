<?php
session_start();
include_once 'Database.php';
if($_POST)
{
$subject=$_POST['cid'];
		   $sem=$_POST['sem'];
			$batch=$_POST['batch'];
			$dept=$_POST['dept'];
			$number=$_POST['number'];
print $dept;
$tbs=$batch.'studassignmentmark'; 
        $check="CREATE TABLE IF NOT EXISTS $tbs (Regno VARCHAR(20),Batch INT(5),Dept VARCHAR(20),semester INT(2),Course VARCHAR(20),number INT(10),mark INT(10))";
		$data=mysql_query($check);
		
$sqls="select *from $tb where Course='$subject' and Dept='$dept' and semester='$sem'and number='$number'";
$rss=mysql_query($sqls);
$num=mysql_num_rows($rss);
$i=1;

while($rows=mysql_fetch_assoc($rss))
{
	
	  
	$val[$i]=$rows['Regno'];
	$mark[$i]=$_POST["mark"][$i];
	 

/*$SQL="insert into $tbs values('$val[$i]','$batch','$dept','$sem','$subject','$number','$mark[$i]')";
$re=mysql_query($SQL);
*/		
$i=$i+1;			   			   
		   
}
}

?>