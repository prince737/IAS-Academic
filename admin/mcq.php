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
	<title>Edit MCQ / MAMCQ | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    	.stu-con{
			margin:10px;
			background:#fff;	
			padding:20px 20px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		}
		.modal-dialog{
			width:80%!important;
			
		}
		.modal-content{
			border-radius: 0px;
		}
		#search{
			margin-bottom: 15px;
		}
		#ans{
			margin-top: 10px;
			margin-bottom: 10px;
		}
		#success-modal{
			display:none;
		}
		#search_res{
			text-align: center;
			display:none;
		}
	</style>
</head>

<body>	


	<div class="modal fade" id="editor">
		<div class="modal-dialog">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>	<h3 style="color:red;">Edit NAT Question</h3>				
				</div>
				<div class="modal-body">
					<p><b>Important:</b> Be careful with Images. Removing an image from the editor will delete it from the database and thus the question won't contain that image even if you don't click on "Save" button.</p>
					<textarea id="summernote" name="question_desc" required></textarea>
					<input type="text" class="form-control" name="ans" id="ans" placeholder="Correct Answer">  
					<input type="text" class="form-control" name="opt" id="opt" placeholder="No of Options">  
					<p id="qid" style="display:none;"></p>
					<p><b>After making any changes on an image or text color, please refresh the page for them to take effect.</b></p>
				</div> 
				<div class="modal-footer">
					<center><button type="submit" class="btn btn-success" name="remove-dash" id="save" style="width:200px;">Save</button></center>
				</div>		
			</div>
		</div>
	</div>	

	<div id="success-modal">
		<div class="modalconent">
			<h3 style="color:teal;">Information</h3>
			<hr>	
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
				
				<div id="content">				
					<header class="clearfix">
						<h2 class="page_title pull-left">Edit Question</h2>	
						<a type="button" class="new pull-right btn-primary btn-xs" href="questions.php">Add Questions</a>
						<a type="button" class="new pull-right btn-warning btn-xs" href="edit_dir.php">Edit Directory</a>
						<a type="button" class="new pull-right btn-danger btn-xs" href="view_directories.php">View all Directories</a>
					</header>

					<?php  
						if(isset($_GET['did'])){ 
							$did = $_GET['did'];
							$type = $_GET['type'];
							$sql = "select * from directories where dir_id='$did'";
							$res = mysqli_query($conn,$sql);
							$dir = mysqli_fetch_array($res);
							$dname = $dir['dir_name']; 
						}    
					?>
					<p class="dir" style="padding:15px 0px 0 20px;">Directory: <b><?php  echo $dname;    ?></b></p>
					<p class="dir" style="padding:0 0px 0 20px; margin-bottom: -5px;">Question Type: <b id="type" ><?php echo $type; ?></b></p>
					<p id="dir" style="display:none;"><?php echo $did; ?></p>


					

					
					<div class="content-inner">
						<input type="text" class="form-control" id="search" placeholder="Search">
						<p id="search_res"><span id="no">5</span> results found on "<span id="string"></span>"</p>
						<div class="form-wrapper" id="data">
							
							
							<?php

								$sql = "select * from mcq where mcq_directory='$did' and mcq_type='$type'";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res);

								$sql = "select * from mcq where mcq_directory='$did' and mcq_type='$type' LIMIT 10";
								$res = mysqli_query($conn,$sql);
								if(mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_array($res)){
										echo '
											<div class="stu-con">
												<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div><br>
												<b><div>Answer: </b><span class="answer" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</span></div><br>
												<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
												<button class="btn btn-primary btn-sm edit" id="'.$row['mcq_id'].'">Edit</button>
											</div>
										';
									}
								}
								else{
									echo '<div class="stu-con">No data found.</div>';
								}
							?>
							
						</div>
						<br>&nbsp;<button class="btn btn-success" id="show">Show more</button>
						&nbsp;<a class="btn btn-warning" href="temp.php?did=<?php echo $did; ?>&type=NAT"" id="reset">Reset</a>
						&nbsp;&nbsp;<span id="cwrap" style=" font-weight: bold;">Showing 1 to <span id="count" style=" font-weight: bold;"><?php if($count<10) echo $count; else echo'10'; ?></span> of <?php echo $count; ?> entries</span>
						
					</div>				
				</div>
			</div>
		</div>
	</div>	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/mcq.js"></script>
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

		    var a=<?php echo $count; ?>;
			if(a<=10){
				$("#reset").hide();
				$("#show").hide();
			}
		});
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
				
				
				
				
				
				