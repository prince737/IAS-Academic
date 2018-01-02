<?php

	session_start();
	require_once('includes/dbh.inc.php');	
	
		
	$query ="Select * from notices where notices_status=1";
	$result =@mysqli_query($conn,$query);
	
	$query ="Select notices_date from notices where notices_status=1";
	$result1 =@mysqli_query($conn,$query);	
	
?>


<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Notices | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
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
	
	<div class="container-fluid notices-banner">
		<h2>NOTICES</h2>
		<p>"Education for a better future"</p>
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a></li>
		<li class="breadcrumb-item active">Notices</li>
	</ol>
	
	<div class="container">
		<div class="row">
			<div class="col-md-9 content">
				<div class="col-md-12">
					<h3 class="heading">Notice Board</h3>
					
					<?php
						// connect to database
						require_once('includes/dbh.inc.php');
						// define how many results you want per page
						$results_per_page = 10;
						// find out the number of results stored in database
						$sql='SELECT * FROM notices where notices_status=1';
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
						$sql='SELECT * FROM notices where notices_status=1 order by notices_date desc LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)) {
							$phpdate = strtotime($row['notices_date']);
							$date = date( 'd M, Y', $phpdate );
						  echo'
							<div class=notice_data>
							
								<a href="'.$row['notices_location'].'" target="_blank"><span>'.$date.'</span> | ' . $row['notices_content']. '</a>
							
							</div>	<br>
						  ';
						}
						// display the links to the pages
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="notices.php?page=' . $prev . '">&laquo;</a><li>
							';
						}
						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected"' : '';
							echo '
								<li><a '.$selected.' href="notices.php?page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="notices.php?page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					?>
				</div>	
			</div>
			<div class="col-md-3 ">
				<div class="col-md-12">
					<div class="sidebar">
						<h4>What is Lorem Ipsum?</h4>
						<img src="images/demo.jpg" height="110" width="195" style="margin:20px 0px; display:block;"></img>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
					</div>
				
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