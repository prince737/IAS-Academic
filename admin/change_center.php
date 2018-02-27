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
	<title>Students | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="css/student_all.css">
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
										
					<li class="link  active">
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
					<li class="link ">
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
						<h2 class="page_title">Student's Profile Updation requests</h2>	
					</header>	
					<div class="content-inner">
						<div class="row">
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm " id="profile" onclick="location.href='students_profile.php';"><span class="fa fa-wrench"></span> Profile Updation Requests</button>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm " id="change" onclick="location.href='change-requests.php';"><span class="fa fa-exchange"><span> Course Change Requests</button>
							</div>
							
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm current" id="add" onclick="location.href='#';"><span class="fa fa-exchange"><span> Center Change Requests</button>
							</div>
							<div class="col-md-2" style="margin-left:-5px;">
								<button type="submit" class="btn btn-default btn-sm " id="add" onclick="location.href='course_add_requests.php';"><span class="fa fa-plus-circle"><span> Course Addition Requests</button>
							</div>
							<div class="col-md-4">
								<form action="change-requests.php" method="POST" class="navbar-form search-form navbar-right" role="search" style="margin-top:0px;">
									<div class="form-group">
									<input type="text" name="field" class="form-control" placeholder="Name or Registration No">
									</div>
									<button type="submit" class="btn btn-default btn-sm" name="search"><span class="fa fa-search"><span>   Search</button>
								</form>
							</div>
						</div>
						<div class="clearfix"></div>
						
						<div id="change-wrap">
							
							<?php	
						
								
							?>
							<div class="table-wrap"><br>
								<h4>Center Change Requests</h4>
								<table class="table table-bordered" >
									<thead class="thead-dark">
										<tr>
											<th>#</th>
											<th>Name</th>									
											<th>Current Center</th>
											<th>Requested Center</th>									
											<th>Course</th>									
											<th>Actions</th>											
										</tr>
									</thead>
									<tbody>	
										<?php	
											
											if(isset($_POST['search'])){
												$search = mysqli_real_escape_string($conn, $_POST['field']);
												$query = "select * from center_change INNER JOIN courses ON center_change.course_id=courses.course_id INNER JOIN centers on center_change.old_center_id=centers.center_id INNER JOIN students on student_id=stu_id where cchange_status=0 and stu_name LIKE '%$search%' OR stu_registrationNo LIKE '%$search%';";
												
												$result = mysqli_query($conn, $query);
												$count = mysqli_num_rows($result);
											}
											else{
												$query = "select * from center_change INNER JOIN courses ON center_change.course_id=courses.course_id INNER JOIN centers on center_change.old_center_id=centers.center_id INNER JOIN students on student_id=stu_id where cchange_status=0;";
												$result= mysqli_query($conn, $query);
											}
											
											if(isset($_POST['search']) && $count === 0){
													
												echo '<h5 style="text-align:center;">No Result Found.     <a href="change-requests.php">View All</a></h5>';
											}	
											elseif(isset($_POST['search']) && $count > 0){
												echo '<h5 style="text-align:center;">Displaying Results on "'.$search.'".     <a href="change-requests.php">View All</a></h5>';
											}
											
											$i=1;
											while($row = mysqli_fetch_array($result)){		
												$cid=$row['new_center_id'];
												$sql="select center_name from centers where center_id=$cid";
												$res=mysqli_query($conn, $sql);
												$row1=mysqli_fetch_array($res);
												echo '						
													<tr>
													<td>'.$i.'</td>
													<td>'.$row['stu_name'].'</td>
													<td>'.$row['center_name'].'</td>
													<td>'.$row1['center_name'].'</td>
													<td>'.$row['course_name'].'</td>
													<td>
													
														<button class="btn btn-success btn-xs" data-target="#Modalapprv'.$row['stu_id'].$i.'" data-toggle="modal"><span class="fa fa-thumbs-o-up"> Approve</button>

														<div class="modal fade" id="Modalapprv'.$row['stu_id'].$i.'"  >
															<div class="modal-dialog">
																<div class="modal-content modal-cnt" >
																	<div class="modal-header">
																			
																		<button type="button" class="close" data-dismiss="modal">&times;</button>	
																		<h4>Approve Request?</h4>
																	</div>
																	<div class="modal-body">
																				
																		<form action="includes/center_change.inc.php" method="POST">
																			<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
																			<input type="hidden" name="oldValue" value="'.$row['old_center_id'].'"/>
																			<input type="hidden" name="newValue" value="'.$row['new_center_id'].'"/>
																			<input type="hidden" name="course" value="'.$row['course_id'].'"/>
																			
																			
																			<p>Sure to approve '.$row['stu_name'].'\'s request to change his/her center from <b>'.$row['center_name'].'</b> to <b>'.$row1['center_name'].'</b> for course <b>'.$row['course_name'].'</b>?</p>
																			<p><b>This cannot be reverted!</b></p>
																			
																			<button class="btn btn-success btn-sm pull-right approve" name="approve-center"><span class="fa fa-thumbs-up"> Approve</button>
																			<div class="clearfix"></div>
																		</form>
																	</div> 																
																</div>
															</div>
														</div>	
														
														<a class="btn btn-warning btn-xs" href="students_all.php?id='.$row['stu_id'].'" target="_blank"><span class="fa fa-info-circle"> Details</a>
													
														<button class="btn btn-danger btn-xs" data-target="#Modaldeny'.$row['stu_id'].$i.'" data-toggle="modal"><span class="fa fa-thumbs-o-down"> Deny</button>

														<div class="modal fade" id="Modaldeny'.$row['stu_id'].$i.'"  >
															<div class="modal-dialog">
																<div class="modal-content modal-deny">
																	<div class="modal-header">
																			
																		<button type="button" class="close" data-dismiss="modal">&times;</button>	
																		<h4>Deny Request?</h4>
																	</div>
																	<div class="modal-body">
																				
																		<form action="includes/center_change.inc.php" method="POST">
																			<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
																			<input type="hidden" name="oldValue" value="'.$row['old_center_id'].'"/>
																			<input type="hidden" name="newValue" value="'.$row['new_center_id'].'"/>
																			<input type="hidden" name="course" value="'.$row['course_id'].'"/>
																			
																			<p>Sure to deny '.$row['stu_name'].'\'s request to change his/her center from <b>'.$row['center_name'].'</b> to <b>'.$row1['center_name'].'</b> for course <b>'.$row['course_name'].'</b>?</p>
																			<p><b>This cannot be reverted!</b></p>
																			
																			<button class="btn btn-danger btn-sm pull-right deny" name="deny_center"><span class="fa fa-thumbs-down"> Deny</button>
																			<div class="clearfix"></div>
																		</form>
																	</div> 																
																</div>
															</div>
														</div>		


															
													
													</td>
													
												';
											}			
										?>	
									</tbody>
								</table>										
							
							</div>
							
							
						</div>
						
						
							
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	
	
	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/default.js"></script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('change_center.php');
			};
		};
	</script>
	
</body>
</html>

<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	
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
	if(isset($_GET['update_success']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Student\'s center change request was successfully approved.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	
	if(isset($_GET['change_denied']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Student\'s course change request was successfully denied.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
		
	
?>

