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
    <link rel="stylesheet" type="text/css" href="css/exam.css">
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
		</div>
	</nav>
	<div class="instructions_wrap">
		<span class="pull-left">Name of exam goes here</span>
		<span class="pull-right"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Instructions</span>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 mainbody">
				<div class="stream_wrap">
					<span class="stream">Course Name</span>
					<i class="fa fa-calculator fa-5 pull-right" aria-hidden="true"></i>
				</div>
				<div class="time_wrap">
					<span class="pull-right"><b>Time Left: 176:00</b></span>
				</div>
				<div class="qtype_wrap">
					<span class="qtype"><b>Question Type: MCQ</b></span>
					<span class="marks pull-right">Marks for correcr answer: <span style="color:green;">1</span></span>
				</div>
				<div class="question_wrap">
					<div class="question_no"><b>Question 1</b></div>
					<div class="question_data">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</div>
					<div class="options">
						<div class="radio">
						  	<label style="font-size: 16px;">
						    	<input type="radio" name="optionsRadios">
						    	A
						  	</label>
						</div><br>
						<div class="radio">
						  	<label style="font-size: 16px;">
						    	<input type="radio" name="optionsRadios">
						    	B
						  	</label>
						</div><br>
						<div class="radio">
						  	<label style="font-size: 16px;">
						    	<input type="radio" name="optionsRadios">
						    	C
						  	</label>
						</div><br>
						<div class="radio">
						  	<label style="font-size: 16px;">
						    	<input type="radio" name="optionsRadios">
						    	D
						  	</label>
						</div>
					</div>
				</div>
				<div class="response_wrap">
					<button class="btn btn-default">Mark for Review & Next</button>
					<button class="btn btn-default">Clear Response</button>
					<button class="btn btn-primary pull-right">Save & Next</button>
				</div>
			</div>
			<div class="col-sm-2 sidebar">
				<div class="user">
					<img src="StudentProfileImages/5ad2027a76d6d1.4020618950.jpg" height="100" width="100">
					<span>Your Name</span>
				</div>
				<div class="nav_buttons">

				</div>
				<div class="submission">
					<button class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<footer>Version: 00.01</footer>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.js"></script>	
</body>