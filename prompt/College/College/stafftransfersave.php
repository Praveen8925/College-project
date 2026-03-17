<?PHP
  session_start();
 include_once 'Database.php';

$sid=$_POST["sid"];
$dept=$_POST["dept"];
$transfer=$_POST["transfer"]; 
 $dt=date("d-m-Y");
$dt=date_create($dt);
 $dt=date_format($dt,"Y-m-d");
   
      $sql = "update addstaff set Department='$transfer' where SID='$sid'";
     mysql_query($sql);
      $SQL = "insert into stafftransfer values('$sid','$dept','$transfer','$dt')";
      $result = mysql_query($SQL);
      if($result==1)
      {
      $_SESSION['stafftransfer'] = "Record Saved Successfully";
      }
     else
       {
        $_SESSION['stafftransfer'] = "Record Not Saved";
        }
  
  header("location: stafftransfer.php");
?>