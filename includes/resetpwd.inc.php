<?php

	session_start();
	
	include 'dbh.inc.php';

	include 'simple-crypt.inc.php';
	echo 'dd';
	
	if(isset($_POST['submit'])){
		echo 'dd';
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$email = simple_crypt( $email, 'd' );
		$token = mysqli_real_escape_string($conn, $_POST['token']);
		
		echo $token;
		echo $email;
		
		$sql = "select * from students where stu_email='$email' and stu_token='$token';" ;
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		echo $resultCheck;
		if($resultCheck == 1) 
		{
			 
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			$query = "update students set stu_password='$hashedPwd' where stu_email='$email' and stu_token='$token';";
			if(!mysqli_query($conn, $query)){
				header("Location: ../resetPassword.php?err");
				exit();
			}
			else{
				$query = "update students set stu_token='' where stu_email='$email'";
				mysqli_query($conn, $query);
				header("Location: ../login.php?ERxpchdYYzU");
				exit();
			}
		} 
	}
	else{
		header("Location: ../resetPassword.php?empty");
		exit();
	}

	