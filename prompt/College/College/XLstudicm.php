<?php
          session_start();	
	  include_once 'database.php';
          
          $dept=$_SESSION['$dept'];
          $fdate=$_SESSION['$fdate'] ;
          $tdate=$_SESSION['$tdate'] ;
           if( $dept=='Select')
              {
            $SQL="SELECT * FROM studenticm,student where studenticm.RegNo=student.RegNo AND Date >= '$fdate' AND Date <= '$tdate' ";
            $result=mysql_query($SQL);
               }
            else
              {
             $SQL="SELECT * FROM studenticm,student where studenticm.RegNo=student.RegNo AND student.Department='$dept' AND Date >= '$fdate' AND Date <= '$tdate' ";
             $result=mysql_query($SQL);
              }
          $filename = "Inter_college_meet";
	  $file_ending = "xls";
	  header("Content-Type: application/xls");    
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	 
                 echo "SI.No\tReg_No \t Name \t Department \t Event \t Place \t Institution Name\t Date   ";
                 
             
	  print("\n");    
              $i=1;
      while($row =mysql_fetch_assoc($result))
      {
                                 $date=$row["Date"];
                                 $date=date_create($date);
                                 $date=date_format($date,"d-m-Y");
                                         
        $schema_insert = "";
        print "$i\t".$row["RegNo"]."\t".$row["Name"]."\t".$row["Department"]."\t".$row["Event_Name"]."\t".$row["Place"]."\t".$row["Institution_Name"]."\t".$date."\t";
       
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
      }
  

	    
?>