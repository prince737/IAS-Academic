<?php
	session_start();
	require_once('includes/dbh.inc.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gallery | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
	
    <link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
	<link rel="stylesheet" href="css/lightbox.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>

	

	<div id="sidebar">
		<h1>Navigation</h1>	
		<ul > 
			<li class="link">
				<a href="index.php">
					<i class="fa fa-home" aria-hidden="true"></i>
					<span>HOME</span>
				</a>
			</li>
			<li class="link">
				<a href="#collapse-post" data-toggle="collapse" aria-control="collapse-post">
					<i class="fa fa-book" aria-hidden="true"></i>
					<span >COURSES</span>
				</a>
				<ul class="collapse collapsable" id="collapse-post" style="margin:0px; padding:0px; ">
					<?php
						include_once 'includes/dbh.inc.php';

						$query = "Select distinct course_type from courses";
						$result= mysqli_query($conn, $query);
										
						if($result){
							while($row= mysqli_fetch_array($result)){
								echo '<li><a tabindex="-1" href="courses.php?crX='.$row['course_type'].'">'.strtoupper($row['course_type']).'</a></li>';
							}
						}									
					?>	
				</ul>
			</li>
			
			<li class="link">
				<a href="#collapse-post12" data-toggle="collapse" aria-control="collapse-post12">
					<i class="fa fa-graduation-cap" aria-hidden="true"></i>
					<span >ADMISSIONS</span>
				</a>
				<ul class="collapse collapsable" id="collapse-post12" style="margin:0px; padding:0px; ">
					<li>
						<a href="admissions.html">
							<span>ADMISSION PROCESS</span>
						</a>
					</li>
					<li>
						<a href="direct_adm.html">
							<span>DIRECT ADMISSION</span>
						</a>
					</li>
					<li>
						<a href="SET.html">
							<span>SCHOLARSHIP ENTRANCE TEST (SET)</span>
						</a>
					</li>
					<li>
						<a href="provisional.html">
							<span>PROVISIONAL ADMISSION</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="link">
				
				<a href="505.php">
					<i class="fa fa-home" aria-hidden="true"></i>
					<span>ONLINE EXAMS</span>
				</a>
				
			</li>
			
			<li class="link active">
				<a href="#">
					<i class="fa fa-picture-o" aria-hidden="true"></i>
					<span >GALLERY</span>
				</a>
			</li>
			<li class="link">
				<a href="#collapse-post2" data-toggle="collapse" aria-control="collapse-post2">
					<i class="fa fa-address-book-o" aria-hidden="true"></i>
					<span >CONTACTS</span>
				</a>
				<ul class="collapse collapsable" id="collapse-post2" style="margin:0px; padding:0px; ">
					<li>
						<a href="#">
							<span>CORPORATE OFFICE</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>KOLKATA</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>HOWRAH</span>
						</a>
					</li>
					<li>
						<a href="contacts.html">
							<span>BERHAMPORE</span>
						</a>
					</li>
					<li>
						<a href="contacts.html">
						<span>DURGAPUR</span>
						</a>
					</li>
					<li>
						<a href="contacts.html">
							<span>SILIGURI</span>
						</a>
					</li>
					<li>
						<a href="contacts.html">
							<span>SIKKIM</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<?php
					if(isset($_SESSION['student'])){
						$email = $_SESSION['student'];
						$query = "select * from students where stu_email='$email'";
						$result = mysqli_query($conn, $query);
						$row=mysqli_fetch_array($result);
						echo '<a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
							  <ul class="dropdown-menu pull-right" >
					
							  <li><a tabindex="-1" href="profile.php">PROFILE HOME</a></li>
								  <li><a tabindex="-1" href="profile.php">ACCOUNT SETINGS</a></li>
								  <li><form action="includes/logout.inc.php" method="POST"><button name="logout" tabindex="-1" class="logout" >LOGOUT</button></form></li>
							  </ul>	
						';
					}
					elseif(isset($_COOKIE['student'])){
						$email = $_COOKIE['student'];
						$query = "select * from students where stu_email='$email'";
						$result = mysqli_query($conn, $query);
						$row=mysqli_fetch_array($result);
						echo '<a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
							  <ul class="dropdown-menu pull-right" >
									
								  <li><a tabindex="-1" href="profile.php">PROFILE HOME</a></li>
								  <li><a tabindex="-1" href="profile.php">ACCOUNT SETINGS</a></li>
								  <li><form action="includes/logout.inc.php" method="POST"><button name="logout" tabindex="-1" class="logout" >LOGOUT</button></form></li>
							  </ul>	
						';
					}
					else{
						echo '<a href="login.php" class="smoothScroll">LOG IN</a>
								  
						';
					}
									
				
				?>
								
								
			</li>
		</ul>				

		<div id="sidebar-btn">
			<p >MENU</p>  
			<span></span>
			<span></span>
			<span></span>
			
		</div>
	
	</div>
	<div id="banner">
		
		<div class="clear-fix">
		    
			<span class="pull-right">Gallery</span>
		</div>
		<div class="jumbotron text-center">
			<p class="brand"><a href="index.php"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</a></p>
			<p class="about">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining <span style="color:#51d2e8;">essentially unchanged</span></p> 
			<div class="btn-group">
			    <button class="btn <?php if(!isset($_GET['RRnpo'])){ echo 'active'; }?>" onclick="location.href='gallery.php'">All</button>
			    <button class="btn <?php if($_GET['RRnpo'] == 'pssT'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=pssT'">Campus Tour</button>
			    <button class="btn <?php if($_GET['RRnpo'] == 'cm'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=cm'">Classroom</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'ty'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=ty'">Faculty</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'Ts'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=Ts'">Events</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'gRA'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=gRA'">Inauguration</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'Noi'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=Noi'">Celebrations</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'Tht'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=Tht'">Something</button>
				<button class="btn <?php if($_GET['RRnpo'] == 'RRR'){ echo 'active'; }?>" onclick="location.href='gallery.php?RRnpo=RRR'">Misc</button>
			</div>
		</div>
	</div>
	
	<div class="container wrapper">
		<div class="row row1">
		
			<?php
						
				if(!isset($_GET['RRnpo'])){
										
					$results_per_page = 12;
					$query = "select * from gallery order by gallery_folder";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql='select * from gallery order by gallery_folder LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<div class="text-center"><ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul></div>';
					}					
					
				}// END OF ALL
				elseif($_GET['RRnpo'] == 'pssT'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Campus'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Campus' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=pssT&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=pssT&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=pssT&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}							
									
				}//END OF CAMPUS
				
				elseif($_GET['RRnpo'] == 'cm'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Classroom'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Classroom' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=cm&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=cm&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=cm&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				} //END OF CLASSROOM
				
				elseif($_GET['RRnpo'] == 'ty'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Faculty'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Faculty' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=ty&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=ty&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=ty&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				} //END OF FACULTY
				
				elseif($_GET['RRnpo'] == 'Ts'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Events'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Events' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=Ts&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=Ts&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=Ts&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				} //END OF EVENTS
				
				elseif($_GET['RRnpo'] == 'gRA'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Inauguration'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Inauguration' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=gRA&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=gRA&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=gRA&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				}//END OF INAUGURATION
				
				elseif($_GET['RRnpo'] == 'Noi'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Celebrations'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Celebrations' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=Noi&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=Noi&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=Noi&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				}//END OF CELEBRATIONS
				
				elseif($_GET['RRnpo'] == 'Tht'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Something'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Something' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=Tht&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=Tht&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=Tht&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				}//END OF SOMETHING
				
				elseif($_GET['RRnpo'] == 'RRR'){
					$results_per_page = 12;
					$query = "select * from gallery where gallery_folder='Misc'";
					$result = mysqli_query($conn, $query);
					$number_of_results = mysqli_num_rows($result);
						
					$number_of_pages = ceil($number_of_results/$results_per_page);
						
					if (!isset($_GET['page'])) {
					  $page = 1;
					} else {
					  $page = $_GET['page'];
					}
					
					$this_page_first_result = ($page-1)*$results_per_page;
						
					$sql="select * from gallery where gallery_folder='Misc' LIMIT " . $this_page_first_result . "," .  $results_per_page;
					$result = mysqli_query($conn, $sql);
										
					while($row = mysqli_fetch_array($result) ){
						
						echo '
							<div class="col-md-3 col-sm-6 top-buffer">
								<div class="wrapper">
									<a href="'. $row['gallery_location'] .'" data-lightbox="All" data-title="'.$row['gallery_caption'].'">
									
										<div class="contain">
										    <img height="200" style="width:100%;" src=" '. $row['gallery_location'] .'" />
										    <div class="overlay">
											    <div class="text"><p>+</p>Click to Expand</div>
										    </div>
										</div>
									
										
									</a>
								</div>
							</div>	
						';						
					}	
					
					if($number_of_pages > 1){
						$prev=$page-1;
						$next=$page+1;
						echo '<ul class="pagination">';
						if($prev >=1){
							echo '
								<li><a href="gallery.php?RRnpo=RRR&page=' . $prev . '">&laquo;</a><li>
							';
						}

						
						
						for ($p=1;$p<=$number_of_pages;$p++) {
							$selected = $p == $page ? 'class="selected btn disabled"' : '';
							echo '
								<li><a '.$selected.' href="gallery.php?RRnpo=RRR&page=' . $p . '">' . $p . '</a><li>
							';
							
						}
						if($next <= $number_of_pages && $number_of_pages >= 2){
							echo '
								<li><a href="gallery.php?RRnpo=RRR&page=' . $next . '">&raquo;</a><li>
							';
						}
						echo '</ul>';
					}					
					
				} //END OF MISC
			?>
			
		</div>
	</div>
	
	<div class="container-fluid top-pad">
		<div class="row">
		
			<div class="col-md-12"  style="background:#51d2e8;">
			<div class="row">
				<div class="col-md-6 contact-form" id="contact">
				
					<h1>Contact Us</h1>
					<?php
					if(isset($_GET['qs']) && $_GET['qs'] == 1){
						echo '
							<p class="success">Thank You for reaching us. We will get in touch at the earliest.</p>
						';
					}					
					?>
					<form action="includes/contact.inc.php" method="POST">
						<div class="col-md-6">
							<div class="form-group">
								<input type="email" required class="form-control" id="email" name="email" placeholder="Email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" required class="form-control" id="phone" name="phone" maxlength="10" placeholder="Contact Number">
							</div>
						</div>	
						<div class="col-md-12">
							<div class="form-group">
								
								<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group ">
								<textarea class="form-control" id="msg" rows="3" placeholder="Message" name="message"  required></textarea>
								<button type="submit" id="submit" name="submit" class="btn btn-default submit">Send Query</button>
							</div>
						</div>
					</form>

				
				</div>
				
				<div class="col-sm-6 side">
					<h1>Our Mission</h1>
					<p>The mission of the Institute of Applied Science is to help prepare outstanding educators, scholars, and researchers, and to advance the profession of education, as broadly defined, through research on the science and art of teaching and learning, the application of clinical processes, the effective uses of technology, and the analysis and development of leadership and educational policy.</p>
					<a href="registration.php">Join us Now!</a>
					<a href="admission.php">Browse Admission Process</a><br><br>
				</div>
			</div>
		</div>
		</div>
	</div>
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						Copyright &copy; Institute of Applied Science 2017 | Something: About something
					</div>
				</div>
				
			</div>
		</div>
	</footer>
	
	
    <script src="js/jquery-3.2.1.min.js"></script>   
    <script src="js/bootstrap.js"></script>
	<script src="js/lightbox.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#sidebar-btn').click(function(){
				$('#sidebar').toggleClass('visible');
			});
		});
	</script>

</body>

</html>