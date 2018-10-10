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
	<title>Create / Pulish Exams | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    	.paper{
    		display: none;
    	}
    	.paper span{
    		margin-bottom: 20px; 
    		margin-right: 50px;
    		display: inline-block;
    	}
	</style>
</head>


<body>	

	
			
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
					<li class="breadcrumb-item active">Exams</li>					
					<li class="breadcrumb-item active">Create Exam</li>
				</ol>
				
				<div id="content">				
					<header class="clearfix">
						<h2 class="page_title pull-left">Create a new Exam</h2>	
						<a type="button" class="new pull-right btn-primary btn-xs" href="exams.php">View all Exams</a>
					</header>
					
					<div class="content-inner">
						<div class="form-wrapper" id="data">
							<form action="includes/exams.inc.php" method="POST" enctype="multipart/form-data">		
								<select class="form-control" id="pid" name="pid" required>
									<option selected value="">Select Paper</option>
									<?php
										$sql = 'select * from papers';
										$result = mysqli_query($conn, $sql);
										
										while($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row['qpid'].'">'.$row['qp_name'].'</option>';
										}										
									
									?>
								</select><br>
								<div class="paper">
									<span>Paper Id: <b id="paperid"></b></span><span>Paper Level: <b id="plevel"></b></span><span>Full Marks: <b id="pmarks"></b></span>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="exam_title" required placeholder="Exam Title">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="exam_type" required placeholder="Exam Type">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="exam_standard" required placeholder="Exam Standard">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="exam_time" required placeholder="Time">
								</div>
								<div class="form-group">
									<select class="form-control" id="nega" name="exam_nega" required>
										<option selected value="">Negative Marking</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control" id="cal" name="exam_cal" required>
										<option selected value="">Calculator</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary" name="save_exam">Create Exam</button>
								</div>



								<!--<div class="form-group">
									<input type="text" class="form-control" name="paper_name" required placeholder="Paper Name">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="paper_marks" required placeholder="Full Marks">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="paper_standard" required placeholder="Paper Standard">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="paper_level" required placeholder="Paper Level">
								</div><div class="form-group">
									<input type="text" class="form-control" name="paper_type" required placeholder="Paper Type">
								</div>
								-->
							</form>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<?php
		if(isset($_GET['err']))
		{
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Something went wrong, please try again.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		elseif(isset($_GET['id'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Exam was succesfully created21. Its Id is  <b>'.$_GET['id'].'</b>.<br> Go to <a href="exams.php">view all</a> page to publish it.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}

	?>
	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/exam.js"></script>

	<script>
		document.getElementById('button').onclick = function () {
			document.getElementById('success-modal').style.display = "none";
		};
		
	
	</script>
	
	
	

</body>
</html>