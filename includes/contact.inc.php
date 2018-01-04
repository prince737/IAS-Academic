<?php
	/*echo date("Y-m-d h:i:s a");
	echo date('m/d/Y h:i:s', time());*/
	date_default_timezone_set("Asia/Kolkata");
	
	if(isset($_POST['qsubmit'])){
		include_once 'dbh.inc.php';
		
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$message = mysqli_real_escape_string($conn, $_POST['message']);
		$date = date('m/d/Y');
		$time = date("h:i a");
		
		
		$sql = "insert into queries (q_email, q_phone, q_name, q_message, q_date, q_time) values ('$email', '$phone', '$name', '$message', '$date', '$time')";
		mysqli_query($conn, $sql);
		header("Location: ../index.php?qs=1#contact");
		exit();
		
	}
	
	if(isset($_POST['submit'])){
		include_once 'dbh.inc.php';
		
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$message = mysqli_real_escape_string($conn, $_POST['message']);
		$date = date('m/d/Y');
		$time = date("h:i a");
		
		
		$sql = "insert into queries (q_email, q_phone, q_name, q_message, q_date, q_time) values ('$email', '$phone', '$name', '$message', '$date', '$time')";
		mysqli_query($conn, $sql);
		header("Location: ../gallery.php?qs=1#contact");
		exit();
		
	}