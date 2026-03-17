<?php
          session_start();	
	  include_once 'database.php';
          
          $dept=$_SESSION['$dept'];
          $fdate=$_SESSION['$fdate'] ;
          $tdate=$_SESSION['$tdate'] ;
           if($dept=='Select')
            {
	  $SQL="SELECT * FROM staffresult,addstaff where staffresult.SID=addstaff.SID  AND  staffresult.Year >=$fdate AND staffresult.Year <= '$tdate'";
	  $result = mysql_query($SQL);
             }
          else
            {
          $SQL="SELECT * FROM staffresult,addstaff where staffresult.SID=addstaff.SID AND addstaff.Department='$dept' AND  staffresult.Year >=$fdate AND staffresult.Year <= '$tdate'";
	  $result = mysql_query($SQL);
            }
        
          $filename = "100%result";
	  $file_ending = "xls";
	  header("Content-Type: application/xls");    
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	         echo "SREE SARASWATHI THYAGARAJA COLLEGE,(AUTONOMOUS)\n UG DEPARTMENT OF INFORMATION TECHNOLOGY\n STAFF ACHIEVEMENT LIST\n";
                 echo "SI.No\tSID \t Name \t Department \t Course Name \t Year \t Semester\t ";
                 
             
	  print("\n");    
              $i=1;
      while($row =mysql_fetch_assoc($result))
      {
        $schema_insert = "";
        print "$i\t".$row["SID"]."\t".$row["Name"]."\t".$row["Department"]."\t".$row["Course Name"]."\t".$row["Year"]."\t".$row["Semister"]."\t";
       
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
      }
  

	    
?>