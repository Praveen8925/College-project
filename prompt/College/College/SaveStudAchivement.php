<?PHP
  session_start();
 include_once 'Database.php';
if(isset($_SESSION['$stuachive']))
  {
if($_SESSION['$stuachive']== 'ICM')
{
 $regno = $_POST["regno"];  
 $event = $_POST["event"];
 $pal = $_POST["pal"];
 $cname = $_POST["cname"]; 
$icmdate = $_POST["icmdate"]; 
if(isset($_FILES['icmcer']))
  {
      $file_name = $_FILES['icmcer']['name'];
      $file_size = $_FILES['icmcer']['size'];
      $file_tmp = $_FILES['icmcer']['tmp_name'];
      $file_type = $_FILES['icmcer']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['icmcer']['name'])));
      $expensions= array("jpeg","jpg","png");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 2097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $icmcer="upload/".$regno."icm".$icmdate.".".$file_ext;
	    rename("upload/".$file_name,$icmcer);
      }
   } 
$icmdate=date_create($icmdate);
 $icmdate=date_format($icmdate,"Y-m-d");
$SQL = "insert into studenticm values('$regno','$event','$pal','$cname','$icmdate','$icmcer')";
print $SQL;       
$result = mysql_query($SQL);
}
 if($_SESSION['$stuachive']== 'Workshop')
{
 $regno = $_POST["regno"];
 $wsname = $_POST["wsname"];
 $wsins = $_POST["wsins"];
 $sdate = $_POST["sdate"]; 
$edate = $_POST["edate"];
if(isset($_FILES['wscer']))
  {
      $file_name = $_FILES['wscer']['name'];
      $file_size = $_FILES['wscer']['size'];
      $file_tmp = $_FILES['wscer']['tmp_name'];
      $file_type = $_FILES['wscer']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['wscer']['name'])));
      $expensions= array("jpeg","jpg","png");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 2097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $wscer="upload/".$regno."WS".$sdate.".".$file_ext;
	    rename("upload/".$file_name,$wscer);
      }
   }
      $sdate=date_create($sdate);
      $sdate=date_format($sdate,"Y-m-d");
      $edate=date_create($edate);
      $edate=date_format($edate,"Y-m-d");
      $SQL = "insert into studentworkshop values('$regno','$wsname','$wsins','$sdate','$edate','$wscer')";
      print $SQL; 
$result = mysql_query($SQL);
}
if($_SESSION['$stuachive']== 'Conference')
{
 $regno = $_POST["regno"];
 $level = $_POST["level"];
 $insname = $_POST["insname"];
 $date = $_POST["date"]; 
if(isset($_FILES['ccer']))
  {
      $file_name = $_FILES['ccer']['name'];
      $file_size = $_FILES['ccer']['size'];
      $file_tmp = $_FILES['ccer']['tmp_name'];
      $file_type = $_FILES['ccer']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['ccer']['name'])));
      $expensions= array("jpeg","jpg","png");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
      }      
      if($file_size > 2097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $ccer="upload/".$regno."con".$date.".".$file_ext;
	    rename("upload/".$file_name,$ccer);
      }
   }
      $date=date_create($date);
      $date=date_format($date,"Y-m-d");
      $SQL = "insert into studentconference values('$regno','$level','$insname','$date','$ccer')";
      print $SQL; 
$result = mysql_query($SQL);
}
} 
$_SESSION['studachiv'] = "Record Saved Successfully";    
header("location: studahivement.php");
?>