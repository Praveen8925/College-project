<?PHP
  session_start();
 include_once 'Database.php';
   function randomPassword() 
  {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789*%$@#";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
  }
 $stid = $_POST["studid"];
 $stid=strtoupper($stid);
 $stbat = $_POST["studbat"];
$status = $_POST["status"];
  $SQL= "select * from student where Batch='$stbat';" ;
$rm=mysql_query($SQL);

if(mysql_num_rows($rm)==0 and $status=="Student")
  {

$batch=$stbat;
$SQL="CREATE TABLE collegedetails.$batch(Batch int(4),sem int(4),exam_type varchar(15),RegNo varchar(10),mark varchar(30),decided varchar(1))";
$rs=mysql_query($SQL);
$table=$stbat.'lab';
$SQL="CREATE TABLE collegedetails.$table(Batch int(4),sem int(4),Type varchar(15),RegNo varchar(10),mark varchar(30),decided varchar(1))";
$rs=mysql_query($SQL);
$tablename=$stbat.'assignment';
$SQL="CREATE TABLE collegedetails.$tablename(Batch int(4),sem int(4),RegNo varchar(10),ass_mark varchar(30),decided varchar(1))";
$rs=mysql_query($SQL);
$tn=$stbat.'attendance';
$SQL="CREATE TABLE collegedetails.$tn(Batch int(4),sem int(4),RegNo varchar(10),tot_working_days int(5),no_day_present int(5),decided varchar(1))";
$rs=mysql_query($SQL);

   }
 $stname = $_POST["stname"];
$stname=strtoupper($stname);
 $stdept = $_POST["stDept"];
 $stemail = $_POST["email"];
 $SQL="select * from student where RegNo='$stid'";
 $re=mysql_query($SQL);
 if (mysql_num_rows($re)>0)
  {    
	$_SESSION['stsave'] = "Student ID Alredy Exist <br> Record Not Saved";
  }
  else
  {    
      $pass=randomPassword();
      $SQL = "insert into student values('$stid',$stbat,'$stname','$stdept','$stemail','$pass','$status')";print $SQL;
      $result = mysql_query($SQL);
      if($result==1)
      {
      $from = "hodugit@stc.ac.in";
      $headers = "From: ".$from."\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $message = "<html><head></head><body><table bgcolor='#003366' width='600'><tr><td><b><font color='#FFFFFF' face='Calibri' size='+2'>Dear ".$stname."</font></b></td></tr><tr><td bgcolor='#FFFFFF'><div style='word-wrap: break-word;'><font color='#003366' face='Times New Roman' Size='+1'>Your Account has been Created Successfully<br/><b>User name : ".$stid."<br/>Password : ".$pass."</b><br/>Please Login and Change Your Password : www.stc.ac.in<br/></font></div></td></tr><tr><td><p align='right'><b><font color='#FFFFFF' face='Calibri' size='+1'>Sincerely <br />Sree Saraswathi Thyagaraja Collge, Pollachi</font></b></p></td></tr></table></center></body></html>";
      mail($stemail,"Account Created Successfully",$message,$headers);
      $_SESSION['stsave'] = "Record Saved Successfully";
      }
     else
       {
        $_SESSION['stsave'] = "Record Not Saved";
        }
  }
  header("location: addstudent.php");
?>