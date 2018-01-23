<?php

	session_start();
	include_once '../../includes/dbh.inc.php';
	
	if(isset($_POST['approve-update'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$attr = mysqli_real_escape_string($conn, $_POST['attr']);
		$newVal = mysqli_real_escape_string($conn, $_POST['newValue']);
		
		$query = "update students set ".$attr." = '$newVal' where stu_id=$id";
		if(!mysqli_query($conn, $query)){
			
			header("Location: ../students_profile.php?err");
			exit();
		}
		else{
			$query = "update student_profile_update set spu_status=1 where student_id=$id AND spu_field='$attr'";
			echo $query;
			if(!mysqli_query($conn, $query)){
				header("Location: ../students_profile.php?err1");
				exit();
			}
			else{
				header("Location: ../students_profile.php?update_success");
				exit();
			}
		}
	}