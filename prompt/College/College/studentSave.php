<?PHP
  session_start();
  include_once 'Database.php';
  $studid = $_POST["studid"];$_SESSION['sstudid']=$studid; 
  $name = $_POST["name"];  
  $course = $_POST["course"];
  $email = $_POST["email"];  
$aadharno=$_POST["aadharno"];  
  $dob = $_POST["dob"];                 
    $pname = $_POST["pname"];
  $occupation = $_POST["occupation"];
  $address = $_POST["address"];
  $pcode = $_POST["pcode"];
  $pmno= $_POST["pmno"];
  $mno= $_POST["mno"];
    $adate = $_POST["admdate"];
  $admno= $_POST["admno"];
  $nation= $_POST["nation"];
  $community= $_POST["community"];
  $caste = $_POST["caste"];
  $gen= $_POST["gen"];
  $bg= $_POST["bg"]; 
  $tenmark= $_POST["tenmark"];
  $tmark= $_POST["tmark"];
  $studph= $_FILES['studph'];
$Studphoto=$_SESSION['Studphoto'];
    
      if($Studphoto=="" and $_FILES['studph']['name']=="" )
        $studph="";
      else if($Studphoto<>"" and $_FILES['studph']['name']=="" ) 
        {
         $studph=$Studphoto;
         }
      else 
       {
        if( $_FILES['studph']['name']<>"" and $Studphoto<>"" )
         {
        $tl=strlen($Studphoto);
       $pn="upload/".$studid."Photo";
        $fl=strlen($pn);
        $Studphoto11 = explode(".",$Studphoto);
         $studpname =$Studphoto11[0];
          $studpext =$Studphoto11[1];
          $ll=strlen($studpext);
           $ss=$tl-$fl-$ll-1;
           $a=substr($Studphoto,$fl,$ss);$a++;
           }
          else if($_FILES['studph']['name']<>"" and $Studphoto=="")
            $a=0;
if(isset($_FILES['studph']))
  {
      $file_name = $_FILES['studph']['name'];
      $file_size = $_FILES['studph']['size'];
      $file_tmp = $_FILES['studph']['tmp_name'];
      $file_type = $_FILES['studph']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['studph']['name'])));
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
          $studph="upload/".$studid."Photo".$a.".".$file_ext;
	    rename("upload/".$file_name,$studph);
      }
   }
}
$rs=mysql_query("select * from studentpersonal where Regno='$studid' ");
  if (mysql_num_rows($rs)==0)
  {
      $dob=date_create($dob);
      $dob=date_format($dob,"Y-m-d");
              $SQL = "insert into studentpersonal values('$studid','$name','$dob','$pname','$occupation','$address','$pcode','$pmno','$mno','$adate','$admno','$email','$nation','$community','$caste','$gen','$bg','$tenmark','$tmark','$studph','$aadharno')";
              $result = mysql_query($SQL); 
               $_SESSION['student'] = "Record Saved Successfully";                	
  }
  else
  {
$dob=date_create($dob);
      $dob=date_format($dob,"Y-m-d");
     $SQL = "update studentpersonal set Dob='$dob',Parentsname='$pname',Occupation='$occupation',Address='$address',Pincode='$pcode',Pmobileno='$pmno',Mobileno='$mno',AdmissionDate='$adate',AdmissionNo='$admno',Emailid='$email',Nationality='$nation',Community='$community',Caste= '$caste',Gender='$gen',Bgroup='$bg',TenthMark='$tenmark',TwelvethMark='$tmark',StudentPhoto='$studph',aadharno='$aadharno' where Regno='$studid'";      
      $result = mysql_query($SQL);// print $SQL;
      $_SESSION['student'] = "Record Updated Successfully";
  }
  header("location: StudentOperation.php");
?>