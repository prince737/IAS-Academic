<?php

	require_once('../../includes/dbh.inc.php');
	
	if(isset($_POST['approve']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query= "Update students set stu_approvalstatus=1 where stu_email = '$email'";		
		if(mysqli_query($conn,$query))
		{
			echo "success";
		}
		else{
			echo "fail";
		}
	}
	
	if(isset($_POST['deny']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "Insert into denied_students select * from students where stu_email = '$email'";	
		if(mysqli_query($conn,$query))
		{
			echo "success";
		}
		else{
			echo "fail";
		}
		$query = "delete from students where stu_email = '$email'";
		if(mysqli_query($conn,$query))
		{
			echo "success";
		}
		else{
			echo "fail";
		}
		
	}
	
	