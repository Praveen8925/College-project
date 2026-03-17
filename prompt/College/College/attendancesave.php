<?PHP
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$tn=$batch.'attendance';
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$totday = $_POST["totday"];
$yn= $_POST["yn"];
$num = count($_POST["regno"]);
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["regno"][$i-1];
$pday[$i]=$_POST["pday"][$i-1];
if($yn=="Submit")
$d='y';
else if($yn=="Finalized")
$d='n';
$i_u=$_POST["iu"][$i-1];
if($i_u==1)
$SQL="insert into  $tn values('$batch','$sem','$val[$i]','$totday','$pday[$i]','$d')";
else
$SQL = "update  $tn set tot_working_days='$totday',no_day_present='$pday[$i]',decided='$d' where Batch='$batch' and sem='$sem'  and RegNo='$val[$i]'" ;
mysql_query($SQL);

}
 $_SESSION['att'] = "Record Saved Successfully";

header("location: attendance.php");
?>