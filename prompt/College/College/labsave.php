<?PHP
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$type = $_POST["type"];
$yn= $_POST["yn"];
$num = count($_POST["regno"]);
$tn=$_SESSION['tn'];
$lcnt=$_SESSION['lcnt'];
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["regno"][$i-1];
$mar[$i]="";
for($j=1;$j<=$lcnt;$j++)
{
$mark[$j]=$_POST['mark'][$i][$j];
if($mark[$j]=='a' or $mark[$j]=='ab' or $mark[$j]=='A'or $mark[$j]=='Ab')
$mark[$j]='AB';
$a=strlen($mark[$j]);
if($a==0 or $a>=3)
$mark[$j]="00";
if($a==1)
$mark[$j]="0".$mark[$j];
if($j==1)
$mar[$i]=$mark[$j];
else
$mar[$i]=$mar[$i]."-".$mark[$j];
}
if($yn=="Submit")
$d='y';
else if($yn=="Finalized")
$d='n';
$i_u=$_POST["iu"][$i-1];
if($i_u==1)
$SQL="insert into collegedetails.$tn values('$batch','$sem','$type','$val[$i]','$mar[$i]','$d')";
else
$SQL = "update collegedetails.$tn set mark='$mar[$i]',decided='$d' where Batch='$batch' and sem='$sem' and Type='$type' and RegNo='$val[$i]'" ;

mysql_query($SQL);
}
$_SESSION['record'] = "Record Saved Successfully";

header("location: lab.php");
?>