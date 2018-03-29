<?php
	ob_start();
	session_start();
	require_once('../../includes/dbh.inc.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	//Load composer's autoloader
	require '../../vendor/autoload.php';
	
	if(isset($_POST['approve'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		
		$sql="select * from sett where id='$id'";
		$res=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($res);		
		
		$roll='SET';
		$date = substr_replace(date('Y'), '', 1, 1);
		$roll .= $date;
		
		
		$roll.='0'.$row['set_center'];
		$roll.=$row['set_finalExam'];
		
		$query= "select max(substr(set_rollNo,11,4)) as max from sett"; 
		$res=mysqli_query($conn,$query);
		$row1= mysqli_fetch_array($res);
		
		if($row1['max']==null){
			$roll.='0001';
		}
		else{
			$roll .= str_pad($row1['max'] + 1, 4, 0, STR_PAD_LEFT);
		}
		
		$query="update sett set set_rollNo='$roll', set_status=1 where id='$id'";
		if(!mysqli_query($conn,$query)){
			header("Location: ../set.php?err");	
			exit();
		}
		else{			
			
		
			$msg= '			
				<div class="email-background" style="background: #eee;">
					<div class="email-container" style="background: #fff; max-width: 550px; margin: 0 auto; border-bottom: 5px solid #104a5b;">
						<div class="email-header" style="background: #104a5b; padding: 20px;">
							<img  src="http://www.iasacademic.in/images/logo.jpg" style="height: 68px; width: 90px; border-radius: 7px; display: block; margin: 0 auto;" width="90" height="68">
							<p class="brand" style="text-align: center; font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 23px; padding-top: 3px; text-shadow: 2px 2px #000; padding-bottom: 0px; margin-bottom: 0px;"><span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">I</span>NSTITUTE OF <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">A</span>PPLIED <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">S</span>CIENCE</p>
							<p class="text" style="font-family: \'Times New Roman\', Georgia, Serif; color: #888888; font-size: 18px; text-align: center; padding: 0px; margin: 0px;">NEET-UG | IIT-JEE | FOUNDATIONS</p>
							
						</div>
						<div class="email-sub">
							<p class="subject" style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #000; background: #25a5cd; padding: 10px 20px; text-align: center;">Status of your Application for IAS-SETOAS</p>
						</div>
						<div class="email-body" style="font-family: sans-serif; padding: 30px 20px; text-align: justify; line-height: 25px;">
							<p class="hello" style="color: #212121; margin: 0; font-size: 20px; padding: 5px 0px;">Hello '.$row['set_name'].',</p>
							<p class="greet" style="color: #212121; margin: 0; font-size: 18px; padding: 5px 0px 0px 0px;">Greetings for the day!</p><br>
							<p style="color: #212121; margin: 0; padding: 0;">Congratulations! Your application for participating in IAS Talent Search 2018 through IAS-SET having Application No: <strong>'.$row['set_applicationNo'].'</strong> is found in order and is approved. Your Roll No for the Exam is <strong>'.$roll.'.</strong>  Admit card for the Exam will be available soon at the official website of IAS.</p>
							<p style="color: #212121; margin: 0; padding: 0;">Visit <a href="http://www.iasacademic.in">www.iasacademic.in</a> regularly for latest announcements and events.</p>	<br>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>Thank You</strong></p>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>Have a nice day</strong></p>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>TEAM IAS </strong></p> 				
						</div>
					</div>
				</div>			
			';
				
			$mail = new PHPMailer(true);  
			try{
				
				//mail($email,"My subject",$msg);
				
				$mail->SMTPDebug = 2;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'sg2plcpnl0091.prod.sin2.secureserver.net';  // Specify SMTP servers  smtpout.asia.secureserver.net
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'mail@iasacademic.in';                 // SMTP username
				$mail->Password = 'prince737@ovi.com';                           // SMTP password @3barpartha123
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom('mail@iasacademic.in', 'Institute of Applied Science');
				$mail->addAddress($row['set_email']); 
				$mail->addReplyTo('mail@iasacademic.in', 'Institute of Applied Science');

				  //Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Status of your Application for IAS-SETOAS';
				
				$mail->Body= $msg;
				if(!$mail->send()){
					$query="update sett set set_rollNo='', set_status=0";
					mysqli_query($conn,$query);
					header("Location: ../set_enroll.php?error_code=476");	
					exit();
				}
				else{
					header("Location: ../set.php?appr_success");
					exit();
				}		
				
			}
			catch(Exception $e){				
				header("Location: ../set.php?error_code=486");	
				exit();
			}
			
		}
		
	}
	
	elseif(isset($_POST['deny'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$reason = mysqli_real_escape_string($conn, $_POST['reason']);
		
		$sql="select * from sett where id='$id'";
		$res=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($res);

		$query="update sett set set_denyReason='$reason', set_status=2, set_admitStatus=0, set_dateAssigned='', set_timeAssigned='' where id='$id'";
		if(!mysqli_query($conn,$query)){
			header("Location: ../set.php?err");	
			exit();
		}
		else{	

			$msg= '			
				<div class="email-background" style="background: #eee;">
					<div class="email-container" style="background: #fff; max-width: 550px; margin: 0 auto; border-bottom: 5px solid #104a5b;">
						<div class="email-header" style="background: #104a5b; padding: 20px;">
							<img  src="http://www.iasacademic.in/images/logo.jpg" style="height: 68px; width: 90px; border-radius: 7px; display: block; margin: 0 auto;" width="90" height="68">
							<p class="brand" style="text-align: center; font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 23px; padding-top: 3px; text-shadow: 2px 2px #000; padding-bottom: 0px; margin-bottom: 0px;"><span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">I</span>NSTITUTE OF <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">A</span>PPLIED <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">S</span>CIENCE</p>
							<p class="text" style="font-family: \'Times New Roman\', Georgia, Serif; color: #888888; font-size: 18px; text-align: center; padding: 0px; margin: 0px;">NEET-UG | IIT-JEE | FOUNDATIONS</p>
							
						</div>
						<div class="email-sub">
							<p class="subject" style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #000; background: #25a5cd; padding: 10px 20px; text-align: center;">Status of your Application for IAS-SETOAS</p>
						</div>
						<div class="email-body" style="font-family: sans-serif; padding: 30px 20px; text-align: justify; line-height: 25px;">
							<p class="hello" style="color: #212121; margin: 0; font-size: 20px; padding: 5px 0px;">Hello '.$row['set_name'].',</p>
							<p class="greet" style="color: #212121; margin: 0; font-size: 18px; padding: 5px 0px 0px 0px;">Greetings for the day!</p><br>
							<p style="color: #212121; margin: 0; padding: 0;">We regret informing that your application for participating to IAS TALENT SERCH 2018 via IAS-SET having application No: <strong>'.$row['set_applicationNo'].'</strong> has been denied due to the fact that '.$reason.'</p>
							<p style="color: #212121; margin: 0; padding: 0;">You can email us anytime at "mail@iasacademic.in" or contact us via the form available at <a href="http://www.iasacademic.in">www.iasacademic.in</a> to get help regarding your issue. We would be happy to assist you.</p>
							<p style="color: #212121; margin: 0; padding: 0;">Visit <a href="http://www.iasacademic.in">www.iasacademic.in</a> regularly for latest announcements and events.</p>	<br>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>Thank You</strong></p>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>Have a nice day</strong></p>
							<p style="color: #212121; margin: 0; padding: 0;"><strong>TEAM IAS </strong></p> 				
						</div>
					</div>
				</div>			
			';
				
			$mail = new PHPMailer(true);  
			try{
				
				//mail($email,"My subject",$msg);
				
				$mail->SMTPDebug = 2;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'sg2plcpnl0091.prod.sin2.secureserver.net';  // Specify SMTP servers  smtpout.asia.secureserver.net
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'mail@iasacademic.in';                 // SMTP username
				$mail->Password = 'prince737@ovi.com';                           // SMTP password @3barpartha123
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom('mail@iasacademic.in', 'Institute of Applied Science');
				$mail->addAddress($row['set_email']); 
				$mail->addReplyTo('mail@iasacademic.in', 'Institute of Applied Science');

				  //Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Status of your Application for IAS-SETOAS';
				
				$mail->Body= $msg;
				if(!$mail->send()){
					$query="update sett set set_rollNo='', set_status=0";
					mysqli_query($conn,$query);
					header("Location: ../set_enroll.php?err");	
					exit();
				}
				else{
					header("Location: ../set.php?deny_success");
					exit();
				}		

			}
			catch(Exception $e){				
				header("Location: ../set.php?error_code=486");	
				exit();
			}

		}	
	}
	elseif(isset($_POST['gen']) || isset($_POST['upd'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$time = mysqli_real_escape_string($conn, $_POST['time']);

		$query="update sett set set_dateAssigned='$date', set_timeAssigned='$time', set_admitStatus=1 where id='$id'";
		if(!mysqli_query($conn,$query)){
			header("Location: ../set.php?err");	
			exit();
		}	
		else{
			header("Location: ../set.php?admit_success");	
			exit();
		}

	}