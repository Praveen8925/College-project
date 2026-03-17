<?PHP
  session_start();
  include_once 'Database.php';
  $name = $_POST["name"];  
  $sid = $_POST["sid"];
  $depart = $_POST["depart"];
  $qual= $_POST["qual"];
  $desigtn = $_POST["desigtn"];
  $dob = $_POST["dob"];
  $address = $_POST["address"];
  $mno= $_POST["mno"];
  $email = $_POST["email"];
  $jdate = $_POST["date"];
  $ugexpy= $_POST["ugexpy"];
  $ugexpm= $_POST["ugexpm"];
  $pgexpm= $_POST["pgexpm"];
  $pgexpy= $_POST["pgexpy"];
  $iexpm= $_POST["iexpm"];
  $iexpy= $_POST["iexpy"];
  $domain = $_POST["domain"];
  $ugexp=$ugexpy."-".$ugexpm;
  $pgexp=$pgexpy."-".$pgexpm;
  $iexp=$iexpy."-".$iexpm;
     $StfPho=$_SESSION['StfPho'];
    $Stfsig=$_SESSION['Stfsig']; 
      if($StfPho=="" and $_FILES['stfph']['name']=="" )
        $stfphoto="";
      else if($StfPho<>"" and $_FILES['stfph']['name']=="" ) 
        {
         $stfphoto=$StfPho;
         }
      else 
       {
        if( $_FILES['stfph']['name']<>"" and $StfPho<>"" )
         {
        $tl=strlen($StfPho);
       $pn="upload/".$sid."Photo";
        $fl=strlen($pn);
        $StfPho11 = explode(".",$StfPho);
         $stfpname =$StfPho11[0];
          $stfpext =$StfPho11[1];
          $ll=strlen($stfpext);
           $ss=$tl-$fl-$ll-1;
           $a=substr($StfPho,$fl,$ss);$a++;
           }
          else if($_FILES['stfph']['name']<>"" and $StfPho=="")
            $a=0;
  if(isset($_FILES['stfph']))
  {
      $file_name = $_FILES['stfph']['name'];
       
      $file_size = $_FILES['stfph']['size'];
      $file_tmp = $_FILES['stfph']['tmp_name'];
      $file_type = $_FILES['stfph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['stfph']['name'])));
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
          $stfphoto="upload/".$sid."Photo".$a.".".$file_ext;
	    rename("upload/".$file_name,$stfphoto);
      }
   } 
 
 }
      if($Stfsig=="" and $_FILES['stfsgn']['name']=="" )
        $stfsign="";
      else if($StfPho<>"" and $_FILES['stfsgn']['name']=="" ) 
        {
         $stfsign=$Stfsig;
         }
      else 
       {
        if( $_FILES['stfsgn']['name']<>"" and $Stfsig<>"" )
         {
        $stl=strlen($Stfsig);
       $spn="upload/".$sid."Photo";
        $sfl=strlen($spn);
        $Stfsig11 = explode(".",$Stfsig);
         $sstfpname =$Stfsig11[0];
          $sstfpext =$Stfsig11[1];
          $sll=strlen($sstfpext);
           $sss=$stl-$sfl-$sll-1;
           $sa=substr($StfPho,$fl,$sss);$sa++;
           }
          else if($_FILES['stfsgn']['name']<>"" and $Stfsig=="")
            $sa=0;
  if(isset($_FILES['stfsgn']))
  {
      $file_name = $_FILES['stfsgn']['name'];
      $file_size = $_FILES['stfsgn']['size'];
      $file_tmp = $_FILES['stfsgn']['tmp_name'];
      $file_type = $_FILES['stfsgn']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['stfsgn']['name'])));
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
           $stfsign="upload/".$sid."Sign".$sa.".".$file_ext;
	     rename("upload/".$file_name,$stfsign);
      }
   } 
}
  $rs=mysql_query("select * from staffdetail where SID='$sid' ");
  if (mysql_num_rows($rs)==0)
  {
      $dob=date_create($dob);
      $dob=date_format($dob,"Y-m-d");
      $jdate=date_create($jdate);
      $jdate=date_format($jdate,"Y-m-d");
      $SQL = "insert into staffdetail values('$sid','$qual','$dob','$address','$mno','$jdate','$ugexp','$pgexp','$iexp','$domain','$stfphoto','$stfsign')";
      $result = mysql_query($SQL);
      	
  }
  else
  {
      $dob=date_create($dob);
      $dob=date_format($dob,"Y-m-d");
      $jdate=date_create($jdate);
      $jdate=date_format($jdate,"Y-m-d");
      $SQL = "update staffdetail set Qualification='$qual',DOB='$dob',Address='$address',Mobileno='$mno',DOJ='$jdate',UGExp='$ugexp',PGExp='$pgexp',Domain='$domain',Industryexp='$iexp',StaffPhoto='$stfphoto',staffsign='$stfsign' where SID='$sid'";      
      print $SQL;
      $result = mysql_query($SQL); 
  }
  header("location: StaffDetail.php");
?>