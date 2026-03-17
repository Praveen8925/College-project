<?php
require('fpdf.php');
include_once 'database.php';
session_start();	
	  include_once 'database.php';
          $batch=$_SESSION['$batch'];
          $dept=$_SESSION['$dept'];
          $sem=$_SESSION['$sem'];
         // $tablename=$_SESSION['$tablename'];
          $cid=$_SESSION['$cid'];
          $icid=$_SESSION['$icid'];
          $a=$_SESSION['$a'];

                                     $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);

                            
                       $SQL= "select * from subjectdetails where Batch='$batch' and sem='$sem' and Programme_Name='$dept' and TRIM(CourseID)='$cid'" ;
                       $rs=mysql_query($SQL);
                       $db_field=mysql_fetch_assoc($rs); 
                       $totmark=$db_field['Total_Mark'];
                       $type=$db_field['Type'];
                       $cname=$db_field['Course_Name'];
                       $totmark = explode("-",$totmark); 
                       $emark=$totmark[0];
                       $ic1mark=$totmark[1];
                       $ic2mark=$totmark[2];
                       $immark=$totmark[3];
                        $iassmark=$totmark[4];
                       $iattmark=$totmark[5];
                       $totint=$ic1mark+$ic2mark+$immark+$iassmark+$iattmark;

$w=strlen('Cycle Test II');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->multiCell(10,15,$w,1,0,'C',1);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(15,$w,'SI.No',1,0,'C',1);
$pdf->setxy($x+5,$y);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(10,$w,'Reg No',1,0,'C',1);
$pdf->setxy($x+15,$y);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(15,$w,'Name',1,0,'C',1);
$pdf->setxy($x+25,$y);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(35,$w,'Cycle Test I',1,0,'C',1);
$pdf->setxy($x+35,$y);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(45,$w,'Cycle Test II',1,0,'C',1);
$pdf->setxy($x+45,$y);
$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->multiCell(50,$w,'Model Exam',1,0,'C',1);
//$pdf->Cell(50,7,'REMARK',1,0,'C',1);
//$pdf->Cell(50,7,'REMARK',1,0,'C',1);
$pdf->Ln();




mysql_close();
$pdf->Output();
?>
