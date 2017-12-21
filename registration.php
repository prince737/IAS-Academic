<?php
	session_start();
?>

<html>
<head>
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
    <div class="container-fluid">
	    <div class="row">
			<div class="col-md-5 col-sm-10 contactus">
				<div class="heading">
					<img src="images/logo.jpg"/>
				</div>
				<form>
				    <div class="item"><span>1</span>  Your Basic Info</div>
  					<div class="form-group">
					<label for="name">NAME:</label>
    					<input type="text" class="form-control" id="name" required>
  					</div>
					<div class="form-group ">
    					<label for="gender">GENDER:</label><br>
						<input type="radio" name="gender" value="male" id="gender"> Male<br>
						<input type="radio" name="gender" value="female"> Female<br>
						<input type="radio" name="gender" value="other"> Other
  					</div>
					<div class="form-group ">
						<label for="datepicker">DATE OF BIRTH:</label>
    					<input type="text" class="form-control" id="datepicker" name="dob" required/>
  					</div>
					<div class="form-group ">
						<label for="email">EMAIL:</label>
    					<input type="email" required class="form-control" id="email" id="email">
  					</div>
					<div class="form-group ">
						<label for="contact">CONTACT NUMBER:</label>
    					<input type="text" required class="form-control" id="contact"> 
  					</div>
					<div class="item"><span>2</span>  Education</div>
					<div class="form-group ">
					<label for="he">HIGHEST EDUCATION:</label>
    					<input type="text" class="form-control" name="he" id="he" required />
  					</div>
					<div class="form-group ">
						<label for="yop">YEAR OF PASSING:</label>
    					<input type="text" class="form-control" name="yop" id="yop" required />
  					</div>
					<div class="form-group ">
					<label for="course">COURSE OPTING FOR:</label>
    					<select class="form-control" id="course">
							<option selected>Choose...</option>
							<option value="volvo">Volvo</option>
							<option value="saab">Saab</option>
							<option value="mercedes">Mercedes</option>
							<option value="audi">Audi</option>
						</select>
  					</div>
					<div class="item"><span>3</span>  Password</div>
					<div class="form-group ">
						<label for="pwd">PASSWORD:</label>
    					<input type="text" required class="form-control" id="pwd"> 
  					</div>
					<div class="form-group ">
						<label for="cpwd">CONFIRM PASSWORD:</label>
    					<input type="text" required class="form-control" id="cpwd"> 
  					</div>
  					<button type="submit" id="register" class="submit">Register</button>
				</form>
			</div>
		</div>
	</div>
		
			<!--<div class="col-lg-6 form">
				<form action="includes/registration.inc.php" method="POST">
					
					
					<div class="input-contain">
						<span>GENDER:</span>
						<input type="radio" name="gender" value="male"> Male
						<input type="radio" name="gender" value="female"> Female
						<input type="radio" name="gender" value="other"> Other
					</div>
					<div class="input-contain">
						<input type="text" class="inputText" id="datepicker" name="dob" required/>
						<span class="floating-label">DATE OF BIRTH </span>
					</div>
					<div class="input-contain">
						<input type="text" class="inputText" name="he" required />
						<span class="floating-label">HIGHEST EDUCATION </span>
					</div>
					<div class="input-contain">
						<input type="text" class="inputText" name="yop" required />
						<span class="floating-label">YEAR OF PASSING</span>
					</div>
					<select class="inputText input-contain" style="color:#dee1e4;">
					<option>SELECT COURSE</option>
						<option value="volvo">Volvo</option>
						<option value="saab">Saab</option>
						<option value="mercedes">Mercedes</option>
						<option value="audi">Audi</option>
					</select>
					<div class="input-contain">
						<input type="email" class="inputText" name="email" required />
						<span class="floating-label">EMAIL</span>
					</div>
					
					<div class="input-contain">
						<input type="text" class="inputText" name="contact" required />
						<span class="floating-label">CONTACT NUMBER</span>
					</div>
					<div class="input-contain">
						<input type="password" class="inputText" name="pwd" required />
						<span class="floating-label">PASSWORD</span>
					</div>
					<div class="input-contain">
						<input type="password" class="inputText" name="cpwd" required />
						<span class="floating-label">CONFIRM PASSWORD</span>
					</div>
					<button type="submit" name="submit">Sign Up</button>
				</form>
			</div>
		
		</div>-->
		
	
	
	<script src="js/jquery-3.2.1.min.js"></script>   
    <script src="js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1990:2013'
		});
	} );
	</script>
	
	
</body>
</html>