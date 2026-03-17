<?PHP
  session_start();
  include_once 'Database.php';
  $event = $_POST["eve"];
  print "select * from Events where EventsMsg='$event'";
  $rs=mysql_query("select * from Events where EventsMsg='$event'");
  print mysql_num_rows($rs);
  if (mysql_num_rows($rs)>0)
  {
	$_SESSION['Event'] = "Event Alredy Exist <br> Record Not Saved";
  }
  else
  {
        mysql_query("insert into Events values ('','$event')") or die(mysql_error());
        $_SESSION['Event'] = "Record Saved Successfully";
  }
  header("location: EventsAdd.php");
?>