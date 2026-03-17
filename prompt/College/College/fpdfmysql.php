<?php
//SHOW A DATABASE ON A PDF FILE
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');

//Connect to your database
include_once 'database.php';

//Select the Products you want to show in your PDF file
$result=mysql_query("select * from workdiary");
$number_of_products = mysql_numrows($result);
if($result == false)
{
   echo mysql_error();
    exit();
}


//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_del_date = "";
$column_dep = "";
$pdf=new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 25;
//Table position, under Fields Name
$Y_Table_Position = 29;
$Y_Table_Position = 29;
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(0);
$pdf->Cell(20,6,'SID',1,0,'L',1);
$pdf->SetX(15);
$pdf->Cell(100,6,'DATE',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(60,6,'CLASS',1,0,'L',1);
$pdf->SetY($Y_Table_Position);
//For each row, add the field to the corresponding column
$i=20;
while($row = mysql_fetch_array($result))
{
	$sid = $row["SID"];
	$name = substr($row["DATE"],0,20);
	$del_date = substr($row["Class"],0,20);


	//$column_code = $column_code.$code."\n";
	//$column_name = $column_name.$name."\n";
    $pdf->SetX(0);
    $pdf->Cell(20,6,$sid,1,0,'L',1);
    //$pdf->SetY($Y_Table_Position);
    $pdf->SetX(15);
    $pdf->Cell(100,6,$name,1,0,'L',1);
	 $pdf->SetX(85);
    $pdf->Cell(150,6,$del_date,1,0,'L',1);
	 $pdf->SetX(100);
    
	$pdf->Ln();
    $pdf->SetX(135);	
	//$i=$i+20;
}
mysql_close();

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.


//Create a new PDF file

//Now show the 3 columns
$i = 0;
//$pdf->SetY($Y_Table_Position);
/*while ($i < 5)
{
$pdf->SetFont('Arial','',14);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_code,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_name,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$i=$i+1;
}
//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
//$i = 0;
/*$pdf->SetY($Y_Table_Position);
while ($i < $column_name)
{
	$pdf->SetX(45);
	$pdf->Cell(120,6,'$column_name',1);
	$i = $i +1;
}*/

$pdf->Output();
?>
