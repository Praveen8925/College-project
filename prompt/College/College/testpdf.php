<?php
require('fpdf.php');
          session_start();	
	  include_once 'database.php';
          $SQL= "select * from workdiary ";
	  $r= mysql_query($SQL);
           
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
 while($row =mysql_fetch_assoc($r))
        {
$pdf->MultiCell(40,10,$row['SID']);
$pdf->MultiCell(40,10,$row['DATE']);
        }

$pdf->Output();
?>