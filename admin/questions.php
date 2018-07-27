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
	<title>Questions| IAS</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/question.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="../images/logo.jpg" />
</head>
<body>

	<div id="success-modal">
		<div class="modalconent">
			<h3>Information</h3>
			<hr>	
			<p><b class="para"></b></p> 
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
								<a href="#">
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
					<header  class="clearfix">
						<h2 class="page_title pull-left">Add Questions</h2>
						<a type="button" class="new pull-right btn-primary btn-xs" href="#">Add Questions</a>
						<a type="button" class="new pull-right btn-warning btn-xs" href="#">Edit Directory</a>
						<a type="button" class="new pull-right btn-danger btn-xs" href="#">View all Directories</a>
					</header>
					
					<div class="inner-content">
						<div class="form-wrapper">
							<form id="questionForm" action="includes/question.inc.php" method="POST" enctype="multipart/form-data">
								
								<label for="course">Choose a directory to add questions to:</label>
								<select class="form-control" id="qdir" name="qdir" required>
									<option selected value="0">Select Directory</option>
									<?php
										$sql = 'select * from directories';
										$result = mysqli_query($conn, $sql);
										
										while($row = mysqli_fetch_array($result)){
											echo '<option value="'.$row['dir_id'].'">'.$row['dir_name'].'</option>';
										}										
									
									?>
								</select>

								<label for="course">Choose the type of question:</label>
								<select class="form-control" id="qtype" name="qtype" required>
									<option selected value="0">Select Question Type</option>
									<option value="MCQ">MCQ</option>
									<option value="NAT">NAT</option>
									<option value="CDL">CDL</option>
									<option value="MAMCQ">MAMCQ</option>									
								</select>
								<div class="form-group summernote">
									<p><strong>Important:</strong> Do not use backspace key to remove an inserted image, instead click on the image and then click on the trashcan icon.</p>
									<textarea id="summernote" name="question_desc" required></textarea>
								</div>
								<div class="mcq" id="mcq">
									<div class="form-group">
										<input type="text" class="form-control" name="option_no" id="option_no" placeholder="Number of Options">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="mcq_ans" id="mcq_ans" placeholder="Correct Answer">
									</div>
									<div class="clearfix">
										<button type="submit" class="btn btn-primary" style="width:120px;" id="submit_mcq" name="submit_mcq">Save</button>
									</div>
								</div>
								<div class="nat" id="nat">
									<div class="form-group">
										<input type="text" class="form-control" name="nat_ans" id="nat_ans" placeholder="Correct Answer">
									</div>
									<div class="clearfix">
										<button type="submit" class="btn btn-primary" style="width:120px;" name="submit_nat">Save</button>
									</div>
								</div>
								<div class="mamcq" id="mamcq">
									<div class="form-group">
										<input type="text" class="form-control" name="moption_no" id="moption_no" placeholder="Number of Options">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="mamcq_answers" id="mamcq_answers" placeholder="Correct Answers (Comma separated)">
									</div>
									<div class="clearfix">
										<button type="submit" class="btn btn-primary" style="width:120px;" name="submit_mamcq">Save</button>
									</div>
								</div>	

								<div class="cdl" id="cdl">
									<div id="cdl_data"></div>
									<small>*You must save the CDL data before adding question linked to it.</small><br>
									<input type="hidden" class="form-control" name="cdl_id" id="cdl_id">
									<button type="submit" id="add_question" class="btn btn-primary" name="submit_cdl">Save Data</button>
								</div>	
												
							</form>
						</div>
					</div>	
														
				</div> <!-- end of content-->
			</div>
		</div>	
	</div>

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/default.js"></script>
	<script src="js/questions.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	<script>
		$(document).ready(function() {
		    $('#summernote').summernote({
		    	height: 400,
		    	callbacks: {
			        onImageUpload : function(files, editor, welEditable) {			 
			            for(var i = files.length - 1; i >= 0; i--) {
			                sendFile(files[i], this);
			            }
			        },
			        onMediaDelete : function(target) {
		                deleteFile(target[0].src);
		            }
			    }

		    });
		});

		function sendFile(file, el) {
			var form_data = new FormData();
			form_data.append('file', file);
			$.ajax({
			    data: form_data,
			    type: "POST",
			    url: 'editor-upload.php',
			    cache: false,
			    contentType: false,
			    processData: false,
			    success: function(url) {
			        $(el).summernote('editor.insertImage', url);
			    }
			});
		}

		function deleteFile(src) {
		    $.ajax({
		        data: {src : src},
		        type: "POST",
		        url: 'editor-delete.php', // replace with your url
		        cache: false,
		        success: function(resp) {
		            console.log(resp);
		        }
		    });
		}


	</script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none";
			};
		};

		
	</script>


	
</body>
</html>