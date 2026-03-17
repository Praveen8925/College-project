<?PHP
  session_start();
 include_once 'Database.php';
 $batch = $_POST["batch"];  
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $subject = $_POST["cid"]; 
$icmdate = $_POST["icmdate"]; 
if(isset($_FILES['notes']))
  {
      $file_name = $_FILES['notes']['name'];
      $file_size = $_FILES['notes']['size'];
      $file_tmp = $_FILES['notes']['tmp_name'];
      $file_type = $_FILES['notes']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['notes']['name'])));
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
          $notes="upload/"."notes".$icmdate.".".$file_ext;
	    rename("upload/".$file_name,$notes);
      }
   } 
$SQL = "insert into notes values('$batch','$dept','$sem','$subject','$notes')";
print $SQL;       
$result = mysql_query($SQL);
 $_SESSION['addnotes'] = "Record Saved Successfully";    
header("location: addnotes.php");

?>