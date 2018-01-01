<?php
	session_start();
	require_once('../../includes/dbh.inc.php');
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	if(isset($_POST['approve']))
	{
		
		$query= "Update students set stu_approvalstatus=1 where stu_email = '$email'";		
		if(mysqli_query($conn,$query))
		{
			header("Location: ../admin.php?saprv='$name'");	
		}
		else{
			header("Location: ../admin.php?err");	
		}
	}
	
	if(isset($_POST['deny']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "Update students set stu_approvalstatus=2 where stu_email = '$email'";	
		if(mysqli_query($conn,$query))
		{
			header("Location: ../admin.php?sdny=$name");	
		}
		else{
			echo "fail";
		}
		
	}
	
	