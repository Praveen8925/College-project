    


<?php
include_once 'database.php';// for db conectivity
  $SQL= "select * from workdiary ";
	  $result = mysql_query($SQL);
    //$tablename="rentsum";
    //$sql = "Select empcode,ticket_no,ctgcode,empname,allot_dt,to_char(qtrno) qtrno,type,seccode,wt,lf,'0' arr ,CONSERV con,met_chg,'0' eu from $tablename where MONTH='$month' AND YEAR='$year' and type not in ('4','5','0') order by qtrno "; 
    //$result =oci_parse($conn,$sql);
    //oci_execute($result); 
    $filename="hrent.pdf";
header("Content-type: application/pdf");
header("Content-disposition: pdf" . "hh" . ".pdf");
//header("Content-disposition: attachment;filename=$filename");
while($row =mysql_fetch_assoc($result))
        {
         $empcode=$rowj['Class'];
    echo $empcode."\r\n";
         }
?>
