<?php

	session_start();
	require_once('includes/dbh.inc.php');	
	
		
	$query ="Select * from events where events_status=1";
	$result =@mysqli_query($conn,$query);
	
	$result1 =@mysqli_query($conn,$query);
	
?>


<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Events | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/events.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/monthly.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="images/logo.jpg" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body>
	<?php
		include('header.php');
	?>
	
	<div class="container-fluid events-banner">
		<h2>EVENTS</h2>
		<p>Join us on the days that matters the most.</p>
	</div>
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a></li>
		<li class="breadcrumb-item active">Events</li>
	</ol>
	<div class="container">
		
		<div class="row row-centered">
			<div class="col-md-10 col-centered">
				<p class="banner">Find all our upcoming events below</p>
				<p class="helper">*click on a event to find out more</p>
				<div class="monthly" id="mycalendar"></div>
			</div>
		</div>
	
	
	</div>
	
	<?php
		include('footer.php');
	?>
	

	<script src="js/jquery-3.2.1.min.js"></script> 
    <script src="js/bootstrap.js"></script>
	<script src="vendor/js/jquery.js"></script>
	<script src="vendor/js/monthly.js"></script>
	
	<?php
		$count = 0;
		$index=0;
		$colors = array('#669966', '#666699','#999966','#666699','#CC99CC');
		echo '<script type="text/javascript">
				var sampleEvents = {
				"monthly": [
		';
		$no = mysqli_num_rows($result1);
		while($row = mysqli_fetch_array($result))
		{
			$count++;
			echo '{
						"id": '.$row['eid'].',
						"name": "'.$row['events_heading'].'<br>'.$row['events_body'].'",
						"startdate": "'.$row['events_startdate'].'",
						"enddate": "'.$row['events_enddate'].'",
						"starttime": "'.$row['events_time'].'",
						"endtime": "2:00",
						"color": "'.$colors[$index].'",
						"url": ""
				';
				if($count == $no){
					echo '}';
				}
				else{
					echo '},';
				}
            $index = ($index + 1) % 4;				
		}
		echo ']
			};
		</script>	
		';
	
	?>
		
	
<script>

	$(window).load( function() {
		$('#mycalendar').monthly({
			mode: 'event',
			dataType: 'json',
			events: sampleEvents
		});
	});
</script>
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