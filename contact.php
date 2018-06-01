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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/contact.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/aos.css">
		<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
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
						
						<p class="addrs-data">67 B, M.T. ROAD<br>
						DHAKURIA, KOLKATA-700031<br><br>
						Phone:<br>
						+91 700-329-8045<br><br>
						Email:<br>
						mail@iasacademic.in<br>
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
						
						<p class="addrs-data">67 B, MAHARAJA THAKUR ROAD<br>
						DHAKURIA, KOLKATA-700031<br><br>
						Phone:<br>
						+91 985-153-1638<br><br>
						Email:<br>
						 	mail@iasacademic.in<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>

					</div>
				</div>
			</div>
			
			<div class="col-sm-6 " id="hwh">
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300" style="min-height:311px;">
					<div class="col-sm-5 map">
						<div class="map-link">
							<a href="https://www.google.co.in/maps/place/Tarapada+Chatterjee+Ln,+Shibpur,+Howrah,+West+Bengal+711103/@22.5657975,88.3122473,21z/data=!4m5!3m4!1s0x3a027833023bebe7:0xddc445139b1e0e95!8m2!3d22.5658747!4d88.3117751?hl=en" target="_blank">GET DIRECTIONS</a>
							<div class="arrow"></div>
						</div>
					</div>
					
					<div class="col-sm-7 addrs">
						<p class="bname">HOWRAH</p>
						
						<p class="addrs-data">
						2/2/2 TARAPADA CHATTERJEE LANE<br>
						HOWRAH - 711103<br><br>
						Phone:<br>
						 	+91 900-771-8592<br><br>
						Email:<br>
						 	 	 mail@iasacademic.in<br>
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
						
						<p class="addrs-data">3rd FLOOR <br>MUNICIPAL MARKET COMPLEX<br>
						RANIBAGAN MORE CROSSING  <br>
						BERHAMPORE<br><br>
						Phone:<br>
						 	+91 704-449-2842<br><br>
						Email:<br>
						 	 	mail@iasacademic.in<br>
						</p>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			
			<div class="col-sm-6 " id="skm">
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
					
					
					<div class="col-sm-12 text-center">
						<p class="bname">SIKKIM</p>
						
						<div class="opening">
							<p>OPENING SOON!</p>
						</div>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			
			<div class="col-sm-6 " >
			
				<div class="col-sm-12 offices" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
					<div class="col-sm-12 text-center">
						<p class="bname">DURGAPUR</p>
						
						<div class="opening">
							<p>OPENING SOON!</p>
						</div>
						
						<button class="cntct-btn" data-target="#Modal" data-toggle="modal" >Questions in Mind?</button>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-6 " data-aos="fade-up" data-aos-once="true" data-aos-delay="300" id="sili">
			
				<div class="col-sm-12 offices">
					<div class="col-sm-12 text-center">
						<p class="bname">SILIGURI</p>
						<div class="opening">
							<p>OPENING SOON!</p>
						</div>
						
						
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
	
	<?php
		include('footer.php');
	?>
	
	
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
	<script>
		$('#contact').addClass('actv');
	</script>
		
		
</body>
</html>