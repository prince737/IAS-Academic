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
	<title>Add Course | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css/chosen.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
					
					<li class="link active">
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
						<h2 class="page_title">Add a new Course</h2>	
					</header>
					
					<div class="content-inner">
						<div class="form-wrapper">
							<form action="includes/courses.inc.php" method="POST">
																
								<div class="form-group">
									<label class="sr-only">Course Id</label>
									<input type="text" class="form-control" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; }  ?>" name="cid" placeholder="Course Id " required />
								</div>
								<div class="form-group">
									<label class="sr-only">Course Type</label>
									<input type="text" class="form-control" value="<?php if(isset($_GET['tp'])){ echo $_GET['tp']; }  ?>" name="ctype" placeholder="Course Type" required />
								</div>
								<div class="form-group">
									<label class="sr-only">Course Name</label>
									<input type="text" value="<?php if(isset($_GET['nm'])){ echo $_GET['nm']; }  ?>" class="form-control" name="cname" placeholder="Course Name" required />
								</div>
								<div class="form-group ">
									<select class="form-control chosen_select" id="he" name="classes[]" required multiple data-placeholder="Choose who can apply for this course">	
										<?php
											$array = array('Class X', 'Class XI', 'Class XII', 'Btech', 'Mtech', 'Other');
											$i=20;
											for($j=0; $j<6; $j++){ 
												if(isset($_GET['climit']) && $_GET[$i] == $array[$j] ){
													echo '<option selected>'.$array[$j].'</option>';	
														$i++;
												}
												else{
													echo '<option>'.$array[$j].'</option>';												
												}
											}
										?>		
										
									</select>	
								</div>
								<div class="form-group ">
									<select class="form-control chosen_select" id="he" name="centers[]" required multiple data-placeholder="Choose centers where this course will be available">		
										<?php	
											$query ="select center_name from centers";
											$result=mysqli_query($conn,$query);
											$i=0;
											while($row = mysqli_fetch_array($result)){
												if(isset($_GET['limit']) && $_GET[$i] == $row['center_name'] ){
													echo '<option selected>'.$row['center_name'].'</option>';	
													$i++;		
												}
												else{
												
													echo '<option>'.$row['center_name'].'</option>';
												}
											}
											
											
											
										?>	
										
									</select>	
								</div>
								<div class="form-group">
									<label class="sr-only">Course Description</label>
									<textarea class="form-control" name="cdesc" style="height:200px;" placeholder="Course Description (This will be displayed on Courses Page for viewers) " required ><?php if(isset($_GET['desc'])){ echo $_GET['desc']; }  ?></textarea>
								</div>
								<p style="color:teal;">Use html paragraph tags to create separate paragraphs .</p> <br>
																
								<div class="checkbox">
									<label>
										<input type="checkbox" name="save">Publish Course when I click on save
									</label>
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="add-course">Save / Publish</button>
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
													&nbsp; &nbsp;<button id="button" name="add-course1" class="btn btn-warning btn-sm pull-right">Yes</button>
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
	
	<?php
	
		if(isset($_GET['success']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">New Course was added successfully.</p> 
						<button id="buttoner" class="btn btn-danger btn-sm pull-right">Close</button>
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
						<button id="buttoner" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['crsExt']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Course Id you entered is already in use. Please provide a different one.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		
		
	
	?>
	
	
	
	
	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	
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
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
			};
			
			
		};
	</script>
	<script>
		document.getElementById('buttoner').onclick = function () {
			document.getElementById('success-modal').style.display = "none",
			window.location.replace('add_course.php');
		};
		
	
	</script>
	
	
	

</body>
</html>
				
				
				
				
				
				