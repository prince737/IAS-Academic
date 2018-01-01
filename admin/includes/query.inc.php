<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	session_start();
	//Load composer's autoloader
	require '../../vendor/autoload.php';
	include_once '../../includes/dbh.inc.php';
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$msg = mysqli_real_escape_string($conn, $_POST['message']);
	$id = mysqli_real_escape_string($conn, $_POST['q_id']);
	
	if(isset($_POST['sreply'])){
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
			$mail->setFrom('princedey51@yahoo.com', 'Mailer');
			$mail->addAddress($email); 
			$mail->addReplyTo('info@example.com', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');

			  //Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = $msg;
			
			$mail->send();
			
			$query = "update queries set q_replystatus = 1 where q_id = '$id';";
			if(mysqli_query($conn, $query)){
				header("Location: ../admin.php?msnt");	
				exit();
			}
			else{
				header("Location: ../admin.php?err");	
			}
			
			
			
		}
		catch(Exception $e){
			header("Location: ../admin.php?m_n_snt");
		}
	}
	
	
	if(isset($_POST['remove-dash'])){
		$query = "update queries set q_removalstatus = 1 where q_id = '$id';";
		if(mysqli_query($conn, $query)){
				header("Location: ../admin.php?rdsh");	
				exit();
		}
		else{
			header("Location: ../admin.php?err");	
		}
	}
	
	if(isset($_POST['remove-db'])){
		$query = "delete from queries where q_id = '$id';";
		if(mysqli_query($conn, $query)){
				header("Location: ../admin.php?rdb");	
				exit();
		}
		else{
			header("Location: ../admin.php?err");
		}
	}
	