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
					<p class="para">Notice / Event was added successfully.</p> 
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
	if(isset($_GET['update_success']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Student\'s profile updation request was successfully approved.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['deny_success']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Student\'s profile updation request was successfully denied.</p> 
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
						<h2 class="page_title">Student's Profile Updation requests</h2>	
					</header>	
					<div class="content-inner">
						<div class="row">
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm current" id="profile" name="search"><span class="fa fa-wrench"><span> Profile Updation Requests</button>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm " id="change"  onclick="location.href='change-requests.php';"><span class="fa fa-exchange"><span> Course Change Requests</button>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-default btn-sm " id="add" onclick="location.href='change_center.php';"><span class="fa fa-exchange"><span> Center Change Requests</button>
							</div>
							<div class="col-md-2" style="margin-left:-5px;">
								<button type="submit" class="btn btn-default btn-sm " id="add" onclick="location.href='course_add_requests.php';"><span class="fa fa-plus-circle"><span> Course Addition Requests</button>
							</div>
							<div class="col-md-4">
								<form action="students_profile.php" method="POST" class="navbar-form search-form navbar-right" role="search" style="margin-top:0px;">
									<div class="form-group">
									<input type="text" name="field" class="form-control" placeholder="Name or Registration No">
									</div>
									<button type="submit" class="btn btn-default btn-sm" name="search"><span class="fa fa-search"><span>   Search</button>
								</form>
							</div>
						</div>
						<div class="clearfix"></div>
						
						<div id="profile-wrap">
						<?php	
						
							if(isset($_POST['search'])){
								$search = mysqli_real_escape_string($conn, $_POST['field']);
								$query = "select DISTINCT stu_id, stu_imageLocation, stu_name, stu_roll from students INNER JOIN student_profile_update ON stu_id = student_id where (stu_name LIKE '%$search%' OR stu_roll LIKE '%$search%') AND (spu_status=0)";
								
								$result = mysqli_query($conn, $query);
								$count = mysqli_num_rows($result);
							}
							else{
								$query = "select DISTINCT stu_id, stu_imageLocation, stu_name, stu_roll from students INNER JOIN student_profile_update ON stu_id = student_id  where spu_status=0";
								$result= mysqli_query($conn, $query);
								$check = mysqli_num_rows($result);
							}
							
							if(isset($check) AND $check < 1 AND !isset($_POST['search'])){
								echo '<br><h5 style="text-align:center;">No records yet!</h5>';
							}
							
							if(isset($_POST['search']) && $count === 0){
									
								echo '<h5 style="text-align:center;">No Result Found.     <a href="students_profile.php">View All</a></h5>';
							}	
							echo '<div id="form-wrapper">';		
							while($data=mysqli_fetch_array($result)){
								echo '
								<div class="form-wrapper" >
										<div class="stu-info">
											<table>
												<tr>
													<td>
														<img src="../'.$data['stu_imageLocation'].'" height="120" width="120" ></img>
													</td>
													<td>
														Name: <span style="padding-left:5%;">'.$data['stu_name'].'</span><br>
														Student Id: <span style="padding-left:2%;">'.$data['stu_roll'].'</span><br>
														
													</td>
												</tr>
											</table>		
										</div>
									<div class="table-wrap">
									
									<h4>Updation Requests</h4>
									<table class="table table-bordered" >
										<thead class="thead-dark">
											<tr>
												<th>#</th>
												<th>Attribute</th>									
												<th>Current Value</th>
												<th>Requested Value</th>									
												<th>Actions</th>											
											</tr>
										</thead>
										<tbody>		
								';
									
									
								$query = "select * from students INNER JOIN student_profile_update ON stu_id = student_id AND stu_id=".$data['stu_id']." AND spu_status=0";
								$res= mysqli_query($conn, $query);
								$i=1;
								while($row = mysqli_fetch_array($res)){
									echo '
																			
										<tr>
										<td class="col-md-1">'.$i.'</td>
									';											
									$attr = $row['spu_field'];
									$attrName= findAttribute($attr);
									$query="select ".$attr." from students where stu_id=".$row['stu_id']."";
									$res1=mysqli_query($conn, $query);
									$row_attr = mysqli_fetch_array($res1);
									echo '
										<td class="col-md-2">'.$attrName.'</td>
										<td class="col-md-3">'.$row_attr[$attr].'</td>
										<td class="col-md-4">'.$row['spu_newValue'].'</td>
										<td class="col-md-2">
											<button class="btn btn-success btn-xs" data-target="#Modalapprv'.$row['stu_id'].$attr.'" data-toggle="modal">Approve</button>
											<div class="modal fade" id="Modalapprv'.$row['stu_id'].$attr.'"  >
												<div class="modal-dialog">
													<div class="modal-content modal-cnt" >
														<div class="modal-header">
																
															<button type="button" class="close" data-dismiss="modal">&times;</button>	
															<h4>Approve Request?</h4>
														</div>
														<div class="modal-body">
																	
															<form action="includes/stu_update.inc.php" method="POST">
																<input type="hidden" name="newValue" value="'.$row['spu_newValue'].'"/>
																<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
																<input type="hidden" name="attr" value="'.$attr.'"/>
																
																<p>Sure to approve '.$row['stu_name'].'\'s request to update his '.$attrName.'?</p>
																<p><b>This cannot be reverted.</b></p>
																
																<button class="btn btn-success btn-sm pull-right approve" name="approve-update"><span class="fa fa-thumbs-up"> Approve</button>
																<div class="clearfix"></div>
															</form>
														</div> 																
													</div>
												</div>
											</div>		
											<button class="btn btn-danger btn-xs" data-target="#Modaldeny'.$row['stu_id'].$attr.'" data-toggle="modal"><span class="fa fa-thumbs-o-down"> Deny</button>
											
											<div class="modal fade" id="Modaldeny'.$row['stu_id'].$attr.'"  >
												<div class="modal-dialog">
													<div class="modal-content modal-deny">
														<div class="modal-header">
																			
															<button type="button" class="close" data-dismiss="modal">&times;</button>	
															<h4>Deny Request?</h4>
														</div>
														<div class="modal-body">
																	
															<form action="includes/stu_update.inc.php" method="POST">
																<input type="hidden" name="newValue" value="'.$row['spu_newValue'].'"/>
																<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
																<input type="hidden" name="attr" value="'.$attr.'"/>
															
																<p>Sure to deny '.$row['stu_name'].'\'s request to update his '.$attrName.'?</b>?</p>
																<p><b>This cannot be reverted!</b></p>
																
																<button class="btn btn-danger btn-sm pull-right deny" name="deny-update"><span class="fa fa-thumbs-down"> Deny</button>
																<div class="clearfix"></div>
															</form>
														</div> 																
													</div>
												</div>
											</div>	
										</td>
										</tr>
										
									';
									$i++;
								}
								
								
								echo '
											</tbody>
										</table>
									</div>
								</div>	
								
								';
								
							}
							echo '</div>'
						?>	
						
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
				window.location.replace('students_profile.php');
			};
		};
	</script>
	
