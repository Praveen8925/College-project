<?PHP
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$exam = $_POST["t_exam"];
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
if($mark[$j]=='a' or $mark[$j]=='ab' or $mark[$j]=='A' or $mark[$j]=='Ab')
$mark[$j]='AB';
$a=strlen($mark[$j]);
if($a==0or $a>=3 )
$mark[$j]="00";
if($a==1)
$mark[$j]="0".$mark[$j];
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
$SQL="insert into collegedetails.$batch values('$batch','$sem','$exam','$val[$i]','$mar[$i]','$d')";
else
$SQL = "update collegedetails.$batch set mark='$mar[$i]',decided='$d' where Batch='$batch' and sem='$sem' and exam_type='$exam' and RegNo='$val[$i]'" ;
mysql_query($SQL);
//print $SQL;
}
$_SESSION['mark'] = "Record Saved Successfully";
header("location: mark.php");
?>