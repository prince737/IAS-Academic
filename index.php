<?php
	
	session_start();
	require_once('includes/dbh.inc.php');	
	
	
	
		

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/lightslider.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="images/logo.jpg" />
	

<body>

	<?php
		include('header.php');
	?>
	
	<!--<div class="container-fluid for-sm">
		<div class="row cover">
			
			<p class="heading" data-aos="fade-up" data-aos-duration="700" data-aos-anchor-placement="center-center" data-aos-delay="100" data-aos-once="true">Where True Learning Begins...</p>
			<p class="text" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200" data-aos-once="true" >Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi. Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.Lorem ipsum Excepteur amet adipisicing fugiat velit nisi.</p>
			<div class="clearfix">
				<h6 class="pull-right" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300" data-aos-once="true">Enroll Now</h6>
			</div>
			<p class="scroll"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></p><br>
			<p class="sc">SCROLL</p>
		</div>
	</div>-->
	
	
	<div class="container-fluid carouseller hidden-xs">
		<div class="row">
			<div class="col-sm-12 slide-show">
				
				<div id="my-slider" class="carousel slide" data-ride="carousel">


					<ol class="carousel-indicators">

						<li data-target="#my-slider" data-slide-to="0" class="active"></li>
						<li data-target="#my-slider" data-slide-to="1"></li>
						<li data-target="#my-slider" data-slide-to="2"></li>
						<li data-target="#my-slider" data-slide-to="3"></li>
					
					</ol>

					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<a href="" title="Click to Know More!">
								<img src="images/SET218002.png" />   						 
							</a> 
						</div>
                        <div class="item">
							<a href="courses.php?crX=IAS Test Series" title="Click to Know More!">
								<img src="images/Home2.png" />									 
							</a>
                        </div>                       
                        <div class="item">
							<a href="courses.php?crX=GATE / PSU / IES" title="Click to Know More!">
								 <img src="images/Home30.png" />								 
							 </a>
                        </div>
						<div class="item">
							<a href="courses.php?crX=Training & Project Work" title="Click to Know More!">
								 <img src="images/ard.png" />								 
							</a> 
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
	
	
	
	<div class="container-fluid hidden-md hidden-lg">
		<div class="row">
			<div class="col-sm-12 slide-show">
				
				<div id="my-slider1" class="carousel slide" data-ride="carousel">


					<ol class="carousel-indicators">

						<li data-target="#my-slider1" data-slide-to="0" class="active"></li>
						<li data-target="#my-slider1" data-slide-to="1"></li>
						<li data-target="#my-slider1" data-slide-to="2"></li>
					
					</ol>

					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<a href="#" title="Click to Know More!">
								 <img src="images/mob1.png" />								 
							</a> 
						</div>
                        <div class="item">
							<a href="courses.php?crX=IAS Test Series" title="Click to Know More!">
                             <img src="images/mob2.png" />                            
							 </a>
                        </div>                       
                        <div class="item">
							<a href="courses.php?crX=GATE / PSU / IES" title="Click to Know More!">
								 <img src="images/mob3.png" />								 
							 </a>
                        </div>					
						

					</div>

					<a class="left carousel-control" href="#my-slider1" role="button" data-slide="prev">
						<span  class="glyphicon glyphicon-chevron-left"aria-hidden="true"></span>
					</a>
					<a class="right carousel-control" href="#my-slider1" role="button" data-slide="next">
						<span  class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</a>


				</div>

			</div>
		</div>
	</div>  <!--END OF  CAROUSEL -->
	
	

	<div class="container-fluid" >
		
		<div class="row notice-wrapper">
			
			<div class="col-md-6 notice-container">
				<h4 class="label-primary text-center">NOTICEBOARD</h4>
				<div class="notice-board">
					<?php
						$query ="Select * from notices where notices_status=1";
						$result =@mysqli_query($conn,$query);
						$count=mysqli_num_rows($result);
						if($count < 1){
								echo '<span style="display:block; width:100%; text-align:center; font-size:18px;">Noticeboard shall be updated soon.</span>';
						}
						else{
							echo'<div class="marquee">';
							
							
								$i=0;								
								while($row = mysqli_fetch_array($result))
								{
									$phpdate = strtotime($row['notices_date']);
									$date = date( 'd M, Y', $phpdate );
									echo'
										<div class=notice_data>';
										if($i<4){
											echo '<img src="images/new.jpg" height="20" width="20"></img>&nbsp;';
										}
											
											echo '<span class="fa fa-file-text-o"></span>	
											<a href="'.$row['notices_location'].'" target="_blank"><span>'.$date.'</span> | ' . $row['notices_content']. '</a>
									
										</div>	<br>
									';
									$i++;
								}
							
							
							echo '</div>';	
						}
						?>
						
				</div>
				<a class="link btn btn-primary" href="notices.php">View All Notices</a>
				
				
			</div>
			<div class="col-md-6 notice-container">				
				<h4 class="label-primary text-center"> EVENTS & ANNOUNCEMENTS</h4>			
				<div class="notice-board">
					
												
							<?php
								$query ="Select * from events where events_status=1";
								$result1 =@mysqli_query($conn,$query);
								$count=mysqli_num_rows($result1);
								if($count < 1){
										echo '<span style="display:block; width:100%; text-align:center; font-size:18px;">Events shall be updated soon.</span>';
								}
								
								else
								{						
									echo '<div class="marquee">';	
									while($row = mysqli_fetch_array($result1))
									{
										$phpdate = strtotime($row['events_startdate']);
										$date1 = date( 'd M, Y', $phpdate );
										$phpdate = strtotime($row['events_enddate']);
										$date2 = date( 'd M, Y', $phpdate );
										$i=0;
										
											
											if( strtotime('now') < strtotime($date2) ) {
												echo '<div class="notice_data">';
												if($i<4){
													echo '<img src="images/new.jpg" height="20" width="20"></img>&nbsp;';
												}
												echo '<i class="fa fa-calendar" style="color:#795548;" aria-hidden="true"></i>
													<a href="events.php"><span>Starts: '.$date1.'  Ends: '.$date2.'</span> | <span>From '.$row['events_starttime'].' to '.$row['events_endtime'].' | </span>' . $row['events_heading']. '</a>';
												echo '</div>	<br>';	
											}
										
										$i++;
									}
									echo '</div>';
								}
							?>
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
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200" style="text-align:justify;">Institute of Applied Science, established and directed by the alumni of Jadavpur University and different IITs in India along with other reputed Institutions, is a noble organization in the field of education and has been serving the students since 2000.  </p>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-graduation-cap" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200" style="text-align:justify;">Our admission process
						is simple and we also
						offer Scholarships to
						deserving &amp; needy
						students through a knowledge based screening process, IAS Scholarship Entrance Test (SET). </p>
					</div>
				</div>
				<div class="col-md-3" >
					<div class="content-wlcm" >
						<span class="fa fa-trophy" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200" style="text-align:justify;">IAS offers Scholarship Entrance
						Test (SET) to the students who
						are willing to admit in the
						specific course in which the
						minimum qualifying marks in
						the Board Exams is not fulfilled.</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content-wlcm">
						<span class="fa fa-snowflake-o" data-aos="fade-up" data-aos-once="true" data-aos-delay="100"></span>
						<p data-aos="fade-up" data-aos-once="true" data-aos-delay="200" style="text-align:justify;">We are aimed to become an
						international Institute through
						our success and analysis and
						development of leadership
						and educational policy.</p>
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
	
	
	<!--<div class="container-fluid" id="gallery">
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
	</div>-->

	<!--GALLERY SECTION ENDS-->

	<!--<div class="container-fluid review-wrap">
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
	
	</div>-->
	
	
	
	<div class="container-fluid top-pad">
		
		<div class="row" >
		
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
							<td class="ans"><p >+91 700-329-8045</p></td>
						</tr>
						<tr>
							<td><p><span class="fa fa-envelope-o"></span>Email : </p></td>
							<td class="ans"><p >mail@iasacademic.in</p></td>
						</tr>
						<tr>
							<td style="vertical-align:top;"><p><span class="fa fa-address-book-o"></span>Address : </p></td>
							<td class="ans"><p>INSTITUTE OF APPLIED SCIENCE<br>
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
	
	<!-- SET MODAL -->
	
	<!--<div id="set" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" >				
				<div class="modal-body">
				    <button type="button" class="close" data-dismiss="modal">&times;</button>
					<p class="title"><span>IAS</span> TALENT SEARCH 2018</p>
					<p class="know">through </p>
					<p class="test">Scholarship Entrance Test</p>
					<small class="small">(Tentative Date: 3rd Week of April)</small>
					<img src="images/set.png"></img>
					<p class="know-hl">Medal and Certificates for best Performers </p>
					<p class="know">And get upto 100% scholarship for tution fees of courses at IAS</p>
					<a href="set_enroll.php" class="set_enroll btn" id="enroll">Enroll Now</a>
				</div> 
				<div class="modal-footer">
					<a href="#"><i class="fa fa-arrow-left"></i>LEARN MORE</a>
				</div>			
			</div>
		</div>
	</div>-->
	
	<?php
	
		include('footer.php');
		
	?>
	

    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script> 	
    <script src="js/bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(window).on('load', function () {
			$('#set').modal('show');
		});
	</script>	
	
	<script src="js/aos.js"></script>	
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
			 $('#phone').css('border', '2px solid #D32F2F');
			return false;
		} 
        $('#error_contact').html('');  
		$('#contact').css('border', 'none');		
        
	});	
	
	</script>
	
	<script>
		$('#home').addClass('actv');
	</script>
	
	
	
    
</body>

</html>