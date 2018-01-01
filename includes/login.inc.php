<?php

session_start();

include 'simple-crypt.inc.php';

if(isset($_POST['submit'])) 
{
	include 'dbh.inc.php';
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);	
	
	
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
				if($row['stu_approvlstatus'] == 0 ){
					header("Location: ../login.php?l=na");
					exit();
				}
				else
				{
					$hashedPwdCheck = password_verify($pwd, $row['stu_password']);
					if($hashedPwdCheck == false)
					{
						$mail= $row['stu_email'];
						header("Location: ../login.php?m=$mail&l=pdm");
						exit();
					}
					elseif($hashedPwdCheck == true)
					{
						//Login the user here
						$_SESSION['student'] = $row;
						header("Location: ../profile.php");
						exit();
					}
				}
				
			}
		}
	}
}
else 
{
	header("Location: ../login.php?login=error");
	exit();
}	