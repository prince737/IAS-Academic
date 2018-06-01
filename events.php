<?php
	
	session_start();
	require_once('includes/dbh.inc.php');	
		
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
		
		<!--<div class="row row-centered">
			<div class="col-md-10 col-centered">
				<p class="banner">Find all our upcoming events below</p>
				<p class="helper">*click on a event to find out more</p>
				<div class="monthly" id="mycalendar"></div>
			</div>
		</div>-->
		
		<div class="row">
			<div class="col-md-8 event-contain">
				<h3>Upcoming Events</h3><br>
				<div class="event-wrap">
					



					<?php
						// connect to database
						require_once('includes/dbh.inc.php');
						// define how many results you want per page
						$results_per_page = 10;
						// find out the number of results stored in database
						$sql='SELECT * FROM events where events_status=1';
						$result = mysqli_query($conn, $sql);
						$number_of_results = mysqli_num_rows($result);
						// determine number of total pages available
						$number_of_pages = ceil($number_of_results/$results_per_page);
						// determine which page number visitor is currently on
						if (!isset($_GET['page'])) {
						  $page = 1;
						} else {
						  $page = $_GET['page'];
						}
						// determine the sql LIMIT starting number for the results on the displaying page
						$this_page_first_result = ($page-1)*$results_per_page;
						// retrieve selected results from database and display them on page
						$sql='SELECT * FROM events where events_status=1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)){
							$phpdate = strtotime($row['events_startdate']);
							$date1 = date( 'd M, Y', $phpdate );
							$phpdate = strtotime($row['events_enddate']);
							$date2 = date( 'd M, Y', $phpdate );
							
							//if(strtotime('now') < strtotime($date2)){
							
								echo '
									
									<div class="col-md-2"><img class="hidden-xs" src="images/event.jpg" height="80" width="80"></img></div>
											<div class="col-md-10">
												<div class="ehead">
													'.$row['events_heading'].'
												</div><br>
												<small>Starts: '.$date1.'</small>
												<small>&nbsp;&nbsp;Ends: '.$date2.'&nbsp;&nbsp;&nbsp;|</small>
												<small>&nbsp;Starting Time : '.$row['events_starttime'].'</small>
												<small>&nbsp;&nbsp;Ending Time : '.$row['events_endtime'].'</small>
												<div class="desc">
													'.$row['events_body'].'
												</div>
											</div>
									<hr style="border: 0.5px solid #909090;">	
										
								';
							//}
							
						}
						// display the links to the pages
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="events.php?page=' . $prev . '">&laquo;</a><li>
							';
						}
						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected"' : '';
							echo '
								<li><a '.$selected.' href="events.php?page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="events.php?page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					?>	
					
					
				</div>
				
			</div>
			<div class="col-md-4">
				
				<div class="monthly" id="mycalendar"></div>
				<!--<div class="sidebar">
					<h4>What is Lorem Ipsum?</h4>
					<img src="images/demo.jpg" height="140" width="250" style="margin:20px 0px; display:block;"></img><br>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
				</div>-->			
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
		$query ="Select * from events where events_status=1";
		$result =@mysqli_query($conn,$query);
	
		$result1 =@mysqli_query($conn,$query);
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
						"starttime": "'.$row['events_starttime'].'",
						"endtime": "'.$row['events_endtime'].'",
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