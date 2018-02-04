<?php
	session_start();
	include '../includes/simple-crypt.inc.php';
	
	if(isset($_SESSION['admin'])){
		header("Location: admin.php");
		exit();
	}
	
	
	
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrator Login | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/pwd.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="../images/logo.jpg" />
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
				<a href="index.php" class="pull-left"><img src="../images/logo.jpg" height="35" width="45" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>
			
		</div>
	</nav>
	
	
	<div class="bg container-fluid">
		
		
		<p class="text">Administrator Login</p>
		
		<div class="row">
			<div class="col-md-7 col-lg-4 col-sm-10 col-md-offset-4 signin">					
				<p class="icon"><span class="fa fa-lock"></span></p>	
				<form class="form" action="includes/adminlogin.inc.php" method="POST">
				
					<input type="text" name="uid" id="uid" placeholder="User Id" class="form-control" required>
					<input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required>
					
					<button type="submit" name="submit" id="submit" class="submit">Login in as Admin</button><br>
					
					<p id="message" style="text-align:center;"></p>
					<p id="message1" style="text-align:center;"></p>						
				
				</form>
			
			
			</div>
		</div>
	
	</div>