<?php
require('fpdf.php');
include_once 'database.php';
session_start();	
	  include_once 'database.php';
          $userid=$_SESSION['AU'];
          
          $fdate=$_SESSION['$wdfdate'] ;
          $tdate=$_SESSION['$wdtdate'] ;
            $fdate=date_create($fdate);
            $fdate=date_format($fdate,"y-m-d");
             $tdate=date_create($tdate);
             $tdate=date_format($tdate,"y-m-d");
$result=mysql_query("select * from workdiarys where SID='$userid' AND DATE >= '$fdate' AND DATE <= '$tdate'  ORDER BY DATE ASC,Hour ASC ");
$number_of_products = mysql_numrows($result);
if($result == false)
{
   echo mysql_error();
    exit();
}

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);


$pdf->Cell(25,7,'DATE',1,0,'C',1);

$pdf->Cell(25,7,'CLASS',1,0,'C',1);

$pdf->Cell(15,7,'HOUR',1,0,'C',1);

$pdf->Cell(35,7,'SUBJECT',1,0,'C',1);

$pdf->Cell(45,7,'TOPIC COVERED',1,0,'C',1);
$pdf->Cell(50,7,'REMARK',1,0,'C',1);
$pdf->Ln();


$i=1;
while($row=mysql_fetch_assoc($result))
{
    $date=$row["DATE"];
    $date=date_create($date);
    $date=date_format($date,"d-m-y"); 
                            $class = $row["Class"];
			
                            $topic=$row["Topic"];
                            $hour=$row["Hour"];
                 
                $pdf->Cell(25,6,$date,1,0,'L',1);
               //$pdf->Ln(10);
                 $pdf->Cell(25,6,$class,1,0,'L',1);
                
                 $pdf->Cell(15,6,$hour,1,0,'L',1);
 		/*$pdf->Cell(25,6,$date);
               $pdf->Ln();
                 $pdf->MultiCell(25,6,$class);
                
                 $pdf->MultiCell(15,6,$hour);*/
                 
                 
                 
                 $sub=$row["subject"];
                 $SQL= "select * from  subjectdetails where trim(CourseID)='$sub'" ;
                 $rm=mysql_query($SQL);
                  if(($r=mysql_num_rows($rm))>0)
                    {
                     $r=mysql_fetch_assoc($rm);
                     $course_name=$r["Course_Name"];
                     
                     $pdf->Cell(35,6,$course_name,1,0,'L',1);
                     }
                   else
                      {
                       
                       $pdf->Cell(35,6,$sub,1,0,'L',1);
                       }
                        $topic = $row["Topic"];
                            $remark= $row["Remark"];
                     
                       $pdf->Cell(45,6,$topic,1,0,'L',1);
                       
                       $pdf->Cell(50,6,$remark,1,0,'L',1);
                       $pdf->Ln();
    	                   }



mysql_close();
$pdf->Output();
?>
