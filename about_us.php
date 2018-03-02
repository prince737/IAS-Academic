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
				<h3 class="text-center"><b>Dedicated to serve the STUDENTS</b></h3>

					<p>Institute of Applied Science, established and directed by the alumni of Jadavpur University
					and different IITs in India along with other reputed Institutions, is a noble organisation in the
					field of education. Institute of Applied Science has been serving the students since 2000. The
					Institute started its journey in the field of GATE training. A few years back Institute of
					Applied Science has launched its other wings for trainings in other fields as Joint Entrance
					Exams (JEE), National Eligibility and Entrance Test (NEET-UG) and Industrial Training
					courses.</p>
					<p>The classes are conducted by the experienced Professors of Institute of Applied Science and
					experts from different resources. The special classes are conducted by the scholar students of
					IIT Kharagpur, Jadavpur University, Calcutta Medical College, NRS Medical College etc.
					We here at Institute of Applied Science never compromise on quality. Individual attention is
					given to each and every student irrespective of one’s standing in the merit at any point of
					time. We never increase our batch size beyond a limit; this facilitates proper Student-Faculty
					interaction. Our faculty is always willing to clear doubts of students even individually, if
					required. Our Research and Development (R&amp;D) team works round the clock to ensure that
					our teaching methodology, study material and course structure is contemporarily updated.
					Salient Features:</p>
					<ul>
						<li>Counselling, motivation and enhancement session for the students.</li>
						<li>Exclusive study of the fundamental science.</li>
						<li>Exclusive practice of the numeric problems.</li>
						<li>Advance classes for conceptually smart students.</li>
					</ul>
					<p><b>Vision:</b></p>
					<ul>
						<li>To be the Top Performing and Most Admired in the Academic Regime.</li>
						<li>The Institute of Applied Science will be a world leader in the integration of teaching
					and learning.</li>
					</ul>
					
					<p><b>Mission:<b></p>
					<p>The mission of the Institute of Applied Science is to help prepare outstanding educators,
					scholars, and researchers, and to advance the profession of education, as broadly defined,
					through research on the science and art of teaching and learning, the application of clinical
					processes, the effective uses of technology, and the analysis and development of leadership
					and educational policy.</p>
					<p><b>Values:</b></p>
					<ul>
						<li> Motivation and enhancement.</li>
						<li>Academic excellence and integrity.</li>
						<li>Outstanding teaching and service.</li>
						<li>Scholarly research and professional leadership.</li>
						<li>Integration of teaching, research, and service.</li>
						<li>Individual and collective excellence.</li>
						<li>Diversity, equity, and social justice.</li>
						<li>Education of individuals across the life span.</li>
					</ul>
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