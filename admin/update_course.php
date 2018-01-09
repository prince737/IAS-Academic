<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	if(isset($_GET['success']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Course was successfully Updated.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
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
	
	$resultName;
	$result;
	$selectedName;
	$selectedType;

	$query="select distinct course_type from courses;";
	$resultType = mysqli_query($conn, $query);
	
	if(isset($_POST['course'])){
	
		global $selectedType;
		$selectedType = mysqli_real_escape_string($conn, $_POST['course']);
		$query = "select course_name from courses where course_type = '$selectedType'";
		global $resultName;
		$resultName = mysqli_query($conn, $query);
	}
	
	if(isset($_POST['courseName'])){
		global $selectedName;
		$selectedName= mysqli_real_escape_string($conn, $_POST['courseName']);
		$query = "select * from courses where course_name = '$selectedName' and course_type='$selectedType'";
		global $result;
		$result = mysqli_query($conn, $query);
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Update Course | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
						<a href="students.php">
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Students</span>
						</a>
					</li>
					
					<li class="link active">
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
								<a href="#">
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
								<a href="#">
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
					<li class="link online-exam">
						<a href="#">
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
									<a href="#" class="logout">
										<span class="fa fa-sign-out" aria-hidden="true">Log out
									</a>
								</li>
							</ul>
						</div>
					</header>
				</div>
				
				<div id="content">				
					<header>
						<h2 class="page_title">Update an Course</h2>	
					</header>
					
					<div class="content-inner">
						<div class="form-wrapper">
						
							<form action="update_course.php" method="POST">
								<div class="form-group">
									<label for="course">Choose a course type:</label>
									<select class="form-control" id="course" name="course" onchange="this.form.submit()">
										<option selected>Choose Course Type</option>
										<?php
											if($resultType){
												while($row = mysqli_fetch_array($resultType)){
													global $selectedType;
													if($row['course_type'] == $selectedType){
														echo '<option value="'.$row['course_type'].'" selected>'.$row['course_type'].'</option>';
													}
													else{
														echo '<option value="'.$row['course_type'].'">'.$row['course_type'].'</option>';
													}
												}
											}											
										
										?>
									</select>	
								</div>
							
								<div class="form-group">
									<label for="course">Choose a course to Update:</label>
									<select class="form-control" id="course" name="courseName" onchange="this.form.submit()">
										<option selected>Choose a Course to Update</option>
										<?php
											if($resultName){
												while($row = mysqli_fetch_array($resultName)){
													global $selectedName;
													if($row['course_name'] == $selectedName){
														echo '<option value="'.$row['course_name'].'" selected>'.$row['course_name'].'</option>';
													}
													else{
														echo '<option value="'.$row['course_name'].'">'.$row['course_name'].'</option>';
													}
													
												}
											}											
										
										?>
									</select>	
								</div>
							
							</form>
							
							<form action="includes/courses.inc.php" method="POST">
								<?php
									global $result;
									if($result){
										while($row = mysqli_fetch_array($result)){
											echo '
												<div class="form-group">
													<label for="cid">Course Id:</label>
													<input type="text" value="'.$row['course_id'].'" class="form-control" id="cid" name="cid" placeholder="Course Id " required />
												</div>
												<div class="form-group">
													<label for="ctype">Course Type:</label>
													<input type="text" id="ctype" value="'.$row['course_type'].'" class="form-control" name="ctype" placeholder="Course Type" required />
												</div>
												<div class="form-group">
													<label for="cname">Course Name:</label>
													<input type="text" id="cname" value="'.$row['course_name'].'" class="form-control" name="cname" placeholder="Course Name" required />
												</div>
												<div class="form-group">
													<label for="cdesc">Course Description:</label>
													<textarea class="form-control"  style="height:200px;" name="cdesc" placeholder="Course Description (This will be displayed on Courses Page for viewers) " required id="cdesc">'.$row['course_description'].'</textarea>
												</div>
												<p style="color:teal;">Use html paragraph tags to create separate paragraphs .</p> <br>
											';
										}
									}			
								?>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="Update">Publish Course when I click on save
									</label>
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="update-course">Save / Publish</button>
								</div>
								
								<?php
									if(isset($_GET['crsTPnA']))
									{
										echo '			    
											<div id="success-modal">
												<div class="modalconent">
													<h3 style="color:teal;">Information</h3>
													<hr>	
													<p class="para">Course type you entered does not exist. Sure to create it?.</p> 
													<button id="button" type="button" class="btn btn-danger btn-sm pull-right">No</button>
													&nbsp; &nbsp;<button id="button" name="update-course1" class="btn btn-warning btn-sm pull-right">Yes</button>
												</div>
											</div>
										';			
									}
								?>
								
								
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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('update_course.php');
			};
		};
	</script>

</body>
</html>
				
				
				
				
				
				