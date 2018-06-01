<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();


include '../../includes/dbh.inc.php';

include '../../includes/simple-crypt.inc.php';

if(isset($_POST['submit'])) 
{
	
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);		
	
	echo$uid.$pwd;
	
	//Error Handlers
	if(empty($uid) || empty($pwd)) 
	{
		header("Location: ../admin_login.php?login=empty");
		exit();
	} 
	else
	{
		$sql = "select * from admin where admin_uid = '$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1)
		{	
			$encryptmail = simple_crypt( $uid, 'e' );
			header("Location: ../login.php?m=$encryptmail&l=er");
			exit();
		}
		else
		{
			if($row = mysqli_fetch_assoc($result))
			{
				//$hashedPwdCheck = password_verify($pwd, $row['admin_password']);
				if($pwd != $row['admin_password'])
				{
					$mail= simple_crypt( $uid, 'e' );
					header("Location: ../admin_login.php?m=$mail&l=pdm");
					exit();
				}
				elseif($pwd == $row['admin_password'] /*$hashedPwdCheck == true*/)
				{
					//Login the user here
					
					$_SESSION['admin'] = $uid;
					header("Location: ../admin.php");
					exit();
					
				}
			}
				
			
		}
	}
}
	

else 
{
	header("Location: ../admin_login.php?login=error");
	exit();
}	