<?php
	session_start();
	require_once('includes/dbh.inc.php');
	
	if(!isset($_SESSION['student']) && !isset($_COOKIE['student'])){
		header("Location: login.php");
		exit();
	}
	
?>
		
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Queued Changes| IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/pending_updates.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a href="index.php" class="pull-left hidden-xs"><img src="images/logo.jpg " height="35" width="45" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">      
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form" action="includes/logout.inc.php" method="POST">
							<button type="submit" name="logout"><span class="fa fa-sign-out"></span>Log Out</button>
						</form>
					</li>
				</ul>
			</div>			
		</div>
	</nav>
	
	<?php
		if(isset($_SESSION['student'])){
			$email = $_SESSION['student'];
			$query = "select * from students where stu_email='$email'";
		}
		elseif(isset($_COOKIE['student'])){
			$email = $_COOKIE['student'];
			$query = "select * from students where stu_email='$email'";
		}
		$result = mysqli_query($conn, $query);
	?>
	
	<div class="container-fluid profile-wrapper">
		<div class="row">
			<div class="col-md-3 navigation shadow" >
				<div class="img-name">
					<?php
						
						$row = mysqli_fetch_array($result);
							echo '
								<div class="contain">
								<img class="img-thumbnail" src="'.$row['stu_imageLocation'].'" />
								<div class="overlay">
								    <div class="text">
									
										<form action="includes/change.inc.php" method="POST" enctype="multipart/form-data" >
											<input type="file" id="fileLoader" accept=".jpg, .jpeg, .png" onchange="this.form.submit();" name="image"/>
											<input type="hidden" name="id"  value="'.$row['stu_id'].'"></input>
											<input type="button" class="btn btn-default btn-sm" id="btnOpenFileDialog" value = "Change Image" onclick="openfileDialog();" />
										
										</form>
									
									</div>
								</div>
								</div><br>
								<p class="name">'.$row['stu_roll'].'</p>
							'; 		
					?>
				</div>
				<div class="nav-menu shadow">
					<ul> 
						<li class="link">
							<a href="profile.php">
								<i class="fa fa-home" aria-hidden="true"></i>PROFILE HOME</span>
							</a>
						</li>
						<li class="link">
							<a href="account_settings.php">
								<i class="fa fa-cogs" aria-hidden="true"></i>ACCOUNT SETTINGS</span>
							</a>
						</li>
						<li class="link">
							<a href="change_course.php">
								<i class="fa fa-book" aria-hidden="true"></i>CHANGE COURSE / CENTER</span>
							</a>
						</li>
						<li class="link">
							<a href="add_course.php">
								<i class="fa fa-plus-square-o" aria-hidden="true"></i>APPLY FOR ANOTHER COURSE</span>
							</a>
						</li>
						<li class="link">
							<a href="pending_updates.php">
								<i class="fa fa-spinner" aria-hidden="true"></i>VIEW PENDING UPDATES</span>
							</a>
						</li>
						<li class="link">
							<a href="downloads.php">
								<i class="fa fa-download" aria-hidden="true"></i>DOWNLOADS</span>
							</a>
						</li>
						<li class="link" id="exam">
							<a href="exams.php" id="exam_link">
								<i class="fa fa-pencil" aria-hidden="true"></i>EXAMS</span>
								<?php
									$sql = "select * from exams natural join exam_course where exam_status=1 and course_id in (select course_id from students_courses where student_id=".$row['stu_id'].");";
									$resultset = mysqli_query($conn,$sql);
									$i=0;
									while($r = mysqli_fetch_array($resultset)){
										$query = "select * from results where exam_id = '".$r['exam_id']."' and student_id = ".$row['stu_id'];
										$res = mysqli_query($conn,$query);
										$num_res = mysqli_num_rows($res);
										if($num_res == 0){
											$i++;
										}
									}
									if($i!=0){
										echo '<span class="notification">'.$i.'</span>';
									}
								?>
							</a>
						</li>
						<li class="link">
							<a href="results.php">
								<i class="fa fa-list-alt" aria-hidden="true"></i>RESULTS</span>
								<?php
									$sql = "select * from results where student_id =".$row['stu_id']." and publish_status=1";
									$res = mysqli_query($conn,$sql);
									$rescount = mysqli_num_rows($res);
									if($rescount > 0)
										echo '<span class="res_no">'.$rescount.'</span>';
								?>
							</a>
						</li>
						<li class="link logout">
							<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="logout"><span class="fa fa-sign-out"></span>LOG OUT</button>
							</form>
						</li>
						
						
					</ul>	
				</div>
				
			</div>
			<div class="col-md-9 content shadow">
			
				<h4>Queued Course Changes</h4>
					 
				<a href="change_course.php" class="btn btn-xs pending pull-right hidden-xs"><span class="fa fa-cogs"></span> Back to Change Course / Center</a>				
					
				<hr>
					
				<?php
					$id=$row['stu_id'];
					$query="select * from course_change where student_id=$id";
					$res=mysqli_query($conn, $query);
					$check=mysqli_num_rows($res);
					$i=1;
					if($check<1){
						echo '<p>No records found.</p>';
					}
					else{
						echo '
							<table class="table table-bordered" >
								<thead class="thead-dark">
									<tr>
										<th>#</th>								
										<th>Status</th>								
										<th>Center</th>
										<th>Current Course</th>										
										<th>Request Course</th>									
										<th>Actions</th>									
									</tr>
								</thead>
								<tbody>	
						';		
						while($row_cor=mysqli_fetch_array($res)){
							echo '
								<tr>
									<form action="includes/course.inc.php" method="POST">
										<td>'.$i.'</td>
										';
										
										if($row_cor['change_status'] == 0){
											echo '<td><span class="label label-warning">Pending</span></td>';
										}
										elseif($row_cor['change_status'] == 1){
											echo '<td><span class="label label-success">Approved</span></td>';
										}
										elseif($row_cor['change_status'] == 2){
											echo '<td><span class="label label-danger">Denied</span></td>';
										}
										
										//CENTER NAME
										$query="select center_name from centers where center_id=".$row_cor['center_id'];
										$result1=mysqli_query($conn, $query);
										$row1=mysqli_fetch_array($result1);										
										echo '<td>'.$row1['center_name'].'</td>';
										
										//OLD COURSE NAME
										$query="select course_name from courses where course_id=".$row_cor['old_course_id'];
										$result2=mysqli_query($conn, $query);
										$row2=mysqli_fetch_array($result2);										
										echo '<td>'.$row2['course_name'].'</td>';
										
										//NEW COURSE NAME
										$query="select course_name from courses where course_id=".$row_cor['new_course_id'];
										$result3=mysqli_query($conn, $query);
										$row3=mysqli_fetch_array($result3);										
										echo '<td>'.$row3['course_name'].'</td>
										
											


										
										<td>
														
											<input type="hidden" name="id" value="'.$id.'"/>
											<input type="hidden" name="newcor" value="'.$row_cor['new_course_id'].'"/>
											<input type="hidden" name="oldcor" value="'.$row_cor['old_course_id'].'"/>';
											
											if($row_cor['change_status'] == 0){
												echo '<button type="button" class="btn btn-danger btn-xs" name="delete_req" data-target="#Modalrem'.$i.'" data-toggle="modal"> Remove</button>	';
											}
											else{
												echo '<button class="btn btn-danger btn-xs" name="delete_list" > Delete from List</button>	';
											}											
												
											
											
											
											echo '<div class="modal fade modalrem" id="Modalrem'.$i.'">
												<div class="modal-dialog">
													<div class="modal-content modal-cnt" >
														<div class="modal-header">
																
														<button type="button" class="close" data-dismiss="modal">&times;</button>	
															<h4><i class="fa fa-bullhorn animated infinite tada" aria-hidden="true"></i> SURE ABOUT REMOVING YOUR REQUEST?</h4>
														</div>
														<div class="modal-body">
															Deleting your request would mean that your Course won\'t be queued for updation anymore.<br><br>
															Are you sure about doing this?<br><br>
																
															<button name="rmvReq" class="btn btn-danger btn-sm request" >Yes, please remove</button>
															<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, keep the Request</button>
														</div> 																
													</div>
												</div>
											</div>
											
											
											
											
											
											
										</td>	
									</form>	
								</tr>				
							';
							$i++;
						}
						echo '
								</tbody>
							</table>
						';
					}
				?>
				
				<br><br>
				
				
				<h4>Queued Center Changes</h4>
				<hr>
					
				<?php
					$id=$row['stu_id'];
					$query="select * from center_change where student_id=$id";
					$res=mysqli_query($conn, $query);
					$check=mysqli_num_rows($res);
					$i=1;
					if($check<1){
						echo '<p>No records found.</p>';
					}
					else{
						echo '
							<table class="table table-bordered" >
								<thead class="thead-dark">
									<tr>
										<th>#</th>								
										<th>status</th>								
										<th>Course</th>
										<th>Current Center</th>										
										<th>Request Center</th>									
										<th>Actions</th>									
									</tr>
								</thead>
								<tbody>	
						';		
						while($row_cen=mysqli_fetch_array($res)){
							echo '
								<tr>
									<form action="includes/center.inc.php" method="POST">
										<td>'.$i.'</td>
										';
										
										if($row_cen['cchange_status'] == 0){
											echo '<td><span class="label label-warning">Pending</span></td>';
										}
										elseif($row_cen['cchange_status'] == 1){
											echo '<td><span class="label label-success">Approved</span></td>';
										}
										elseif($row_cen['cchange_status'] == 2){
											echo '<td><span class="label label-danger">Denied</span></td>';
										}
										
										
										//COURSE NAME
										$query="select course_name from courses where course_id=".$row_cen['course_id'];
										$result1=mysqli_query($conn, $query);
										$row1=mysqli_fetch_array($result1);										
										echo '<td>'.$row1['course_name'].'</td>';
										
										//OLD CENTER NAME
										$query="select center_name from centers where center_id=".$row_cen['old_center_id'];
										$result2=mysqli_query($conn, $query);
										$row2=mysqli_fetch_array($result2);										
										echo '<td>'.$row2['center_name'].'</td>';
										
										//NEW COURSE NAME
										$query="select center_name from centers where center_id=".$row_cen['new_center_id'];
										$result3=mysqli_query($conn, $query);
										$row3=mysqli_fetch_array($result3);										
										echo '<td>'.$row3['center_name'].'</td>
										<td>
														
											<input type="hidden" name="id" value="'.$id.'"/>
											<input type="hidden" name="cor" value="'.$row_cen['course_id'].'"/>
											<input type="hidden" name="newcen" value="'.$row_cen['new_center_id'].'"/>
											<input type="hidden" name="oldcen" value="'.$row_cen['old_center_id'].'"/>';
											
											if($row_cen['cchange_status'] == 0){
												echo '<button type="button" class="btn btn-danger btn-xs" name="delete_req" data-target="#Modalcen'.$i.'" data-toggle="modal">Remove</button>';
											}
											else{
												echo '<button class="btn btn-danger btn-xs" name="delete_clist">Delete from List</button>	';
											}
														
													
											
											
											
											echo'<div class="modal fade modalrem" id="Modalcen'.$i.'">
												<div class="modal-dialog">
													<div class="modal-content modal-cnt" >
														<div class="modal-header">
																
														<button type="button" class="close" data-dismiss="modal">&times;</button>	
															<h4><i class="fa fa-bullhorn animated infinite tada" aria-hidden="true"></i> SURE ABOUT REMOVING YOUR REQUEST?</h4>
														</div>
														<div class="modal-body">
															Removing your request would mean that your Center won\'t be queued for updation anymore.<br><br>
															Are you sure about doing this?<br><br>
																
															<button name="rmvReq" class="btn btn-danger btn-sm request" >Yes, please remove</button>
															<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, keep the Request</button>
														</div> 																
													</div>
												</div>
											</div>
											
											
											
											
											
											
										</td>	
									</form>	
								</tr>				
							';
							$i++;
						}
						echo '
								</tbody>
							</table><br>
						';
					}
				?>
				<br>
				<p style="color:teal;"><b>Please Note:</b> To edit any changes that are already queued, please visit <a href="change_course.php" style="color:teal;">Change Course / Center Page</a>.</p>
				
						
			</div>					
		</div>
		
		<a href="change_course.php" class="btn btn-xs pending hidden-md hidden-lg"><span class="fa fa-cogs"></span> ack to Change Course / Center</a>
		
	</div>
				
	</div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						Copyright &copy; Institute of Applied Science 2017
					</div>
				</div>
				
			</div>
		</div>
	</footer>
	
	
	<script src="js/jquery-3.2.1.min.js"></script>   	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	
	<script src="js/bootstrap.js"></script>	
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('pending_changes.php');
			};
		};
	</script>
	
	
</body>
</html>

<?php

	if(isset($_GET['err']) )
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Something went wrong. Please try again.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['courserem']) )
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Your request to change the course "'.$_GET['courserem'].'" was successfully removed.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['centerrem']) )
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Your request to change the center "'.$_GET['centerrem'].'" was successfully removed.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['rem-list']) )
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Entry was successfully removed from the display list.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}




?>
