<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
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
					<li><a href="registration.php" style="font-size:16px;"><span class="glyphicon glyphicon-user"></span> Enroll Now</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="bg container-fluid">
			
		<p class="text">Log in to access your profile and exams</p>
		<div class="row">
			<div class="col-md-7 col-lg-4 col-sm-10 col-md-offset-4 signin">
				
				<img src="images/no-photo.jpg" class="dp">
				<form class="form" action="includes/login.inc.php" method="POST">
					<input type="email" name="email" id="email" placeholder="E-mail" class="form-control" value="<?php if(isset($_GET['m'])){echo $_GET['m'];} ?>" required>				
					<input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required>	
					<button type="submit" name="submit" id="submit" class="submit">Log In</button><br>
					<p id="error_email" style="text-align:center;"></p>
					<p id="error_pwd" style="text-align:center;"></p>
					<?php
						if(isset($_GET['l']))
						{
							if($_GET['l'] == 'na')
							{
								echo '<p class="error" style="text-align:center; ">You are not yet approved by our administrator. We will send you an email once you are approved. </p>';
							}
							elseif($_GET['l'] == 'pdm')
							{
								echo '<p class="error" style="text-align:center; ">Passwords do not match. Try again. </p>';
							}
							elseif($_GET['l'] == 'er')
							{
								echo '<p class="error" style="text-align:center; ">Invalid email id or password. </p>';
							}
						}
					?>
					
					
					<label class="checkbox pull-left">
						<input type="checkbox" value="remember-me">
						Remember me
					</label>
					<a href="#" class="pull-right need-help">Forgot Password? </a><span class="clearfix"></span>	
				
				</form>
			
			
			</div>
		</div>
	
	</div>
	
<script src="js/jquery-3.2.1.min.js"></script>   
<script src="js/bootstrap.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
	$('#email').on('blur', function(){
		if(!this.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
		{
			$('#error_email').html('Please provide a valid email address.').css('color', '#D32F2F').css('font-size','16px');
			 $(this).focus(); 
			 $('#email').css('border', '2px solid #D32F2F');
			return false;
		} 
        $('#error_email').html('');  
		$('#email').css('border', 'none');			
        
	});	
	
	$('#pwd').on('blur', function(){
		if(this.value.length < 8){
			$('#error_pwd').html('Passwords must be atleast 8 characters long.').css('color', '#D32F2F').css('font-size','16px');
			$(this).focus(); 
			$('#pwd').css('border', '2px solid #D32F2F');
			$('#submit').prop('disabled',true);
			return false;
		} else{
            $('#error_pwd').html('');  
			$('#pwd').css('border', 'none');
			$('#submit').prop('disabled',false);	
        }
		});		
</script>
</body>
</html>