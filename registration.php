<?php
	
	session_start();
	
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
    					<input type="text" class="form-control" name="name" id="name" value="<?php if(isset($_GET['0'])){echo $_GET[0];} ?>" required>
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
						<input type="radio" name="gender" value="male" id="gender" required> Male<br>
						<input type="radio" name="gender" value="female"> Female<br>
						<input type="radio" name="gender" value="other"> Other
  					</div>
					<div class="form-group ">
						<label for="datepicker">DATE OF BIRTH (yyyy-mm-dd):</label>
    					<input type="text" class="form-control" id="datepicker" name="date" value="<?php if(isset($_GET['1'])){echo $_GET[1];} ?>"" required/>
  					</div>
					<div class="form-group ">
						<label for="email">EMAIL:</label>
    					<input type="email" required class="form-control" id="email" name="email" value="<?php if(isset($_GET['2'])){echo $_GET[2];} ?>">
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
    					<input type="text" required class="form-control" id="contact" name="contact" maxlength="10" value="<?php if(isset($_GET['3'])){echo $_GET[3];} ?>"> 
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
    					<input type="text" required class="form-control" id="gname" name="gname" value="<?php if(isset($_GET['4'])){echo $_GET[4];} ?>">
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
    					<input type="text" required class="form-control" id="gcontact" maxlength="10" name="gcontact" value="<?php if(isset($_GET['5'])){echo $_GET[5];} ?>"> 
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
    					<textarea class="form-control" id="address" rows="3" name="address" required><?php if(isset($_GET['6'])){echo $_GET[6];} ?></textarea>
  					</div>
					<div class="item"><span>2</span>  Education</div>
					<div class="form-group ">
						<label for="he">HIGHEST EDUCATION:</label>
    					<input type="text" class="form-control" name="he" id="he" required value="<?php if(isset($_GET['7'])){echo $_GET[7];} ?>"/>
  					</div>
					<div class="form-group ">
						<label for="inst">INSTITUTE WHERE YOU PURSUED HIGHEST EDUCATION:</label>
    					<input type="text" class="form-control" name="inst" id="inst" required value="<?php if(isset($_GET['8'])){echo $_GET[8];} ?>"/>
  					</div>
					<div class="form-group ">
						<label for="yop">YEAR OF PASSING:</label>
    					<input type="text" class="form-control" name="yop" id="yop" maxlength="4" required value="<?php if(isset($_GET['9'])){echo $_GET[9];} ?>"/>
  					</div>
					<div class="form-group ">
					<label for="course">COURSE OPTING FOR:</label>
    					<select class="form-control" id="course" name="course">
							<option selected>Choose...</option>
							<option value="volvo">Volvo</option>
							<option value="saab">Saab</option>
							<option value="mercedes">Mercedes</option>
							<option value="audi">Audi</option>
						</select>
  					</div>
					<div class="item"><span>3</span>  Help us to recognize you</div>
					<div class="form-group ">
						<label for="img">UPLOAD PHOTO:</label>
    					<input type="file" class="form-control" name="image" id="img" accept=".jpg, .jpeg, .png" required />
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