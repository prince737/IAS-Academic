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
	<title>Change Course | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/pending_updates.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/jquery-3.2.1.min.js"></script>   
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
			$query = "select * from students INNER JOIN students_courses ON stu_id=student_id where stu_email='$email'";
		}
		elseif(isset($_COOKIE['student'])){
			$email = $_COOKIE['student'];
			$query = "select * from students INNER JOIN students_courses ON stu_id=student_id where stu_email='$email'";
		}
		$result = mysqli_query($conn, $query);
	?>
	
	<div class="container-fluid profile-wrapper">
		<div class="row">
			<div class="col-md-3 navigation shadow" >
				<div class="img-name">
				<?php
					$rowMain = mysqli_fetch_array($result);
						echo '
							<img class="img-thumbnail" src="'.$rowMain['stu_imageLocation'].'" /> 
							<form action="includes/change.inc.php" method="POST" enctype="multipart/form-data">
								<input type="file" id="fileLoader" accept=".jpg, .jpeg, .png" onchange="this.form.submit();" name="image"/>
								<input type="hidden" name="id"  value="'.$rowMain['stu_id'].'"></input>
								<input type="button" class="btn btn-default btn-sm" id="btnOpenFileDialog" value = "Change Image" onclick="openfileDialog();" />
							<p class="name">'.$rowMain['stu_name'].'</p>
							</form>
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
						<li class="link active">
							<a href="admin.php">
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
							<a href="505.php">
								<i class="fa fa-download" aria-hidden="true"></i>DOWNLOADS</span>
							</a>
						</li>
						<li class="link">
							<a href="505.php">
								<i class="fa fa-pencil" aria-hidden="true"></i>EXAMS</span>
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
				
				<h4>Change existing course</h4>
				<a href="pending_changes.php" class="btn btn-xs pull-right pending hidden-xs"><span class="fa fa-spinner"></span> View Queued Changes</a>
				<hr>
				<form action="includes/course.inc.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $rowMain['stu_id']; ?>"></input>
					<div class="form-group ">
    					<label> CHOOSE THE COURSE YOU WANT TO CHANGE:</label><br>
					<?php
							
						
						$query="select * from students_courses INNER JOIN courses ON students_courses.course_id=courses.course_id where student_id =".$rowMain['stu_id']." AND registration_no IS NOT NULL";
						$res=mysqli_query($conn, $query);
						$check = mysqli_num_rows($res);
						if($check > 0){
							while($row=mysqli_fetch_array($res)){
								echo ' <label class="radio-inline">
								  <input type="radio" value="'.$row['course_id'].'" name="optradio"';
								  if(isset($_GET['radio']) && ($_GET['radio'] == $row['course_id'])){
									  echo ' checked';
								  }
								  
								  echo '>'.$row['course_name'].'
								</label>';
							}
							
						}
					?>
					</div>
					
					
					<div class="form-group">
						<label for="type">CHOOSE THE TYPE OF COURSE:</label>
    					<select class="form-control" id="type" name="type1" onchange="this.form.submit()" required>
							<option value="">Choose course type</option>
							<?php
								$id = $rowMain['stu_id'];
								$course=$rowMain['course_name'];
								$arr=array('Class X', 'Class XI', 'Class XII', 'Btech', 'Mtech');
								$class=$rowMain['stu_highestdegree'];
								echo $class;
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
							$sql="select * from students_courses INNER JOIN courses ON students_courses.course_id=courses.course_id where student_id =$id ";
							$res=mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($res)){
								$arr[]=$row['course_name'];
							}
							$sql="select * from course_change INNER JOIN courses ON new_course_id=courses.course_id where student_id =$id ";
							$res=mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($res)){
								array_push($arr,$row['course_name']);
							}
							
						?>
						<label for="name">CHOOSE THE COURSE:</label>
    					<select class="form-control" id="name" name="name1" required">
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
										if(!in_array($row['course_name'], $arr)){
											if(isset($_GET['name']) && $_GET['name'] == $row['course_name']){
												echo '<option value="'.$row['course_name'].'" selected>'.$row['course_name'].'</option>';												
											}
											elseif(isset($_GET['name']) && $_GET['name'] == 'Robotics with ARDUINO ' && $row['course_name'] == 'Robotics with ARDUINO & PID'){
												echo '<option value="'.$row['course_name'].'" selected>'.$row['course_name'].'</option>';
											}
											else{
												echo '<option value="'.$row['course_name'].'">'.$row['course_name'].'</option>';
											}
										}
									}
								}
								
							?>
						</select>
					</div>	
						
					
						


						<button type="button" class="btn btn-primary btn-xs save" data-target="#Modalreq" data-toggle="modal">Request Course Change</button>	<br>
						
						
						<div class="modal fade" id="Modalreq"  >
							<div class="modal-dialog">
								<div class="modal-content modal-cnt" >
									<div class="modal-header" style="background:#1976d2;">
											
										<button type="button" class="close" data-dismiss="modal">&times;</button>	
										<h4><i class="fa fa-bell-o animated infinite swing" aria-hidden="true"></i> ATTENTION!</h4>
									</div>
									<div class="modal-body">
										
										<?php 
											if(isset($_GET['type']) && isset($_GET['radio'])){
												echo '<p>Are you sure you want to alter current course with <b class="cname">';
												echo "
													<script>
														$(document).ready(function(){ 
														  $('#name').change(function(){ 
															$('.cname').html($('#name').val());
															;
														  });
														});
													</script>
												
												";
												echo ' </b>? <br><br>
												Any previously queued changes for the new course will be overwritten.<br></p>
												<button name="request_change" class="btn btn-primary btn-sm request">Yes, Please Change</button>
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
					
					
				
				</form>
				
				
				<br><br>
				<h4 id="center">Change Center</h4><hr>
				<form action="includes/center.inc.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $rowMain['stu_id']; ?>"></input>
					<div class="form-group ">
    					<label> CHOOSE THE COURSE FOR WHICH YOU WANT TO CHANGE CENTER:</label><br>
					<?php
						
						$query="select * from students_courses INNER JOIN courses ON students_courses.course_id=courses.course_id where student_id =".$rowMain['stu_id']." AND registration_no IS NOT NULL";
						$res=mysqli_query($conn, $query);
						$check = mysqli_num_rows($res);
						if($check > 0){
							while($row=mysqli_fetch_array($res)){
								echo ' <label class="radio-inline">
								  <input type="radio" onchange="this.form.submit()" value="'.$row['course_id'].'" name="radio"';
								  if(isset($_GET['radioc']) && ($_GET['radioc'] == $row['course_id'])){
									  echo ' checked';
								  }
								  
								  echo '>'.$row['course_name'].'
								</label>';
							}
							
						}
					?>
					</div>
					
					<div class="form-group">
						
						
						<label for="center">CHOOSE NEW CENTER:</label>
    					<select class="form-control" id="center" name="center" required>
							<option value="">Choose center name</option>
							<?php
								if(isset($_GET['radioc'])){
									$query = "select * from course_center where course_id= ".$_GET['radioc']."";
									$res = mysqli_query($conn, $query);
									
									
									while($row = mysqli_fetch_array($res)){
										
										$query="select center_id from students_courses where student_id=".$rowMain['stu_id']." and course_id=".$row['course_id']." AND registration_no IS NOT NULL";
										$res1=mysqli_query($conn, $query);
										$count=mysqli_num_rows($res1);
										$row1 = mysqli_fetch_array($res1);
										$oldcid=$row1['center_id'];
										
										
										$query ="select * from centers where center_id = ".$row['center_id']."";
										$result = mysqli_query($conn, $query);
										$rowc = mysqli_fetch_array($result);
										if($rowc['center_id'] != $oldcid){
											echo '<option value="'.$rowc['center_id'].'">'.$rowc['center_name'].'</option>';
										}
										
									}
								}
							?>
						</select><br>	
						
						
					</div>
					
					<button type="button" class="btn btn-primary btn-xs save" data-target="#Modalcen" data-toggle="modal">Request Center Change</button>	
						
						
						<div class="modal fade" id="Modalcen">
							<div class="modal-dialog">
								<div class="modal-content modal-cnt" >
									<div class="modal-header">
											
										<button type="button" class="close" data-dismiss="modal">&times;</button>	
										<h4><i class="fa fa-bell-o animated infinite swing" aria-hidden="true"></i> ATTENTION!</h4>
									</div>
									<div class="modal-body">
										
										<?php 
											if(isset($_GET['radioc'])){
												echo '<p>Sure about changing your Center?</p>
												<button name="center_change" class="btn btn-primary btn-sm request">Yes, Please Change</button>
												<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, I need to think over</button>';
											}
											else{
												echo '<p>Please fill out all the fields first!</p>
												<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">Close</button>
												';
											}
										?>
										
										
									</div> 																
								</div>
							</div>
						</div>		
					
					
				</form>
				<a href="pending_changes.php" class="btn btn-xs pending hidden-lg hidden-md"><span class="fa fa-spinner"></span> View Pending Updates</a>
				
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
	
	
		
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	
	<script src="js/bootstrap.js"></script>	
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('change_course.php');
			};
		};
	</script>	
	
	<script>
		function openfileDialog() {
			$("#fileLoader").click();
		}
	</script>	
	
	
	
</body>
</html>

<?php
	
	if(isset($_GET['courseQueued']) && $_GET['courseQueued']==1)
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">The Course change you requested was successfully queued for administrator\'s Approval. You will be notified once your request is approved.<br><br>
					You can view all your pending changes by clicking <a href="pending_changes.php">here.</a></p>	
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
	if(isset($_GET['centerQueued']) && $_GET['centerQueued']==1)
	{
		echo '			    
			<div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">The Center change you requested was successfully queued for administrator\'s Approval. You will be notified once your request is approved.<br><br>
					You can view all your pending changes by clicking <a href="pending_changes.php">here.</a></p>	
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

