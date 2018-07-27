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
	<title>Add Notes | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css/chosen.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="../images/logo.jpg" />
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
								<a href="#">
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
					<li class="link active">
						<a href="#collapse-pos2" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-book" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Study Material</span>
						</a>
						<ul class="collapse collapsable" id="collapse-pos2" style="margin:0px; padding:0px; ">
							<li>
								<a href="#">
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
				<div id="content">
					<header>
						<h2 class="page_title">Add new Notes</h2>	
					</header>
					<div class="content-inner">
						<div class="form-wrapper">
							<form action="includes/notes.inc.php" method="POST" enctype="multipart/form-data">
								
								
								<div class="form-group ">			
									<select class="form-control" id="he" name="course_name" required onchange="this.form.submit()">		
										<option selected value="0">Choose course name for whom this note will be available</option>
										<?php	
											$query ="select distinct course_type from courses";
											$result=mysqli_query($conn,$query);
											$i=0;
											while($row = mysqli_fetch_array($result)){
												if(isset($_GET['cname']) && $_GET['cname'] == $row['course_type'] ){
													echo '<option value="'.$row['course_type'].'" selected>'.$row['course_type'].'</option>';
												}
												elseif(isset($_GET['cname']) && $row['course_type'] == '10+2 Entrance Exams' && $_GET['cname']=='10 2 Entrance Exams'){
													echo '<option value="'.$row['course_type'].'" selected>'.$row['course_type'].'</option>';
												}
												elseif(isset($_GET['cname']) && $row['course_type'] == 'Training & Project Work' && $_GET['cname']=='Training '){
													echo '<option value="'.$row['course_type'].'" selected>'.$row['course_type'].'</option>';
												}
												else{
													echo '<option value="'.$row['course_type'].'">'.$row['course_type'].'</option>';
												}
											}
										?>	
									</select>	
								</div>
								<div class="form-group ">
									<select class="form-control" id="he" name="ctype" onchange="this.form.submit()" required">		
										<option value="0">Choose Course Type for whom this note will be available</option>
										<?php	
											if($_GET['cname'] == '10 2 Entrance Exams'){
												$select = '10+2 Entrance Exams';
											}
											elseif($_GET['cname'] == 'Training '){
												$select = 'Training & Project Work';
											}
											else{
												$select = $_GET['cname'];
											}
											$query ="select * from courses where course_type='$select'";
											$result=mysqli_query($conn,$query);
											$i=0;
											while($row = mysqli_fetch_array($result)){
												if(isset($_GET['ctype']) && $_GET['ctype'] == $row['course_id']){
													echo '<option value="'.$row['course_id'].'" selected>'.$row['course_name'].'</option>';
												}
												else
													echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
											}
										?>	
									</select>
								</div>	
								<div class="form-group ">
									<select class="form-control chosen_select" id="he" name="centers[]" required multiple data-placeholder="Choose Centers">		
										<?php	
											$query ="select * from centers inner join course_center on course_center.center_id=centers.center_id where course_id=".$_GET['ctype'];
											$result=mysqli_query($conn,$query);
											$i=0;
											while($row = mysqli_fetch_array($result)){
												echo '<option value="'.$row['center_id'].'">'.$row['center_name'].'</option>';
												
											}
										?>	
									</select>
								</div>	
								<div class="form-group">
									<label class="sr-only">Date</label>
									<input type="text" class="form-control" name="date" required id="datepicker" placeholder="Date (YYYY-MM-DD)">
								</div>
								<div class="form-group">
									<label class="sr-only">Date</label>
									<input type="text" class="form-control" name="name" required placeholder="Name for the Note">
								</div>
								<div class="form-group">
									<label>Choose Notes Type:  </label>
									<label class="radio-inline">
										<input type="radio" name="ntype" value="video" required>Video
									</label>
									<label class="radio-inline">
										<input type="radio" name="ntype" value="doc">Document
									</label>
								</div>
								<div class="form-group">
									<p for="doc">Upload the notes file: </p>
									<input type="file" class="form-control" name="file" id="doc" accept=".pdf, .doc, .mp4, .3gp, .mpeg4, .mpeg" required/>
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="upload_all">Save / Publish</button>
								</div>
							</form>
						</div>	
					</div>
					<header>
						<h2 class="page_title">For individual Student</h2>	
					</header>
					<div class="content-inner">
						<div class="form-wrapper">
							<form action="includes/notes.inc.php" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<input type="text" name="sid" class="form-control" placeholder="Enter Student Id" required>
								</div>
								<div class="form-group">
									<label class="sr-only">Name</label>
									<input type="text" class="form-control" name="name" required placeholder="Name for the Note">
								</div>
								<div class="form-group">
									<label class="sr-only">Date</label>
									<input type="text" class="form-control" name="date" required id="datepicker1" placeholder="Date (YYYY-MM-DD)">
								</div>
								<div class="form-group">
									<label>Choose Notes Type:  </label>
									<label class="radio-inline">
										<input type="radio" name="ntype" value="video" required>Video
									</label>
									<label class="radio-inline">
										<input type="radio" name="ntype" value="doc">Document
									</label>
								</div>
								<div class="form-group">
									<p for="doc">Upload the notes file: </p>
									<input type="file" class="form-control" name="file1" id="doc" accept=".pdf, .doc,.mp4,.3gp,.mpeg" required/>
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="upload">Upload</button>
								</div>
							</form>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</div>	
	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/default.js"></script>
	<script src="../vendor/js/chosen.jquery.min.js"></script>
	<script>
		$(".chosen_select").chosen({
			disable_search_threshold: 10,
			no_results_text: "Oops, nothing found!",
			width: "100%"
		});
	</script>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
	  $( function() {
		$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				altField: "#datepicker",
				altFormat: "yy-mm-dd",
			});
	  });
	</script>
	<script>
	  $( function() {
		$( "#datepicker1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				altField: "#datepicker1",
				altFormat: "yy-mm-dd",
			});
	  });
	</script>
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('add_notes.php');
			};
		};
	</script>
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
		if(isset($_GET['success']))
		{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Note was successfully added.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
		}
		
	?>	

</body>
</html>