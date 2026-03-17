<?PHP
  session_start();
  include_once 'Database.php';
 $batch = $_POST["batch"];
 $dept = $_POST["dept"];
 $sem = $_POST["sem"];
 $courseid = $_POST["courseid"];
$courseid=strtoupper($courseid);
$coursename = $_POST["coursename"];
$coursename=strtoupper($coursename);
$type = $_POST["tp"];
$SQL= "select * from sixthhour where Batch='$batch' and sem='$sem' and Programme_Name='$dept' order by CourseID asc" ;
 $rs=mysql_query($SQL);
     $db_field=mysql_fetch_assoc($rs);
     $decided=$db_field['decided'];print $decided;
      print mysql_num_rows($rs);
     if($decided=='y' or mysql_num_rows($rs)==0)
         {

 $rs=mysql_query("select * from  sixthhour where CourseID='$courseid'");
 if (mysql_num_rows($rs)>0)
  {
	$_SESSION['subject'] = "Course Name Alredy Exist <br> Record Not Saved";
  }
  else
  {    
    mysql_query("insert into sixthhour values('$batch','$sem','$dept','$courseid','$coursename','$type','$d')") or die(mysql_error());
    $_SESSION['subject'] = "Record Saved Successfully";
  }
   }
   else
     $_SESSION['subject'] = " Record Not Saved <br>This Semister was finalized";
  header("location: sixthhoursubject.php");
?>