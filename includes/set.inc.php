<?php


session_start();
include_once 'dbh.inc.php';
include 'simple-crypt.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	
	//Load composer's autoloader
require '../vendor/autoload.php';
include_once '../includes/dbh.inc.php';

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

	if(empty($name) || empty($gname) || empty($exam) || empty($board) || empty($center) || empty($sname) || empty($address) || empty($email) || empty($contact) || empty($wp) || empty($language)){
		header("Location: ../set_enroll.php?error_code=676");	
		exit();
	}
	
	$query="select * from sett where set_email='$email'";
	$res=mysqli_query($conn,$query);
	$count=mysqli_num_rows($res);
	if($count>0){
		header("Location: ../set_enroll.php?error_code=576");	
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
		$roll+=1;
		$appId .= '000'.$roll;
	}
	else{
		$appId .= '0001';
	}
	
	
	
	
	$query = "insert into sett(set_no, set_applicationNo, set_name, set_gname, set_finalExam, set_board, set_center, set_school, set_address, set_email, set_contact, set_wp, set_language, set_year) values($temp, '$appId', '$name', '$gname', '$exam', '$board', $center, '$sname', '$address', '$email', '$contact', '$wp', '$language', $year)";
	echo $query;
	
	if(mysqli_query($conn,$query)){
		
			
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
			$mail->Body    = '';
			if(!$mail->Send()){
                header("Location: ../set_enroll.php?error_code=476");	
				exit();
            }
			else{
				$name=simple_crypt($name,'e');
				$appid=simple_crypt($appId,'e');									
				
				header("Location: ../set_enroll.php?success=$name&&appid=$appid");	
				exit();
			}
			
		}
		catch(Exception $e){
            header("Location: ../set_enroll.php?error_code=476");	
			exit();
		}
	}
	else{
		header("Location: ../set_enroll.php?error_code=476");	
		exit();
	}
}
