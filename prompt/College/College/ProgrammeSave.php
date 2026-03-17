<?PHP
  session_start();
  include_once 'Database.php';
  $cname = $_POST["cname"];
 $bname = $_POST["bname"];
 $sform = $_POST["sform"];
 $btype = $_POST["btype"];
$SQL="select * from  coursedetails where Programme='$cname' or Department='$bname' or Shortform='$sform'";
$rs=mysql_query($SQL);
if (mysql_num_rows($rs)>0)
  {
	$_SESSION['course'] = "Course Name or Department Alredy Exist <br> Record Not Saved";
  }
  else
  {    
    mysql_query("insert into coursedetails values('$cname','$bname','$btype','$sform')") or die(mysql_error());
    $_SESSION['course'] = "Record Saved Successfully";
  }
  header("location: ProgrammeDetail.php");
?>