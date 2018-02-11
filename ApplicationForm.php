<?php
	//call the FPDF library
	require('includes/fpdf181/fpdf.php');

	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	//create pdf object
	$pdf = new FPDF('P','mm','A4');
	//add new page
	$pdf->AddPage();
	
	$pdf->Image('images/logo.jpg',10,5,33,25);
	$pdf->SetX(43);
	$pdf->SetFont('Times','B',18);

	//Cell(width , height , text , border , end line , [align] )

	$pdf->Cell(130 ,5,'INSTITUTE OF APPLIED SCIENCE',0,1);
	
	$pdf->SetXY(43,17);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(130 ,5,'CORPORTE OFFICE - 67B, Maharaja Thakur Road, Dhakuria, Kol- 700031',0,1);
	$pdf->SetXY(43,23);
	$pdf->Cell(130 ,5,'Mob - +91 891-046-2774, Email - corporateoffice_ias@gmail.com ',0,1);
	$pdf->Line(0, 32, 600, 32);
	$pdf->SetY(40);
	
	$pdf->SetFont('Arial','UB',12);
	$pdf->Cell(0 ,5,'STUDENT ENROLLMENT FORM',0,1,'C');
	$pdf->Image('images/profile.jpg',165,50,35,43);
	
	$pdf->SetY(55);
	//NAME	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(60 ,5,'AKASH ROY',0,1);
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60 ,5,'(Full name of the student)',0,1);
	
	//DOB
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(50 ,10,'20 Jan 1997',0,0);
	$pdf->Cell(50 ,10,'Male',0,0);
	$pdf->Cell(50 ,10,'GEN',0,1);
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50 ,0,'(Date of Birth)',0,0);
	$pdf->Cell(50 ,0,'(Gender)',0,0);
	$pdf->Cell(50 ,0,'(Category)',0,1);
	//output the result
	$pdf->Output();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	