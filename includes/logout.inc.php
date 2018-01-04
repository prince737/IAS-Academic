<?php
	if(isset($_POST['logout']))
	{
		session_start();
		
		setcookie('student', "", time()-(60*60*24*30), '/');
		session_unset();
		session_destroy();
		
		header("Location: ../login.php");
	}