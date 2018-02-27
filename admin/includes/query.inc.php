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
	
	if(isset($_POST['sreply']) || isset($_POST['qsreply'])){
		$mail = new PHPMailer(true);  
		try{
			
			
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtpout.asia.secureserver.net';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'mail@iasacademic.in';                 // SMTP username
			$mail->Password = '@3barpartha123';                           // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('mail@iasacademic.in', 'Mailer');
			$mail->addAddress($email); 
			$mail->addReplyTo('mail@iasacademic.in', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');

			  //Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = $msg;
			$mail->Send();
			
			$query = "update queries set q_replystatus = 1 where q_id = '$id';";
			if(mysqli_query($conn, $query)){
				if(isset($_POST['sreply'])){
					header("Location: ../admin.php?msnt");	
					exit();
				}
				else{
					header("Location: ../queries.php?msnt");	
					exit();
				}
			}
			else{
				if(isset($_POST['sreply'])){
					header("Location: ../admin.php?error");	
					exit();
				}
				else{
					header("Location: ../queries.php?error");	
					exit();
				}	
			}
			
			
			
		}
		catch(Exception $e){
			if(isset($_POST['remove-db'])){
					header("Location: ../admin.php?error");	
					exit();
				}
				else{
					header("Location: ../queries.php?error");	
					exit();
				}
		}
	}
	
	
	if(isset($_POST['remove-dash']) || isset($_POST['qremove-dash'])){
		$query = "update queries set q_removalstatus = 1 where q_id = '$id';";
		if(mysqli_query($conn, $query)){
				if(isset($_POST['remove-db'])){
					header("Location: ../admin.php?rdb");	
					exit();
				}
				else{
					header("Location: ../queries.php?rdb");	
					exit();
				}
		}
		else{
			if(isset($_POST['remove-db'])){
					header("Location: ../admin.php?rdb");	
					exit();
				}
				else{
					header("Location: ../queries.php?rdb");	
					exit();
				}
		}
	}
	
	if(isset($_POST['remove-db']) || isset($_POST['qremove-db'])){
		$query = "delete from queries where q_id = '$id';";
		if(mysqli_query($conn, $query)){
			    if(isset($_POST['remove-db'])){
					header("Location: ../admin.php?rdb");	
					exit();
				}
				else{
					header("Location: ../queries.php?rdb");	
					exit();
				}
				
		}
		else{
			if(isset($_POST['remove-db'])){
					header("Location: ../admin.php?rdb");	
					exit();
				}
				else{
					header("Location: ../queries.php?rdb");	
					exit();
				}
		}
	}
	