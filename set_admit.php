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
	<title>SET Admit Card Download | IAS</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/set.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
 <style>
 	.input-field input:focus + label, .materialize-textarea:focus + label {
     color: #795548  !important;
    }

/* label underline focus color */
    .input-field input:focus, .materialize-textarea:focus{
     border-bottom: 1px solid #795548  !important;
     box-shadow: 0 1px 0 0 #795548  !important;
    }
    .input-field input[type=text].valid {
     border-bottom: 1px solid teal;
     box-shadow: 0 1px 0 0 teal;
   }
   .input-field input[type=email].valid {
     border-bottom: 1px solid teal;
     box-shadow: 0 1px 0 0 teal;
   }
</style>
</head>

<body bgcolor="#d7ccc8 ">
	<div class="row">
		<div class="bg col s12 brown">
			<p class="brand"><a href="index.php"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</a></p>
			<a class="link" href="#">Learn More About SET</a>
		</div>	
		<div class="col l6 offset-l3 m10 offset-m1 s10 offset-s1">
			<div class="form_wrapper_admit z-depth-2">
				<h5>Scholarship Entrance Test Admit Card Download</h5>
				
				<div class="row">
					<form action="includes/set.inc.php" method="POST">
						<div class="input-field col m12">
							<input id="roll" name="roll" type="text" class="validate" required>
							<label class="active" for="roll">SET Roll Number</label>
							<p for="roll" id="error_roll" class="error"></p>
						</div>
											
						<div class="input-field col m12">
						  <input id="email" type="email" class="validate" name="email" required>
						  <label for="email">Email</label>
						  <p for="email" id="error_email" class="error"></p>
						</div>
						
						<div class="clearfix"></div>
						<div class="center-align">
							<button class="btn waves-effect waves-light brown" type="submit" name="admit">Download Admit Card</button>
						</div>
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
				window.location.replace('set_admit.php');
			};
		};
	</script>	
	<script>		
		$('#email').on('blur', function(){
			if(!this.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
			{
				$('#error_email').html('<span class="fa fa-exclamation-triangle"></span>  Please provide a valid email.').addClass('error_active').css('display', 'block');
				return false;
			} 
			$('#error_email').html('').css('display', 'none');  			
		});			
		
	</script>
	
	<?php	
		if(isset($_GET['error']) && $_GET['error']==618)
		{
			echo '			    
				<div id="success-modal">
					<div class="modalcontent">
						<span class="fa fa-exclamation-triangle"></span>
						<p class="snap">Oh Snap!</p>
						<p class="msg">The Email Id and Roll No. combination you entered does not match with our records.</p>
						<button id="button" class="waves-effect waves-light btn close red lighten-1">Close</button>
					</div>
				</div>
			';			
		}
	?>	
</body>
</html>	