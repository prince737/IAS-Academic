<?php
	session_start();
	require_once('includes/dbh.inc.php');
	
	if(isset($_GET['qs']) && ($_GET['qs'] == 1))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Thank You! <span class="fa fa-smile-o"></span> </h3>
					<hr>	
					<p class="para">Your query was received and We will get back to you at the earliest.</p> 
					<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
				</div>
			</div>
		';			
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contacts | IAS</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/contact.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/aos.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" type="image/jpg"href="images/logo.jpg" />
</head>

<body>
	
	<?php
		include('header.php');
	?>
	
	<div class="container-fluid contact-banner">
		<h2>CONTACT US</h2>
		<p>Just focus on your goal, we will help you to achieve it.</p>
	</div>
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Contacts</li>
	</ol>
	
	<div class="container">
	
		<div class="row">
		
			<div class="col-sm-6">
			
				<div class="col-sm-12 offices">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="https://www.google.co.in/maps/place/67,+Maharaja+Tagore+Rd,+Dhakuria,+Babu+Bagan,+Selimpur,+Kolkata,+West+Bengal+700031" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
							
					</div>
					
					<div class="col-sm-7 addrs" id="co">
						<p class="bname cor-ofc">CORPORATE OFFICE</p>
						
						<p class="addrs-data">67B, MAHARAJA THAKUR ROAD<br>
						DHAKURIA, <br>
						KOLKATA-700031<br><br>
						Phone:<br>
						+91 891-046-2774<br><br>
						Email:<br>
						corporateoffice_ias@gmail.com<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>

					</div>
				</div>
			</div>
			
			<div class="col-sm-6 " >
			
				<div class="col-sm-12 offices">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="https://www.google.co.in/maps/place/67,+Maharaja+Tagore+Rd,+Dhakuria,+Babu+Bagan,+Selimpur,+Kolkata,+West+Bengal+700031" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">KOLKATA</p>
						
						<p class="addrs-data">67B, MAHARAJA THAKUR ROAD<br>
						DHAKURIA, <br>
						KOLKATA-700031<br><br>
						Phone:<br>
						+91 891-046-2774<br><br>
						Email:<br>
						 	iasacademicmail@gmail.com<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>

					</div>
				</div>
			</div>
			
			<div class="col-sm-6 " id="hwh">
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300" style="min-height:311px;">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="http://www.maps.google.com" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">HOWRAH</p>
						
						<p class="addrs-data">PARBATI<br>
						XXXXXXXXXXXXX<br>
						XXXXXXX<br><br>
						Phone:<br>
						 	+91 877-779-4425<br><br>
						Email:<br>
						 	 	 iasacademicmail@gmail.com<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>


					</div>
				</div>
			</div>
			
			
			<div class="col-sm-6 " >
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="https://www.google.co.in/maps/place/Ranibagan+More/@24.0983325,88.2542521,17z/data=!4m8!1m2!2m1!1s+RANIBAGAN+MORE+berhampore" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">BERHAMPORE</p>
						
						<p class="addrs-data">3rd FLOOR, MUNICIPAL MARKET COMPLEX<br>
						RANIBAGAN MORE CROSSING,  <br>
						BERHAMPORE<br><br>
						Phone:<br>
						 	+91 985-116-5385<br><br>
						Email:<br>
						 	 	iasacademicmail@gmail.com<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			
			<div class="col-sm-6 " id="skm">
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="http://www.maps.google.com" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">SIKKIM</p>
						
						<p class="addrs-data">PXXXXXXX<br>
						XXXXXXXXXXXXX<br>
						XXXXXXX<br><br>
						Phone:<br>
						 	 	+91 123-456-7890<br><br>
						Email:<br>
						 	 	 iasacademicmail@gmail.com<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			
			<div class="col-sm-6 " >
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="http://www.maps.google.com" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">DURGAPUR</p>
						
						<p class="addrs-data">PXXXXXXX<br>
						XXXXXXXXXXXXX<br>
						XXXXXXX<br><br>
						Phone:<br>
						 	 	+91 123-456-7890<br><br>
						Email:<br>
						 	 	 iasacademicmail@gmail.com<br></p>
								 
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-6 " data-aos="fade-up" data-aos-once="true" data-aos-delay="300" id="sili">
			
				<div class="col-sm-12 offices">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="http://www.maps.google.com" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">SILIGURI</p>
						
						<p class="addrs-data">PXXXXXXX<br>
						XXXXXXXXXXXXX<br>
						XXXXXXX<br><br>
						Phone:<br>
						 	 	+91 123-456-7890<br><br>
						Email:<br>
						 	 	 iasacademicmail@gmail.com<br>
						</p>
								 
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
					</div>
				</div>
			</div>
			
		</div>
		
		
	</div>
	
	<!-- Contact modal begins -->
		<div class="modal fade" id="Modal"  >
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<p class="send-query">Send Your Queries</p>
					<p class="bottomliner">We would be happy to hear from you</p>
						<?php
					if(isset($_GET['qs']) && $_GET['qs'] == 1){
						echo '
							<p class="success">Thank You for reaching us. We will get in touch at the earliest.</p>
						';
					}					
				?>
                </div>
				<div class="modal-body">
				
					<div class=" contactus" >
						
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
								<textarea class="form-control" id="msg" rows="2" placeholder="Message" name="message"  required></textarea>
							</div>

							<button type="submit" id="submit" name="cont-submit" class="btn btn-default">Send Query</button>
						</form>
					</div>
                        
				</div>  <!-- MODAL BODY ENDS HERE  -->
                    
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
		
		<script>
			AOS.init();
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
	
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location = "contact.php";
			};
		};
	</script>
		
		
</body>
</html>