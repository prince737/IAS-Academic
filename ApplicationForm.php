<?php
	//call the FPDF library
	require('includes/fpdf181/fpdf.php');
	include 'includes/dbh.inc.php';
	
	$id = mysqli_real_escape_string($conn, $_GET['sid']);
	
	$query="select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id INNER JOIN centers on centers.center_id=students_courses.center_id where stu_id=$id";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);

	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	//create pdf object
	$pdf = new FPDF('P','mm','A4');
	//add new page
	$pdf->AddPage();
	
	//NAME OF INSTITUTE
	$pdf->Image('images/logo.jpg',10,5,33,25);
	$pdf->SetX(43);
	$pdf->SetFont('Times','B',22);
	$pdf->Cell(1 ,5,'I',0,0);
	$pdf->SetFont('Times','B',16);
	$pdf->SetXY(45.7,10.5);
	$pdf->Cell(1 ,5,'NSTITUTE',0,0);
	$pdf->SetXY(78,10.5);
	$pdf->Cell(1 ,5,'OF',0,0);
	$pdf->SetXY(89,10);
	$pdf->SetFont('Times','B',22);
	$pdf->Cell(1 ,5,'A',0,0);
	$pdf->SetXY(94.6,10.5);
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(1 ,5,'PPLIED',0,0);
	$pdf->SetXY(118,10);
	$pdf->SetFont('Times','B',22);
	$pdf->Cell(1 ,5,'S',0,0);
	$pdf->SetXY(122.3,10.5);
	$pdf->SetFont('Times','B',16);
	$pdf->Cell(1 ,5,'CIENCE',0,0);
	
	//ADDRESS
	$pdf->SetXY(43,17);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(130 ,5,'CORPORTE OFFICE - 67B, Maharaja Thakur Road, Dhakuria, Kol- 700031',0,1);
	$pdf->SetXY(43,23);
	$pdf->Cell(130 ,5,'Mob - +91 891-046-2774, Email - corporateoffice_ias@gmail.com ',0,1);
	$pdf->Line(7, 32, 202, 32);
	$pdf->SetY(40);
	
	$pdf->SetFont('Arial','UB',12);
	$pdf->Cell(0 ,5,'STUDENT ENROLLMENT FORM',0,1,'C');
	//$pdf->Image($row['stu_imageLocation'],165,50,35,40);
	
	$pdf->SetY(55);
	//NAME	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(100 ,5,$row['stu_name'],0,0);
	$pdf->Cell(50 ,5,$row['stu_gender'],0,1);
	
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(100 ,5,'(Full name of the student)',0,0);
	$pdf->Cell(50 ,5,'(Gender)',0,1);
	
	//Date Formatting
	$date = $row['stu_dob'];
	$date = date("d-m-Y", strtotime($date));
	
	//ROW 2
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(50 ,10,$date,0,0);
	$pdf->Cell(50 ,10,$row['stu_religion'],0,0);
	$pdf->Cell(50 ,10,$row['stu_category'],0,1);
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50 ,0,'(Date of Birth)',0,0);
	$pdf->Cell(50 ,0,'(Religion)',0,0);
	$pdf->Cell(50 ,0,'(Category)',0,1);
	
	//ROW 3
	$pdf->SetY(78);
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(50 ,10,$row['stu_contact'],0,0);
	$pdf->Cell(50 ,10,$row['stu_gurdianname'],0,0);
	$pdf->Cell(50 ,10,$row['stu_gurdiancontact'],0,1);
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50 ,0,'(Student\'s Contact)',0,0);
	$pdf->Cell(50 ,0,'(Guardian\'s Name)',0,0);
	$pdf->Cell(50 ,0,'(Guardian\'s Contact)',0,1);
	
	//END oF GENERAL
	$pdf->Line(7, 95, 202, 95);
	$pdf->Ln(10);
	
	//ADDRESS FORMATTING
	$addr = preg_replace('/(.*), (.*), /', "$1,$2\n", $row['stu_street']);
	
	//LEFT COLUMN
	$pdf->SetFont('Times','BI',14);
	$pdf->Cell(50 ,10,'Communication Address',0,1);
	$pdf->SetX(15);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(80 ,5,$row['stu_street'],0,1);
	$pdf->SetX(15);
	$pdf->Cell(50 ,5,$row['stu_city'],0,1);
	$pdf->SetX(15);
	$pdf->Cell(50 ,5,'PIN- '.$row['stu_pin'],0,1);
	$pdf->SetX(15);
	$pdf->Cell(50 ,5,$row['stu_state'],0,1);
	$pdf->SetX(15);
	$pdf->Cell(50 ,5,'johndoe@example.com ',0,1);
	
	$pdf->SetFont('Times','BI',14);
	$pdf->Cell(50 ,10,'Qualification Details',0,1);
	if($row['stu_highestdegree']=='Class X'){
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_highestdegree'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_university'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_currentinstitute'],0,1);
	}
	elseif($row['stu_highestdegree']=='Class XI' || $row['stu_highestdegree']=='Class XII'){
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_highestdegree'],0,1);
		$pdf->SetX(15);
		$pdf->MultiCell(80 ,5,'Subjects- '.$row['stu_subjectCombo'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_university'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_currentinstitute'],0,1);
	}
	elseif($row['stu_highestdegree']=='Btech' || $row['stu_highestdegree']=='Mtech'){
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_highestdegree'].', '.$row['stu_dept'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,'(Expected) Year of Pass- '.$row['stu_yearofpass'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_university'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_currentinstitute'],0,1);
	}
	elseif($row['stu_highestdegree']=='Other'){
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_highestdegree'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_university'],0,1);
		$pdf->SetX(15);
		$pdf->Cell(50 ,5,$row['stu_currentinstitute'],0,1);
	}
	
	
	
	//RIGHT COLUMN
	$pdf->SetXY(107,98);
	
	$pdf->SetFont('Times','BI',14);
	$pdf->Cell(50 ,10,'Academic Details',0,1);
	
	$pdf->SetFont('Arial','BI',16);
	$pdf->SetX(112);
	$pdf->Cell(50 ,15,$row['stu_roll'],1,1,'C');
	
	$pdf->Ln(4);

	$pdf->SetFont('Arial','BI',10);
	$pdf->SetX(112);
	$pdf->Cell(50 ,5,$row['registration_no'],0,1);
	$pdf->SetX(112);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(50 ,5,'(Registration Number)',0,1);
	
	$pdf->SetFont('Arial','BI',10);
	$pdf->SetX(112);
	$pdf->Cell(50 ,5,$row['course_type'].' ('.$row['course_name'].')',0,1);
	$pdf->SetX(112);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(50 ,5,'(Course Name)',0,1);
	
	
	
	$pdf->SetX(112);
	$pdf->SetFont('Arial','BI',10);
	$pdf->Cell(50 ,5,$row['center_name'],0,1);
	$pdf->SetX(112);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(50 ,5,'(Center Name)',0,1);
	
	
	$pdf->Line(7, 170, 202, 170);
	
	//DECLARATIONS
	$pdf->SetY(180);
	
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(183 ,5,'I hereby declare that Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',0,1);
	
	$pdf->Line(50, 232, 115, 232);
	
	$pdf->SetXY(50,235);
	$pdf->SetFont('Arial','BI',12);
	$pdf->Cell(50 ,5,'Student\'s Signature with Date',0,1);
	
	$pdf->Line(130, 232, 195, 232);
	
	$pdf->SetXY(130,235);
	$pdf->SetFont('Arial','BI',12);
	$pdf->Cell(50 ,5,'Guardian\'s Signature with Date',0,1);
	
	
	
	$pdf->SetXY(15,276.9);
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(50 ,0,'[ '.$row['stu_applicationId'].' ]',0,1);
	//output the result
	$pdf->Output();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	