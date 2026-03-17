<?php
          session_start();	
	  include_once 'database.php';
          
          $dept=$_SESSION['$dept'];
          $fdate=$_SESSION['$fdate'] ;
          $tdate=$_SESSION['$tdate'] ;

           $fdate=date_create($fdate);
           			$fdate=date_format($fdate,"M-Y");
           			$tdate=date_create($tdate);
           			$tdate=date_format($tdate,"M-Y");
                             echo "\t\t\t\t"."Publication Report". $fdate."TO".$tdate."\t";
                              print "\n";  
                                $fdate="1-".$fdate;
                                $tdate="10-".$tdate;
                                $fdate=date_create($fdate);
           			$fdate=date_format($fdate,"Y-m-d");
           			$tdate=date_create($tdate);
           			$tdate=date_format($tdate,"Y-m-d");
   
           if( $dept=='Select')
               {
              $SQL="SELECT * FROM  staffpublication,addstaff where staffpublication.SID=addstaff.SID AND Issue >= '$fdate' AND Issue <= '$tdate' ";
              $rs=mysql_query($SQL);
               }
              else
              {
              $SQL="SELECT * FROM  staffpublication,addstaff where staffpublication.SID=addstaff.SID AND addstaff.Department='$dept' AND Issue >= '$fdate' AND Issue <= '$tdate' ";
              $rs=mysql_query($SQL);
               }
        
          $filename = "publication.$fdate.to.$tdate";
	  $file_ending = "xls";
	  header("Content-Type: application/xls");    
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	
                 echo "S.No  \t SID \t Name \t Department \t Type\t Title \t Journal_Proceeding Name\t ISBN/ISSN No\tImpact No\tVolume\tIssue\tPage No";
                 
             
	  print("\n");    
              $i=1;
     while($row=mysql_fetch_assoc($rs))
    	                  {
                                  $schema_insert = "";
                                  $issue=$row["Issue"];
                                  $issue=date_create($issue);
           			  $issue=date_format($issue,"M-Y");
                                  $pageno=$row['Page_No'];
                                  
                                  print "$i\t".$row["SID"]."\t".$row["Name"]."\t".$row["Department"]."\t".$row["jptype"]."\t".$row["Title"]."\t".$row["jpname"]."\t".$row["ISBN/ISSN_No"]."\t".$row["Impact_No"]."\t".$row["Volume"]."\t".$issue."\t".$pageno."\t";
                    
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
    }
  

	    
?>