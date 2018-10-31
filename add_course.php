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
	<title>Downloads | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/pending_updates.css">
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
  integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  crossorigin="anonymous">
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
			$query = "select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id where stu_email='$email'";
		}
		elseif(isset($_COOKIE['student'])){
			$email = $_COOKIE['student'];
			$query = "select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id where stu_email='$email'";
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
						<li class="link active">
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
							<a href="505.php" id="exam_link">
								<i class="fa fa-pencil" aria-hidden="true"></i>EXAMS</span>
								<?php
									$sql = "select * from exam_course inner join exams where exam_status=1;";
									$resultset = mysqli_query($conn,$sql);
									$c = [];
									while($courses = mysqli_fetch_array($resultset)){
										array_push($c, $courses['course_id']);
									}

									$query="select course_id from students_courses where student_id=".$row['stu_id'];
									$res = mysqli_query($conn,$query);
									$cs= [];
									while($r = mysqli_fetch_array($res)){
										array_push($cs, $r['course_id']);
									}
									
									if(!empty(array_intersect($cs, $c))){
										echo '<span class="notification">New</span>';
									}
								?>
							</a>
						</li>
						<li class="link">
							<a href="505.php">
								<i class="fa fa-list-alt" aria-hidden="true"></i>RESULTS</span>
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
				<h4>Apply for another Course</h4><hr>
				
				<form action="includes/course.inc.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
					
					<div class="form-group">
						<label for="type">CHOOSE THE TYPE OF COURSE:</label>
    					<select class="form-control" id="type" name="type" onchange="this.form.submit()" required>
							<option value="">Choose course type</option>
							<?php
								$id=$row['stu_id'];
								$course=$row['course_name'];
								$arr=array('Class X', 'Class XI', 'Class XII', 'Btech', 'Mtech');
								$class=$row['stu_highestdegree'];
								if( !(in_array($class, $arr))){
									$class="Other";
								}
								echo $class;
								$query="select * from course_edu where edu='$class'";
								$reslt= mysqli_query($conn, $query);
								$typ='';
								while($row = mysqli_fetch_array($reslt)){
								
									$cid = $row['course_id'];
									echo $cid;
									$query = "select course_type from courses where course_id = $cid";
									$res= mysqli_query($conn, $query);
									
									while($rowCtype = mysqli_fetch_array($res)){
										if($typ != $rowCtype['course_type']){
											if(isset($_GET['type']) && $rowCtype['course_type'] == $_GET['type']){
												echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
											}
											elseif(isset($_GET['type']) && $rowCtype['course_type'] == '10+2 Entrance Exams' && $_GET['type']=='10 2 Entrance Exams'){
												echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
											}
											elseif(isset($_GET['type']) && $rowCtype['course_type'] == 'Training & Project Work' && $_GET['type']=='Training '){
												echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
											}
											else{
												echo '<option value="'.$rowCtype['course_type'].'">'.$rowCtype['course_type'].'</option>';
											}
										}
										$typ=$rowCtype['course_type'];									
									}									
								}
								
							?>
						</select>
					</div>	
					<div class="form-group ">
						<?php
							$sql="select * from add_course INNER JOIN courses ON add_course.course_id=courses.course_id where student_id =$id";
							$res=mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($res)){
								$arr[]=$row['course_name'];
							}
							
						?>
						<label for="name">CHOOSE THE COURSE:</label>
    					<select class="form-control" id="name" name="name" required onchange="this.form.submit()">
							<option value="">Choose course name</option>
							<?php
								if(isset($_GET['type'])){
									if($_GET['type'] == '10 2 Entrance Exams'){
										$type = '10+2 Entrance Exams';
									}
									elseif($_GET['type'] == 'Training '){
										$type = 'Training & Project Work';
									}
									else{
										$type = $_GET['type'];
									}			
									
									
									$query="select course_name from courses where course_type='$type'";
									$res=mysqli_query($conn, $query);
									while($row = mysqli_fetch_array($res)){										
										if(($row['course_name'] != $course) && !(in_array($row['course_name'], $arr))){
											if(isset($_GET['name']) && $_GET['name'] == $row['course_name']){
												echo '<option value="'.$row['course_name'].'" selected>'.$row['course_name'].'</option>';												
											}
											else{
												echo '<option value="'.$row['course_name'].'">'.$row['course_name'].'</option>';
											}
										}
									}
								}
								
							?>
						</select><br>	
					
						<label for="center">CHOOSE CENTER:</label>
    					<select class="form-control" id="center" name="center" required>
							<option value="">Choose course name</option>
							<?php
								if(isset($_GET['name'])){
									if($_GET['name'] == 'Robotics with ARDUINO '){
										$name = 'Robotics with ARDUINO & PID';
									}
									else{
										$name= $_GET['name'];
									}		
									
									$query = "select center_id from course_center where course_id=(select course_id from courses where course_name = '$name')";
									$res = mysqli_query($conn, $query);
									
									while($row = mysqli_fetch_array($res)){
										$cid = $row['center_id'];
										$query = "select center_name from centers where center_id= $cid";
										$result = mysqli_query($conn, $query);
										while($rowName = mysqli_fetch_array($result)){
											echo '<option value="'.$rowName['center_name'].'">'.$rowName['center_name'].'</option>';
										}
									}
									
								}
								
							?>
						</select><br>	
						
						
						<button type="button" class="btn btn-primary btn-sm save" data-target="#Modalreq" data-toggle="modal">Request Course Addition</button>	
						
						
						<div class="modal fade" id="Modalreq"  >
							<div class="modal-dialog">
								<div class="modal-content modal-cnt" >
									<div class="modal-header">
											
										<button type="button" class="close" data-dismiss="modal">&times;</button>	
										<h4><i class="fa fa-bell-o animated infinite swing" aria-hidden="true"></i> ATTENTION!</h4>
									</div>
									<div class="modal-body">
										
										<?php 
											if(isset($_GET['type']) && isset($_GET['name']) && $_GET['name']!=''){
												echo 'Are you sure you want to apply for <b>'.$name.' </b> as well? <br><br>
												<button name="request" class="btn btn-primary btn-sm request" >Yes, Please Add</button>
												<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, I need to think over</button>';
											}
											else{
												echo 'Please fill out all the fields first!<br><br>
												<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">Close</button>
												';
											}
										?>
										
										
									</div> 																
								</div>
							</div>
						</div>
						
						
						
						
					</div>	
				
				</form><br><br>
				<h4>Pending Requests</h4><hr>
				
				
				<?php		
					$query="select * from add_course INNER JOIN courses ON add_course.course_id=courses.course_id INNER JOIN centers ON centers.center_id=add_course.center_id where student_id =$id and add_status <> 4";
					$res=mysqli_query($conn, $query);
					
					$check=mysqli_num_rows($res);
					
					$i=1;
					if($check<1){
						echo '<p>No pending requests found.</p>';
					}
					else{
						echo '
							<div class="table-responsive">
							<table class="table table-bordered" >
								<thead class="thead-dark">
									<tr>
										<th>#</th>
										<th>Course Name</th>									
										<th>Course Type</th>
										<th>Center</th>
										<th>Status</th>										
										<th>Action</th>										
									</tr>
								</thead>
								<tbody>	
						';		
						while($row=mysqli_fetch_array($res)){
								echo '
									<tr>
										<td>'.$i.'</td>
										<td>'.$row['course_name'].'</td>
										<td>'.$row['course_type'].'</td>
										<td>'.$row['center_name'].'</td>
										<td>';
											if($row['add_status'] == 0){
												echo '<div class="label label-warning">Pending</div>';
											}
											elseif($row['add_status'] == 1){
												echo '<div class="label label-success">Approved</div>';
											}
											elseif($row['add_status'] == 2){
												echo '<div class="label label-danger">Denied</div>';
											}
										echo '</td>
										<td>';
											if($row['add_status'] == 0){
												echo '
												<form action="includes/course.inc.php" method="POST">
													<input type="hidden" name="add_id" value="'.$row['add_id'].'"/>
													<button type="button" class="btn btn-danger btn-xs" name="delete_req" data-target="#Modalrem'.$i.'" data-toggle="modal">Remove Request</button>	
													
													<div class="modal fade modalrem" id="Modalrem'.$i.'">
														<div class="modal-dialog">
															<div class="modal-content modal-cnt" >
																<div class="modal-header">
																		
																	<button type="button" class="close" data-dismiss="modal">&times;</button>	
																	<h4><i class="fa fa-bullhorn animated infinite tada" aria-hidden="true"></i> SURE ABOUT REMOVING?</h4>
																</div>
																<div class="modal-body">
																	Removing your request would mean that you won\'t be able to add the course <b>\''.$row['course_name'].'\'</b>  to your profile.<br><br>
																	Are you sure about doing this?<br><br>
																	
																	<button name="delete_req" class="btn btn-danger btn-sm request" >Yes, remove</button>
																	<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, keep the Request</button>
																</div> 																
															</div>
														</div>
													
													
												</form>';
											}
											elseif($row['add_status'] == 1 || $row['add_status'] == 2){
												echo '
												<form action="includes/course.inc.php" method="POST">
													<input type="hidden" name="sc_id" value="'.$row['add_id'].'"/>
													<input type="hidden" name="sc_status" value="'.$row['add_status'].'"/>
													<button class="btn btn-warning btn-xs" name="remove">Remove</button>
												</form>';
											}											
											
										echo '</td>
										
									</tr>
										
							';
							$i++;
						}
						echo '
							</tbody>
						</table></div><br>
						';
					}
				?>	
				
				
				
				
			</div>		
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
				window.location.replace('add_course.php');
			};
		};
	</script>	
	
	<script>
		function openfileDialog() {
			$("#fileLoader").click();
		}
	</script>	
	
	<?php
	
	if(isset($_GET['courseQueued']) && $_GET['courseQueued']==1)
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">The Course you requested was successfully queued for administrator\'s Approval. You will be notified once your request is approved.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	
	if(isset($_GET['courserem']))
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">The course was successfully removed from addition queue.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['courseclear']))
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">Record was successfully removed.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
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
?>
	
</body>
</html>



