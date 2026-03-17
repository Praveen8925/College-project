<?php
          session_start();	
	  include_once 'database.php';
          
          $dept=$_SESSION['$dept'];
          $fdate=$_SESSION['$fdate'] ;
          $tdate=$_SESSION['$tdate'] ;
           if($dept=='Select')
            {
	  $SQL="SELECT * FROM staffworkshop,addstaff where staffworkshop.SID=addstaff.SID  AND Sdate >= '$fdate' AND Sdate <= '$tdate'  ";
	  $result = mysql_query($SQL);
             }
          else
            {
          $SQL="SELECT * FROM staffworkshop,addstaff where staffworkshop.SID=addstaff.SID AND addstaff.Department='$dept' AND Sdate >= '$fdate' AND Sdate <= '$tdate'";
	  $result = mysql_query($SQL);
            }
        
          $filename = "workshop.$fdate.to.$tdate";
	  $file_ending = "xls";
	  header("Content-Type: application/xls");    
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	 
                 echo "SI.No\tSID \t Name \t Department \t Event \t Program Name \t Institution Name\t Date \t No.Of.Days \t";
                 
             
	  print("\n");    
              $i=1;
      while($row =mysql_fetch_assoc($result))
      {
       
                                         $date1=$row["Sdate"];
                                         $date2=$row["Edate"];
                                           $date1=date_create($date1);
                                          $date1=date_format($date1,"d-m-Y");
                                          $date2=date_create($date2);
                                          $date2=date_format($date2,"d-m-Y");
                                         $difference=$date2-$date1;
                                          $difference=$difference+1;
        $schema_insert = "";
        print "$i\t".$row["SID"]."\t".$row["Name"]."\t".$row["Department"]."\t".$row["Event"]."\t".$row["Program Name"]."\t".$row["Institution Name"]."\t".$date1."\t$difference\t";
       
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
      }
  

	    
?>