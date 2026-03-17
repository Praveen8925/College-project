<?PHP
session_start();
include_once 'Database.php';
$batch = $_POST["batch"];
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$sid = $_POST["sid"];

$SQL= "select * from classincharge where Batch='$batch' and  Department='$dept' and sem='$sem'" ;
$rs=mysql_query($SQL);
if (mysql_num_rows($rs)==0)
{
$SQL="insert into classincharge values('$batch','$dept','$sem','$sid')";
mysql_query($SQL);
$_SESSION['clsic'] = "Record Saved Successfully";
}
else
 $_SESSION['clsic'] = "Alredy Exist <br> Record Not Saved ";
 

header("location: classincharge.php");
?>