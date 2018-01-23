<?php
	
	session_start();
	require_once('includes/dbh.inc.php');	
	
	
	
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
	<link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/lightslider.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="images/logo.jpg" />
	

<body>

	<?php
		include('header.php');
	?>
	
	<div class="container-fluid for-sm">
		<div class="row cover">
			
			<p class="heading" data-aos="fade-up" data-aos-duration="700" data-aos-anchor-placement="center-center" data-aos-delay="100" data-aos-once="true">Where True Learning Begins...</p>
			<p class="text" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200" data-aos-once="true" >Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi. Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.</p>
			<div class="clearfix">
				<h6 class="pull-right" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300" data-aos-once="true">Enroll Now</h6>
			</div>
			<p class="scroll"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></p><br>
			<p class="sc">SCROLL</p>
		</div>
	</div>
	
	
	<div class="container-fluid carouseller">
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
								$query ="Select * from notices where notices_status=1 order by STR_TO_DATE(notices_date, '%M %d, %Y') DESC";
								$result =@mysqli_query($conn,$query);		
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
					<div class="content-wlcm" >
						<span class="fa fa-thumbs-o-up" data-aos="fade-up" data-aos-delay="100" data-aos-once="true"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-trophy" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				<div class="col-md-3" >
					<div class="content-wlcm" >
						<span class="fa fa-hand-peace-o" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-snowflake-o" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					</div>
				</div>
			
			</div>
		
		</div>
	
	</div>
	<!--NEW SECTION ENDS-->
	
	
	<!--Enroll container -->

	<div class="container">
		<div class="row enroll" >
			<div class="col-sm-4 slogan" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-once="true">
				EDUCATION FOR A BETTER FUTURE!
			</div>
			<div class="col-sm-5 mission" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-once="true">
				The mission of the Institute of Applied Science is to help prepare outstanding educators, scholars, and researchers, through research on the science and art of teaching and learning, the application of clinical processes, the effective uses of technology, and the analysis and development of leadership and educational policy.
			</div>
			<div class="col-sm-3">
				<a class="enroll-btn btn" href="registration.php" data-aos="zoom-in-up" data-aos-duration="1000"  data-aos-once="true">ENROLL NOW</a>
			</div>
		</div>

	</div>  <!--Enroll container -->
	
	
	<div class="container-fluid" id="gallery">
		<div class="row" >

			<div class="col-md-6 lefty">
				<h1>Have a look at our Gallery</h1>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br><a href="gallery.php">Browse All!</a>
</p>
				<img data-aos="fade-up-left" data-aos-duration="1000" data-aos-once="true" data-aos-delay="300" src="images/3.jpg"></img>
			</div>
			<div class="col-md-6 righty">
				<img src="images/1.jpg" class="first" data-aos="fade-up-right" data-aos-once="true" data-aos-duration="1000" data-aos-delay="300" ></img>
				<img src="images/demo.jpg" class="second" data-aos="fade-up-right" data-aos-once="true" data-aos-duration="1000" data-aos-delay="300" ></img>

			</div>
				
		</div>
	</div>

	<!--GALLERY SECTION ENDS-->

	<div class="container-fluid review-wrap">
		<h2>Hear From Our Students</h2>
		<div class="container" >
			<div class="row review">
				
				<ul id="light-slider">
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Cupidatat quis pariatur anim.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li>
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li>
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Excepteur amet adipisicing fugiat velit nisi. Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li >
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li>
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li>
					<li class="review-content">
						
						<p><img src="images/profile.jpg"></img><span>"</span>Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.<span>"</span></p>
						<br><label class="name">Chris P. Bacon</label><br>
						<label class="details">ISC, Delhi Public School</label>
					</li>
				</ul>

				
			</div>
		</div>
	
	</div>
	
	
	
	<div class="container-fluid top-pad">
		
		<div class="row">
		
		<div class="col-md-12 contact-form">
			<h2>Contact Us</h2>
			<p class="text">Have doubts in mind? How about sharing then with us? We would be happy to hear from you.</p>
			
			<div class="row">
				<div class="col-md-6" id="contact">
				
					
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
								<p id="error_email"></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" required class="form-control" id="phone" name="phone" maxlength="10" placeholder="Contact Number">
								<p id="error_contact"></p>
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
								<button type="submit" id="submit" name="qsubmit" class="btn btn-default submit">Send Query</button>
							</div>
						</div>
					</form>

				
				</div>
				
				<div class="col-sm-6 side hidden-xs">
				
					<table>
						<tr>
							<td><p><span class="fa fa-phone"></span>Call us : </p></td>
							<td class="ans"><p >(033) 2657-3758</p></td>
						</tr>
						<tr>
							<td><p><span class="fa fa-envelope-o"></span>Email : </p></td>
							<td class="ans"><p >support@ias.com</p></td>
						</tr>
						<tr>
							<td style="vertical-align:top;"><p><span class="fa fa-address-book-o"></span>Address : </p></td>
							<td class="ans"><p >INSTITUTE OF APPLIED SCIENCE<br>
					67B, Maharaja Thakur Road,<br>Dhakuria, Kolkata-700031</p></td>
						</tr>
					
					</table>
					
				</div>
			</div>
		</div>
		</div>
	</div>
	
	
	
	

	<!--<div class="container-fluid contact-form" id="contact" data-stellar-background-ratio="0.4">
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
	</div>-->
	

	
	<?php
	
		include('footer.php');
		
	?>
	

    <script src="js/jquery-3.2.1.min.js"></script> 
    <script src="js/bootstrap.js"></script>
	<script src="js/aos.js"></script>
	
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
    <script src="vendor/js/lightslider.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#light-slider").lightSlider({
				item: 4,
				auto: true,
				pauseOnHover: false,
				loop: true,
				keyPress: false,
				controls: true,
				prevHtml: '',
				nextHtml: '',
				adaptiveHeight:false
			});
		});
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
	
	<!--<script>
		alert(window.location.href);
	</script>-->
    
</body>

</html>