</body>
</html>

<?php
		function findAttribute($attr){
			if($attr == 'stu_name'){
				return 'Name';
			}
			elseif($attr == 'stu_gurdianname'){
				return 'Guardian\'s Name';
			}
			elseif($attr == 'stu_address'){
				return 'Address';
			}
			elseif($attr == 'stu_subjectCombo'){
				return 'Subject Combination';
			}
			elseif($attr == 'stu_dob'){
				return 'Date of Birth';
			}
			elseif($attr == 'stu_gender'){
				return 'Gender';
			}
			elseif($attr == 'stu_email'){
				return 'Email';
			}
			elseif($attr == 'stu_contact'){
				return 'Contact';
			}
			elseif($attr == 'stu_gcontact'){
				return 'Guardian\'s Contact';
			}
			elseif($attr == 'stu_currentinstitute'){
				return 'Current Institute';
			}
			elseif($attr == 'stu_university'){
				return 'Board / University';
			}
			elseif($attr == 'stu_highestdegree'){
				return 'Class / Course';
			}
			elseif($attr == 'stu_dept'){
				return 'Department';
			}
			elseif($attr == 'stu_yop'){
				return 'Year of Passing';
			}
			elseif($attr == 'stu_currentStatus'){
				return 'Current Status';
			}
			elseif($attr == 'stu_category'){
				return 'Category';
			}
			elseif($attr == 'stu_blood'){
				return 'Blood Group';
			}
			elseif($attr == 'stu_religion'){
				return 'Religion';
			}
		}
	?>