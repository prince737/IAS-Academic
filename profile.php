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
	<title>Profile | IAS</title>
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
			<div class="cover hidden-xs">
			
				
			
			</div>		
		
			<div class="col-md-3 navigation shadow" style="margin-top:20px;">
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
								<p class="name">'.$row['stu_name'].'</p>
							'; 		
					?>
					
				</div>
				<div class="nav-menu shadow">
					<ul> 
						<li class="link active">
							<a href="#">
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
						<li class="link ">
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
			<div class="col-md-7 content shadow" style="margin-top:20px;">	
				<div class="container-fluid" >
				
							
					<div class="row notice-wrapper">
						
						<div class="col-md-6 notice-container">
							<p >NOTICEBOARD</p>
							<div class="notice-board">
								<div class="marquee">
										
										<?php
											$query ="Select * from notices where notices_status=1 order by STR_TO_DATE(notices_date, '%M %d, %Y') DESC";
											$result =@mysqli_query($conn,$query);
											$i=0;								
											while($row1 = mysqli_fetch_array($result))
											{
												$phpdate = strtotime($row1['notices_date']);
												$date = date( 'd M, Y', $phpdate );
												echo'
													<div class=notice_data>';
													if($i<4){
														echo '<img src="images/new.jpg" height="20" width="20"></img>&nbsp;';
													}
														
														echo '<span class="fa fa-file-text-o"></span>	
														<a href="'.$row1['notices_location'].'" target="_blank"><span>'.$date.'</span> | ' . $row1['notices_content']. '</a>
												
													</div>	<br>
												';
												$i++;
											}
										?>
										
									</div>	
									
							</div>
							<a class="link btn btn-primary" href="notices.php">View All Notices</a>
							
							
						</div>
						<div class="col-md-6 notice-container">				
							<p> EVENTS & ANNOUNCEMENTS</p>			
							<div class="notice-board">
								<div class="marquee">
															
										<?php
											$query ="Select * from events where events_status=1";
											$result1 =@mysqli_query($conn,$query);	
											if($result1)
											{
													
												while($row2 = mysqli_fetch_array($result1))
												{
													$phpdate = strtotime($row2['events_startdate']);
													$date1 = date( 'd M, Y', $phpdate );
													$phpdate = strtotime($row2['events_enddate']);
													$date2 = date( 'd M, Y', $phpdate );
													$i=0;
													
														
														if( strtotime('now') < strtotime($date2) ) {
															echo '<div class="notice_data">';
															if($i<4){
																echo '<img src="images/new.jpg" height="20" width="20"></img>&nbsp;';
															}
															echo '<i class="fa fa-calendar" style="color:#795548;" aria-hidden="true"></i>
																<a href="events.php"><span>Starts: '.$date1.'  Ends: '.$date2.'</span> | <span>From '.$row2['events_starttime'].' to '.$row2['events_endtime'].' | </span>' . $row2['events_heading']. '</a>';
															echo '</div>	<br>';	
														}
													
													$i++;
												}
											}
										?>
									
								</div>	
							</div>
							<a class="link btn btn-primary" href="events.php">View All Events</a>
							
						</div>
					</div>
				</div>	
						
			</div>	
			<div class="col-md-2 courses">
				<h3><?php echo $row['stu_roll']; ?></h3>
				<h4>My Courses</h4>
				<ul>
					<?php
						
						$query="select * from students_courses natural join courses natural join centers where student_id=".$row['stu_id'];
						$res=mysqli_query($conn,$query);
						while($r=mysqli_fetch_array($res)){
							echo '
								<li>'.$r['course_name'].'</li>
								'.$r['registration_no'].' <br>
								'.$r['center_name'].' <br><br>
							';
						}
					
					?>
					
				</ul>
				
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
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	<script src="js/jquery.marquee.js" type="text/javascript"></script>
	

	<script>
		$('.marquee').marquee({
			duration: 10000,
			gap:320,
			delayBeforeStart: 0,
			direction: 'up',
			duplicated: true,
			pauseOnHover: true
		});
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



