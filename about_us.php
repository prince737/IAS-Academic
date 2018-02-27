<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>About Us | IAS</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/about.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/aos.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" type="image/jpg" href="images/logo.jpg" />
</head>

<body>
	
	<?php
		include('header.php');
	?>
	
	<div class="container-fluid admission-banner">
		<h2>ABOUT US</h2>
		<p>Just focus on your goal, we will help you to achieve it.</p>
	</div>
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">About Us</li>
	</ol>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 about">
				<h1>About Us</h1><br>
				<img src="images/3.jpg" ></img><br><br>
				<p>We here at Institute of Applied Science never compromise on quality. Individual attention is
				given to each and every Student irrespective of one’s standing in the merit at any point of
				time. We never increase our batch size beyond a limit; this facilitates proper Student-Faculty
				interaction. Our faculty is always willing to clear doubts of Students even individually, if
				required. Our Research and Development team works round the clock to ensure that our
				teaching methodology, study material and course structure is constantly updated.</p>
			</div>
			<div class="col-md-4 hidden-xs">
				<div class="sidebar">
					<h4>What is Lorem Ipsum?</h4>
					<img src="images/8.jpg" height="140" width="240" style="margin:20px 0px; display:block;"></img>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
					<a href="registration.php">Enroll Now!</a>
				</div>			
			</div>
		</div>
	</div>
	
	<?php
	
		include('footer.php');
		
	?>
	
	<script src="js/jquery-3.2.1.min.js"></script>   
	<script src="js/bootstrap.js"></script>
	<script>
		$('ul.nav li.dropdown').hover(function() {
			$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500);
			$('.bg').removeClass('bg');
			$(this).addClass('bg');
			}, function() {
			$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
			$('.bg').removeClass('bg');
		});
	</script>
		
</body>
</html>		