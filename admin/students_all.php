<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
	
	if(isset($_GET['saprv']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">'.$_GET['saprv'].' was successfully approved.</p>
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
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Manage Students | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="css/student_all.css">
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
				<ul> 
					<li class="link">
						<a href="admin.php">
							<i class="fa fa-th" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Dashboard</span>
						</a>
					</li>
					<li class="link active">
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
								<a href="active_events.php">
									<span>View Active</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post21" data-toggle="collapse" aria-control="collapse-post21">
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
						<h2 class="page_title">Student Profiles</h2>	
					</header>
					
					<div class="container-fluid">	
						<div class="row filter-row">
							<div class="form-group col-md-2 col-xs-6">					
								<select class="form-control" required name="folder">
									<option selected value="">All Course Types</option>
									<?php
										$query = "select distinct course_type from courses";
										$res=mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($res)){
											echo '<option value="'.$row['course_type'].'">'.$row['course_type'].'</option>';
										}
									?>	
								</select>
							</div>
							
							<div class="form-group col-md-2 col-xs-6">	
								
								<select class="form-control" required name="courses">
									<option selected value="">All Courses</option>
								<?php
									$query = "select * from courses";
									$res=mysqli_query($conn, $query);
									while($row = mysqli_fetch_array($res)){
										echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
									}
								?>	
									
								</select>
							</div>	
							<div class="form-group col-md-2 col-xs-6">					
								<select class="form-control" required name="folder">
									<option selected value="">All Centers</option>
									<?php
										$query = "select * from centers";
										$res=mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($res)){
											echo '<option value="'.$row['center_id'].'">'.$row['center_name'].'</option>';
										}
									?>	
								</select>
							</div>	
							<div class="form-group col-md-2 col-xs-6">					
								<select class="form-control" required name="folder">
									<option selected value="">All Approval Status</option>
									<option value="0">All Pending Approval</option>
									<option value="1">All Approved</option>									
									<option value="2">All Denied</option>
									
								</select>
							</div>	
								
								
							<form action="students_all.php" method="POST" class="navbar-form navbar-right col-md-4 search-form" role="search" style="margin-top:0px;">
								<div class="form-group">
								  <input type="text" name="field" class="form-control" placeholder="Search">
								</div>
								<button type="submit" class="btn btn-default btn-sm" name="search"><span class="fa fa-search"><span>   Search</button>
							</form>
							
						</div>
					
					</div>
					<div class="content-inner">						
						<div class="form-wrapper">
							<?php
								$results_per_page = 10;
								// find out the number of results stored in database
								$sql='SELECT * FROM students';
								$result = mysqli_query($conn, $sql);
								$number_of_results = mysqli_num_rows($result);
								// determine number of total pages available
								$number_of_pages = ceil($number_of_results/$results_per_page);
								// determine which page number visitor is currently on
								if (!isset($_GET['page'])) {
								  $page = 1;
								} else {
								  $page = $_GET['page'];
								}
								// determine the sql LIMIT starting number for the results on the displaying page
								$this_page_first_result = ($page-1)*$results_per_page;
								// retrieve selected results from database and display them on page
								
								/*if(isset($_POST['search'])){
									$search = mysqli_real_escape_string($conn, $_POST['field']);
									$query = "select * from students INNER JOIN courses ON course_id=cid INNER JOIN centers on students.center_id = centers.center_id where stu_name LIKE '%$search%' OR stu_email LIKE '%$search%' OR stu_registrationNo LIKE '%$search%' OR course_name LIKE '%$search%' OR center_name LIKE '%$search%' OR course_id LIKE '%$search%' OR centers.center_id LIKE '%$search%' OR stu_address LIKE '%$search%' OR stu_highestdegree LIKE '%$search%'";
									$result = mysqli_query($conn, $query);
									$count = mysqli_num_rows($result);
								}
								elseif(isset($_GET['id'])){
									$id=mysqli_real_escape_string($conn, $_GET['id']);
									$query = "select * from students INNER JOIN courses ON course_id=cid INNER JOIN centers on students.center_id = centers.center_id where stu_id=$id";
									$result = mysqli_query($conn, $query);
									$count = mysqli_num_rows($result);
									
								}*/
								//else{
									$sql='SELECT * FROM students INNER JOIN students_courses ON stu_id=student_id INNER JOIN courses on students_courses.course_id= courses.course_id INNER JOIN centers ON students_courses.center_id=centers.center_id LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
									$result = mysqli_query($conn, $sql);
								//}
																
								
								echo '<div class="row">';
								$i = 1;
								
								if(isset($_POST['search'])){
									
									echo '<h5 style="text-align:center;">'.$count.' matching record/s found on "'.$search.'"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="students_all.php">View All</a></h5>';
								}
								while($row = mysqli_fetch_array($result)) {
								  echo'
										
								    <div class="row stu-con">
										<div class="col-md-3">
											<img style="display:inline-block;" src="../'.$row['stu_imageLocation'].'" height="200" width="200" class="img-thumnail" /> 
																							
											<h3>'.$row['stu_name'].'</h3>
											
													
										</div>
										<div class="col-md-4">
											<h4>General Information</h4>
											<table>												
												<tr>
													<td>E-mail:</td>
													<td class="data">
													
													<button data-target="#Modalmail'.$i.'" data-toggle="modal" name="deny_stu" type="button" class="send-mail">'.$row['stu_email'].'</button>
													</td>
													
													<div class="modal fade" id="Modalmail'.$i.'"  >
														<div class="modal-dialog modal-sm">
															<div class="modal-content" >
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Contact Student</h4>				
																</div>
																<div class="modal-body">
																	Sure to deny '.$row['stu_email'].'?
																</div> 
																<div class="modal-footer">
																	
																</div>		
															</div>
														</div>
													</div>							
													
												</tr>
												<tr>
													<td>Date of Birth:</td>
													<td class="data">'.$row['stu_dob'].'</td>
												</tr>
												<tr>
													<td>Gender:</td>
													<td class="data">'.$row['stu_gender'].'</td>
												</tr>
												<tr>
													<td>Address:</td>
													<td class="data">'.$row['stu_address'].'</td>
												</tr>
												<tr>
													<td>Guardian:</td>
													<td class="data">'.$row['stu_gurdianname'].'</td>
												</tr>
												<tr>
													<td>Guardian\'s Contact:</td>
													<td class="data">'.$row['stu_gurdiancontact'].'</td>
												</tr>
											
											</table>
										</div>	
										<div class="col-md-4">
											<h4>Education</h4>
											<table>
												<!--<tr>
													<td>Registration Number:</td>
													<td class="data">';
														if($row['stu_registrationNo'] == null){
															echo '<span class="no-apprv">Student not yet Approved</span>';
														}else{
															echo $row['stu_registrationNo'];
														}
													echo '</td>
												</tr>-->
												<tr>
													<td>Date of Admimssion:</td>
													<td class="data">'.$row['stu_dateofadmission'].'</td>
												</tr>
												<tr>
													<td>Date of Application:</td>
													<td class="data">'.$row['stu_dateofapplication'].'</td>
												</tr>
												<!--<tr>
													<td>Course Opted:</td>
													<td class="data">'.$row['course_name'].'</td>
												</tr>	
												<tr>
													<td>Center:</td>
													<td class="data">'.$row['center_name'].'</td>
												</tr>-->';
												
												if($row['stu_highestdegree'] == 'Class XI' || $row['stu_highestdegree'] == 'Class XII'){
													echo '<tr>
															<td>Currently Pursuing:</td>
															<td class="data">'.$row['stu_highestdegree'].'</td>
														</tr>
														<tr>
															<td>School:</td>
															<td class="data">'.$row['stu_currentinstitute'].'</td>
														</tr>
															
														<tr>
															<td>Board:</td>
															<td class="data">'.$row['stu_university'].'</td>
														</tr>	
														<tr>
															<td>Subjects:</td>
															<td class="data">'.$row['stu_subjectCombo'].'</td>
														</tr>
															
													';
													
												}
												elseif($row['stu_highestdegree'] == 'Class X'){
													echo '<tr>
															<td>Currently Pursuing:</td>
															<td class="data">'.$row['stu_highestdegree'].'</td>
														</tr>
														<tr>
															<td>School:</td>
															<td class="data">'.$row['stu_currentinstitute'].'</td>
														</tr>
															
														<tr>
															<td>Board:</td>
															<td class="data">'.$row['stu_university'].'</td>
														</tr>														
															
													';													
												}
												elseif($row['stu_highestdegree'] == 'Btech' || $row['stu_highestdegree'] == 'Mtech'){
													echo '<tr>
															<td>Currently Pursuing:</td>
															<td class="data">'.$row['stu_highestdegree'].'</td>
														</tr>
														<tr>
															<td>Department:</td>
															<td class="data">'.$row['stu_dept'].'</td>
														</tr>
														<tr>
															<td>College:</td>
															<td class="data">'.$row['stu_currentinstitute'].'</td>
														</tr>
															
														<tr>
															<td>University:</td>
															<td class="data">'.$row['stu_university'].'</td>
														</tr>
														<tr>
															<td>Expected year of Passing:</td>
															<td class="data">'.$row['stu_yearofpass'].'</td>
														</tr>														
															
													';													
												}
												else{
													echo '<tr>
															<td>Current Education / Status:</td>
															<td class="data">'.$row['stu_currentStatus'].'</td>
														</tr>
														<tr>
															<td>Highest Degree:</td>
															<td class="data">'.$row['stu_highestdegree'].'</td>
														</tr>
														<tr>
															<td>College:</td>
															<td class="data">'.$row['stu_currentinstitute'].'</td>
														</tr>
															
														<tr>
															<td>Year of Passing:</td>
															<td class="data">'.$row['stu_yearofpass'].'</td>
														</tr>															
															
													';													
												}	
												
													
											echo '</table>
										</div>		
										<div class="col-md-1 action">
											<h4>Actions</h4>
											<form action="includes/stu.inc.php" method="POST" id="stu_form">
												
												<input type="hidden" value="'.$row['stu_email'].'" name="email"></input>
												<input type="hidden" value="'.$row['stu_name'].'" name="name"></input>';
												if($row['stu_approvalstatus']==0 ){
													echo '<button class="btn btn-xs btn-success" type="submit" name="approve_stu"><span class="fa fa-thumbs-o-up"></span>Approve</button>';
													echo '<button class="btn btn-xs btn-danger" data-target="#Modal'.$i.'" data-toggle="modal" name="deny_stu" type="button" ><span class="fa fa-trash-o"></span>Delete</button>	';
												}
												elseif($row['stu_approvalstatus']==2 ){
													echo '<button class="btn btn-xs btn-success" type="submit" name="approve_stu"><span class="fa fa-thumbs-o-up"></span>Re-approve</button>';
												}												
												else{
													echo '<button class="btn btn-xs btn-danger" data-target="#Modal'.$i.'" data-toggle="modal" name="deny_stu" type="button"><span class="fa fa-trash-o"></span>Delete</button>	';
												}
												
										  echo '<div class="modal fade" id="Modal'.$i.'"  >
													<div class="modal-dialog modal-sm">
														<div class="modal-content" >
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Deny Approval</h4>				
															</div>
															<div class="modal-body">
																Sure to deny '.$row['stu_name'].'?
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-danger btn-xs" name="deny_stu">Deny Student</button>
															</div>		
														</div>
													</div>
												</div>												
											</form>
										</div>	
									</div>			
								    ';
									$i++;
								}
								echo '
								</div>
								</div>'
								;
								// display the links to the pages
								$prev=$page-1;
								$next=$page+1;
								echo '<ul class="pagination">';
								if($prev >=1){
									echo '
										<li><a href="students.php?page=' . $prev . '">Prev</a><li>
									';
								}
								
								
								for ($p=1;$p<=$number_of_pages;$p++) {
									$selected = $p == $page ? 'class="selected"' : '';
									echo '
										<li><a '.$selected.' href="students.php?page=' . $p . '">' . $p . '</a><li>
									';
									
								}
								if($next <= $number_of_pages && $number_of_pages >= 2){
									echo '
										<li><a href="students.php?page=' . $next . '">Next</a><li>
									';
								}
								echo '</ul>';
							?>
					
						
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
				window.location.replace('students_all.php');
			};
		};
	</script>
	
	<script>
		$('#aprv').on('click', function(){
			
				$('#sd').toggle();
				$('#ds').css('display','none');
			
		});
		$('#aprv1').on('click', function(){
			
				$('#ds').toggle();
				$('#sd').css('display','none');
			
		});
		
	</script>
	

</body>
</html>
				