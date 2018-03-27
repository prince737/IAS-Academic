<nav class="navbar navbar-inverse my-navbar">
	

		<div class="container-fluid my-content">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="flase">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand brand-sm" href="index.html" style="color:white;"><img class="hidden-xs" src="images/logo.jpg"/><p><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</p></a>
			</div>
			
			
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="row">
					<div class="col-lg-5 brand-div">
						
						<a href="index.php" ><img src="images/logo.jpg" class="logo "/></a>
						<table>
							<tr>	
								<td valign="center" style="line-height:30px;">
									<p class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</p>
									<p class="tag">Where true learning begins ...</p>
								
								</td>
							</tr>
							
						</table>
					
					</div>
					
					<div class="col-lg-7 menu">
						<ul class="nav navbar-nav" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="index.php" id="home">HOME</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="courses">COURSES<span class="caret"></span></a>
								<ul class="dropdown-menu" >
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
							<li>
								<a href="admissions.php" class="smoothScroll" id="admn">ADMISSIONS</a>
								
							</li>
							
							<li>
								<a href="login.php" class="smoothScroll" id="exam">ONLINE EXAMS</a>
								
							</li>
							
							
							<li>
								<a href="505.php" class="smoothScroll">GALLERY</a>
								
							</li>
							<li class="dropdown">
								<a href="contact.html" class="dropdown-toggle" data-toggle="dropdown" id="contact">CONTACT<span class="caret"></span></a>
								<ul class="dropdown-menu pull-left" >
									
									<li><a tabindex="-1" href="contact.php">CORPORATE OFFICE</a></li>
									<li><a tabindex="-1" href="contact.php">KOLKATA</a></li>
									<li><a tabindex="-1" href="contact.php">HOWRAH</a></li>
									<li><a tabindex="-1" href="contact.php">BERHAMPORE</a></li>
									<li><a tabindex="-1" href="contact.php">DURGAPUR</a></li>
									<li><a tabindex="-1" href="contact.php">SILIGURI</a></li>
									<li><a tabindex="-1" href="contact.php">SIKKIM</a></li>

								</ul>
							</li>
							<span class="clearfix hidden-lg hidden-md hidden-sm"></span>
							
								<?php
									if(isset($_SESSION['student'])){
										$email = $_SESSION['student'];
										$query = "select * from students where stu_email='$email'";
										$result = mysqli_query($conn, $query);
										$row=mysqli_fetch_array($result);
										echo '
										    <li class="dropdown">
											  <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
											  <ul class="dropdown-menu pull-right" >
									
												  <li><a tabindex="-1" href="profile.php">PROFILE HOME</a></li>
												  <li><a tabindex="-1" href="profile.php">ACCOUNT SETTINGS</a></li>
												  <li><form action="includes/logout.inc.php" method="POST"><button name="logout" tabindex="-1" class="logout" >LOGOUT</button></form></li>
											  </ul>	
											</li>  
										';
									}
									elseif(isset($_COOKIE['student'])){
										$email = $_COOKIE['student'];
										$query = "select * from students where stu_email='$email'";
										$result = mysqli_query($conn, $query);
										$row=mysqli_fetch_array($result);
										echo '
										    <li class="dropdown">
										       <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
											  <ul class="dropdown-menu pull-right" >
									
												  <li><a tabindex="-1" href="profile.php">PROFILE HOME</a></li>
												  <li><a tabindex="-1" href="profile.php">ACCOUNT SETTINGS</a></li>
												  <li><form action="includes/logout.inc.php" method="POST"><button name="logout" tabindex="-1" class="logout" >LOGOUT</button></form></li>
											  </ul>	
											</li>  
										';
									}
									else{
										echo '
										   <li>
											<a href="login.php" class="smoothScroll">LOG IN</a>
										   </li>	
										';
									}
									
									
								?>
								
								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</nav>
	
	
	
	