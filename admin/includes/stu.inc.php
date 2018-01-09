<?php
	session_start();
	require_once('../../includes/dbh.inc.php');
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	if(isset($_POST['approve']) || isset($_POST['approve_stu']))
	{
		
		$query= "Update students set stu_approvalstatus=1 where stu_email = '$email'";		
		if(mysqli_query($conn,$query)){
		
			if(isset($_POST['approve_stu'])){
				header("Location: ../students.php?saprv='$name'");	
			}
			else{
				header("Location: ../admin.php?saprv='$name'");	
			}
		}
		else{
			if(isset($_POST['approve_stu'])){
				header("Location: ../students.php?err");	
			}
			else{
				header("Location: ../admin.php?err");	
			}
		}
	}
	
	if(isset($_POST['deny']) || isset($_POST['deny_stu']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "Update students set stu_approvalstatus=2 where stu_email = '$email'";	
		if(mysqli_query($conn,$query))
		{
			if(isset($_POST['deny_stu'])){
				header("Location: ../students.php?sdny='$name'");	
			}
			else{
				header("Location: ../admin.php?sdny='$name'");	
			}
		}
		else{
			if(isset($_POST['deny_stu'])){
				header("Location: ../students.php?err");	
			}
			else{
				header("Location: ../admin.php?err");	
			}
		}
		
	}
	
	