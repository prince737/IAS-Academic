<?php
	
	session_start();
	require_once('includes/dbh.inc.php');
	include 'includes/simple-crypt.inc.php';
	
	$query="select distinct course_type from courses;";
	$resultType = mysqli_query($conn, $query);
	
		
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration | IAS</title>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
				<a href="index.php" class="pull-left"><img src="images/logo.jpg" height="35" width="35" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">      
				<ul class="nav navbar-nav navbar-right">
					<li><a style="font-size:16px;" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
				</ul>
			</div>
		</div>
	</nav>
    <div class="container-fluid">
	    <div class="row">
			<div class="col-lg-5 col-sm-10 register">
				<div class="heading">Register</div>
				<p class="require">All the fields below are required.*</p>
				<?php
					if(isset($_GET['signup']) && ($_GET['signup'] == 'emailtaken'))
						{
							echo '<p class="error" style="text-align:center; ">Please review the errors below. </p>';
						}
					if(isset($_GET['signup']) && ($_GET['signup'] == 'empty'))
						{
							echo '<p class="error" style="text-align:center; ">All fields are required. Please fill them carefully. </p>';
						}	
				?>
				<form action="includes/registration.inc.php" method="POST" enctype="multipart/form-data">
				    <div class="item"><span>1</span>  Your Basic Info</div>
  					<div class="form-group">
						<label for="name">NAME:</label>
    					<input type="text" class="form-control" name="name" id="name" value="<?php if(isset($_GET['0'])){echo simple_crypt($_GET[0],'d');} ?>" required>
						<p for="name" id="error_name" ></p>
						<?php
							if(isset($_GET['nm']))
							{
								echo '<p class="error">Please provide a valid name. </p>';
							}
						?>
					</div>
					<div class="form-group ">
    					<label for="gender">GENDER:</label><br>						
						<input type="radio" name="gender" value="male" id="gender" <?php if(isset($_GET['10']) && simple_crypt($_GET['10'],'d')=='male'){echo 'checked';} ?> required> Male<br>
						<input type="radio" name="gender" value="female" <?php if(isset($_GET['10']) && simple_crypt($_GET['10'],'d')=='female'){echo 'checked';} ?>> Female<br>
						<input type="radio" name="gender" value="other" 
							<?php if(isset($_GET['10']) && simple_crypt($_GET['10'],'d')=='other'){echo 'checked'; }?>> Other
  					</div>
					<div class="form-group ">
						<label for="datepicker">DATE OF BIRTH (yyyy-mm-dd):</label>
    					<input type="text" class="form-control" id="datepicker" name="date" value="<?php if(isset($_GET['1'])){echo simple_crypt($_GET[1],'d');} ?>"" required/>
  					</div>
					<div class="form-group ">
						<label for="email">EMAIL:</label>
    					<input type="email" required class="form-control" id="email" name="email" value="<?php if(isset($_GET['2'])){echo simple_crypt($_GET[2], 'd');} ?>">
						<p for="name" id="error_email"></p>
						<?php
							if(isset($_GET['em']))
							{
								echo '<p class="error">Please provide a valid email address. </p>';
							}
							if(isset($_GET['signup']) && ($_GET['signup'] == 'emailtaken'))
							{
								echo '<p class="error">Email id already registered, please use a different one. </p>';
							}
							
						?>
						
  					</div>
					<div class="form-group ">
						<label for="contact">CONTACT NUMBER:</label>
    					<input type="text" required class="form-control" id="contact" name="contact" maxlength="10" value="<?php if(isset($_GET['3'])){echo simple_crypt($_GET[3],'d');} ?>"> 
						<p for="name" id="error_contact"></p>
						<?php
							if(isset($_GET['ct']))
							{
								echo '<p class="error">Please provide a valid contact number. </p>';
							}
						?>
  					</div>
					<div class="form-group ">
						<label for="gname">GURDIAN'S NAME:</label>
    					<input type="text" required class="form-control" id="gname" name="gname" value="<?php if(isset($_GET['4'])){echo simple_crypt($_GET[4], 'd');} ?>">
						<p for="name" id="error_gname"></p>	
						<?php
							if(isset($_GET['gnm']))
							{
								echo '<p class="error">Please provide a valid name. </p>';
							}
						?>	
  					</div>
					<div class="form-group ">
						<label for="gcontact">GURDIAN'S CONTACT NUMBER:</label>
    					<input type="text" required class="form-control" id="gcontact" maxlength="10" name="gcontact" value="<?php if(isset($_GET['5'])){echo simple_crypt($_GET[5],'d');} ?>"> 
						<p for="name" id="error_gcontact"></p>
						<?php
							if(isset($_GET['gct']))
							{
								echo '<p class="error">Please provide a valid contact number. </p>';
							}
						?>
  					</div>
					<div class="form-group ">
						<label for="address">FULL ADDRESS:</label>
    					<textarea class="form-control" id="address" rows="3" name="address" required><?php if(isset($_GET['6'])){echo simple_crypt($_GET[6],'d');} ?></textarea>
  					</div>
					<div class="item" id="education"><span>2</span>  Education</div>
					<div class="form-group ">
						<label for="he">EDUCATION YOU ARE CURRENTLY PURSUING:</label>
    					<select class="form-control" id="he" name="he" required onchange="this.form.submit()">
							<option selected>Choose your current Education</option>
							<?php
								if(isset($_GET['class'])){
									$class= $_GET['class'];
								}
								$array = array('Class X', 'Class XI', 'Class XII', 'Btech', 'Mtech', 'Other');
								for($i=0; $i<6; $i++){
									if($array[$i]==$class){
										echo '<option selected>'.$array[$i].'</option>';								
										$j++;
									}
									else{
										echo '<option>'.$array[$i].'</option>';
									}
								}
							?>							
						</select>	
  					</div>
					<?php
						if(isset($_GET['class']) && $_GET['class'] == 'Other'){
							echo '
								<div class="form-group ">
									<label for="address">PLEASE SPECIFY:</label>
										<input type="text" class="form-control" name="edu" value="';
										if(isset($_GET['11'])){echo $_GET['11'];} 
										echo' " required/>
								</div>
								<div class="form-group ">
									<label for="inst">INSTITUTE WHERE YOU ARE PURSUING YOUR CURRENT EDUCATION:</label>
									<input type="text" class="form-control" name="inst" id="inst" required value="';
									if(isset($_GET['8'])){echo simple_crypt($_GET['8'],'d');} 
									echo '"/>
								</div>
								
								';
						}						
						elseif(isset($_GET['class']) && ($_GET['class'] == 'Btech' || $_GET['class'] == 'Mtech')){
							echo '
								<div class="form-group ">
									<label for="address">DEPARTMENT:</label>
										<input type="text" class="form-control" name="dept" value="';
										if(isset($_GET['12'])){echo $_GET['12'];} 
										echo' " required/>
								</div>
								<div class="form-group ">
									<label for="address">EXPECTED YEAR OF PASSING:</label>
										<input type="text" class="form-control" maxlength="4" name="yop" value="';
										if(isset($_GET['9'])){echo simple_crypt($_GET['9'],'d');} 
										echo' " required/>
								</div>								
								<div class="form-group ">
									<label for="address">NAME OF YOUR COLLEGE:</label>
										<input type="text" class="form-control" name="college" value="';
										if(isset($_GET['14'])){echo $_GET['14'];} 
										echo' " required/>
								</div>
								<div class="form-group ">
									<label for="address">NAME OF YOUR UNIVERSITY:</label>
										<input type="text" class="form-control" name="university" value="';
										if(isset($_GET['13'])){echo $_GET['13'];} 
										echo' " required/>
								</div>
							';
						}
						elseif(isset($_GET['class']) && ($_GET['class'] == 'Class X' || $_GET['class'] == 'Class XI' || $_GET['class'] == 'Class XII')){
							echo '
								<div class="form-group ">
									<label for="address">NAME OF YOUR SCHOOL:</label>
										<input type="text" class="form-control" name="school" value="';
										if(isset($_GET['15'])){echo $_GET['15'];} 
										echo' " required/>
								</div>
							';	
							
						}
						
					?>
					
					
					<?php
						if(isset($_GET['class'])){
							$class= $_GET['class'];						
							
							
							$query="select * from course_edu where edu='$class'";
							$result= mysqli_query($conn, $query);
							
							echo '
								<div class="form-group ">
									<label for="course">TYPE OF COURSE YOU ARE OPTING FOR:</label>
									<select class="form-control" id="course" name="course_type" required onchange="this.form.submit()">
										<option selected>Choose Course Type</option>
							';
							$type='';
							while($row = mysqli_fetch_array($result)){
								
								$cid = $row['course_id'];
								$query = "select course_type from courses where course_id = $cid";
								$res= mysqli_query($conn, $query);
								
								while($rowCtype = mysqli_fetch_array($res)){
									global $type;
									if($type != $rowCtype['course_type']){
										if(isset($_GET['select']) && $rowCtype['course_type'] == $_GET['select']){
											echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
										}
										elseif(isset($_GET['select']) && $rowCtype['course_type'] == '10+2 Entrance Exams' && $_GET['select']=='10 2 Entrance Exams'){
											echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
										}
										elseif(isset($_GET['select']) && $rowCtype['course_type'] == 'Training & Project Work' && $_GET['select']=='Training '){
											echo '<option value="'.$rowCtype['course_type'].'" selected>'.$rowCtype['course_type'].'</option>';
										}
										else{
											echo '<option value="'.$rowCtype['course_type'].'">'.$rowCtype['course_type'].'</option>';
										}
									}
									
									$type=$rowCtype['course_type'];
								}
							}
							echo '
									</select>	
								</div>
							';
						}
					
					?>
					

					<?php
						if(isset($_GET['select'])){
							if($_GET['select'] == '10 2 Entrance Exams'){
								$select = '10+2 Entrance Exams';
							}
							elseif($_GET['select'] == 'Training '){
								$select = 'Training & Project Work';
							}
							else{
								$select = $_GET['select'];
							}
							
							$class=$_GET['class'];
							
							echo '
								<div class="form-group ">
									<label for="course">NAME OF THE COURSE:</label>
									<select class="form-control" id="course_name" name="course_name" required onchange="this.form.submit()">
									<option selected>Choose Course Name</option>
							';
							
							
							$query = "select course_name from courses where course_type='$select'";
							$res = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($res)){	
								if(isset($_GET['courseName']) && $_GET['courseName'] == $row['course_name']){
									echo '<option value="'.$row['course_name'].'" selected>'.$row['course_name'].'</option>';
									
								}
								else{
									
									echo '<option value="'.$row['course_name'].'">'.$row['course_name'].'</option>';
									
								}
							}
							
							/*$j=20;
							for($i=0; $i<$_GET['limit']; $i++){
								if(isset($_GET['courseName']) && $_GET['courseName'] == simple_crypt($_GET[$j], 'd')){
									echo '<option value="'.simple_crypt($_GET[$j], 'd').'" selected>'.simple_crypt($_GET[$j], 'd').'</option>';
									$j++;
								}
								else{
									echo '<option value="'.simple_crypt($_GET[$j], 'd').'">'.simple_crypt($_GET[$j], 'd').'</option>';
									$j++;
								}
								
							}*/
							echo '
									</select>	
								</div>
							';
						}
					
					?>
					<div class="item"><span>3</span>  Identity</div>
					<div class="form-group ">
						<label for="img">UPLOAD PHOTO:</label>
    					<input type="file" class="form-control" name="image" id="img" accept=".jpg, .jpeg, .png" required />
						<p style="color:teal;">Accepted types are jpg, png and jpeg. MAX Size 1mb.</p>
						<p for="name" id="error_image"></p>
  					</div>
					<div class="item"><span>4</span>  Password</div>
					<div class="form-group ">
						<label for="pwd">PASSWORD:</label>
    					<input type="password" required class="form-control" id="pwd" name="pwd"> 
  					</div>
					<div class="form-group ">
						<label for="cpwd">CONFIRM PASSWORD:</label>
    					<input type="password" required class="form-control" id="cpwd" name="cpwd"> 
  					</div>
					<p id="message" style="margin-top: 20px; font-size:16px;"></p>
					<p id="message1" style="margin-top: 20px; font-size:16px;"></p>
  					<button type="submit" id="register" name="register" class="submit">Register</button>
				</form>
			</div>
		</div>
	</div> 
	
		
	<script src="js/jquery-3.2.1.min.js"></script>  	
	<script src="js/register.js"></script>   
    <script src="js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	
	
</body>
</html>