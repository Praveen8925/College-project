<?PHP
  session_start();
  include_once 'Database.php';
  $achiev = $_POST["achiev"];
  //print "select * from achievement where Name='$achiev'";
  $rs=mysql_query("select * from achievement where Name='$achiev'");
  print mysql_num_rows($rs);
  if (mysql_num_rows($rs)>0)
  {
	$_SESSION['achievement'] = "Name Alredy Exist <br> Record Not Saved";
  }
  else
  {
        mysql_query("insert into achievement values ('$achiev')") or die(mysql_error());
        $_SESSION['achievement'] = "Record Saved Successfully";
  }
  header("location: achiveadd.php");
?>