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
 $sid = $_POST["sid"];  
 $name = $_POST["name"];
 $dept = $_POST["Dept"];
 $desigtn = $_POST["desigtn"];
 $email = $_POST["email"];
 $rs=mysql_query("select * from addstaff where SID='$sid' ");
 if (mysql_num_rows($rs)>0)
  {
	$_SESSION['course'] = "Staff ID Alredy Exist <br> Record Not Saved";
  }
  else
  {    
      $pass=randomPassword();
      $SQL = "insert into addstaff values('$sid','$name','$dept','$desigtn','$email','$pass')";
      $result = mysql_query($SQL);
      if($result==1)
      {
      $from = "hodugit@stc.ac.in";
      $headers = "From: ".$from."\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $message = "<html><head></head><body><table bgcolor='#003366' width='600'><tr><td><b><font color='#FFFFFF' face='Calibri' size='+2'>Dear ".$name."</font></b></td></tr><tr><td bgcolor='#FFFFFF'><div style='word-wrap: break-word;'><font color='#003366' face='Times New Roman' Size='+1'>Your Account has been Created Successfully<br/><b>User name : ".$sid."<br/>Password : ".$pass."</b><br/>Please Login and Change Your Password : www.stc.ac.in<br/></font></div></td></tr><tr><td><p align='right'><b><font color='#FFFFFF' face='Calibri' size='+1'>Sincerely <br />Sree Saraswathi Thyagaraja Collge, Pollachi</font></b></p></td></tr></table></center></body></html>";
      mail($to,"Account Created Successfully",$message,$headers);
      $_SESSION['course'] = "Record Saved Successfully";
     }
     else
        $_SESSION['course'] = "Record Saved Successfully";
  }
  header("location: AddstaffDetail.php");
?>