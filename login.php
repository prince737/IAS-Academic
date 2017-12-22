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

	
	<div class="bg container-fluid">
	
		<div class="row row-centered">
			<div class="col-sm-6 col-lg-4 col-centered">
				<p class="brand">Institute of Applied Science</p>
				<div class="content">
					<p class="login">LOG IN</p>
					<form class="form" action="includes/login.inc.php" method="POST">
					    <p class="name">EMAIL</p> 
						<input type="email" name="email" placeholder="E-mail" required><br>
						<p class="name">PASSWORD</p>
						<input type="password" name="pwd" placeholder="Password" required><br>
						<button type="submit" name="submit" class="submit">LOG IN</button><br>
						<a href="#" class="fp">Forgot Your Password?</a>
					</form>
					
				</div>
				<a href="registration.php" >register</a>
			</div>
		</div>
	
	</div>
	


<script src="js/jquery-3.2.1.min.js"></script>   
<script src="js/bootstrap.js"></script>

</body>
</html>