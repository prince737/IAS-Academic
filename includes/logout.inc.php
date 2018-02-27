<?php
	if(isset($_POST['logout']))
	{
		session_start();
		
		setcookie('student', "", time()-(60*60*24*30), '/');
		session_unset();
		session_destroy();
		
		if(isset($_SERVER['HTTP_REFERER'])) {
		 header('Location: '.$_SERVER['HTTP_REFERER']);  
		} else {
		 header('Location: index.php');  
		}
		exit();
	}