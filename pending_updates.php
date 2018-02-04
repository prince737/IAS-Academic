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
	<title>Pending Updates | IAS</title>
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
							<img class="img-thumbnail" src="'.$row['stu_imageLocation'].'" /> 
							<form action="includes/change.inc.php" method="POST" enctype="multipart/form-data">
								<input type="file" id="fileLoader" accept=".jpg, .jpeg, .png" onchange="this.form.submit();" name="image"/>
								<input type="hidden" name="id"  value="'.$row['stu_id'].'"></input>
								<input type="button" class="btn btn-default btn-sm" id="btnOpenFileDialog" value = "Change Image" onclick="openfileDialog();" />
							<p class="name">'.$row['stu_name'].'</p>
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
						<li class="link active">
							<a href="#">
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
			
				<h4>Queued Updates</h4>
					 
				<a href="profile.php" class="btn btn-xs pending pull-right hidden-xs"><span class="fa fa-cogs"></span> Back to Account Settings</a>				
					
				<hr>
				
				<?php
					$id=$row['stu_id'];
					$query="select * from student_profile_update where student_id=$id AND spu_status=0";
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
										<th>Attribute</th>									
										<th>Current Value</th>
										<th>Requested Value</th>										
										<th>Actions</th>									
									</tr>
								</thead>
								<tbody>	
						';		
						while($row_spu=mysqli_fetch_array($res)){
							$attr = $row_spu['spu_field'];
							$attrName= findAttribute($attr);
								echo '
									<tr>
									<form action="includes/profile_update.inc.php" method="POST">
										<td>'.$i.'</td>
										<td>'.$attrName.'</td>
										<td>'.$row[$attr].'</td>
										<td><span id="val'.$i.'">'.$row_spu['spu_newValue'].'</span>
											<input type="text" name="newVal" id="newVal'.$i.'" value="'.$row_spu['spu_newValue'].'"/>
										</td>
										<td>
											
												<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
												<input type="hidden" name="attr" value="'.$attr.'"/>
												
												<button type="button" class="btn btn-danger btn-xs" name="delete_req" data-target="#Modalrem'.$i.'" data-toggle="modal">Delete</button>	
												
												
												<div class="modal fade modalrem" id="Modalrem'.$i.'">
													<div class="modal-dialog">
														<div class="modal-content modal-cnt" >
															<div class="modal-header">
																	
															<button type="button" class="close" data-dismiss="modal">&times;</button>	
																<h4><i class="fa fa-bullhorn animated infinite tada" aria-hidden="true"></i> SURE ABOUT DELETING YOUR REQUEST?</h4>
															</div>
															<div class="modal-body">
																Deleting your request would mean that your <b>'.$attrName.'</b> won\'t be queued for updation anymore.<br><br>
																Are you sure about doing this?<br><br>
																	
																<button name="rmvReq" class="btn btn-danger btn-sm request" >Yes, please remove</button>
																<button type="button" class="btn btn-success btn-sm no" data-dismiss="modal">No, keep the Request</button>
															</div> 																
														</div>
													</div>
												</div>
												
												
												
												<button type="button" class="btn btn-warning btn-xs" id="edit'.$i.'">Edit</button>	
												<button name="save"class="btn btn-success btn-xs " id="save'.$i.'">Save</button>	
											
										</td>
										<script src="js/jquery-3.2.1.min.js"></script>   
										<script>
											$(document).ready(function() {
												$("#newVal'.$i.'").hide();
												$("#save'.$i.'").hide();
												
												$("#edit'.$i.'").on("click", function () {
													$("#newVal'.$i.'").show();
													$("#save'.$i.'").show();
													$("#edit'.$i.'").hide();
													$("#val'.$i.'").hide();
													
												}) ;															
														
											})
										</script>
										
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
				<h4>Approved Changes</h4>	<hr>
				
				<?php
					$id=$row['stu_id'];
					$query="select * from student_profile_update where student_id=$id AND spu_status IN(1,2)";
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
										<th>Attribute</th>		
										<th>Requested Value</th>										
										<th>Status</th>										
										<th>Actions</th>										
									</tr>
								</thead>
								<tbody>	
						';		
						while($row_spu=mysqli_fetch_array($res)){
							$attr = $row_spu['spu_field'];
							$attrName= findAttribute($attr);
								echo '
									<tr>
										<td>'.$i.'</td>
										<td>'.$attrName.'</td>
										<td>'.$row_spu['spu_newValue'].'</td>
										';
											if($row_spu['spu_status'] == 1){
												echo '<td><span class="label label-success">Approved</span></td>';
											}
											elseif($row_spu['spu_status'] == 2){
												echo '<td><span class="label label-danger">Denied</span></td>';
											}
										echo '
										<td>
											<form action="includes/profile_update.inc.php" method="POST">
												<input type="hidden" name="id" value="'.$row['stu_id'].'"/>
												<input type="hidden" name="attr" value="'.$attr.'"/>
												<button class="btn btn-danger btn-xs" name="remove-update">Remove</button>	
											</form>
										</td>
										
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
				<a href="profile.php" class="btn btn-xs pending hidden-md hidden-lg"><span class="fa fa-cogs"></span> Back to Account Settings</a>
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
				window.location.replace('profile_updates.php');
			};
		};
	</script>
	
	
	
	<script>
		 $('#new-pwd,#renew-pwd').on('keyup', function () {
        if ($('#new-pwd').val() == $('#renew-pwd').val()) {
            $('#message').html('').css('color', '#5fcf80');
            $('#change').prop('disabled',false);
        } else{
            $('#message').html('Passwords do not Match.').css('color', '#D32F2F');
            $('#change').prop('disabled',true);
        }
        });  

		$('#new-pwd').on('blur', function(){
		if(this.value.length < 8){
			$('#message1').html('Passwords must be atleast 8 characters long.').css('color', '#D32F2F');
			return false;
		} else{
            $('#message1').html('');           
        }
		});		
	</script>
	<script>
		function openfileDialog() {
			$("#fileLoader").click();
		}
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
				return 'Subject Gender';
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
		}
	?>