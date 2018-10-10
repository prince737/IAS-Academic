<?php
	session_start();
	
	include_once '../includes/dbh.inc.php';
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Remove Question  | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    	.stu-con{
			margin:10px;
			background:#fff;	
			padding:20px 20px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);			
		}
		#success-modal, .nav_controls, .type, .mod_span{
			display:none;
		}
		.marks{
			height:30px;
			margin-left: 15px;
		}
	</style>
</head>

<body>	

	<div id="success-modal">
		<div class="modalconent">
			<h3 style="color:teal;">Information</h3>
			<hr>	
			<p><b class="para" id="para"></b></p> 
			<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
		</div>
	</div>
			
	<div class="container-fluid display-table">
		<div class="row display-table-row">
			<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="mySidebar">
				<h1 class="hidden-sm hidden-xs">Navigation</h1>				
				<ul > 
					<li class="link">
						<a href="admin.php">
							<i class="fa fa-th" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Dashboard</span>
						</a>
					</li>
					<li class="link">
						<a href="#collapse-poststd" data-toggle="collapse" aria-control="collapse-poststd">
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Students</span>
						</a>
						<ul class="collapse collapsable" id="collapse-poststd" style="margin:0px; padding:0px; ">
							<li>
								<a href="students_all.php">
									<span>All Students</span>
								</a>
							</li>
							<li>
								<a href="students_profile.php">
									<span>Profile Updation Requests</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="link">
						<a href="#collapse-post1c" data-toggle="collapse" aria-control="collapse-post1c">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Courses</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post1c" style="margin:0px; padding:0px; ">
							<li>
								<a href="#">
									<span>Add New</span>
								</a>
							</li>
							<li>
								<a href="update_course.php">
									<span>Update Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post1" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Notices</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post1" style="margin:0px; padding:0px; ">
							<li>
								<a href="admin_notices.php">
									<span>Create New</span>
								</a>
							</li>
							<li>
								<a href="active_events.php">
									<span>View Active</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post2" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Events</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post2" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_event.php">
									<span>Create New</span>
								</a>
							</li>
							<li>
								<a href="active_events.php">
									<span>View Active</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-pos2" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-book" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Study Material</span>
						</a>
						<ul class="collapse collapsable" id="collapse-pos2" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_notes.php">
									<span>Add New</span>
								</a>
							</li>
							<li>
								<a href="remove_notes.php">
									<span>Remove Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post21" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-picture-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Gallery</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post21" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_image.php">
									<span>Add New Images</span>
								</a>
							</li>
							<li>
								<a href="remove_image.php">
									<span>Delete Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="queries.php">
							<i class="fa fa-question-circle-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Queries</span>
						</a>
					</li>
					<li class="link">
						<a href="set.php">
							<i class="fa fa-pencil"></i>
							<span class="hidden-sm hidden-xs">Scholarship Entrance Test</span>
						</a>
					</li>
					<li class="link online-exam">
						<a href="online_exam.php">
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Online Exams</span>
						</a>
					</li>
				</ul>				
			</div>
			<div class="col-md-10 col-sm-11 display-table-cell valign-top">
				<div class="row">
					<header id="nav-header" class="clearfix">
						<div class="col-md-5">
							<nav class="navbar-default pull-left">
								<button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#mySidebar">
									<span class="sr-only">Toggle Notification</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</nav>
							<a class="navbar-brand hidden-sm hidden-xs" href="../index.php" target="_blank"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
						</div>
						<div class="col-md-7">
							<ul class="pull-right">
								<li id="welcome" class="hidden-xs">Welcome to your administration area</li>
								<li class="fixed-width">
									<a href="#">
										<span class="fa fa-bell" aria-hidden="true"></span>
										<span class="label label-warning">3</span>
									</a>	
								</li>
								<li class="fixed-width">	
									<a href="#">
										<span class="fa fa-envelope" aria-hidden="true"></span>
										<span class="label label-success">3</span>
									</a>
								</li>
								<li>	
									<form action="includes/adminlogout.inc.php" method="POST">
										<button class="logout" name="alogout"><span class="fa fa-sign-out" aria-hidden="true">Log out</button>
									</form>
								</li>
							</ul>
						</div>
					</header>
				</div>

				<ol class="breadcrumb" style="margin-top:20px;">
					<li class="breadcrumb-item"><a href="online_exam.php">Online Exams</a></li>
					<li class="breadcrumb-item"><a href="papers.php">View All Papers</a></li>
					<li class="breadcrumb-item active">Remove Questions</li>
				</ol>
				
				<?php
					$paper_id = $_GET['qpid'];
				?>

				<div id="content">				
					<header class="clearfix">
						<h2 class="page_title pull-left">Remove Questions from a Paper</h2>	
						<a type="button" class="new pull-right btn-primary btn-xs" href="create_paper.php">Create Question Paper</a>
						<a type="button" class="new pull-right btn-success btn-xs" href="add_questions.php?qpid=<?php echo $paper_id; ?>">Add Question</a>
					</header>

					<?php

						//LOAD QUESTIONS IN PAPER
						$sql = "select * from paper_question where paper_id='$paper_id' order by sl_no";
						$res_q = mysqli_query($conn, $sql);

						//MCQ MARKS
						$sql = "SELECT count(question_type) as count, sum(marks) as marks FROM `paper_question` WHERE paper_id='$paper_id' and question_type = 'MCQ'";
						$res = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($res);
						$noMcq = $row['count'];
						$marksMcq = $row['marks'];

						//MMCQ MARKS
						$sql = "SELECT count(question_type) as count, sum(marks) as marks FROM `paper_question` WHERE paper_id='$paper_id' and question_type = 'MMC'";
						$res = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($res);
						$noMmcq = $row['count'];
						$marksMmcq = $row['marks'];

						//NAT MARKS
						$sql = "SELECT count(question_type) as count, sum(marks) as marks FROM `paper_question` WHERE paper_id='$paper_id' and question_type = 'NAT'";
						$res = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($res);
						$noNat = $row['count'];
						$marksNat = $row['marks'];

						/*$noCdl = 5;
						$marksCdl = 25;		*/				

						$totalMarks = $marksMcq + $marksMmcq + $marksNat /*+ $marksCdl*/;

					?>

					<div class="content-inner">
						<table class="table table-bordered">
							<thead>
					            <tr>
					                <th>Paper Id</th>
					                <th>No. of MCQ</th>
					                <th>Marks MCQ</th>
					                <th>No. of MMCQ</th>
					                <th>Marks MMCQ</th>
					                <th>No. of NAT</th>
					                <th>Marks NAT</th>
					                <!--<th>No. of CDL</th>
					                <th>Marks CDL</th>-->
					                <th>Total Marks</th>
					            </tr>
					        </thead>
					         <tbody>
					         	<tr>
					         		<td id="pid"><?php echo $paper_id ?></td>
					         		<td id="noMcq"><?php echo $noMcq ?></td>
					         		<td id="marksMcq"><?php echo $marksMcq ?></td>
					         		<td id="noMmc"><?php echo $noMmcq ?></td>
					         		<td id="marksMmc"><?php echo $marksMmcq ?></td>
					         		<td id="noNat"><?php echo $noNat ?></td>
					         		<td id="marksNat"><?php echo $marksNat ?></td>
					         		<!--<td id="noCdl"><?php echo $noCdl ?></td>
					         		<td id="marksCdl"><?php echo $marksCdl ?></td>-->
					         		<td id="marksTotal"><?php echo $totalMarks ?></td>
					         	</tr>
					         </tbody>
						</table>
						<div class="form-wrapper" id="data">
						<?php
							while($row = mysqli_fetch_array($res_q)){
								$qid = $row['question_id'];
								if($row['question_type'] == 'MCQ' || $row['question_type'] == 'MAMCQ'){
									$sql = "select * from mcq where mcq_id=$qid and mcq_type='MCQ'";
									$res = mysqli_query($conn, $sql);
									$row1 = mysqli_fetch_array($res);
									echo '
										<div class="stu-con">
											<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
											<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
											<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
											<hr>
											<button class="btn btn-danger btn-sm remq" id="mcq'.$row1['mcq_id'].'">Remove from Paper</button>
								     	</div>
									';
								}
								if($row['question_type'] == 'MMC'){
									$sql = "select * from mcq where mcq_id=$qid and mcq_type='MAMCQ'";
									$res = mysqli_query($conn, $sql);
									$row1 = mysqli_fetch_array($res);
									echo '
										<div class="stu-con">
											<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
											<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
											<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
											<hr>
											<button class="btn btn-danger btn-sm remq" id="mmc'.$row1['mcq_id'].'">Remove from Paper</button>
								     	</div>
									';
								}
								elseif($row['question_type'] == 'NAT'){
									$sql = "select * from nat where nat_id=$qid";
									$res = mysqli_query($conn, $sql);
									$row1 = mysqli_fetch_array($res);
									echo '
										<div class="stu-con">
											<div class="statement" id="stmt'.$row1['nat_id'].'">'.$row1['nat_statement'].'</div>
											<div class="answer" id="ans'.$row1['nat_id'].'">Correct Answer: '.$row1['nat_answer'].'</div>
											<hr>
											<button class="btn btn-danger btn-sm remq" id="nat'.$row1['nat_id'].'">Remove from Paper</button>
								    	</div>
									';
								}
							}
						?>
						</div>
						<div class="nav_controls">
							<br>&nbsp;<button class="btn btn-success" id="show">Show more</button>
							&nbsp;<a class="btn btn-warning" href="add_questions.php?qpid=<?php echo $_GET['qpid'] ?>" id="reset">Reset</a>
							&nbsp;&nbsp;
							<span id="cwrap" style=" font-weight: bold;">
								Showing 1 to 
								<span id="count" style=" font-weight: bold;"></span>
								 of <span id = "count1" style=" font-weight: bold;"></span> entries
							</span>
						</div>


						<div class="modal fade" id="remModal">
							<div class="modal-dialog modal-sm" style="margin-top: 10%;">
								<div class="modal-content" >
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Remove Question</h4>			
									</div>
									<div class="modal-body">
										Sure about removing the question?
										<span id="qid" class="mod_span"></span>
										<span id="qtype" class="mod_span"></span>
										<span id="qpid" class="mod_span"></span>
									</div> 
									<div class="modal-footer">
										<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-danger btn-xs" name="deny" id="removeQes">Remove</button>
									</div>		
								</div>
							</div>
						</div>

					</div>				
				</div>
			</div>
		</div>
	</div>
	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/remove_question.js"></script>

	<script>
		document.getElementById('button').onclick = function () {
			document.getElementById('success-modal').style.display = "none";
		};		
	
	</script>

</body>
</html>
				
				
				
				
				
				