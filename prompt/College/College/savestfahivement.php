<?PHP
  session_start();
 include_once 'Database.php';
if(isset($_SESSION['$achive']))
  {
$sid=$_SESSION['$sid'] ;
if($_SESSION['$achive']== 'Publication')
{
 $jptype = $_POST["jptype"];  
 $pubt = $_POST["pubt"];
 $jpname = $_POST["jpname"];
 $isno = $_POST["isno"]; 
$imno = $_POST["imno"];
 $vol = $_POST["vol"];
$issuem = $_POST["issuem"];
$issuey = $_POST["issuey"];
 $pag = $_POST["pag"];
$issue="5".$issuem."-".$issuey;
$issue=date_create($issue);
$issue=date_format($issue,"Y-m-d");
if(isset($_FILES['pcer']))
  {
      $file_name = $_FILES['pcer']['name'];
      $file_size = $_FILES['pcer']['size'];
      $file_tmp = $_FILES['pcer']['tmp_name'];
      $file_type = $_FILES['pcer']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['pcer']['name'])));
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
          $pcer="upload/".$sid."Pubcer".$issue.".".$file_ext;
	    rename("upload/".$file_name,$pcer);
      }
   } 
if(isset($_FILES['ppaper']))
  {
      $file_name = $_FILES['ppaper']['name'];
      $file_size = $_FILES['ppaper']['size'];
      $file_tmp = $_FILES['ppaper']['tmp_name'];
      $file_type = $_FILES['ppaper']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['ppaper']['name'])));
      $expensions= array("doc","docx");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a doc or docx file.";
      }      
      if($file_size > 2097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $ppaper="upload/".$sid."Pubpaper".$issue.".".$file_ext;
	    rename("upload/".$file_name,$ppaper);
      }
   }               
$SQL = "insert into staffpublication values('$sid','$jptype','$pubt','$jpname','$isno','$imno','$vol','$issue','$pag','$pcer','$ppaper')";
       
$result = mysql_query($SQL);
}
 if($_SESSION['$achive']== 'PP')
{
 $level = $_POST["level"];  
 $prest = $_POST["prest"];
 $ppprg = $_POST["ppprg"];
 $pptitle = $_POST["pptitle"]; 
$insname = $_POST["insname"];
 $ppdate = $_POST["ppdate"];
if(isset($_FILES['ppcer']))
  {
      $file_name = $_FILES['ppcer']['name'];
      $file_size = $_FILES['ppcer']['size'];
      $file_tmp = $_FILES['ppcer']['tmp_name'];
      $file_type = $_FILES['ppcer']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['ppcer']['name'])));
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
          $ppcer="upload/".$sid."PPcer".$ppdate.".".$file_ext;
	    rename("upload/".$file_name,$ppcer);
      }
   } 
if(isset($_FILES['pppaper']))
  {
      $file_name = $_FILES['pppaper']['name'];
      $file_size = $_FILES['pppaper']['size'];
      $file_tmp = $_FILES['pppaper']['tmp_name'];
      $file_type = $_FILES['pppaper']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['pppaper']['name'])));
      $expensions= array("doc","docx");
	if(in_array($file_ext,$expensions)=== false)
      {
         $_SESSION['error']="extension not allowed, please choose a doc or docx file.";
      }      
      if($file_size > 2097152) 
      {
         $_SESSION['error']='File size must be excately 2 MB';
      }      
      else
      {
          move_uploaded_file($file_tmp,"upload/".$file_name);
          $pppaper="upload/".$sid."PPpap".$ppdate.".".$file_ext;
	    rename("upload/".$file_name,$pppaper);
      }
   }               
$ppdate=date_create($ppdate);
      $ppdate=date_format($ppdate,"Y-m-d");
      $SQL = "insert into staffpp values('$sid','$level','$prest','$ppprg','$pptitle','$insname','$ppdate','$ppcer','$pppaper')";
  
$result = mysql_query($SQL);
}
if($_SESSION['$achive']== 'Workshop')
{
 $event = $_POST["event"];  
 $wname = $_POST["wname"];
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
          $wscer="upload/".$sid."WScer".$sdate.".".$file_ext;
	    rename("upload/".$file_name,$wscer);
      }
   }
      $sdate=date_create($sdate);
      $sdate=date_format($sdate,"Y-m-d");
 $edate=date_create($edate);
      $edate=date_format($edate,"Y-m-d");
      $SQL = "insert into staffworkshop values('$sid','$event','$wname','$wsins','$sdate','$edate','$wscer')";
      print $SQL; 
$result = mysql_query($SQL);
}
if($_SESSION['$achive']== '100%Result')
{
  $ccode = $_POST["ccode"];
 $cname = $_POST["cname"];
 $year = $_POST["year"]; 
$sem = $_POST["sem"];
       $SQL = "insert into staffresult values('$sid','$ccode','$cname','$year','$sem')";
   
$result = mysql_query($SQL);
}
if($_SESSION['$achive']== 'Research')
{
 $mtype = $_POST["mtype"];  
 $protitle = $_POST["protitle"];
$sdate = $_POST["sdate"];
$agency = $_POST["agency"];
 $pstatus = $_POST["pstatus"];
 $fund = $_POST["fund"]; 
$datecom= $_POST["datecom"];
$sdate=date_create($sdate);
      $sdate=date_format($sdate,"Y-m-d");
    $datecom=date_create($datecom);
       $datecom=date_format($datecom,"Y-m-d");
       $SQL = "insert into staffresearch values('$sid','$mtype','$protitle','$sdate','$agency','$pstatus','$fund','$datecom')";
  
$result = mysql_query($SQL);
}
} 
$_SESSION['stfachiv'] = "Record Saved Successfully";    
header("location: stfahivement.php");
?>