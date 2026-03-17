<?PHP
  session_start();
  include_once 'Database.php';
 $sid = $_POST["sid"];
 $dept = $_POST["dept"];
 $date = $_POST["date"];
$do = $_POST["do"];
 $cls = $_POST["cls"];
$hour = $_POST["hour"];
$sub = $_POST["sub"];
$topic = $_POST["topic"];
$class=$cls."-".$dept; 
$remark = $_POST["remark"];
$asid = $_POST["asid"];
$tool =$_POST["tool"];
if($sub=="select")
$sub="";
if($sid<>$asid)
{
$SQL= "select * from workdiarys where SID='$sid' AND DATE = '$date' AND  session='FD'" ;
$rs=mysql_query($SQL);
print $SQL;
if(mysql_num_rows($rs)>0)
{
$_SESSION['wd'] = "Record  Not Saved ";
}
else
{
if($remark=="CL" or $remark=="OD")
{
$class="";
$hour="";
$sub="";
$topic="";
$asid="";
$session = $_POST["session"];
$reason= $_POST["reason"];
}
else
{
$remark="";
$session="";
$reason="";
}
if($asid=="Select")
$asid="";
$date=date_create($date);
$date=date_format($date,"y-m-d");
     $SQL="insert into workdiarys values('$sid','$date','$do','$class','$hour','$sub','$topic','$asid','$remark','$session','$reason','$tool')";
     
    mysql_query($SQL) or die(mysql_error());
    $_SESSION['wd'] = "Record Saved Successfully";
 }
}
else 
$_SESSION['wd'] = "Record Not  Saved ";
  header("location: workdiary.php");
?>

