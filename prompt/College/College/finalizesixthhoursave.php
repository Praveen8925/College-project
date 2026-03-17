<?PHP
  session_start();
  include_once 'Database.php';
 $batch = $_POST["batch"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $num = count($_POST["sub"]);
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["sub"][$i-1];
$SQL = "update sixthhour set decided='n' where CourseID='$val[$i]'" ;
mysql_query($SQL);
}
    $_SESSION['finalizesub'] = "Record Finalized Successfully";
    header("location: finalizesixthhour.php");
?>