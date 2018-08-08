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
	<title>Edit NAT | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    	.stu-con{
			margin:5px;
			background:#fff;	
			padding:20px 20px;
		}
		.modal-dialog{
			width:80%!important;
			
		}
		.modal-content{
			border-radius: 0px;
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
					<p>Important: Be careful with Images. Removing an image from the editor will delete it from the database and thus the question won't contain that image even if you don't click on "Save" button.</p>
					<textarea id="summernote" name="question_desc" required></textarea>
					<input type="text" class="form-control" name="nat_ans" id="nat_ans" placeholder="Correct Answer">  
				</div> 
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" name="remove-dash">Save</button>
					<button type="submit" name="remove-db" class="btn btn-danger">Close</button>
				</div>		
			</div>
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
					<p class="dir" style="padding:0 0px 0 20px; margin-bottom: -5px;">Question Type: <b><?php  echo $type;    ?></b></p>
					<p id="dir" style="display:none;"><?php echo $did; ?></p>


					<input type="text" class="form-control" id="search" placeholder="Search a NAT Question">

					
					<div class="content-inner">
						<div class="form-wrapper" id="data">
							<?php

								$sql = "select * from nat where nat_directory='$did'";
								$res = mysqli_query($conn,$sql);
								$count = mysqli_num_rows($res);

								$sql = "select * from nat where nat_directory='$did' LIMIT 10";
								$res = mysqli_query($conn,$sql);
								if(mysqli_num_rows($res) > 0){
									while($nat = mysqli_fetch_array($res)){
										echo '
											<div class="stu-con">
												<div class="statement" id="stmt'.$nat['nat_id'].'">'.$nat['nat_statement'].'</div>
												<div class="answer" id="ans'.$nat['nat_id'].'">'.$nat['nat_answer'].'</div>
												<button class="btn btn-primary btn-sm edit" id="'.$nat['nat_id'].'">Edit</button>
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
						
					</div>				
				</div>
			</div>
		</div>
	</div>	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/nat.js"></script>
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
</body>
</html>
				
				
				
				
				
				