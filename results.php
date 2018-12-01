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
	<title>Results | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/profile_new.css">
    <link rel="stylesheet" type="text/css" href="css/exams.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
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
			$query = "select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id INNER JOIN centers ON centers.center_id=students_courses.center_id where stu_email='$email'";
		}
		elseif(isset($_COOKIE['student'])){
			$email = $_COOKIE['student'];
			$query = "select * from students INNER JOIN students_courses ON student_id=stu_id INNER JOIN courses ON courses.course_id=students_courses.course_id INNER JOIN centers ON centers.center_id=students_courses.center_id where stu_email='$email'";
		}
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);

		$query="select * from students_courses natural join courses natural join centers where student_id=".$row['stu_id'];
		$course_res=mysqli_query($conn,$query);
		
	?>

	<div class="container">
    	<div class="row">
         	<div class="col-sm-12">
         		<div class="cover_wrap">
         			<div class="cover">         				
         			</div>
         			<div class="data">
         				<div class="row">
         					<div class="col-sm-3 text-center">
         						<img class="img" <?php echo 'src="'.$row['stu_imageLocation'].'"'; ?> />
         					</div>
         					<div class="col-sm-3 text-center">
         						<p class="res"><?php echo $row['stu_name']; ?></p>
         						<p class="query">Full Name</p>
         					</div>
         					<div class="col-sm-3 text-center">
         						<p class="res"><?php echo $row['stu_roll']; ?></p>
         						<p class="query">Roll Number</p>
         					</div>
         					<div class="col-sm-3 text-center">
         						<p class="res"><?php echo $row['center_name']; ?></p>
         						<p class="query">Center</p>
         					</div>
         				</div>
         			</div>
         		</div>
         	</div>         	
    	</div>
    	<div class="row row2">
        	<div class="col-sm-3">
        		<div class="courses">
        			<p class="chead">My Courses</p>
        			<ul>
						<?php
							while($r=mysqli_fetch_array($course_res)){
								echo '
									<li><span class="cname">'.$r['course_name'].'</span><br>
									<span class="reg">'.$r['registration_no'].' </span><br>
									<span class="cen">'.$r['center_name'].' </span></li>
								';
							}
						
						?>						
					</ul>
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
						<li class="link active" id="result">
							<a href="#">
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
        	<div class="col-sm-9">
        		<div class="main">
        			<div class="exam_heading">Results</div>
        			<div class="exam_content">
	        			<table class="table table-bordered">
							<thead>
						      <tr>
						        <th>Exam Id</th>
						        <th>Title</th>
						        <th>Standard</th>
						        <th>Marks Scored</th>
						        <th>Published On</th>
						        <th>Actions</th>
						      </tr>
						    </thead>
						    <tbody>
						    	<?php
						    		$sql = "select * from results natural join exams where student_id = ".$row['stu_id']." and publish_status = 1";
						    		$res = mysqli_query($conn, $sql);

						    		$i=1;
									while($r=mysqli_fetch_array($res)){

										$query = "select qp_fullmarks from papers where qpid = '".$r['paper_id']."'";
										$rs = mysqli_query($conn, $query);
										$full_marks=mysqli_fetch_array($rs);

										$date = strtotime($r['exam_end']);
										echo '
										<tr>
						        			<td>'.$r['exam_id'].'</td>
						        			<td>'.$r['exam_title'].'</td>
						        			<td>'.$r['exam_standard'].'</td>
						        			<td>'.$r['marks'].' / '.$full_marks['qp_fullmarks'].'</td>
						        			<td>'.$r['publish_date'].'</td>
						        			<td><a href="result_details.php?exam='.$r['exam_id'].'&id='.$row['stu_id'].'" class="btn btn-warning btn-xs" target="_blank">Details</a></td>
						      			</tr>

						      			';
						      			$i++;
									}
						    	?>
						    </tbody>
						</table>
					</div>
        		</div>

        	</div>
        </div>
    </div>

    <!------CONFIRMATION MODAL----->
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
				window.location.replace('results.php');
			};
		};

	</script>	
	
</body>
</html>



