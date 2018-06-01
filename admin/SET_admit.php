<?php
	//call the FPDF library
	require('../includes/fpdf181/fpdf.php');
	include '../includes/dbh.inc.php';
	
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	
	$query="select * from sett where id='$id'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);


	if($row['set_finalExam']==01){
		$c='CLASS VIII pass out';
	}
	elseif($row['set_finalExam']==02){
		$c='CLASS IX pass out';
	}
	elseif($row['set_finalExam']==03){
		$c='CLASS X pass out';
	}
	elseif($row['set_finalExam']==04){
		$c='CLASS XI pass out';
	}
	else{
		$c='CLASS XII pass out';
	}

	if($row['set_center']==01){
		$cn="IAS Kolkata Centre";
		$cn1="67 B, Maharaja Thakur Road";
		$cn2="Dhakuria, Kolkata-700031";
		$cn3="Beside Modern Academy School";
	}
	elseif($row['set_center']==02){
		
		$cn='IAS Howrah Centre';
		$cn1="2/2/2 Tarapada Chatterjee Lane";
		$cn2="Howrah - 711103";
		$cn3="Near Nabanna Bus Stand, Beside PNB ATM";
	}	
	else{
		$cn="IAS Berhampore Centre";
		$cn1="3rd Floor";
        $cn2="Municipal Market Complex";
		$cn3="Ranibagan More Crossing, Berhampore";
	}

    //create pdf object
	$pdf = new FPDF('P','mm','A4');
	//add new page
	$pdf->AddPage();

	//header
	$pdf->SetFont('Times','B',20);
	$pdf->SetFillColor(16,74,91);
	$pdf->SetTextColor(255,255,255);
	$pdf->setX(20);
	$pdf->Cell(170 ,15,'IAS-SET 2018 (1) ADMITCARD',1,1,'C',TRUE);
	
	$pdf->Rect(20 ,25,170,150);

	$pdf->SetXY(40,35);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Examination Date:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$row['set_dateAssigned'],0,0);

	//time
	$pdf->SetXY(40,47);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Examination Time:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$row['set_timeAssigned'],0,0);


	//App no
	$pdf->SetXY(40,59);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Application Number:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$row['set_applicationNo'],0,0);


	//Roll no
	$pdf->SetXY(40,71);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Roll Number:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$row['set_rollNo'],0,0);


	//name
	$pdf->SetXY(40,83);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Name:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$row['set_name'],0,0);


	//standard
	$pdf->SetXY(40,95);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Examination Standard:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$c,0,0);


	//center
	$pdf->SetXY(40,107);
	$pdf->SetFont('Times','',14);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,'Examination Center:',0,0);
	$pdf->SetX(105);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(65 ,12,$cn,0,0);
	$pdf->SetXY(105,115);
	$pdf->Cell(65 ,9,$cn1,0,0);
	$pdf->SetXY(105,122);
	$pdf->Cell(65 ,9,$cn2,0,0);
	$pdf->SetXY(105,129);
	$pdf->Cell(65 ,9,$cn3,0,0);

	//sign
	$pdf->Image('../images/sign.jpg',40,130,35,20);
	$pdf->SetXY(42,144);
	$pdf->Cell(65 ,9,'Kaulin Pal',0,0);
	$pdf->SetXY(42,151);
	$pdf->Cell(65 ,9,'Executive Counseller',0,0);
	$pdf->SetXY(42,157);
	$pdf->Cell(65 ,9,'Institute of Applied Science',0,0);

	//nstructions
	$pdf->Rect(20 ,179,170,75);
	$pdf->SetXY(20,179);
	$pdf->SetFont('Times','B',14);
	$pdf->Cell(170 ,10,'Instructions to Candidates',0,0,'C');

	$pdf->SetXY(20,191);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(5, 5, '1.', 0, 0, 'L');
	$pdf->SetXY(25,191);
	$pdf->multiCell(166, 5, 'A printed copy of this Admit Card must be presented for the verification along with at least one original (Not photocopy or scanned copy) valid photo identification proof (For example: Voter Id, Adhaar-UID, PAN Card, Driving License, School/ College Id)', 0, 'L', false);

	$pdf->SetXY(20,208);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(5, 5, '2.', 0, 0, 'L');
	$pdf->SetXY(25,208);
	$pdf->multiCell(166, 5, 'The candidates are advised to report the examination venue at least 30 minutes before the scheduled commencement of the examination.', 0, 'L', false);

	$pdf->SetXY(20,220);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(5, 5, '3.', 0, 0, 'L');
	$pdf->SetXY(25,220);
	$pdf->multiCell(166, 5, 'Mobile phones, Calculators or any kind of electronic communication devices are strictly prohibited inside the examination hall.', 0, 'L', false);

	$pdf->SetXY(20,232);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(5, 5, '4.', 0, 0, 'L');
	$pdf->SetXY(25,232);
	$pdf->multiCell(166, 5, 'Candidates will not be permitted to enter the examination hall after 30 minutes from the scheduled starting of the examination.', 0, 'L', false);

	$pdf->SetXY(20,244);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(5, 5, '5.', 0, 0, 'L');
	$pdf->SetXY(25,244);
	$pdf->multiCell(166, 5, 'Candidate should not bring any type of paper/ chart/ table into the examination hall.', 0, 'L', false);

	$pdf->SetFillColor(16,74,91);
	$pdf->Rect(20 ,260,170,21,'F');

	//footer
	$pdf->Image('../images/logo.jpg',25,263,25,15);

	$pdf->SetXY(56,265);
	$pdf->SetFont('Times','',24);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Times','B',28);
	$pdf->Cell(1 ,5,'I',0,0);
	$pdf->SetFont('Times','B',20);
	$pdf->SetXY(59,266);
	$pdf->Cell(1 ,5,'NSTITUTE',0,0);
	$pdf->SetXY(98,266);
	$pdf->Cell(1 ,5,'OF',0,0);
	$pdf->SetXY(111,265);
	$pdf->SetFont('Times','B',28);
	$pdf->Cell(1 ,5,'A',0,0);
	$pdf->SetXY(117,266);
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(1 ,5,'PPLIED',0,0);
	$pdf->SetXY(147,265);
	$pdf->SetFont('Times','B',28);
	$pdf->Cell(1 ,5,'S',0,0);
	$pdf->SetXY(152.5,266);
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(1 ,5,'CIENCE',0,0);

	$pdf->SetXY(83.8,271.8);
	$pdf->SetFont('Times','B',16);
	$pdf->SetTextColor(102,178,204);
	$pdf->Cell(1 ,5,'NEET-UG | IIT-JEE | FOUNDATIONS',0,0);

	$pdf->Output();