<?php
	session_start();
	require_once('includes/dbh.inc.php');
	
?>	
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result Details | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/result_details.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>


	<?php
		//call the FPDF library
		require('includes/fpdf181/fpdf.php');
		include 'includes/dbh.inc.php';

		$sid = mysqli_real_escape_string($conn, $_GET['id']);
		$exam_id = mysqli_real_escape_string($conn, $_GET['exam']);
		
		$query="select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id INNER JOIN centers on centers.center_id=students_courses.center_id where stu_id=$sid";
		$res=mysqli_query($conn,$query);
		$student = mysqli_fetch_array($res);

		$query="select * from results natural join exams where student_id=$sid and exam_id = '$exam_id'";
		$res=mysqli_query($conn,$query);
		$result = mysqli_fetch_array($res);
		$marks = explode(',',$result['qwise_marks']);
		$answers = $result['result'];
		$ans = json_decode(stripslashes($answers));

		$query = "select qp_fullmarks from papers where qpid = '".$result['paper_id']."'";
		$rs = mysqli_query($conn, $query);
		$full_marks=mysqli_fetch_array($rs);
	?>

	<div class="res_container">
		<div class="res_header">
			<table>
				<tr>
					<td><img src="images/logo.jpg"></td>
					<td>
						<p><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></p>
						<p>CORPORTE OFFICE - 67B, Maharaja Thakur Road, Dhakuria, Kol- 700031</p>
						<p>Mob - +91 891-046-2774, Email - corporateoffice_ias@gmail.com </p>
					</td>
				</tr>
			</table>
		</div>
		<p class="border2"></p>
		<div class="exam_report">
			<p class="rep"><u>EXAM REPORT</u></p>
			<table>
				<tr>
					<td class="text"><span><?php echo strtoupper($student['stu_name']); ?></span></td>
					<td class="text"><span><?php echo $student['stu_roll']; ?></span></td>
					<td class="text"><span><?php echo $result['publish_date']; ?></span></td>
				</tr>
				<tr>
					<td class="title"><span>(Full Name)</span></td>
					<td class="title"><span>(Roll Number)</span></td>
					<td class="title"><span>(Result Published On)</span></td>
				</tr>
				<tr>
					<td class="text"><span><?php echo $result['exam_id']; ?></span></td>
					<td class="text"><span><?php echo strtoupper($result['exam_title']); ?></span></td>
					<td class="text"><span><?php echo $result['exam_type']; ?></span></td>
					<td class="text"><span><?php echo $result['exam_standard']; ?></span></td>					
				</tr>
				<tr>
					<td class="title"><span>(Exam ID)</span></td>
					<td class="title"><span>(Exam Title)</span></td>
					<td class="title"><span>(Exam Type)</span></td>
					<td class="title"><span>(Standard)</span></td>					
				</tr>
			</table>
			<p class="marks"><i><?php echo $result['marks'].' / '.$full_marks['qp_fullmarks']; ?></i></p><br>
			<p class="marks_title">(Marks Scored)</p>
			<p class="border2"></p>
		</div>
		<div class="questions_wrap">
			<p class="rep"><u>QUESTION WISE DETAILS</u></p>
			<?php
				$query = "select * from paper_question where paper_id = '".$result['paper_id']."'";
				$rs = mysqli_query($conn, $query);
				$i = 1;
				while($question=mysqli_fetch_array($rs)){
					if($question['question_type'] == 'MCQ' || $question['question_type'] == 'MMC'){
						$sql = "select * from mcq where mcq_id = ".$question['question_id'];
						$res = mysqli_query($conn, $sql);
						$mcq = mysqli_fetch_array($res);
						echo '<p class="sl_no"><u><b>Question: '.$i.'</b></u></p><div class="qdata">'.$mcq['mcq_statement'].'</div><br><br>';
						echo '
							<table>
								<tr>';
						if(!empty($ans->{$i}[0])){
							if($question['question_type'] == 'MMC'){
								$a = implode(',',$ans->{$i}[0]);
								echo '<td class="text"><span>'.strtolower($a).'</span></td>';
							}
							else{
								echo '<td class="text"><span>'.strtolower($ans->{$i}[0]).'</span></td>';
							}
						}
						else{
							echo '<td class="text"><span>N/A</span></td>';
						}
						echo '
									<td class="text"><span>'.$mcq['mcq_answer'].'</span></td>
									<td class="text"><span>'.$marks[$i-1].'</span></td>
									<td class="text"><span>'.$question['marks'].'</span></td>
								</tr>
								<tr>
									<td class="title"><span>(Your Answer)</span></td>
									<td class="title"><span>(Correct Answer)</span></td>
									<td class="title"><span>(Marks Scored)</span></td>
									<td class="title"><span>(Full Marks)</span></td>
								</tr>
							</table>
							<p class="border"></p>
						';
					}
					if($question['question_type'] == 'NAT'){
						$sql = "select * from nat where nat_id = ".$question['question_id'];
						$res = mysqli_query($conn, $sql);
						$nat = mysqli_fetch_array($res);
						echo '<p class="sl_no"><u><b>Question: '.$i.'</b></u></p><div class="qdata">'.$nat['nat_statement'].'</div><br><br>';
						echo '
							<table>
								<tr>';

						if(!empty($ans->{$i}[0])){
							echo '<td class="text"><span>'.strtolower($ans->{$i}[0]).'</span></td>';
						}
						else{
							echo '<td class="text"><span>N/A</span></td>';
						}
						echo '
									<td class="text"><span>'.$nat['nat_answer'].'</span></td>
									<td class="text"><span>'.$marks[$i-1].'</span></td>
									<td class="text"><span>'.$question['marks'].'</span></td>
								</tr>
								<tr>
									<td class="title"><span>(Your Answer)</span></td>
									<td class="title"><span>(Correct Answer)</span></td>
									<td class="title"><span>(Marks Scored)</span></td>
									<td class="title"><span>(Full Marks)</span></td>
								</tr>
							</table>
							<p class="border"></p>
						';
					}

					$i++;
					
				}
			?>
		</div>
		<div class="signature">
			<span class="dash">______________________________</span>
			<span class="dash">______________________________</span>
			<br>
			<span class="gur"><b>Guardian's Signature</b></span>
			<span class="stu"><b>Student's Signature</b></span>
		</div>
		<div class="clearfix"></div>
	</div>
	<button class="print hidden-print" title="Print / Save"><i class="fa fa-print" aria-hidden="true"></i></button>

	<script src="js/jquery-3.2.1.min.js"></script>   
	<script src="js/bootstrap.js"></script>	
	<script type="text/javascript">
		$('.print').click(function() {
			window.print();
		});
	</script>
	
</body>
</html>