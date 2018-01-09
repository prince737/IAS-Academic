<?php
	
	session_start();
	require_once('includes/dbh.inc.php');	
	
	$query ="Select * from notices where notices_status=1 order by STR_TO_DATE(notices_date, '%M %d, %Y') DESC";
	$result =@mysqli_query($conn,$query);	
	
	$query ="Select * from events where events_status=1";
	$result1 =@mysqli_query($conn,$query);	

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="images/logo.jpg" />
	

<body>

	<nav class="navbar navbar-inverse my-navbar">
	

		<div class="container-fluid my-content">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="flase">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand brand-sm" href="index.html" style="color:white;"><img src="images/logo.jpg"/>Institute of Applied Science</a>
			</div>
			
			
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="row">
					<div class="col-lg-5 brand-div">
						
						<img src="images/logo.jpg" class="logo"/>
						<table>
							<tr>	
								<td valign="center" style="line-height:30px;">
									<p class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</p>
									<p class="tag">Where true learning begins...</p>
								
								</td>
							</tr>
							
						</table>
					
					</div>
					
					<div class="col-lg-7 menu">
						<ul class="nav navbar-nav" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="#" class="actv">HOME</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">COURSES<span class="caret"></span></a>
								<ul class="dropdown-menu" >
								
									<li><a tabindex="-1" href="courses.php?ee=1">10+2 ENTRANCE EXAMS</a></li>
									<li><a tabindex="-1" href="courses.php?be">BOARD EXAMS</a></li>
									<li><a tabindex="-1" href="courses.php?bec">BOARD & ENTRANCE COMBINED</a></li>
									<li><a tabindex="-1" href="courses.php?gpi">GATE / PSU / IES</a></li>
									<li><a tabindex="-1" href="courses.php?ce">COMPETITIVE EXAMS</a></li>
									<li><a tabindex="-1" href="courses.php?tpw">TRAINING AND PROJECT WORKS</a></li>
									<li><a tabindex="-1" href="courses.php?its">IAS TEST SERIES</a></li>

								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMISSIONS<span class="caret"></span></a>
								<ul class="dropdown-menu" >
									
									<li><a tabindex="-1" href="admissions.html">ADMISSION PROCESS</a></li>
									<li><a tabindex="-1" href="direct_adm.html">DIRECT ADMISSION</a></li>
									<li><a tabindex="-1" href="SET.html">SCHOLARSHIP ENTRANCE TEST (SET)</a></li>
									<li><a tabindex="-1" href="provisional.html">PROVISIONAL ADMISSION</a></li>

								</ul>

							</li>
						
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">ONLINE EXAMS<span class="caret"></span></a>
								<ul class="dropdown-menu" >
									
									<li><a tabindex="-1" href="login.php">LOGIN</a></li>
									<li><a tabindex="-1" href="registration.php">ENROLL NOW</a></li>
									<li><a tabindex="-1" href="#">AVAILABLE EXAMS</a></li>

								</ul>
							</li>
							<li>
								<a href="gallery.php" class="smoothScroll">GALLERY</a>
								
							</li>
							<li class="dropdown">
								<a href="contact.html" class="dropdown-toggle" data-toggle="dropdown">CONTACT<span class="caret"></span></a>
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
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</nav>


	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 slide-show">
				
				<div id="my-slider" class="carousel slide" data-ride="carousel">


					<ol class="carousel-indicators">

						<li data-target="#my-slider" data-slide-to="0" class="active"></li>
						<li data-target="#my-slider" data-slide-to="1"></li>
						<li data-target="#my-slider" data-slide-to="2"></li>
						<li data-target="#my-slider" data-slide-to="3"></li>
						<li data-target="#my-slider" data-slide-to="4"></li>
					
					</ol>

					<div class="carousel-inner" role="listbox">
                        <div class="item active">
                             <img src="images/alexis-brown-85793.jpg" />
                             <div class="carousel-caption">
                                  <h1>Image 1</h1>
                             </div >
                        </div>
                        <div class="item">
                             <img src="images/davide-cantelli-153517.jpg" />
                             <div class="carousel-caption">
                                  <h1>Image 2</h1>
                             </div >
                        </div>
                        <div class="item">
                             <img src="images/roman-mager-59976.jpg" />
                             <div class="carousel-caption">
                                  <h1>Image 3</h1>
                             </div >
                        </div>
                        <div class="item">
                             <img src="images/sergey-zolkin-21234.jpg" />
                             <div class="carousel-caption">
                                  <h1>Image 4</h1>
                             </div >
                        </div>
                        <div class="item">
                             <img src="images/tamara-menzi-1185481.jpg" />
                             <div class="carousel-caption">
                                  <h1>Image 5</h1>
                             </div >
                        </div>

					</div>

					<a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">
						<span  class="glyphicon glyphicon-chevron-left"aria-hidden="true"></span>
					</a>
					<a class="right carousel-control" href="#my-slider" role="button" data-slide="next">
						<span  class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</a>


				</div>

			</div>
		</div>
	</div>  <!--END OF  CAROUSEL -->

	<div class="container-fluid" >
		
		<div class="row notice-wrapper">
			
			<div class="col-md-6 notice-container">
				<h4 class="label-primary"><span class="fa fa-arrow-right"></span>NOTICEBOARD</h4>
				<div class="notice-board">
					<div class="marquee">
							
							<?php
								if($result)
								{
										
									while($row = mysqli_fetch_array($result))
									{
										$phpdate = strtotime($row['notices_date']);
										$date = date( 'd M, Y', $phpdate );
										echo'
											<div class=notice_data>
												<span class="fa fa-file-text-o"></span>	
												<a href="'.$row['notices_location'].'" target="_blank"><span>'.$date.'</span> | ' . $row['notices_content']. '</a>
											
											</div>	<br>
										';
									}
								}
							?>
							
						</div>	
						
				</div>
				<a class="link btn btn-primary" href="notices.php">View All Notices</a>
				
				
			</div>
			<div class="col-md-6 notice-container">				
				<h4 class="label-primary"><span class="fa fa-arrow-right"></span> EVENTS & ANNOUNCEMENTS</h4>			
				<div class="notice-board">
					<div class="marquee">
												
							<?php
								if($result1)
								{
										
									while($row = mysqli_fetch_array($result1))
									{
										$phpdate = strtotime($row['events_startdate']);
										$date1 = date( 'd M, Y', $phpdate );
										$phpdate = strtotime($row['events_enddate']);
										$date2 = date( 'd M, Y', $phpdate );
										echo'
										
											<div class=notice_data>
												<i class="fa fa-calendar" style="color:#795548;" aria-hidden="true"></i>
												<a href="events.php"><span>'.$date1.'</span> | <span>'.$row['events_time'].' onwards | </span>' . $row['events_heading']. '</a>
											
											</div>	<br>
											
										';
									}
								}
							?>
						
					</div>	
				</div>
				<a class="link btn btn-primary" href="events.php">View All Events</a>
				
			</div>
		</div>
	</div>	
		

	<!--NEW SECTION-->

	<div class="container-fluid welcome" >
		<h3>WELCOME TO INSTITUTE OF APPLIED SCIENCE</h3>
							
		<div class="container">
		
			<div class="row">
			
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-thumbs-o-up"></span>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-trophy"></span>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-hand-peace-o"></span>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-snowflake-o"></span>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	
	<div class="container-fluid" id="gallery">
		<div class="row" >

			<div class="col-md-6 lefty">
				<h1>Have a look at our Gallery</h1>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br><a href="gallery.php">Browse All!</a>
