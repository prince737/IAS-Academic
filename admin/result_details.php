<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Result Details | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="css/student_all.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="../images/logo.jpg" />
    <style>
    	#success-modal, #id{
    		display: none;
    	}
    	#delbtn{
    		margin-left: 5px;
    	}
	</style>
</head>

<body>	

	
			
	<div class="container-fluid display-table">
		<div class="row display-table-row">
			<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="mySidebar">
				<h1 class="hidden-sm hidden-xs">Navigation</h1>				
				<ul> 
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
								<a href="add_course.php">
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
								<a href="active_notices.php">
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
								<a href="new_event.php">
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
							<i class="fa fa-calendar" aria-hidden="true"></i>
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
						<a href="#collapse-post21" data-toggle="collapse" aria-control="collapse-post21">
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
					<li class="breadcrumb-item"><a href="results.php">Results</a></li>
					<li class="breadcrumb-item active">Result Details</li>
				</ol>

				<div id="content">				
					<header class="clearfix">
						<h2 class="page_title pull-left">Edit Question</h2>	
						<a type="button" class="new pull-right btn-primary btn-xs" href="exams.php">Exams</a>
						<a type="button" class="new pull-right btn-warning btn-xs" href="view_directories.php">Directories</a>
						<a type="button" class="new pull-right btn-danger btn-xs" href="papers.php">Papers</a>
					</header>

					<?php  
						if(isset($_GET['exam'])){ 
							$exam = mysqli_real_escape_string($conn, $_GET['exam']);
							$sql = "select count(*) as count, exam_id, exam_start, exam_status, exam_title, exam_type, exam_standard from results natural join exams where exam_id='".$exam."' group by exam_id";
							$res = mysqli_query($conn,$sql);
							$ex = mysqli_fetch_array($res);

							$sql = "select count(student_id) as students from students_courses where course_id in (select course_id from exam_course where exam_id = '".$ex['exam_id']."')";
							$res = mysqli_query($conn,$sql);
							$stu = mysqli_fetch_array($res);
						}    
					?>
					
					
					<div class="content-inner">
						<div class="row info">
							<div class="col-sm-2">Exam Id: <b id="eid"><?php echo $ex['exam_id']; ?></b></div>
							<div class="col-sm-2">Exam Title: <b><?php echo $ex['exam_title']; ?></b></div>
							<div class="col-sm-2">Exam Type: <b><?php echo $ex['exam_type']; ?></div>
							<div class="col-sm-2">Exam Status: <b><?php echo $ex['exam_status']; ?></div>
							<div class="col-sm-2">Students Eligible: <b><?php echo $stu['students']; ?></div>
							<div class="col-sm-2">Students Appeared: <b><?php echo $ex['count']; ?></div>
						</div>
						<br>
						<input type="text" style="width:30%; display: inline-block; margin-right: 10px;" class="form-control" placeholder="Search by name or roll" id="search">
						<select class="form-control" required name="centers" style="width:20%; display: inline-block; margin-right: 10px;">
							<option selected value="">All Centers</option>
							<option value="0">All Pending Approval</option>
							<option value="1">All Approved</option>									
							<option value="2">All Denied</option>
						</select>
						<select class="form-control" required name="courses" style="width:20%; display: inline-block; margin-right: 10px">
							<option selected value="">All Courses</option>
							<option value="0">All Pending Approval</option>
							<option value="1">All Approved</option>									
							<option value="2">All Denied</option>
						</select>
						<span>Sort By Marks: </span>
						<label><input type="radio" name="marks" value="1">High To low</label>
						<label><input type="radio" name="marks" value="2">Low to High</label>
						<br>
						<br>
						<div class="form-wrapper" id="data">
							
							
						</div>
					</div>				
				</div>
				
				
			</div>
		</div>
	</div>	


	<div id="success-modal">
		<div class="modalconent">
			<h3 style="color:teal;">Alert!</h3>
			<hr>	
			<p class="para">Sure about DELETEING the result?</p> 
			<p id="id"></p> 
			<button id="delbtn" class="btn btn-danger btn-sm pull-right">Delete</button>
			<button id="button" class="btn btn-success btn-sm pull-right">Close</button>
		</div>
	</div>


	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/default.js"></script>
	<script src="js/results.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none";
			};
		};
	</script>
	

</body>
</html>
				