<?php
	session_start();
	require_once('../includes/dbh.inc.php');	
	include '../includes/simple-crypt.inc.php';

	
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}

	$dname='';
	$dlevel='';
	$did='';

	if(isset($_POST['qdir'])){
		$dir= mysqli_real_escape_string($conn, $_POST['qdir']);
		$sql = "select * from directories where dir_id='$dir'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$dname = $row['dir_name'];
		$dlevel = $row['dir_level'];
		$did = $row['dir_id'];
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Edit Directory| IAS</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="../images/logo.jpg" />
    <style>
    	header a{
    		margin-left:10px;
    	}
	</style>
</head>
<body>

	<?php
		if(isset($_GET['err'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:red;">Error</h3>
						<hr>	
						<p class="para">Something went wrong, close this dialog and try again.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}
		elseif(isset($_GET['lv'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">The name and level of the Directory having Id  <b>\''.simple_crypt($_GET['id'],'d').'\'</b> was successfully updated to  <b>\''.simple_crypt($_GET['nm'],'d').'\'</b> and  <b>'.$_GET['lv'].'</b> respectively.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}

	?>

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
						<h2 class="page_title pull-left">Edit a Directory</h2>
						<a type="button" class="new pull-right btn-primary btn-xs" href="questions.php">Add Questions</a>
						<a type="button" class="new pull-right btn-warning btn-xs" href="create_dir.php">Create Directory</a>
						<a type="button" class="new pull-right btn-danger btn-xs" href="#">View all Directories</a>
					</header>
					
					<div class="inner-content">
						<div class="form-wrapper">
							<form action="#" method="POST" enctype="multipart/form-data">
								
								<label id="l2" for="course">Choose a directory to edit:</label>
								<select class="form-control" id="qdir" name="qdir" onchange="this.form.submit()" required>
									<option selected value="0">Select Directory</option>
									<?php
										$sql = 'select * from directories';
										$result = mysqli_query($conn, $sql);
										
										while($row = mysqli_fetch_array($result)){
											if(!empty($dname) && $dname==$row['dir_name']){
												echo '<option value="'.$row['dir_id'].'" selected>'.$row['dir_name'].'</option>';
											}
											else{
												echo '<option value="'.$row['dir_id'].'">'.$row['dir_name'].'</option>';
											}
										}										
									
									?>
								</select>
							</form>

							<form action="includes/edit_dir.inc.php" method="POST" enctype="multipart/form-data">
								<?php
									if(!empty($dname) || !empty($dlevel))
									{
										echo '
											<br>
											<p><b>Note: </b>Type over current name and level to change them.</p>
											<div class="form-group">
												<label class="sr-only">Name of Directory</label>
												<input type="text" class="form-control" name="name" required value = "'.$dname.'">
											</div>

											<div class="form-group">
												<label class="sr-only">Level</label>
												<input type="text" class="form-control" name="level" required value = "'.$dlevel.'">
											</div>
											<input type="hidden" class="form-control" name="did" required value = "'.$did.'">

											<button type="submit" class="btn btn-primary" style="width:120px;" name="edit_dir">Save</button>
											<a href="edit_dir.php" class="btn btn-warning">Reset</a>

										';
									}
								?>								
								
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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('edit_dir.php');
			};
		};
	</script>
	
</body>
</html>