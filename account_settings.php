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
	<title>Student Profile | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
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
				<a href="index.php" class="pull-left hidden-xs"><img src="images/logo.jpg" height="35" width="45" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">      
				<ul class="nav navbar-nav navbar-right"" role="menu" aria-labelledby="dropdownMenu">
					
					<li>
						<form class="navbar-form"  action="includes/logout.inc.php" method="POST">
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
						<li class="link active">
							<a href="#">
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
								<i class="fa fa-plus-square-o" aria-hidden="true"></i>VIEW PENDING UPDATES</span>
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
			<div class="col-md-9 content shadow">
				<div id="account-wrapper">
					<p class="header">Basic Information</p>
					<a href="pending_updates.php" class="btn btn-xs pull-right pending hidden-xs"><span class="fa fa-spinner"></span> View Pending Updates</a>
					<div class="clearfix"></div>
					<p class="header1">Please note: Apart from your <b>Picture</b> and <b>Password</b> any changes you make here will only take effect after they are approved by the adminstrator</p>
					<div class="container-fluid">
						<div class="row">
							
							<div class="col-md-6" > 
								<form action="includes/profile_update.inc.php" method="POST">
									<div class="form-group">
										<p class="heading">NAME<span id="edit" class="edit">Edit</span></p>
										<p class="value" id="value"><?php echo $row['stu_name']; ?></p>						
										<input type="text" name="name" class="form-control input" id="input" value="<?php echo $row['stu_name']; ?>"></input>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<button id="save" name="save_name" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</form>
							</div>
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">GENDER<span id="edit1" class="edit">Edit</span></p>
										<p class="value" id="value1"><?php echo $row['stu_gender']; ?></p>	
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>				
										<div class="form-group input" id="input1">					
											<input type="radio" name="gender" value="Male" id="gender" <?php if($row['stu_gender']=='Male'){echo 'checked';} ?>  required> Male
											<input type="radio" name="gender" value="Female" <?php if($row['stu_gender']=='Female'){echo 'checked';} ?> > Female
											<input type="radio" name="gender" value="Other" <?php if($row['stu_gender']=='Other'){echo 'checked';} ?> > Other
											<button id="save1" name="save_gender" class="btn btn-primary btn-sm save">Request Change</button>
										</div>
										
									</div>
								</div>
							</form>
						</div>
						<div class="row">
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">DATE OF BIRTH<span id="edit2" class="edit">Edit</span></p>
										<p class="value" id="value2"><?php echo $row['stu_dob']; ?></p>					
										<input type="text" name="dob" class="form-control input"  id="datepicker" value="<?php echo $row['stu_dob']; ?>"></input>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<button id="save2" name="save_dob" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">EMAIL<span id="edit3" class="edit">Edit</span></p>
										<p class="value" id="value3"><?php echo $row['stu_email']; ?></p>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>					
										<input type="text" name="email" class="form-control input"  id="input3" value="<?php echo $row['stu_email']; ?>"></input>
										<button id="save3" name="save_email" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
						</div>
						<div class="row">
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">CONTACT NUMBER<span id="edit4" class="edit">Edit</span></p>
										<p class="value" id="value4"><?php echo $row['stu_contact']; ?></p>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>				
										<input type="text" name="contact" class="form-control input"  id="input4" value="<?php echo $row['stu_contact']; ?>" maxlength="10"></input>
										<button id="save4" name="save_contact" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">GUARDIAN'S NAME <span id="edit5" class="edit">Edit</span></p>
										<p class="value" id="value5"><?php echo $row['stu_gurdianname']; ?></p>	
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<input type="text" name="gname" class="form-control input"  id="input5" value="<?php echo $row['stu_gurdianname']; ?>"></input>
										<button id="save5" name="save_gname" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
						</div>
						<div class="row">	
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">GUARDIAN'S CONTACT <span id="edit6" class="edit">Edit</span></p>
										<p class="value" id="value6"><?php echo $row['stu_gurdiancontact']; ?></p>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>			
										<input type="text" name="gcontact" class="form-control input"  id="input6" value="<?php echo $row['stu_gurdiancontact']; ?>" maxlength="10"></input>
										<button id="save6" name="save_gcontact" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
							<div class="col-md-6">
								<a class="pwd-change" data-target="#Modal" data-toggle="modal" >CHANGE YOUR PASSWORD</a>
								
								<div class="modal fade" id="Modal"  >
									<div class="modal-dialog">
										<div class="modal-content" >
											<button type="button" class="close hidden-xs" data-dismiss="modal">&times;</button>					
											<div class="modal-body">
												
												<div class="row">
													<div class="col-md-5 hidden-xs">
														<p class="newpwd">Your new password must:</p>
														<ul>
															<li>Be atleast 8 characters in length</li>
															<li>Not be same as your current password</li>
														<ul>
													</div>
													<div class="col-md-7">
														<h4>Change Password</h4>
														<form action="includes/change.inc.php" method="POST">
															<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
															<input type="password" id="old-pwd" name="old-pwd" placeholder="ENTER OLD PASSWORD" class="form-control" required/><br>
															<input type="password" id="new-pwd" name="new-pwd" placeholder="ENTER NEW PASSWORD" class="form-control" required/><br>
															<input type="password" id="renew-pwd" name="renew-pwd" placeholder="RE-ENTER NEW PASSWORD" class="form-control" required/>
															<p id="message"></p>
															<p id="message1"></p>
															<button type="submit" class="btnn" id="change" name="change"><span class="fa fa-key"></span>   Change Password</button>
														</form>
													</div>
												</div>
												
											</div> 											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">CATEGORY<span id="editt1" class="edit">Edit</span></p>
										<p class="value" id="valuee1"><?php echo $row['stu_category']; ?></p>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>				
										<input type="text" name="category" class="form-control input"  id="inputt1" value="<?php echo $row['stu_category']; ?>"></input>
										<button id="savee1" name="save_category" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">BLOOD GROUP<span id="editt2" class="edit">Edit</span></p>
										<p class="value" id="valuee2"><?php echo $row['stu_blood']; ?></p>	
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<input type="text" name="blood" class="form-control input"  id="inputt2" value="<?php echo $row['stu_blood']; ?>"></input>
										<button id="savee2" name="save_blood" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
						</div>
						<div class="row">
							<form action="includes/profile_update.inc.php" method="POST">
								<div class="col-md-6">
									<div class="form-group">
										<p class="heading">Religion<span id="editt3" class="edit">Edit</span></p>
										<p class="value" id="valuee3"><?php echo $row['stu_religion']; ?></p>	
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<input type="text" name="religion" class="form-control input"  id="inputt3" value="<?php echo $row['stu_religion']; ?>"></input>
										<button id="savee3" name="save_religion" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
						</div>
						<div class="row">
							<form action="includes/profile_update.inc.php" method="POST">	
								<div class="col-md-12">
									<div class="form-group">
										<p class="heading">ADDRESS<span id="edit7" class="edit">Edit</span></p>
										<p class="address" id="value7"><?php echo $row['stu_address']; ?></p>
										<input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>"></input>
										<textarea name="address" class="form-control textarea"  id="input7" ><?php echo $row['stu_address']; ?></textarea>	
										<button id="save7" name="save_address" class="btn btn-primary btn-sm save">Request Change</button>
									</div>
								</div>
							</form>
						</div>
						
						<p class="header" style="font-size:25px; padding:30px 0px; border-bottom:1px solid #f3f3f4;">Education</p>
						
						<?php
							if($row['stu_highestdegree'] == 'Class XII' || $row['stu_highestdegree'] == 'Class XI'){
								echo'
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">SCHOOL<span id="edit8" class="edit">Edit</span></p>
												<p class="value" id="value8">'.$row['stu_currentinstitute'].'</p>						
												<input type="text" name="school" class="form-control input" id="input8" value="'.$row['stu_currentinstitute'].'"></input>
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>
												<button id="save8" name="save_school" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">BOARD<span id="edit9" class="edit">Edit</span></p>
												<p class="value" id="value9">'.$row['stu_university'].'</p>		
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>												
												<input type="text" name="board" class="form-control input" id="input9" value="'.$row['stu_university'].'"></input>
												<button id="save9" name="save_board" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">CLASS<span id="edit11" class="edit">Edit</span></p>
												<p class="value" id="value11">'.$row['stu_highestdegree'].'</p>			
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>		
												<input type="text" name="he" class="form-control input" id="input11" value="'.$row['stu_highestdegree'].'"></input>
												<button id="save11" name="save_he" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-12" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">SUBJECT COMBINATION<span id="edit10" class="edit">Edit</span></p>
												<p class="value subject" id="value10">'.$row['stu_subjectCombo'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>		
												<textarea name="subject" class="form-control textarea sub" id="input10" >'.$row['stu_subjectCombo'].'</textarea>
												<button id="save10" name="save_sub" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>
								
								';
							}
							elseif($row['stu_highestdegree'] == 'Class X'){
								echo'
								
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">SCHOOL<span id="edit8" class="edit">Edit</span></p>
												<p class="value" id="value8">'.$row['stu_currentinstitute'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="school" class="form-control input" id="input8" value="'.$row['stu_currentinstitute'].'"></input>
												<button id="save8" name="save_school" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">BOARD<span id="edit9" class="edit">Edit</span></p>
												<p class="value" id="value9">'.$row['stu_university'].'</p>		
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="board" class="form-control input" id="input9" value="'.$row['stu_university'].'"></input>
												<button id="save9" name="save_board" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">CLASS<span id="edit11" class="edit">Edit</span></p>
												<p class="value" id="value11">'.$row['stu_highestdegree'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="he" class="form-control input" id="input11" value="'.$row['stu_highestdegree'].'"></input>
												<button id="save11" name="save_he" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								
								
								';
							}
							elseif($row['stu_highestdegree'] == 'Btech' || $row['stu_highestdegree'] == 'Mtech'){
								
								echo'								
								
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">COURSE<span id="edit11" class="edit">Edit</span></p>
												<p class="value" id="value11">'.$row['stu_highestdegree'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>
												<input type="text" name="he" class="form-control input" id="input11" value="'.$row['stu_highestdegree'].'"></input>
												<button id="save11" name="save_he" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">DEPARTMENT<span id="edit12" class="edit">Edit</span></p>
												<p class="value" id="value12">'.$row['stu_dept'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>
												<input type="text" name="dept" class="form-control input" id="input12" value="'.$row['stu_dept'].'"></input>
												<button id="save12" name="save_dept" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">COLLEGE<span id="edit8" class="edit">Edit</span></p>
												<p class="value" id="value8">'.$row['stu_currentinstitute'].'</p>
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>
												<input type="text" name="school" class="form-control input" id="input8" value="'.$row['stu_currentinstitute'].'"></input>
												<button id="save8" name="save_school" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
									<div class="col-md-6" > 										
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">UNIVERSITY<span id="edit9" class="edit">Edit</span></p>
												<p class="value" id="value9">'.$row['stu_university'].'</p>		
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="board" class="form-control input" id="input9" value="'.$row['stu_university'].'"></input>
												<button id="save9" name="save_board" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>									
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">EXPECTED YEAR OF PASSING<span id="edit13" class="edit">Edit</span></p>
												<p class="value" id="value13">'.$row['stu_yearofpass'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="yop" class="form-control input" id="input13" value="'.$row['stu_yearofpass'].'"></input>
												<button id="save13" name="save_yop" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								
								';
							}
							else{
								echo'								
								
								<div class="row">
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">CURRENT EDUCATION / STATUS<span id="edit11" class="edit">Edit</span></p>
												<p class="value" id="value11">'.$row['stu_currentStatus'].'</p>		
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="cur" class="form-control input" id="input11" value="'.$row['stu_currentStatus'].'"></input>
												<button id="save11" name="save_cur" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>	
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">HIGHEST DEGREE<span id="edit11" class="edit">Edit</span></p>
												<p class="value" id="value11">'.$row['stu_highestdegree'].'</p>		
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="he" class="form-control input" id="input11" value="'.$row['stu_highestdegree'].'"></input>
												<button id="save11" name="save_he" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>	
								</div>	
								<div class="row">									
									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
											<div class="form-group">
												<p class="heading">COLLEGE<span id="edit8" class="edit">Edit</span></p>
												<p class="value" id="value8">'.$row['stu_currentinstitute'].'</p>	
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>
												<input type="text" name="school" class="form-control input" id="input8" value="'.$row['stu_currentinstitute'].'"></input>
												<button id="save8" name="save_school" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>									

									<div class="col-md-6" > 
										<form action="includes/profile_update.inc.php" method="POST">
										<div class="form-group">
												<p class="heading">YEAR OF PASSING<span id="edit13" class="edit">Edit</span></p>
												<p class="value" id="value13">'.$row['stu_yearofpass'].'</p>
												<input type="hidden" name="id" value="'.$row['stu_id'].'"></input>	
												<input type="text" name="yop" class="form-control input" id="input13" value="'.$row['stu_yearofpass'].'"></input>
												<button id="save13" name="save_yop" class="btn btn-primary btn-sm save">Request Change</button>
											</div>
										</form>
									</div>
								</div>	
								
								';
							}						
						?>	
							<a href="pending_updates.php" class="btn btn-xs pending hidden-lg hidden-md"><span class="fa fa-spinner"></span> View Pending Updates</a>
						
					</div>
				</div>				
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
	<script>
		$( function() {
			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: '1990:2012',
				altField: "#datepicker",
				altFormat: "yy-mm-dd",
				defaultDate: "-27y -12m"
			});
		} );
	</script>
	<script src="js/bootstrap.js"></script>	
	<script>
		$( "#edit").click(function() {
		  $( "#input" ).toggle(),
		  $( "#save" ).toggle(),
		  $("#value").toggle(),
		  $("#edit").toggleHTML('Edit', 'Cancel');	
		});
	
	
		$( "#edit1").click(function() {
		  $( "#input1" ).toggle(),
		  $( "#save1" ).toggle(),
		  $("#value1").toggle(),
		  $("#edit1").toggleHTML('Edit', 'Cancel');	
		});

		$( "#edit2").click(function() {
		  $( "#datepicker" ).toggle(),
		  $( "#save2" ).toggle(),
		  $("#value2").toggle(),
		  $("#edit2").toggleHTML('Edit', 'Cancel');	
		});	
		
		$( "#edit3").click(function() {
		  $( "#input3" ).toggle(),
		  $( "#save3" ).toggle(),
		  $("#value3").toggle(),
		  $("#edit3").toggleHTML('Edit', 'Cancel');	
		});	
		
		$( "#edit4").click(function() {
		  $( "#input4" ).toggle(),
		  $( "#save4" ).toggle(),
		  $("#value4").toggle(),
		  $("#edit4").toggleHTML('Edit', 'Cancel');	
		});	
		
		$( "#edit5").click(function() {
		  $( "#input5" ).toggle(),
		  $( "#save5" ).toggle(),
		  $("#value5").toggle(),
		  $("#edit5").toggleHTML('Edit', 'Cancel');	
		});	
		
		$( "#edit6").click(function() {
		  $( "#input6" ).toggle(),
		  $( "#save6" ).toggle(),
		  $("#value6").toggle(),
		  $("#edit6").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit7").click(function() {
		  $( "#input7" ).toggle(),
		  $( "#save7" ).toggle(),
		  $("#value7").toggle(),
		  $("#edit7").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit8").click(function() {
		  $( "#input8" ).toggle(),
		  $( "#save8" ).toggle(),
		  $("#value8").toggle(),
		  $("#edit8").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit9").click(function() {
		  $( "#input9" ).toggle(),
		  $( "#save9" ).toggle(),
		  $("#value9").toggle(),
		  $("#edit9").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit10").click(function() {
		  $( "#input10" ).toggle(),
		  $( "#save10" ).toggle(),
		  $("#value10").toggle(),
		  $("#edit10").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit11").click(function() {
		  $( "#input11" ).toggle(),
		  $( "#save11" ).toggle(),
		  $("#value11").toggle(),
		  $("#edit11").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit12").click(function() {
		  $( "#input12" ).toggle(),
		  $( "#save12" ).toggle(),
		  $("#value12").toggle(),
		  $("#edit12").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#edit13").click(function() {
		  $( "#input13" ).toggle(),
		  $( "#save13" ).toggle(),
		  $("#value13").toggle(),
		  $("#edit13").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#editt1").click(function() {
		  $( "#inputt1" ).toggle(),
		  $( "#savee1" ).toggle(),
		  $("#valuee1").toggle(),
		  $("#editt1").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#editt2").click(function() {
		  $( "#inputt2" ).toggle(),
		  $( "#savee2" ).toggle(),
		  $("#valuee2").toggle(),
		  $("#editt2").toggleHTML('Edit', 'Cancel');	
		});
		
		$( "#editt3").click(function() {
		  $( "#inputt3" ).toggle(),
		  $( "#savee3" ).toggle(),
		  $("#valuee3").toggle(),
		  $("#editt3").toggleHTML('Edit', 'Cancel');	
		});
				
		$.fn.toggleHTML = function(a, b) {
			this.html(function(_, html){
				return html === a  ? b : a;
			})
		}
	</script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('account_settings.php');
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
	
	
	<?php
	
		if(isset($_GET['success']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">'.$_GET['success'].' was successfully queued for update. We will notify you once your request is approved by our administrator. </p> 
						<p class="para"><a href="pending_updates.php">View all pending updates</a></p>
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		
		if(isset($_GET['successChange']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Image was successfully Updated.</p> 
						
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['errLargeFile']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">File size too large.</p> 
						
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['errFileType']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">The type of file you uploaded is not supported. Supported types are <b>png</b>, <b>jpg</b> and <b>jpeg</b></p> 
						
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
						<p class="para"><a href="#">View all pending updates</a></p>
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['errPwdUnset']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Existing password does not match with the value you entered in the first field.</p> 						
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['successPwdChange']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Password was successfully updated.</p> 						
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['errmail']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Email id you entered is already in use. Please provide a different one.</p> 
						<p class="para"><a href="pending_updates.php">View all pending updates</a></p>
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['same']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">The value you entered is same as the existing one. Any pending updation request for the attribute has been cancelled. </p> 
						<p class="para"><a href="pending_updates.php">View all pending updates</a></p>
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['invalid']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">The value you entered is not valid. Please try again.</p>
						<p class="para"><a href="pending_updates.php">View all pending updates</a></p>	
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		
	
	?>
	
	
</body>
</html>