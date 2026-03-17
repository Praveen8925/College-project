<?PHP
  session_start();
  include_once 'Database.php';

 $bname = $_POST["bname"];
 $sform = $_POST["sform"];
 $btype = $_POST["btype"];
$SQL="select * from  otherdept where Department='$bname' or Shortform='$sform'";
$rs=mysql_query($SQL);
if (mysql_num_rows($rs)>0)
  {
	$_SESSION['otherdept'] = "Course Name or Department Alredy Exist <br> Record Not Saved";
  }
  else
  {    
    mysql_query("insert into otherdept values('$bname','$btype','$sform')");
    $_SESSION['otherdept'] = "Record Saved Successfully";
  }
  header("location: otherdept.php");
?>