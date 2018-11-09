<?php
	session_start();
	require_once('includes/dbh.inc.php');
	
	if(!isset($_SESSION['student']) && !isset($_COOKIE['student'])){
		header("Location: login.php");
		exit();
	}

	if(!isset($_GET['eid']) || !isset($_GET['sid']) || !isset($_GET['course'])){
		header("Location: ../exams.php?error");
		exit();
	}

	$eid = $_GET['eid'];
	$sid = $_GET['sid'];
	$course = $_GET['course'];

	$sql = "select * from results where student_id = $sid and exam_id = '$eid' and submission != 0";
	$res = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($res);
	if($count > 0){
		header("Location: exams.php?finished");
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
	<link rel="stylesheet" type="text/css" href="css/calc.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />

</head>

<body onload="timer()">

	<?php
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
		<span class="pull-left" id="sid"><?php echo $sid ?></span>
		<span class="pull-left" id="eid"><?php echo $eid ?></span>
		<span class="pull-left" id="no_of_questions"><?php echo $no_of_questions ?></span>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 mainbody">
				<div class="stream_wrap">
					<span class="stream"><?php echo $course ?></span>
					<i class="fa fa-calculator fa-5 pull-right" aria-hidden="true" id="calc_open"></i>
				</div>
				<div class="time_wrap">
					<span class="pull-right">
						<b>Time Left: <span class="min" id="min">00</span>
						<span class="colon">:</span>
						<span class="sec" id="sec">00</span></b>
					</span>
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
					<div class="navigation" id = "navigation">
					</div>
				</div>
				
				<div class="submission">
					<button class="btn btn-primary" id="submit">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<!-----CALCULATOR--->
	<div class="wrapper-main-calc">
		<div class="calc-header"><span class="pull-right" id="close_calc" aria-hidden="true">&times;</span></div>
			<div class="col-xs-12 wrapper-calc mt30 ptb30" ng-app="calculator" ng-controller="calculatorController">
				<div class="row output">
					<div style="border-bottom:dashed 1px #EFEFEF;" class="col-xs-12 mtb15">
						<span style="color:#888;">Mode</span>
						<span id="output" style="float:right; display:inline-block;  text-align:center;">{{mode}}</span>
					</div>
					<div style="border-bottom:dashed 1px #EFEFEF;" class="col-xs-12 mtb15">
						<span style="color:#888;">Output</span>
						<span id="output" style="float:right; display:inline-block;  text-align:center;">{{result}}</span>
					</div>
					<div class="col-xs-12 mb30">
						<span style="color:#888;">Input Evaluated</span>
						<span style="float:right; display:inline-block;  text-align:center;" ng-bind-html="formula|unsafe"></span>
					</div>
					<input my-enter class="col-xs-12" type="text" ng-model="input" placeholder="Enter the expression" id="input" />
				</div>
				<div id="buttoncontainer" class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class='col-sm-2 col-xs-2 text-center'>
								<div class='row plr5 ptb5'>
									<input type="radio" name="angle" id="degree" checked class="angle" style="display:none;">
									<label for="degree" ng-click="changeAngle(true)" class="button anglelabel" style="padding:0;margin:0;">Degree</label>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2 text-center'>
								<div class='row plr5 ptb5'>
									<input type="radio" name="angle" class="angle" id="radian" style="display:none;">
									<label for="radian" ng-click="changeAngle(false)" class="button anglelabel" style="padding:0;margin:0;">Radian</label>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>MS</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>MC</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='a.mem' ng-click='changeState($event)' class='button'>MR</button>
								</div>
							</div>
							<div class='col-sm-1 col-xs-1'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>M+</button>
								</div>
							</div>
							<div class='col-sm-1 col-xs-1'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>M-</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='sin(' ng-click='changeState($event)' class='button'>sin</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='cos(' ng-click='changeState($event)' class='button'>cos</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='tan(' ng-click='changeState($event)' class='button'>tan</button>
								</div>
							</div>

							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='pi' ng-click='changeState($event)' class='button'>&pi;</button>
								</div>
							</div>	
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>BKSPC</button>
								</div>
							</div>	
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='' ng-click='changeState($event)' class='button'>C</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='asin(' ng-click='changeState($event)' class='button'>sin<sup>-1</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='acos(' ng-click='changeState($event)' class='button'>cos<sup>-1</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='atan(' ng-click='changeState($event)' class='button'>tan<sup>-1</sup></button>
								</div>
							</div>
							
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='1' ng-click='changeState($event)' class='button'>1</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='2' ng-click='changeState($event)' class='button'>2</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='3' ng-click='changeState($event)' class='button'>3</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='e' ng-click='changeState($event)' class='button'>e</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									
									<button id='(' ng-click='changeState($event)' class='button'>(</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id=')' ng-click='changeState($event)' class='button'>)</button>
								</div>
							</div>		
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='4' ng-click='changeState($event)' class='button'>4</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='5' ng-click='changeState($event)' class='button'>5</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='6' ng-click='changeState($event)' class='button'>6</button>
									<!---->
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^(2)' ng-click='changeState($event)' class='button'>x<sup>2</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^(3)' ng-click='changeState($event)' class='button'>x<sup>3</sup></button>
								</div>
							</div>
								
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^' ng-click='changeState($event)' class='button'>x<sup>y</sup></button>
								</div>
							</div>				
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='7' ng-click='changeState($event)' class='button'>7</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='8' ng-click='changeState($event)' class='button '>8</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='9' ng-click='changeState($event)' class='button'>9</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^(1/2)' ng-click='changeState($event)' class='button'>&radic;</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^(1/3)' ng-click='changeState($event)' class='button'><sup>3</sup>&radic;x</button>
								</div>
							</div> 
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='^1/' ng-click='changeState($event)' class='button'><sup>y</sup>&radic;x</button>
								</div>
							</div>	
							<div class='col-sm-1 col-xs-1'>
								<div class='row plr5 ptb5'>
									<button id='-' ng-click='changeState($event)' class='button'>&plusmn;</button>
								</div>
							</div>
							<div class='col-sm-1 col-xs-1'>
								<div class='row plr5 ptb5'>
									<button id='.' ng-click='changeState($event)' class='button'>.</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='0' ng-click='changeState($event)' class='button num'>0</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='=' ng-click='changeState($event)' class='button'>=</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='sinh(' ng-click='changeState($event)' class='button'>sinh</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='cosh(' ng-click='changeState($event)' class='button'>cosh</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='tanh(' ng-click='changeState($event)' class='button'>tanh</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='+' ng-click='changeState($event)' class='button'>+</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='-' ng-click='changeState($event)' class='button'>-</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='*' ng-click='changeState($event)' class='button'>*</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='asinh(' ng-click='changeState($event)' class='button'>sinh<sup>-1</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='acosh(' ng-click='changeState($event)' class='button'>cosh<sup>-1</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='atanh(' ng-click='changeState($event)' class='button'>tanh<sup>-1</sup></button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='/' ng-click='changeState($event)' class='button'>/</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='perc' class='button'>%</button>
								</div>
							</div>	
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id=' Mod ' ng-click='changeState($event)' class='button'>Mod</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id=' log(' ng-click='changeState($event)' class='button'>log</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='logxBasey' ng-click='changeState($event)' class='button'>log<sub>y</sub>x</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id=' ln(' ng-click='changeState($event)' class='button'>ln</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='!' ng-click='changeState($event)' class='button'>n!</button>
								</div>
							</div>
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id=' 10^(' ng-click='changeState($event)' class='button'>10<sup>x</sup></button>
								</div>
							</div>						
							<div class='col-sm-2 col-xs-2'>
								<div class='row plr5 ptb5'>
									<button id='1/' ng-click='changeState($event)' class='button'>1/x</button>
								</div>
							</div>					
						</div><br>
						<center><span><b>Please Note:</b> Calculate log<sub>y</sub>x separately from any expression.</span></center>
				 	</div>

				</div>
				<div id="ajaxwindow2">

				</div>
			</div>	
		</div>
	</div>
	<div id="success-modal">
		<div class="modalcontent">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<h4 class="snap">WARNING!</h4>
			<p class="msg">You tried to leave the tab, authorities will be notified.</p>
			<button id="close_submit" class="btn btn-danger">Close</button>
		</div>
	</div>

	<div id="left-tab">
		<div class="modalcontent">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<h4 class="snap">EXAM SUBMITTED!</h4>
			<p class="msg">You left the tab. Your exam has been submitted. Authorities will be notified.</p>
			<button id="close_submit2" onclick="window.top.close();" class="btn btn-danger">Close</button>
		</div>
	</div>

	<div id="finish">
		<div class="modalcontent">
			<i class="fa fa-check" aria-hidden="true"></i>
			<h4 class="snap">Exam Submitted!</h4>
			<p class="msg">Your exam has been submitted successfully.</p>
			<button id="close_submit2" onclick="window.top.close();" class="btn btn-danger">Close</button>
		</div>
	</div>

	<div id="ended">
		<div class="modalcontent">
			<i class="fa fa-clock-o" aria-hidden="true"></i>
			<h4 class="snap">TIMEOUT!</h4>
			<p class="msg">Exam submitted.</p>
			<button id="close_submit1" onclick="window.top.close();" class="btn btn-danger">Close</button>
		</div>
	</div>

	<footer>Version: 00.01</footer>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.js"></script>	
	<script src="js/exam.js"></script>	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
	<script type="text/javascript" src="js/calc.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript">
		$('#perc').click(function (){
			var data = $('#input').val();
			var i = data.length-1;
			var num = '';
			while(!isNaN(data[i]) || data[i]=='.'){
				num += data[i]; 
				i--;
			}
			num = num.split( '' ).reverse( ).join( '' );
			num = parseFloat(num);
			num = num / 100;
			data = data.substr(0,i+1);
			if(isNaN(num)){
				alert('Cannot use % here. Hint: try evaluating the inner expression first.');
				$('#input').val(data);
			}
			else{
				$('#input').val(data + num);
			}		
		});

		$('#close_calc').click(function() {
			$('.wrapper-main-calc').hide();
		});
		$('#calc_open').click(function() {
			$('.wrapper-main-calc').show();
		});
	</script>
	<script>
		/*$(document).bind("contextmenu",function(e) {
		 	e.preventDefault();
		});
		$(document).keydown(function(e){
		    if(e.which === 123 || e.which === 116){
		       return false;
		    }
		});*/
		

	</script>
</body>