<?php
	session_start();
	include 'includes/simple-crypt.inc.php';
	include 'includes/dbh.inc.php';
	
	if(!isset($_GET['tKr']) || !isset($_GET['em'])){
		header("Location: index.php");
		exit();
	}
	
	$email = mysqli_real_escape_string($conn, $_GET['em']);
	$email = simple_crypt( $email, 'd' );
	$token = mysqli_real_escape_string($conn, $_GET['tKr']);
	$sql = "select * from students where stu_email='$email' and stu_token='$token';" ;
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck == 0) 
	{
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/pwd.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg"
 href="images/logo.jpg" />
</head>

<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a href="index.php" class="pull-left"><img src="images/logo.jpg" height="35" width="35" style="margin:8px;"></a>
				<a class="navbar-brand" href="index.php"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">      
				<ul class="nav navbar-nav navbar-right">
					<li><a href="login.php" style="font-size:16px;"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	
	<div class="bg container-fluid">
		
		
		<p class="text">Reset Your Password</p>
		
		<div class="row">
			<div class="col-md-7 col-lg-4 col-sm-10 col-md-offset-4 signin">
				<p class="instr">*upon successful change you will be redirected to login page where you can verify your new password</p>	
				<p class="icon"><span class="fa fa-lock"></span></p>	
				<form class="form" action="includes/resetpwd.inc.php" method="POST">
					<input type="hidden" name="email" value="<?php echo $_GET['em'];?>">
					<input type="hidden" name="token" value="<?php echo $_GET['tKr'];?>">
					<input type="password" name="pwd" id="pwd" placeholder="New Password" class="form-control"  required>	
					<input type="password" id="cpwd" name="pwd" class="form-control" placeholder="Confirm Password" required>	
					<button type="submit" name="submit" id="submit" class="submit">Reset Password</button><br>
					<p id="message" style="text-align:center;"></p>
					<p id="message1" style="text-align:center;"></p>	
					
				
				</form>
			
			
			</div>
		</div>
	
	</div>




<script src="js/jquery-3.2.1.min.js"></script>   
<script src="js/bootstrap.js"></script>

<script>
	$('#pwd,#cpwd').on('keyup', function () {
        if ($('#pwd').val() == $('#cpwd').val()) {
            $('#message').html('').css('color', '#5fcf80');
            $('#submit').prop('disabled',false);
        } else{
            $('#message').html('Passwords do not Match.').css('color', '#D32F2F');
            $('#submit').prop('disabled',true);
        }
    });  

	$('#pwd').on('blur', function(){
		if(this.value.length < 8){
			$('#message1').html('Passwords must be atleast 8 characters long.').css('color', '#D32F2F');
			$(this).focus(); 
			return false;
		} else{
            $('#message1').html('');           
        }
	});		

</script>

</body>
</html>
