<?php
          session_start();	
	  include_once 'database.php';
          
          $dept=$_SESSION['$dept'];
          $fdate=$_SESSION['$fdate'] ;
          $tdate=$_SESSION['$tdate'] ;
           if($dept=='Select')
            {
	  $SQL ="SELECT * FROM staffpp,addstaff where staffpp.SID=addstaff.SID  AND Date >= '$fdate' AND Date <= '$tdate'";
	  $result = mysql_query($SQL);
             }
          else
            {
          $SQL ="SELECT * FROM staffpp,addstaff where staffpp.SID=addstaff.SID AND addstaff.Department='$dept' AND Date >= '$fdate' AND Date <= '$tdate'";
	  $result = mysql_query($SQL);
            }
        
          $filename = "paper_presentation.$fdate.to.$tdate";
	  $file_ending = "xls";
	  header("Content-Type: application/xls");    
	  header("Content-Disposition: attachment; filename=$filename.xls");  
	  header("Pragma: no-cache"); 
	  header("Expires: 0");
          $sep = "\t";
             
	 
                 echo "S.No\tSID \t Name \t Department \t Level\t Presentation/Participation \t Program Name\t Title\t Institution Name\t Date\t";
                 
             /*for ($i = 0; $i < mysql_num_fields($result); $i++) 
	      {
		#echo mysql_field_name($result,$i) . "\t";
	      }*/
	  print("\n");    
              $i=1;
      while($row =mysql_fetch_assoc($result))
      {
       #mysql_fetch_row
        $schema_insert = "";
                                 $date=$row["Date"];
                                 $date=date_create($date);
                                 $date=date_format($date,"d-m-Y");
        print "$i\t".$row["SID"]."\t".$row["Name"]."\t".$row["Department"]."\t".$row["Level"]."\t".$row["Presentation_Participation"]."\t".$row["Program Name"]."\t".$row["Title"]."\t".$row["Institution Name"]."\t".$date."\t";
       /* for($j=0;$j<mysql_num_fields($result);$j++)
        {
           
           if(!isset($row[$j])) 
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
               
        }*/
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
        $i++;
    }
  

	    
?>