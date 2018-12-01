<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require '../vendor/autoload.php';

include 'dbh.inc.php';

include 'simple-crypt.inc.php';

if(isset($_POST['submit'])) 
{
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);	
	$remember = mysqli_real_escape_string($conn, $_POST['remember']);	
	
	//Error Handlers
	if(empty($email) || empty($pwd)) 
	{
		header("Location: ../login.php?login=empty");
		exit();
	} 
	else
	{
		$sql = "select * from students where stu_email = '$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1)
		{	
			$encryptmail = simple_crypt( $email, 'e' );
			header("Location: ../login.php?m=$encryptmail&l=er");
			exit();
		}
		else
		{
			if($row = mysqli_fetch_assoc($result))
			{
				if($row['stu_approvalstatus'] == 0 ){
					header("Location: ../login.php?l=na");
					exit();
				}
				else
				{
					$hashedPwdCheck = password_verify($pwd, $row['stu_password']);
					if($hashedPwdCheck == false)
					{
						$mail= simple_crypt( $row['stu_email'], 'e' );
						header("Location: ../login.php?m=$mail&l=pdm");
						exit();
					}
					elseif($hashedPwdCheck == true)
					{
						//Login the user here
						if(!empty($remember)){
							setcookie('student', $email, time()+(60*60*24*30), '/');
							
							header("Location: ../profile.php");
							exit();
						}
						else{	
							$_SESSION['student'] = $email;
							setcookie('student', "");
							header("Location: ../profile.php");
							exit();
						}
					}
				}
				
			}
		}
	}
}
elseif(isset($_POST['resetPwd'])) {
	$emailr = mysqli_real_escape_string($conn, $_POST['emailreset']);
	if(empty($emailr)) 
	{
		header("Location: ../login.php?login=emty");
		exit();
	} 
	else
	{
		$sql = "select * from students where stu_email = '$emailr' AND stu_approvalstatus=1";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1)
		{	
			
				header("Location: ../login.php?l=invalid");
				exit();
			
		}
		else{
			$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$str = str_shuffle($str);
			$str = substr($str, 0, 30);
			$encryptmail = simple_crypt( $emailr, 'e' );
			
			$msg = 'Please visit the following link to reset your password: <html><a  href="localhost/iasacademic/resetPassword.php?tKr='.$str.'&em='.$encryptmail.'">Reset Your Password </a> </html>';
			
						
			$mail = new PHPMailer(true);  
		try{
			
			
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.mail.yahoo.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'princedey51@yahoo.com';                 // SMTP username
			$mail->Password = '9733581977';                           // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('princedey51@yahoo.com', 'IAS');
			$mail->addAddress($emailr); 
			$mail->addReplyTo('info@example.com', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');

			  //Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Reset Your Password';
			$mail->Body    = $msg;
			
			
			
			$query = "select stu_token from students where stu_email='$emailr'";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)){
				if(!empty($row['stu_token'])){
					header("Location: ../login.php?l=alrDYreQ");
					exit();
				}
				else{
					$mail->send();
					$query = "update students set stu_token = '$str' where stu_email='$emailr';";
					mysqli_query($conn, $query);
				}
			}
			
			
			
			header("Location: ../login.php?msnt");
			exit();
			
		}
		catch(Exception $e){
			header("Location: ../login.php?l=$e");
			exit();
		}
			
			
			
		}
		
	}
	
}
else 
{
	header("Location: ../login.php?login=error");
	exit();
}	