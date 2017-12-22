<?php

session_start();

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
		echo $resultCheck;
		if($resultCheck < 1)
		{
			header("Location: ../login.php?login=error1");
			exit();
		}
		else{
			if($row = mysqli_fetch_assoc($result))
			{
				$hashedPwdCheck = password_verify($pwd, $row['stu_password']);
				if($hashedPwdCheck == false)
				{
					header("Location: ../login.php?login=error2");
					exit();
				}
				elseif($hashedPwdCheck == true)
				{
					//Login the user here
					$_SESSION['student_id'] = $row['stu_id'];
					header("Location: ../profile.php");
					exit();
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