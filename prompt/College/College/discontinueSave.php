
<?PHP
  session_start();
 include_once 'Database.php';
$stid = $_SESSION['studid'];
$SQL="update student set status='discontinue' where RegNo='$stid'";
$rs=mysql_query($SQL);
if($rs==1)
{
$_SESSION['dissave']="Record Saved Successfully";
}
else
{
$_SESSION['dissave']="Record  Not Saved ";
}
header("location: Discontinue.php");
?>