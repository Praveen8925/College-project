<?PHP
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$tn=$batch.'assignment';
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$num = count($_POST["regno"]);
$yn= $_POST["yn"];
$cnt=$_SESSION['cnt'];
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["regno"][$i-1];
$mar[$i]="";
for($j=1;$j<=$cnt;$j++)
{
$mark[$j]=$_POST['mark'][$i][$j];
$a=strlen($mark[$j]);
if($a==1)
$mark[$j]="0".$mark[$j];
else if($a==0 or $a>=3)
$mark[$j]="00";
if($j==1)
$mar[$i]=$mark[$j];
else
$mar[$i]=$mar[$i]."-".$mark[$j];
}
$i_u=$_POST["iu"][$i-1];
if($yn=="Submit")
$d='y';
else if($yn=="Finalized")
$d='n';
if($i_u==1)
$SQL="insert into  $tn values('$batch','$sem','$val[$i]','$mar[$i]','$d')";
else
$SQL = "update  $tn set ass_mark='$mar[$i]', decided='$d' where Batch='$batch' and sem='$sem'  and RegNo='$val[$i]'" ;
mysql_query($SQL);

}
 $_SESSION['ass'] = "Record Saved Successfully";

header("location: assiment.php");
?>