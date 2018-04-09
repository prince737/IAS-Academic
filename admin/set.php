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
	<title>SET | IAS</title>
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
					<li class="link active">
						<a href="#">
							<i class="fa fa-pencil" aria-hidden="true"></i>
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
					<header>
						<h2 class="page_title">SCHOLARSHIP ENTRANCE TEST</h2>	
					</header>	
					<div class="container-fluid">	
						<div class="row filter-row">
							<form action="set.php" method="GET">
								<div class="form-group col-md-4 col-xs-6"  style="margin-top:10px;">					
									<select class="form-control" required name="apprv" onchange="this.form.submit();">
										<option value="all"<?php if(isset($_GET['apprv']) && $_GET['apprv']=='all'){echo 'selected';}?>>All Approval Status</option>
										<option value="0" <?php if(isset($_GET['apprv']) && $_GET['apprv']=='0'){echo 'selected';}?>>All Pending</option>
										<option value="1"<?php if(isset($_GET['apprv']) && $_GET['apprv']=='1'){echo 'selected';}?>>All Approved</option>									
										<option value="2"<?php if(isset($_GET['apprv']) && $_GET['apprv']=='2'){echo 'selected';}?>>All Denied</option>									
									</select>
								</div>	
							</form>

							<form action="set.php" method="POST">
								<div class="form-group col-md-4 col-xs-6" >					
									<div class="checkbox" >
										<label><input type="checkbox" name="no_email" style="width: 20px; height: 20px;" onChange="this.form.submit()" <?php if(isset($_POST['no_email'])){echo 'checked';}?>  value="1"><span style="font-size: 16px; line-height: 27px; margin-left: 5px;">No email Id specified</span></label>
									</div>
								</div>	
							</form>
 								
								
							<form action="set.php" method="POST" class="navbar-form navbar-right col-md-6 search-form" role="search" style="margin-top:10px;">
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
								$results_per_page = 1000;
								// find out the number of results stored in database
								$sql='SELECT * FROM sett';
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
								
								if(isset($_POST['search'])){
									$search = mysqli_real_escape_string($conn, $_POST['field']);
									$query = "select * from sett where set_name LIKE '%$search%' OR set_email LIKE '%$search%' OR set_applicationNo LIKE '%$search%' OR set_rollNo LIKE '%$search%' OR set_language LIKE '%$search%' OR set_dateAssigned = '$search'";
									$result = mysqli_query($conn, $query);
									$count = mysqli_num_rows($result);
								}
								elseif(isset($_POST['no_email'])){
									$query = "select * from sett where set_email=''";
									$result = mysqli_query($conn, $query);
									$count = mysqli_num_rows($result);
								}
								elseif(isset($_GET['apprv'])){
									$apprv = mysqli_real_escape_string($conn, $_GET['apprv']);
									if($apprv=='all'){
										$sql='SELECT  * FROM sett LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
										$result = mysqli_query($conn, $sql);
									}
									else{
										$sql="SELECT  * FROM sett where set_status='$apprv' LIMIT " . $this_page_first_result . "," .  $results_per_page;
										$result = mysqli_query($conn, $sql);
										$count = mysqli_num_rows($result);
									}
								}
								else{
									$sql='SELECT  * FROM sett LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
									$result = mysqli_query($conn, $sql);
								}
								
								echo '<div class="row">';
								$i = 1;
								
								if(isset($_POST['search'])){
									
									echo '<h5 style="text-align:center;">'.$count.' matching record/s found on "'.$search.'"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="set.php">View All</a></h5>';
								}
								elseif(isset($_POST['no_email'])){
									
									echo '<h5 style="text-align:center;">Displaying '.$count.' students who haven\'t specified an email Id. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="set.php">View All</a></h5>';
								}
								while($row = mysqli_fetch_array($result)) {
									if($row['set_finalExam']==01){
										$c='CLASS VIII';
									}
									elseif($row['set_finalExam']==02){
										$c='CLASS IX';
									}
									elseif($row['set_finalExam']==03){
										$c='CLASS X';
									}
									elseif($row['set_finalExam']==04){
										$c='CLASS XI';
									}
									else{
										$c='CLASS XII';
									}
									
											
									if($row['set_center']==01){
										$cn='KOLKATA';
									}
									elseif($row['set_center']==02){
										$cn='HOWRAH';
									}
									
									else{
										$cn='BERHAMPORE';
									}
								  echo'
										
								    <div class="row stu-con">
										<div class="col-md-5">
											<h4>General Information</h4>
											<table>												
												<tr>
													<td>Name:</td>
													<td class="data">'.$row['set_name'].'</td>
												</tr>
												<tr>
													<td>Guardian\'s Name:</td>
													<td class="data">'.$row['set_gname'].'</td>
												</tr>
												<tr>
													<td>Contact No:</td>
													<td class="data">'.$row['set_contact'].'</td>
												</tr>
												<tr>
													<td>Email:</td>
													<td class="data">'.$row['set_email'].'</td>
												</tr>
												<tr>
													<td>School:</td>
													<td class="data">'.$row['set_school'].'</td>
												</tr>
												<tr>
													<td>Board:</td>
													<td class="data">'.$row['set_board'].'</td>
												</tr>												
												<tr>
													<td>Address:</td>
													<td class="data">'.$row['set_address'].'</td>
												</tr>
												<tr>
													<td>Whatsapp No:</td>
													<td class="data">'.$row['set_wp'].'</td>
												</tr>												
											</table>	
										</div>	
										<div class="col-md-5">
											<h4>Academic Information</h4>
											<table>												
												<tr>
													<td>Roll No:</td>
													<td class="data">';
													
														if($row['set_status']==0){
															echo '<span class="no-apprv">Student not yet Approved</span>';
														} 
														elseif($row['set_status']==2){
															echo '<span class="no-apprv">Student was denied approval</span>';
														}
														else{
															echo $row['set_rollNo'];
														}
													
													echo '</td>
												</tr>
												<tr>
													<td>Application No:</td>
													<td class="data">'.$row['set_applicationNo'].'</td>
												</tr>
												<tr>
													<td>Last Exam:</td>
													<td class="data">'.$c.'</td>
												</tr>												
												<tr>
													<td>Preffered Center:</td>
													<td class="data">'.$cn.'</td>
												</tr>
												<tr>
													<td>Date Asigned:</td>
													<td class="data">';
														if($row['set_admitStatus']==0){
															echo '<span class="no-apprv">Date not Assigned</span>';
														}
														else{
															echo $row['set_dateAssigned'];
														} 													
												echo '
													</td>
												</tr>
												<tr>
													<td>Time Asigned:</td>
													<td class="data">';
														if($row['set_admitStatus']==0){
															echo '<span class="no-apprv">Time not Assigned</span>';
														}
														else{
															echo $row['set_timeAssigned'];
														} 
												echo '
													</td>
												</tr>
												<tr>
													<td>Test Language:</td>
													<td class="data">'.$row['set_language'].'</td>
												</tr>
											</table>	
										</div>	
										<div class="col-md-2">
											<h4>Actions</h4>';
											
												
													
													if($row['set_status']==0 ){
														echo '
														<button class="btn btn-xs btn-success" type="button" 
														data-target="#Modalappr'.$i.'" data-toggle="modal">Approve</button> 														
														<button class="btn btn-xs btn-danger" data-target="#Modal'.$i.'" 
														data-toggle="modal" name="deny_stu" type="button" >Deny</button> 
														
														';
													}
													elseif($row['set_status']==1 ){
														if($row['set_admitStatus']==0){
															echo '<button class="btn btn-xs btn-success" type="button" 
														data-target="#Modalgen'.$i.'" data-toggle="modal">Generate Admit Card</button> ';
														}
														else{
															echo '<a href="SET_admit.php?id='.$row['id'].'" class="btn btn-xs btn-success" type="button" 
														">View Admit Card</a> ';
														echo '<button class="btn btn-xs btn-warning" type="button" 
														data-target="#Modalupd'.$i.'" data-toggle="modal">Update Date / Time</button> ';
														}
														
														echo '<button class="btn btn-xs btn-danger" type="button" data-target="#Modal'.$i.'" data-toggle="modal" name="deny_stu">Deny</button> ';
													}
													else{
														echo '<button class="btn btn-xs btn-success" type="button" 
														data-target="#Modalappr'.$i.'" data-toggle="modal">Approve</button>  ';
													}
												echo '
												
												<form action="includes/set.inc.php" method="POST" id="stu_form">
													<input type="hidden" value="'.$row['id'].'" name="id"></input>
													<div class="modal fade" id="Modal'.$i.'"  >
														<div class="modal-dialog ">
															<div class="modal-content" >
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Deny Approval</h4>				
																</div>
																<div class="modal-body">
																	<label for="reason">WRITE THE REASON FOR DENYING '.$row['set_name'].':</label>
																	<textarea class="form-control" id="reason" name="reason" required></textarea>
																	<small>Assume the following text: "due to the fact that" before your sentence.</small>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-danger btn-xs" name="deny">Deny Student</button>
																</div>		
															</div>
														</div>
													</div>
												</form>		

												<form action="includes/set.inc.php" method="POST" id="stu_form">
													<input type="hidden" value="'.$row['id'].'" name="id"></input>
													<div class="modal fade" id="Modalappr'.$i.'">
														<div class="modal-dialog modal-sm">
															<div class="modal-content" >
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Approve Student?</h4>				
																</div>
																<div class="modal-body">
																	Sure to approve '.$row['set_name'].'?
																</div> 
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-success btn-xs" name="approve">Approve </button>
																</div>		
															</div>
														</div>
													</div>
												</form>	

												<form action="includes/set.inc.php" method="POST" id="stu_form">
													<input type="hidden" value="'.$row['id'].'" name="id"></input>
													<div class="modal fade" id="Modalgen'.$i.'">
														<div class="modal-dialog modal-sm">
															<div class="modal-content" >
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Generate Admit Card for '.$row['set_name'].'</h4>				
																</div>
																<div class="modal-body">
																	<label for="date">ASSIGN DATE OF EXAM:</label>
																	<input type="text" class="form-control" id="datepicker'.$i.'" name="date" required/>
																	<label for="time">ASSIGN TIME SLOT OF EXAM:</label>
																	<input type="text" class="form-control" id="time" name="time" required/>
																</div> 
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-success btn-xs" name="gen">Generate Admit Card </button>
																</div>		
															</div>
														</div>
													</div>													
												</form>	

												<form action="includes/set.inc.php" method="POST" id="stu_form">
													<input type="hidden" value="'.$row['id'].'" name="id"></input>
													<div class="modal fade" id="Modalupd'.$i.'">
														<div class="modal-dialog modal-sm">
															<div class="modal-content" >
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Update date and time slot for '.$row['set_name'].'</h4>				
																</div>
																<div class="modal-body">
																	<label for="date">UPDATE ASSIGNED DATE OF EXAM:</label>
																	<input type="text" class="form-control" id="datepicker'.$i.'" name="date" required value="'.$row['set_dateAssigned'].'"/>
																	<label for="time">UPDATE ASSIGNED TIME SLOT OF EXAM:</label>
																	<input type="text" class="form-control" id="time" name="time" required value="'.$row['set_timeAssigned'].'"/>
																</div> 
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-success btn-xs" name="upd">Update assigned Date / Time</button>
																</div>		
															</div>
														</div>
													</div>													
												</form>	
												
											</table>	
										</div>	';
										if($row['set_status']==2){
											echo '<div class="col-md-12"><br><p class="no-apprv text-center">Denial reason: "'.$row['set_denyReason'].'"</p></div>';
										}
										echo '
									</div>										
								 	';
									$i++;
								}
								echo '</div>';
								
								// display the links to the pages
								$prev=$page-1;
								$next=$page+1;
								echo '<ul class="pagination">';
								if($prev >=1){
									echo '
										<li><a href="set.php?page=' . $prev . '">Prev</a><li>
									';
								}
								
								
								for ($p=1;$p<=$number_of_pages;$p++) {
									$selected = $p == $page ? 'class="selected"' : '';
									echo '
										<li><a '.$selected.' href="set.php?page=' . $p . '">' . $p . '</a><li>
									';
									
								}
								if($next <= $number_of_pages && $number_of_pages >= 2){
									echo '
										<li><a href="set.php?page=' . $next . '">Next</a><li>
									';
								}
								echo '</ul>';
								
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
				window.location.replace('set.php');
			};
		};
	</script>
	<?php
	
		if(isset($_GET['appr_success']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Student was successfully approved for SET.</p> 
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
						<p class="para">Student was successfully denied for SET.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['admit_success']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Student\'s admit card was successfully generated for SET.</p> 
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

</body>
</html>