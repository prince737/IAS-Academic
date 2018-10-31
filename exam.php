<?php
	session_start();
	require_once('includes/dbh.inc.php');
	
	if(!isset($_SESSION['student']) && !isset($_COOKIE['student'])){
		header("Location: login.php");
		exit();
	}
	
?>
		
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exam | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/exam.css">
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
  integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>

	<?php
		if(!isset($_GET['eid']) || !isset($_GET['sid']) || !isset($_GET['course'])){
			header("Location: ../exam.php?error");
			exit();
		}

		$eid = $_GET['eid'];
		$sid = $_GET['sid'];
		$course = $_GET['course'];

		$sql = "select * from exams where exam_id='$eid'";
		$res = mysqli_query($conn, $sql);
		$exam = mysqli_fetch_array($res);

		$sql = "select * from paper_question where paper_id = '".$exam['paper_id']."'";
		$res = mysqli_query($conn, $sql);
		$no_of_questions = mysqli_num_rows($res);
		
		//FIRST QUESTION
		$sql = "select * from paper_question where paper_id = '".$exam['paper_id']."' and sl_no=1";
		$res = mysqli_query($conn, $sql);
		$firstq = mysqli_fetch_array($res);
		$marks = $firstq['marks'];
		if($firstq['question_type'] == 'MCQ' || $firstq['question_type'] == 'MMC'){
			$sql = "select * from paper_question inner join mcq on question_id=mcq_id where mcq_id = ".$firstq['question_id']." and paper_id = '".$firstq['paper_id']."'";
			$res = mysqli_query($conn, $sql);
			$firstq = mysqli_fetch_array($res);
			$qtype = $firstq['question_type'];
			if($qtype=='MMC'){
				$qtype = 'MMCQ';
			}
		}
		else if($firstq['question_type'] == 'NAT') {
			$sql = "select * from paper_question inner join nat on question_id=nat_id where nat_id = ".$firstq['question_id']." and paper_id = '".$firstq['paper_id']."'";
			$res = mysqli_query($conn, $sql);
			$firstq = mysqli_fetch_array($res);
			$qtype = $firstq['question_type'];
		}

		//STUDENT PROFILE
		$query = "select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id INNER JOIN centers ON centers.center_id=students_courses.center_id where stu_id=$sid";
		$result = mysqli_query($conn, $query);
		$student = mysqli_fetch_array($result);

	?>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="pull-left hidden-xs"><img src="images/logo.jpg " height="35" width="45" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>			
		</div>
	</nav>
	<div class="instructions_wrap">
		<span class="pull-left"><?php echo $exam['exam_title'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class="pull-left"><?php echo $exam['exam_type'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class="pull-left"><?php echo $exam['exam_standard'] ?></span>
		<span class="pull-right"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Instructions</span>
		<span class="pull-left" id="pid"><?php echo $exam['paper_id'] ?></span>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 mainbody">
				<div class="stream_wrap">
					<span class="stream"><?php echo $course ?></span>
					<i class="fa fa-calculator fa-5 pull-right" aria-hidden="true"></i>
				</div>
				<div class="time_wrap">
					<span class="pull-right"><b>Time Left: <?php echo $exam['exam_time'] ?></b></span>
				</div>
				<div class="qtype_wrap">
					<span class="qtype"><b>Question Type: <span id="qtype"><?php echo $qtype ?></span></b></span>
					<span class="marks pull-right">Marks for correct answer: <span style="color:green;" id="marks"><?php echo $marks ?></span></span>
				</div>
				<div class="question_wrap">
					<div class="question_no" ><b>Question <span id="qno">1</span></b></div>
					<div class="question_data" id="question_data"></div>
					<div class="options" id="response"></div>
				</div>
				<div class="response_wrap">
					<button class="btn btn-default" id="review">Mark for Review & Next</button>
					<button class="btn btn-default" id="clear_response">Clear Response</button>
					<button class="btn btn-primary pull-right" id="save">Save & Next</button>
				</div>
			</div>
			<div class="col-sm-2 sidebar">
				<div class="user">
					<img class="img" <?php echo 'src="'.$student['stu_imageLocation'].'"'; ?> height="100" width="100" />
					<span><?php echo $student['stu_name']; ?></span>
				</div>
				<div class="nav_buttons">
					<div class="nav_demo">
						<div class="row" style="margin: 0;">
							<table>
								<tr>
									<td><span class="answered">1</span>Answered</td>
									<td><span class="not_answered">0</span>Not Answered</td>
								</tr>
								<tr>
									<td><span class="not_visited">55</span>Not Visited</td>
									<td><span class="review">10</span>Marked for Review</td>
								</tr>
								<tr>
									<td colspan="2"><span class="answered_review">2</span>Answered and Marked for Review (will be considered for evaluation)</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="exam_name">
						<?php echo $exam['exam_title'] ?>
					</div>
					<div class="navigation">
						
						<?php
							$i = 1;
							while($i <= $no_of_questions){
								if($i == 1){
									echo '<button class="btn btn-default navbtn one" id="'.$i.'">'.$i.'</button>';
								}
								else{
									echo '<button class="btn btn-default navbtn" id="'.$i.'">'.$i.'</button>';
								}
								
								if($i%4==0){
									echo '<br>';
								}
								$i += 1;
							}
						?>
					</div>
				</div>
				
				<div class="submission">
					<button class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<div id="success-modal">
		<div class="modalconent">
			<h3 style="color:teal;">Information</h3>
			<hr>	
			<p class="para">Message was successfully sent to user\'s mail id.</p> 
			<button id="close_submit" class="btn btn-danger btn-sm pull-right">Close</button>
		</div>
	</div>

	<footer>Version: 00.01</footer>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.js"></script>	
	<script src="js/exam.js"></script>	
	<script>
		/*$(document).bind("contextmenu",function(e) {
		 	e.preventDefault();
		});
		$(document).keydown(function(e){
		    if(e.which === 123 || e.which === 116){
		       return false;
		    }
		});*/
		$('#close_submit').click(function() {
			$('#success-modal').hide();
		});
	    $(document).mousemove(function( event ) {
			var msg = "Handler for .mousemove() called at ";
			if(event.pageY < 30){
				//alert("warning");
				//$('#success-modal').show();
			}
		});
	    setInterval("myFunction()", 1);
		function myFunction() {
		    if (!document.hasFocus()) {

		        //$('#success-modal').show();
		        //alert('You are not allowed to leave this tab');
		    }
		}

	</script>
</body>