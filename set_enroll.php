<?php
	session_start();
	include 'includes/simple-crypt.inc.php';
	
	if(isset($_SESSION['student']) || isset($_COOKIE['student']) ){
		header("Location: profile.php");
		exit();
	}
	
	
	if(isset($_GET['msnt']))
	{
		echo '			    
		    <div id="success-modal">
				<div class="modalconent">
					<h3 style="color:teal;">Information</h3>
					<hr>	
					<p class="para">We have sent you an email with a link to reset-your password. Please visit the link in order to change your password. Link valid for one time only.</p> 
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
	<title>SET Enrollment Form | IAS</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/set.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>
	<div class="row">
		<div class="bg col s12">
			<p class="brand"><a href="index.php"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</a></p>
			<a class="link" href="#">Learn More About SET</a>
		</div>	
		<div class="col l6 offset-l3 m10 offset-m1 s10 offset-s1">
			<div class="form_wrapper z-depth-2">
				<h5>Scholarship Entrance Test Enrollment Form</h5>
				<p style="color:teal;">Fields marked with * are mandatory</p>
				<div class="row">
					<form action="includes/set.inc.php" method="POST">
						<div class="input-field col s12 m10 l7">
							<input id="name" name="name" type="text" class="validate" required>
							<label class="active" for="name">Full Name*</label>
							<p for="name" id="error_name" class="error"></p>
						</div>
						<div class="input-field col s12 m10 l7">
							<input id="gname" name="gname" type="text" class="validate" required>
							<label class="active" for="gname">Father's / Guardian's Name*</label>
							<p for="gname" id="error_gname" class="error"></p>
						</div>
						<div class="input-field col s12 m10 l7">
							<select required name="exam">
							  <option value="" disabled selected>Choose your option</option>
							  <option value="01">Class VIII</option>
							  <option value="02">Class IX</option>
							  <option value="03">Class X</option>
							  <option value="04">Class XI</option>
							  <option value="05">Class XII</option>
							</select>
							<label>Last Final Exam you appeared for:*</label>
						</div>
						<div class="input-field col s12 m10 l7">
							<select required name="board">
							  <option value="" disabled selected>Choose your option</option>
							  <option value="WB">WB</option>
							  <option value="CBSE">CBSE</option>
							  <option value="ICSE">ICSE</option>
							  <option value="ISC">ISC</option>
							</select>
							<label>Examination Board:*</label>
						</div>
						<div class="input-field col s12 m10 l7">
							<select required name="center">
							  <option value="" disabled selected>Choose your option</option>
							  <option value="01">KOLKATA</option>
							  <option value="03">BERHAMPORE</option>
							  <option value="02">HOWRAH</option>
							</select>
							<label >Center where you would like to sit for the test:*</label>
						</div>
						<div class="input-field col s12 m12 l7">
							<input id="sname" type="text" name="sname" required>
							<label class="active" for="sname">Name of your School*</label>
						</div>
						<div class="input-field col s12">
						  <textarea id="address" class="materialize-textarea" name="address" required></textarea>
						  <label for="address">Full Communication Address*</label>
						</div>
						<div class="input-field col s12 m12 l7">
						  <input id="email" type="email" class="validate" name="email">
						  <label for="email">Email</label>
						  <p for="email" id="error_email" class="error"></p>
						</div>
						<div class="input-field col s12 m12 l7">
						  <input id="contact" type="text" name="contact" class="validate" required maxlength="10">
						  <label for="contact">Contact No*</label>
						  <p for="name" id="error_contact" class="error"></p>
						</div>
						<div class="input-field col s12 m12 l7">
						  <input id="wp" type="text" name="wp" maxlength="10">
						  <label for="wp">Whatsapp No</label>
						</div>	
						<div class="input-field col s12 m10 l7">
							<select required name="language">
							  <option value="" disabled selected>Choose your option</option>
							  <option value="English">ENGLISH</option>
							  <option value="Bengali">BENGALI</option>
							</select>
							<label>Choose your preferred Examination Language:*</label>
						</div>
						<div class="clearfix"></div>
						<button class="btn waves-effect waves-light" type="submit" name="submit">Submit</button>
					</form>
			    </div>
			</div>
		</div>
	</div>
	
	
	
	
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script> 	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
			$('select').formSelect();
		});
	</script>
	<script>
		window.onload = function () {
			document.getElementById('button').onclick = function () {
				document.getElementById('success-modal').style.display = "none"
				window.location.replace('set_enroll.php');
			};
		};
	</script>	
	<script>
		
		$('#contact').on('blur', function(){
			if(!this.value.match(/^[0-9]{10}$/))
			{
				$('#error_contact').html('<span class="fa fa-exclamation-triangle"></span>  Please provide a valid Contact Number.').addClass('error_active').css('display', 'block');
				return false;
			} 
			$('#error_contact').html('').css('display', 'none');  
			
		});	
	</script>
	
	<?php
	
		if(isset($_GET['success']))
		{
			echo '			    
				<div id="success-modal">
					<div class="modalconent">
						<div class="head">
							<span class="fa fa-check"></span>
						</div>	
						<p class="hello">Hello '. strtok(simple_crypt($_GET['success'],'d'), ' ').'!</p>
						<p style="text-align:justify;">Greetings for the day! Your application for participating in IAS talent Search 2018 through Scholarship Entrance Test at Center: <b>'.simple_crypt($_GET['cen'],'d').'</b> having Application No: <b>'.simple_crypt($_GET['appid'],'d').'</b> Dated: <b>'.date('d/m/Y').'</b> is successfully submitted and is waiting for approval. You shall be notified once your request is approved. Please note down your Application No. for further references.</p><br>
						
						<button id="button" class="btn btn-sm button">Close</button><br><br>	
						<a href="index.php">Back to home</a>
					</div>
				</div>
			';			
		}
		if(isset($_GET['error_code']) && $_GET['error_code']!=576)
		{
			echo '			    
				<div id="success-modal">
					<div class="modalcontent">
						<span class="fa fa-exclamation-triangle"></span>
						<p class="snap">Oh Snap!</p>
						<p class="msg">An error occurred while transferring your data, Please try again.</p>
						<button id="button" class="waves-effect waves-light btn close red lighten-1">Close</button>
					</div>
				</div>
			';			
		}
		if(isset($_GET['error_code']) && $_GET['error_code']==576)
		{
			echo '			    
				<div id="success-modal">
					<div class="modalcontent">
						<span class="fa fa-exclamation-triangle"></span>
						<p class="snap">Oh Snap!</p>
						<p class="msg">Email id you Entered is already taken, please use a different one.</p>
						<button id="button" class="waves-effect waves-light btn close red lighten-1">Close</button>
					</div>
				</div>
			';			
		}
	?>	
</body>
</html>	