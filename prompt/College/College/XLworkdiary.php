<?php
          require('fpdf.php');
          session_start();	
	  include_once 'database.php';
          $userid=$_SESSION['AU'];
          
          $fdate=$_SESSION['$wdfdate'] ;
          $tdate=$_SESSION['$wdtdate'] ;
            $fdate=date_create($fdate);
            $fdate=date_format($fdate,"y-m-d");
             $tdate=date_create($tdate);
             $tdate=date_format($tdate,"y-m-d");
             
          print "$userid"."Work Diary Report"." $fdate"."to"."$tdate"."\n";
	  $SQL= "select * from workdiary where SID='$userid' AND DATE >= '$fdate' AND DATE <= '$tdate'  ORDER BY DATE ASC,Hour ASC ";
	  $result = mysql_query($SQL);
                    
          $filename = "$userid";
	  $file_ending = "pdf";
	  header("Content-Type: application/pdf");    
	  header("Content-Disposition: attachment; filename=$filename.pdf");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	 
                 echo "SI.No\t DATE \t Class \t Hour \t Topic \t";
                 
             
	  print("\n");    
              $i=1;
      while($row =mysql_fetch_assoc($result))
        {
       
         $date=$row["DATE"];                             
         $date=date_create($date);
         $date=date_format($date,"d-m-Y");                                
        $schema_insert = "";
        print "$i\r".$date."\r".$row["Class"]."\r".$row["Hour"]."\r".$row["Topic"]."\r";
        #$schema_insert = str_replace($sep."$", "", $schema_insert);
        #$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
       }
  

	    
?>