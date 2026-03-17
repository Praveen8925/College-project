<?PHP
  session_start();
  include_once 'Database.php';
 $batch = $_POST["batch"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
$yn= $_POST["yn"];
 $num = count($_POST["sub"]);
print $num;
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["sub"][$i-1];
$dat[$i]=$_POST['dat'][$i];
$dat[$i]=date_create($dat[$i]);
$dat[$i]=date_format($dat[$i],"Y-m-d");
$mm[$i]=$_POST['mm'][$i-1];
$pm[$i]=$_POST['pm'][$i-1];
$iu=$_POST['iu'][$i-1];
if($yn=="Submit")
$d='y';
else if($yn=="Finalized")
$d='n';
if($iu==1)
$SQL="insert into cycletest_2 values('$batch','$sem','$dept','$val[$i]','$dat[$i]','$mm[$i]','$pm[$i]','$d')";
else
$SQL = "update cycletest_2 set C2_Date='$dat[$i]',max_mark='$mm[$i]',pass_mark='$pm[$i]',decided='$d' where CourseID='$val[$i]'" ;
mysql_query($SQL);
}
    $_SESSION['table'] = "Record Saved Successfully";
    header("location: CycleTest2TimeTable.php");
?>