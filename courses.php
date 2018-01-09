<?php

	session_start();
	require_once('includes/dbh.inc.php');	
	
	if(isset($_GET['ee'])){
		$type = '10+2 Entrance Exams';
	}
	if(isset($_GET['be'])){
		$type = 'Board Exams';
	}
	if(isset($_GET['bec'])){
		$type = 'Board and Entrance Combined';
	}
	if(isset($_GET['gpi'])){
		$type = 'GATE / PSU / IES';
	}
	if(isset($_GET['ce'])){
		$type = 'Competitive Exams';
	}
	if(isset($_GET['tpw'])){
		$type = 'Training & Project Work';
	}
	if(isset($_GET['its'])){
		$type = 'IAS Test Series';
	}
	
	$query= "select * from courses where course_type='$type'";
	$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Courses | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/courses.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/monthly.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="images/logo.jpg" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body>
	<?php
		include('header.php');
	?>
	<div class="container-fluid notices-banner" >
		<h2 class="animated zoomIn">		
			<?php 
				echo $type;		
			?>		
		</h2>
		<p class="animated zoomIn">"Education for a better future"</p>
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Courses</li>
		<li class="breadcrumb-item active">
			<?php 				
				echo $type;				
			?>
		</li>
	</ol>
	
	

	
	<div class="container">	
		<div class="row">
		    <div class="col-md-9"  id="exTab">
				<p class="heading"><?php echo $type; ?> </p>
				<ul class="nav nav-tabs">
				<?php
					if($result){
						
						if($type == 'Board and Entrance Combined'){
							$course_name = array("Engineering and Board", "Medical and Board", "Combined and Board");
							$i=1;
							while($i<=3){
								$active = $i==1? 'class="active"' : '';
								echo '
									<li '.$active.'>
										<a  href="#'.$i.'" data-toggle="tab">'.$course_name[$i-1].'</a>
									</li>							
								';
								$i++;
							}
						}
						else{
							$i=1;
							while($row = mysqli_fetch_array($result)){
								$active = $i==1? 'class="active"' : '';
								echo '
									<li '.$active.'>
										<a  href="#'.$i.'" data-toggle="tab">'.$row['course_name'].'</a>
									</li>							
								';
								$i++;
							}	
						}						
					}
				?>
					
					
				</ul>

				<div class="tab-content ">
					<?php
						$query= "select * from courses where course_type='$type'";
						$result = mysqli_query($conn,$query);
						if($result){
							if($type == 'Board and Entrance Combined'){
								$query= "select course_description from courses where course_id=311";
								$result = mysqli_query($conn,$query);
								$course_desc[0] = mysqli_fetch_array($result); 
								$query= "select course_description from courses where course_id=321";
								$result = mysqli_query($conn,$query);
								$course_desc[1] = mysqli_fetch_array($result); 
								$query= "select course_description from courses where course_id=331";
								$result = mysqli_query($conn,$query);
								$course_desc[2] = mysqli_fetch_array($result); 
								$course_name = array("Engineering and Board", "Medical and Board", "Combined and Board");
								$i=1;
								while($i<=3){
									$active = $i==1? 'active' : '';
									echo '
										<div class="tab-pane '.$active.'" id="'.$i.'">
											<h3>'.$course_name[$i-1].'</h3>
											<p>'.$course_desc[$i-1]['course_description'].'</p>
										</div>'	
									;	
									$i++;
								}
							}
							else{
								$i=1;
								while($row = mysqli_fetch_array($result)){
									$active = $i==1? 'active' : '';
									echo '
										<div class="tab-pane '.$active.'" id="'.$i.'">
											<h3>'.$row['course_name'].'</h3>
											<p>'.$row['course_description'].'</p>
										</div>'	
									;	
									$i++;
								}
							}
						}
					?>					
				</div>
			</div>
			<div class="col-md-3">
				<div  id="course_links">
				    <p>Courses Offered</p>
					<ul>
						<li><a tabindex="-1" href="courses.php?ee=1">10+2 ENTRANCE EXAMS</a></li>
						<li><a tabindex="-1" href="courses.php?be">BOARD EXAMS</a></li>
						<li><a tabindex="-1" href="courses.php?bec">BOARD & ENTRANCE COMBINED</a></li>
						<li><a tabindex="-1" href="courses.php?gpi">GATE / PSU / IES</a></li>
						<li><a tabindex="-1" href="courses.php?ce">COMPETITIVE EXAMS</a></li>
						<li><a tabindex="-1" href="courses.php?tpw">TRAINING AND PROJECT WORKS</a></li>
						<li><a tabindex="-1" href="courses.php?its">IAS TEST SERIES</a></li>
					</ul>	
				</div>				
			</div>
		</div>			
	</div>
	<br><br>

	<div class="container-fluid" id="gallery">
		<div class="row" >

			<div class="col-md-6 left">
				<h1>Have a look at our Gallery</h1>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br><a href="gallery.php">Browse All!</a>
</p>
				<img data-aos="fade-up-left" data-aos-duration="1000" data-aos-delay="300" src="images/3.jpg"></img>
			</div>
			<div class="col-md-6 right">
				<img src="images/1.jpg" class="first" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="300" ></img>
				<img src="images/demo.jpg" class="second" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="300" ></img>

			</div>
				
		</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="js/aos.js"></script>
	
	
	
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
	<script>
        AOS.init();
    </script>
	
	
</body>
</html>