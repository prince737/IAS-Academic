<?php
	session_start();
	require_once('../includes/dbh.inc.php');	
	
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
	
	if(isset($_GET['success']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Event was Updated successfully.</p> 
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
	if(isset($_GET['dlt']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Event was successfully removed.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	
	
	
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Active Events | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/active-notices.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css/chosen.min.css">
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
					<li class="link active">
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
					<header  class="clearfix">
						<h2 class="page_title pull-left">All Events</h2>
						<a type="button" class="new pull-right btn btn-xs" href="new_event.php">Create new</a>
					</header>
					
					<div class="inner-content">
						
							
							<?php
								$query ="Select * from events";
								$result=mysqli_query($conn, $query);
									$i = 1;	
									while($row = mysqli_fetch_array($result))
									{
										$phpdate = strtotime($row['events_startdate']);
										$date1 = date( 'd M, Y', $phpdate );
										$phpdate = strtotime($row['events_enddate']);
										$date2 = date( 'd M, Y', $phpdate );
										echo'
											<div class="row notice-row">
											<div class="col-md-1 col-xs-2 col-sm-1 status-padding">
										';
										if($row['events_status']==1 && strtotime('now') < strtotime($date2)){
											echo '<span class="label label-success label-sm">Active</span>';
										}
										else{
											echo '<span class="label label-danger label-sm">Inactive</span>';
										}
										echo '
											</div>
											<div class="col-md-8 col-xs-10 col-sm-6 notice-title">
												<p class="heading">'.$row['events_heading'].'</p>
												<p>'.$row['events_body'].'</p>
												<small>Starts '.$date1.'</small>
												<small>&nbsp;&nbsp;Ends '.$date2.'</small>
												<small>&nbsp;&nbsp;Starting Time '.$row['events_starttime'].'</small>
												<small>&nbsp;&nbsp;Ending Time '.$row['events_endtime'].'</small>
												
											</div>	
											<div class="col-md-3 col-xs-10 col-sm-5 col-xs-offset-2 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
												<div class="notice-actions">
													<form action="includes/events.inc.php" method="POST" enctype="multipart/form-data">';
														if($row['events_status']==1 && strtotime('now') < strtotime($date2)){
															echo '<button type="submit" class="btn btn-xs btn-default" role="button" name="deactivate" >
															<span class="fa fa-ban" aria-hidden="true">&nbsp;Deactivate</span>
														</button> ';
														}
														elseif($row['events_status']==0){
															echo '<button type="submit" class="btn btn-xs btn-default" role="button" name="activate" >
															<span class="fa fa-unlock" aria-hidden="true">&nbsp;Activate</span>
														</button> ';
														}
													echo '<a type="button" href="../index.php" class="btn btn-xs btn-default" role="buton" name="view" target="_blank">
															<span class="fa fa-folder-open" aria-hidden="true">&nbsp;View</span>
														</a> 
														
														<button type="button" class="btn btn-xs btn-default" role="button" name="update" data-target="#Modal'.$i.'" data-toggle="modal">
															<span class="fa fa-pencil" aria-hidden="true">&nbsp;Edit</span>
														</button> 
														
																										
														
														<button class="btn btn-xs btn-default" type="button" role="buton" name="delete" data-target="#dModal'.$i.'" data-toggle="modal">
															<span class="fa fa-remove" aria-hidden="true">&nbsp;Delete</span>
														</button> 
														
														<div class="modal fade" id="dModal'.$i.'"  >
															<div class="modal-dialog modal-sm" style="margin-top:10%;">
																<div class="modal-content" >
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Deny Approval</h4>				
																	</div>
																	<div class="modal-body">
																		<input type="hidden" value="'.$row['eid'].'" name="eid"></input>
																		Sure to delete the event?
																	</div> 
																	<div class="modal-footer">
																		<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
																			<button type="submit" class="btn btn-danger btn-xs" name="delete">Delete</button>
																	</div>		
																</div>
															</div>
														</div>
														
													</form>
												</div>
											</div>
										</div>
										<hr>
										';
										
										
										echo '
										<form action="includes/events.inc.php" method="POST" enctype="multipart/form-data">
											<div class="modal fade" id="Modal'.$i.'"  >
												<div class="modal-dialog">
													<div class="modal-content" >
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4 style="color:teal;">Update Event</h4>
															<h6>*Leave as it is if no changes are required</h6>	
														</div>
														<div class="modal-body">
															'.$row['eid'].'
															<input type="hidden" value="'.$row['eid'].'" name="eid"></input>	
															
															 
															<div class="form-group">
																<select class="form-control chosen_select" name="courses[]" required multiple data-placeholder="Choose who this event is for">	
																	<option value="all">ALL</option>	';
																	
																		$eventfor=array();
																		$sql="select * from event_for where event_id=".$row['eid'];
																		$res=mysqli_query($conn,$sql);
																		while($ef=mysqli_fetch_array($res)){
																			$eventfor[]=$ef['course_id'];
																		}
																		
																		
																		
																		$query ="select * from courses";
																		$resul=mysqli_query($conn,$query);										
																		while($row1 = mysqli_fetch_array($resul)){	  
																			if(in_array($row1['course_id'],$eventfor)){
																				echo '<option value="'.$row1['course_id'].'" selected>'.$row1['course_name'].' - '.$row1['course_type'].'</option>';		
																			}
																			else{
																				echo '<option value="'.$row1['course_id'].'">'.$row1['course_name'].' - '.$row1['course_type'].'</option>';
																			}																			
																			
																		}	
																echo '</select>	
															</div>
															
																		
															<div class="form-group">
																<label for="datepicker">Update Start Date</label>
																<input type="text" class="form-control" name="startdate" id="datepicker"  value="'.$row['events_startdate'].'"/>
															</div>
															<div class="form-group">
																<label for="datepicker">Update End Date</label>
																<input type="text" class="form-control" name="enddate" id="datepicker2"  value="'.$row['events_enddate'].'"/>
															</div>
															<div class="form-group">
																<label for="datepicker">Update Start Time</label>
																<input type="text" class="form-control" name="stime"" value="'.$row['events_starttime'].'" maxlength="8"/>
															</div>
															<div class="form-group">
																<label for="datepicker">Update End Time</label>
																<input type="text" class="form-control" name="etime"" value="'.$row['events_endtime'].'" maxlength="8"/>
															</div>
															<div class="form-group">
																<label for="datepicker">Update Heading</label>
																<input type="text" class="form-control" name="heading"" value="'.$row['events_heading'].'"/>
															</div>
															<div class="form-group">
																<label for="body">Update Body</label>
																<textarea class="form-control" name="body" rows="5">'.$row['events_body'].'</textarea>
															</div>
															
																		
																		
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="save">Publish Notice when I click on save
																</label>
															</div>
															
														</div> 
														<div class="modal-footer">
															<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary btn-xs" name="update">Save / Publish</button>
														</div>		
													</div>
												</div>
											</div>
										</form>
										';
										
										global $i;
										$i=$i+1;
										
									}
								
							?>
						
						
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
	  $( function() {
		$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				altField: "#datepicker",
				altFormat: "yy-mm-dd",
			});
	  });
	</script>
	<script src="../vendor/js/chosen.jquery.min.js"></script>
	<script>
		$(".chosen_select").chosen({
			disable_search_threshold: 10,
			no_results_text: "Oops, nothing found!",
			width: "100%"
		});

	
	</script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('active_events.php');
			};
		};
	</script>
	
</body>
</html>