<?PHP
session_start();
include_once 'Database.php';

$batch = $_POST["batch"];
$dept = $_POST["dept"];
$sem = $_POST["sem"];
$exam = $_POST["t_exam"];
$num = count($_POST["regno"]);

$cnt=$_SESSION['cnt'];
for($i=1;$i<=$num;$i++)
{
$val[$i]=$_POST["regno"][$i-1];
$SQL= "SELECT * FROM studentpersonal WHERE Regno='$val[$i]'";
$rs=mysql_query($SQL);
$db_field=mysql_fetch_assoc($rs);
$mobileno=$db_field['Mobileno'];
$Name=$db_field['Name'];
print $mobileno."<br>".$Name."<br>";
$mar[$i]="";
print $val[$i]."<br>";                 
for($j=1;$j<=$cnt;$j++)
{   
$cname[$j]=$_POST["cname"][$j-1];        
$mark[$j]=$_POST['mark'][$i][$j];
$a=strlen($mark[$j]);
if($a==0)
$mark[$j]="00";
if($a==1)
$mark[$j]="0".$mark[$j];
print $cname[$j].":".$mark[$j]."<br>";

}
}
 
?>