</p>
				<img data-aos="fade-up-left" data-aos-duration="1000" data-aos-delay="300" src="images/3.jpg"></img>
			</div>
			<div class="col-md-6 righty">
				<img src="images/1.jpg" class="first" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="300" ></img>
				<img src="images/demo.jpg" class="second" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="300" ></img>

			</div>
				
		</div>
	</div>

	<!--NEW SECTION ENDS-->

	<!--GALLERY container  -->

	
	
	
	<!--<div class="container-fluid gallery" id="gallery">
		<p class="courses">Gallery</p><br>


		<div class="img-gallery">
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Koala.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Lighthouse.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Penguins.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Tulips.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Chrysanthemum.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Hydrangeas.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Jellyfish.jpg" />
    			</figure>
  			</a>
  			<a href="#" data-target="#carouselModal" data-toggle="modal">
    			<figure>
      				<img src="images/Desert.jpg" />
    			</figure>
  			</a>
  
		</div>

		<a href="gallery.html" class="go-to-gallery">View All</a>
	
	</div>


	<!--IMAGE CAROUSEL MODAL BEGINS HERE -->

	<div class="modal fade" id="carouselModal"  >
		<div class="modal-dialog img-modal">
            <div class="modal-content " >
               
                <div class="modal-body">
                  
					<div id="img-slider" class="carousel slide" data-ride="carousel">


						<ol class="carousel-indicators">

							<li data-target="#img-slider" data-slide-to="0" class="active"></li>
							<li data-target="#img-slider" data-slide-to="1"></li>
							<li data-target="#img-slider" data-slide-to="2"></li>
							<li data-target="#img-slider" data-slide-to="3"></li>
							<li data-target="#img-slider" data-slide-to="4"></li>
							<li data-target="#img-slider" data-slide-to="5"></li>
							<li data-target="#img-slider" data-slide-to="6"></li>
							<li data-target="#img-slider" data-slide-to="7"></li>
					
						</ol>

						<div class="carousel-inner" role="listbox">
                        	<div class="item active">
                             	<img src="images/Desert.jpg" />
                             	
                        	</div>
                       	    <div class="item">
                             	<img src="images/Jellyfish.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Hydrangeas.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Chrysanthemum.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Tulips.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Penguins.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Lighthouse.jpg" alt="">
                             	
                        	</div>
                        	<div class="item">
                             	<img src="images/Koala.jpg.jpg" alt="">
                             	
                        	</div>

						</div>

						<a class="left carousel-control" href="#img-slider" role="button" data-slide="prev">
						<span  class="glyphicon glyphicon-chevron-left"aria-hidden="true"></span>
						</a>
						<a class="right carousel-control" href="#img-slider" role="button" data-slide="next">
						<span  class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						</a>


					</div>  <!-- IMAGE CAROUSEL ENDS HERE  -->

                </div>  <!-- MODAL BODY ENDS HERE  -->
                    
            </div>
        </div>
    </div>

	
	<!--Enroll container -->

	<div class="container">
		<div class="row enroll" >
			<div class="col-sm-4 slogan" data-aos="fade-right" data-aos-once="true">
				EDUCATION FOR A BETTER FUTURE!
			</div>
			<div class="col-sm-5 mission">
				The mission of the Institute of Applied Science is to help prepare outstanding educators, scholars, and researchers, through research on the science and art of teaching and learning, the application of clinical processes, the effective uses of technology, and the analysis and development of leadership and educational policy.
			</div>
			<div class="col-sm-3">
				<button class="enroll-btn" data-target="#updateModal" data-toggle="modal" data-aos="fade-left" data-aos-once="true">ENROLL NOW</button>
			</div>
		</div>

	</div>  <!--Enroll container -->

	<!--Enroll Modal -->
	
	<div class="modal hide fade" id="updateModal"  >
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                        
                     <p class="modal-title">XD</p>
                        
                     <button class="closed" style="float:right;" data-dismiss="modal">X</button><br><br>
                     <iframe src="https://giphy.com/embed/3oriO2H4VbrgNdPg8U" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/blunttalk-season-2-starz-3oriO2H4VbrgNdPg8U">via GIPHY</a>
                </div>
				<div class="modal-body">
                        
				</div>  <!-- MODAL BODY ENDS HERE  -->
                    
            </div>
        </div>
    </div>


	<div class="container-fluid contact-form" id="contact" data-stellar-background-ratio="0.4">
		<div class="row">
			<div class="col-sm-5 contactus" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
				<p class="send-query">Send Your Queries</p>
				<p class="bottomliner">We would be happy to hear from you</p>
				<?php
					if(isset($_GET['qs']) && $_GET['qs'] == 1){
						echo '
							<p class="success">Thank You for reaching us. We will get in touch at the earliest.</p>
						';
					}					
				?>
				<form action="includes/contact.inc.php" method="POST">
  					<div class="form-group ">
    					
    					<input type="email" required class="form-control" id="email" name="email" placeholder="Email" id="email">
						<p id="error_email"></p>
  					</div>
					<div class="form-group">
						<input type="text" required class="form-control" id="phone" name="phone" maxlength="10" placeholder="Contact Number">
						<p id="error_contact"></p>
					</div>
  					<div class="form-group">
    					
    					<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
  					</div>

  					<div class="form-group ">
   					    <textarea class="form-control" id="msg" rows="3" placeholder="Message" name="message"  required></textarea>
  					</div>

  					<button type="submit" id="submit" name="qsubmit" class="btn btn-default">Send Query</button>
				</form>
			</div>
		</div>
	</div>
	
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h4 style="border-bottom:1px solid white; padding-bottom: 5px;">Copyright &copy; 2016 IAS</h4>
					<h4>Follow Us:</h4>
					<span class="fa fa-google-plus-square" style="font-size:25px;" aria-hidden="true"></span>
					<span class="fa fa-facebook-official" style="font-size:25px;"aria-hidden="true"></span>
					<span class="fa fa-youtube" aria-hidden="true"  style="font-size:25px;"></span>
					<span class="fa fa-twitter-square" style="font-size:25px;" aria-hidden="true"></span>
				</div>
				<div class="col-sm-4">
					<h4 style="border-bottom:1px solid white; padding-bottom: 5px;">About us</h4>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				</div>
				<div class="col-sm-2">
					<h4 style="border-bottom:1px solid white; padding-bottom: 5px;">Quick Links</h4>
					<ul>
						<li><a href="#">Career</a></li>
						<li><a href="#">Academics</a></li>
						<li><a href="#">Announcements</a></li>
						<li><a href="#">Admission</a></li>
						<li><a href="#">For Students</a></li>
						<li><a href="#">Route Map</a></li>
						<li><a href="#">FAQs</a></li>
					</ul>
				</div>
				<div class="col-sm-3">
					<h4 style="border-bottom:1px solid white; padding-bottom: 5px;">Contact Us</h4>
						<p>INSTITUTE OF APPLIED SCIENCE <br>
							67B, Maharaja Thakur Road,<br>
							Dhakuria, Kolkata-700031<br>
							Contact Number: (+91) 900-240-2787
						</p>
				</div>
			</div>
		</div>
	</footer>
	

    <script src="js/jquery-3.2.1.min.js"></script> 
    <script src="js/bootstrap.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/smoothscroll.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	<script src="js/jquery.marquee.js" type="text/javascript"></script>
	<script>
		$('.marquee').marquee({
			duration: 10000,
			gap:320,
			delayBeforeStart: 0,
			direction: 'up',
			duplicated: true,
			pauseOnHover: true
		});
	</script>
    <script src="js/jquery.stellar.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).stellar({
        scrollProperty: 'scroll',
        horizontalScrolling: false,
        positionProperty: 'position'
       });
    </script>  
	
	<script>
    AOS.init();
  </script>
    
    <script> 



    	$('#submit').on('click',function() {
    		 if ($('#email').val()=="") {
    			$('#email').addClass('animated shake');
    			$('#email').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    					$('#email').removeClass('animated shake');

    		        });
    		}

    		if ($('#name').val()=="") {
    			$('#name').addClass('animated shake');
    			$('#name').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    					$('#name').removeClass('animated shake');

    		        });
    		}

    		if ($('#msg').val()=="") {
    			$('#msg').addClass('animated shake');
    			$('#msg').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
    					$('#msg').removeClass('animated shake');

    		        });
    		}
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
	<script>
		$('#email').on('blur', function(){
		if(!this.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
		{
			$('#error_email').html('Please provide a valid email address.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			 $('#email').css('border', '2px solid #D32F2F');
			return false;
		} 
        $('#error_email').html('');  
		$('#email').css('border', 'none');			
        
	});	
	
	$('#phone').on('blur', function(){
		if(!this.value.match(/^[0-9]{10}$/))
		{
			$('#error_contact').html('Please provide a valid Contact Number.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			 $('#phone').css('border', '2px solid #D32F2F');
			return false;
		} 
        $('#error_contact').html('');  
		$('#contact').css('border', 'none');		
        
	});	
	
	</script>
    
</body>

</html>