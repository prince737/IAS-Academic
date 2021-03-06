<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
	
	if(isset($_GET['msnt']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Message was successfully sent to user\'s mail id.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['rdsh']) || isset($_GET['rdb']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Query was successfully removed.</p>
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	
	
	
	
	if(isset($_GET['error']) || isset($_GET['m_n_snt']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Something went wrong, Please try again.</p>
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	
	$query ="Select * from queries where q_replystatus=0 and q_removalstatus=0 order by q_id desc";
	$result =@mysqli_query($conn,$query); 
	
	$query1 ="Select * from queries where q_replystatus=1 and q_removalstatus=0 order by q_id desc";
	$result1 =@mysqli_query($conn,$query1); 
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Manage Queries | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
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
					<li class="link active">
						<a href="#">
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
				
					<div class="row">
						<div class="col-md-6 dashboard-left-cell">
							<div class="admin-content-con">
								<header>
									<h5>Queries with Pending Replies</h5>
								</header>
				                <?php
									if($result){
										$i = 1;	
										while($row = mysqli_fetch_array($result))
										{
											$now = date("Y-m-d");
											$date1 = new DateTime($now);
											$date2 = new DateTime($row['q_date']);
											$diff = $date2->diff($date1)->format("%a");
											
											if($diff == 0){
												$diff = 'Today';
											}
											else{
												$diff = $diff.' days ago';
											}
											
											echo '
											<form action="includes/query.inc.php" method="POST">
												<input type="hidden" value="'.$row['q_id'].'" name="q_id"></input>
												<div class="comment-head-dash clearfix">
													<div class="commenter-name-dash pull-left">'.$row['q_name'].' &nbsp;&nbsp;&nbsp;<small>Mob: </small>'.$row['q_phone'].'</div>
													<div class="days-dash pull-right">'.$diff.'</div>
												</div>
												<p class="comment-dash">
													 '.$row['q_message'].'
												</p>
												<small class="comment-date-dash">'.$row['q_time'].' '.$row['q_date'].'</small>
												
												<button class="btn btn-xs btn-danger pull-right" style="margin-left:10px;" type="button" data-target="#rModal'.$i.'" data-toggle="modal">Remove</button>
												<button class="btn btn-xs btn-success pull-right" name="reply" data-target="#QModal'.$i.'" data-toggle="modal" type="button" >Reply</button>
												<div class="comment-head-dash clearfix"></div>
												<hr>
												
												<div class="modal fade" id="QModal'.$i.'"  >
													<div class="modal-dialog" style="margin-top:50px!important;">
														<div class="modal-content" >
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>	<h3 style="color:teal;">Reply to Query</h3>				
															</div>
															<div class="modal-body">
																<label for="email">User\'s Email:</label>
																<input class="form-control" name="email" id="email" value="'.$row['q_email'].'" readonly><br>
																<label for="name">User\'s Name:</label>
																<input class="form-control" name="name" id="name"  value="'.$row['q_name'].'" readonly><br>
																<label for="email">User\'s Phone Number:</label>
																<input class="form-control" name="phone" id="phone" value="'.$row['q_phone'].'" readonly><br>
																<label for="msg">Your Message:</label>
																 <textarea class="form-control" id="msg" rows="3" placeholder="Message" name="message"  required></textarea>
																
																
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
																<button type="submit" name="qsreply" class="btn btn-success">Send Reply</button>
															</div>		
														</div>
													</div>
												</div>
											</form>	
											<form action="includes/query.inc.php" method="POST">
												<input type="hidden" value="'.$row['q_id'].'" name="q_id"></input>	
												<div class="modal fade" id="rModal'.$i.'"  >
													<div class="modal-dialog modal-xs">
														<div class="modal-content" >
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>	<h3 style="color:#EF5350;">Remove Query</h3>				
															</div>
															<div class="modal-body">
																<p class="font">This will not remove the record from the database, instead, only remove from the dashboard.</p>
															</div> 
															<div class="modal-footer">
																<button type="submit" class="btn btn-warning" name="remove-dash">Continue</button>
																or
																<button type="submit" name="remove-db" class="btn btn-danger">Remove from Database</button>
															</div>		
														</div>
													</div>
												</div>	
											</form>								
											';
											$i++;
										}
									}
								?>
								
							</div>
						</div>
						
						<div class="col-md-6 dashboard-right-cell">
							<div class="admin-content-con">
								<header>
									<h5>Queries that are Already Replied</h5>
								</header>
				                <?php
									if($result1){
										$i = 1;	
										while($row = mysqli_fetch_array($result1))
										{
											$now = date("Y-m-d");
											$date1 = new DateTime($now);
											$date2 = new DateTime($row['q_date']);
											$diff = $date2->diff($date1)->format("%a");
											
											if($diff == 0){
												$diff = 'Today';
											}
											else{
												$diff = $diff.' days ago';
											}
											
											echo '
											<form action="includes/query.inc.php" method="POST">
												<input type="hidden" value="'.$row['q_id'].'" name="q_id"></input>
												<div class="comment-head-dash clearfix">
													<div class="commenter-name-dash pull-left">'.$row['q_name'].' &nbsp;&nbsp;&nbsp;<small>Mob: </small>'.$row['q_phone'].'</div>
													<div class="days-dash pull-right">'.$diff.'</div>
												</div>
												<p class="comment-dash">
													 '.$row['q_message'].'
												</p>
												<small class="comment-date-dash">'.$row['q_time'].' '.$row['q_date'].'</small>
												
												<button class="btn btn-xs btn-danger pull-right" style="margin-left:10px;" type="button" data-target="#rModal'.$i.'" data-toggle="modal">Remove</button>
												
												<div class="comment-head-dash clearfix"></div>
												<hr>
												
											</form>	
											<form action="includes/query.inc.php" method="POST">
												<input type="hidden" value="'.$row['q_id'].'" name="q_id"></input>	
												<div class="modal fade" id="rModal'.$i.'"  >
													<div class="modal-dialog modal-xs">
														<div class="modal-content" >
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>	<h3 style="color:#EF5350;">Remove Query</h3>				
															</div>
															<div class="modal-body">
																<p class="font">This will not remove the record from the database, instead, only remove from the dashboard.</p>
															</div> 
															<div class="modal-footer">
																<button type="submit" class="btn btn-warning" name="qremove-dash">Continue</button>
																or
																<button type="submit" name="qremove-db" class="btn btn-danger">Remove from Database</button>
															</div>		
														</div>
													</div>
												</div>	
											</form>								
											';
											$i++;
										}
									}
								?>
								
							</div>
						</div>
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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('queries.php');
			};
		};
	</script>

</body>
</html>				