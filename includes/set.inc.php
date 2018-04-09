<?php
ob_start();

session_start();
include_once 'dbh.inc.php';
include 'simple-crypt.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	
	//Load composer's autoloader
require '../vendor/autoload.php';

if(isset($_POST['submit'])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$gname = mysqli_real_escape_string($conn, $_POST['gname']);
	$exam = mysqli_real_escape_string($conn, $_POST['exam']);
	$board = mysqli_real_escape_string($conn, $_POST['board']);
	$center = mysqli_real_escape_string($conn, $_POST['center']);
	$sname = mysqli_real_escape_string($conn, $_POST['sname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$wp = mysqli_real_escape_string($conn, $_POST['wp']);
	$language = mysqli_real_escape_string($conn, $_POST['language']);

	if(empty($name) || empty($gname) || empty($exam) || empty($board) || empty($center) || empty($sname) || empty($address) || empty($contact) || empty($language)){
		header("Location: ../set_enroll.php?error_code=676");	
		exit();
	}
	
	$date = substr_replace(date('Y'), '', 1, 1);
	$appId = $date;
	$appId .= 'SET';
	
	$query= "select set_year,set_no from sett where id= (select max(id) from sett)";
	$res=mysqli_query($conn,$query);
	$row= mysqli_fetch_array($res);
	if($row['set_year']==date('y')){
		$temp=$row['set_no']+1;
		$appId .= '00'.$temp;
	}
	else{
		$temp=1;
		$appId .= '001'; //SET NO
	}
	
	
	
	$year=date('y');
	$query= "select max(set_applicationNo) as max from sett where set_no=$temp and set_year=$year"; 
	$res=mysqli_query($conn,$query);
	$row= mysqli_fetch_array($res);
	
	if($row['max'] != ''){
		$roll=substr($row['max'], 9, 4);
		$appId .= str_pad($roll + 1, 4, 0, STR_PAD_LEFT);
	}
	else{
		$appId .= '0001';
	}
	
	if($center==01){
		$cn='KOLKATA';
	}
	elseif($center==02){
		$cn='HOWRAH';
	}
	
	else{
		$cn='BERHAMPORE';
	}	
	
	
	$query = "insert into sett(set_no, set_applicationNo, set_name, set_gname, set_finalExam, set_board, set_center, set_school, set_address, set_email, set_contact, set_wp, set_language, set_year) values($temp, '$appId', '$name', '$gname', '$exam', '$board', $center, '$sname', '$address', '$email', '$contact', '$wp', '$language', $year)";

	if(!mysqli_query($conn,$query)){
		header("Location: ../set_enroll.php?error_code=496");	
		exit();
	}
	elseif(!empty($email)){
		if($exam==01){
			$c='CLASS VIII';
		}
		elseif($exam==02){
			$c='CLASS IX';
		}
		elseif($exam==03){
			$c='CLASS X';
		}
		elseif($exam==04){
			$c='CLASS XI';
		}
		else{
			$c='CLASS XII';
		}			
			
		
		$msg= '			
			<div class="email-background" style="background: #eee;">
				<div class="email-container" style="background: #fff; max-width: 550px; margin: 0 auto; border-bottom: 5px solid #104a5b;">
					<div class="email-header" style="background: #104a5b; padding: 20px;">
						<img  src="http://www.iasacademic.in/images/logo.jpg" style="height: 68px; width: 90px; border-radius: 7px; display: block; margin: 0 auto;" width="90" height="68">
						<p class="brand" style="text-align: center; font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 23px; padding-top: 3px; text-shadow: 2px 2px #000; padding-bottom: 0px; margin-bottom: 0px;"><span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">I</span>NSTITUTE OF <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">A</span>PPLIED <span style="font-family: \'Times New Roman\', Georgia, Serif; color: white; font-size: 35px;">S</span>CIENCE</p>
						<p class="text" style="font-family: \'Times New Roman\', Georgia, Serif; color: #888888; font-size: 18px; text-align: center; padding: 0px; margin: 0px;">NEET-UG | IIT-JEE | FOUNDATIONS</p>
						
					</div>
					<div class="email-sub">
						<p class="subject" style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #000; background: #25a5cd; padding: 10px 20px; text-align: center;">Confirmation of submission of application at IAS-SETOAS</p>
					</div>
					<div class="email-body" style="font-family: sans-serif; padding: 30px 20px; text-align: justify; line-height: 25px;">
						<p class="hello" style="color: #212121; margin: 0; font-size: 20px; padding: 5px 0px;">Hello '.$name.',</p>
						<p class="greet" style="color: #212121; margin: 0; font-size: 18px; padding: 5px 0px 0px 0px;">Greetings for the day!</p><br>
						<p style="color: #212121; margin: 0; padding: 0;">Congratulations you have successfully submitted your application for participating in IAS Talent Search 2018 through IAS-Scholarship Entrance Entrance Test as a '.$c.' passout student at '.$cn.' center having Application Number: '.$appId.' for the IAS Online Application System. Your application is under scrutiny and will be approved if found in order and you will get approval mail accordingly.</p>
						<p style="color: #212121; margin: 0; padding: 0;">Visit the official website of IAS <a href="http://www.iasacademic.in">www.iasacademic.in</a> regularly for latest announcements and events.</p>	<br>
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
			$mail->addAddress($email); 
			$mail->addReplyTo('mail@iasacademic.in', 'Institute of Applied Science');

			  //Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Confirmation of Submission of Application at IAS-SETOAS';
			
			$mail->Body= $msg;
			if(!$mail->send()){
				header("Location: ../set_enroll.php?error_code=476");	
				exit();
			}
			else{
				$name=simple_crypt($name,'e');
				$appid=simple_crypt($appId,'e');
				$cen=simple_crypt($cn,'e');		
				header("Location: ../set_enroll.php?success=$name&appid=$appid&cen=$cen");
				exit();
			}		
			
		}
		catch(Exception $e){
            header("Location: ../set_enroll.php?error_code=486");	
			exit();
		}
	}
	elseif(empty($email)){
		$name=simple_crypt($name,'e');
		$appid=simple_crypt($appId,'e');
		$cen=simple_crypt($cn,'e');				
		header("Location: ../set_enroll.php?success=$name&appid=$appid&cen=$cen");
		exit();
	}
}
elseif(isset($_POST['admit'])){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$roll = mysqli_real_escape_string($conn, $_POST['roll']);


	if(empty($email) || empty($roll)){
		header("Location: ../set_admit.php?empty");	
		exit();
	}

	$sql = "select * from sett where set_rollNo='$roll' and set_email='$email' and set_admitStatus=1";
	$res = mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($res);
	$check = mysqli_num_rows($res);
	if($check != 1){
		header("Location: ../set_admit.php?error=618");	
		exit();
	}
	else{
		header("Location: ../admin/SET_admit.php?id=".$row['id']);	
		exit();
	}


}