<?php

	session_start();
	include_once '../../includes/dbh.inc.php';
	
	if(isset($_POST['approve-update'])){ //profile update
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
	elseif(isset($_POST['approve-course'])){ //course update approval
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$newcid = mysqli_real_escape_string($conn, $_POST['newValue']);
		$oldcid = mysqli_real_escape_string($conn, $_POST['oldValue']);
		
		
		
		$query ="select * from students where stu_id=$id";
		$res=mysqli_query($conn, $query);
		$row=mysqli_fetch_array($res);
		
		if($row['cid'] === $oldcid){
			$reg=substr_replace($row['stu_registrationNo'],$newcid,9,3);
			echo $reg;
			$sql="update students set stu_registrationNo='$reg' where stu_id=$id";
			if(!mysqli_query($conn, $sql)){
				header("Location: ../change-requests.php?err");
				exit();
			}
			
			
		}
		else{
			$query ="select * from students_courses where stu_id=$id AND course_id=$oldcid";
			$res=mysqli_query($conn, $query);
			$row=mysqli_fetch_array($res);
			
			$reg=substr_replace($row['registration_no'],$newcid,9,3);
			$sql="update students_courses set registration_no='$reg' where stu_id=$id AND course_id=$oldcid";
			if(!mysqli_query($conn, $sql)){
				header("Location: ../change-requests.php?err");
				exit();
			}
		}		
		
		$query = "update course_change set change_status = 1 where student_id=$id AND old_course_id=$oldcid AND new_course_id=$newcid";
		if(!mysqli_query($conn, $query)){
			header("Location: ../change-requests.php?err");
			exit();
		}
		else{
			header("Location: ../change-requests.php?update_success");
			exit();
		}
	}
	elseif(isset($_POST['deny_course'])){ //course update denial
		
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$newcid = mysqli_real_escape_string($conn, $_POST['newValue']);
		$oldcid = mysqli_real_escape_string($conn, $_POST['oldValue']);
	
		$query = "update course_change set change_status = 2 where student_id=$id AND old_course_id=$oldcid AND new_course_id=$newcid";
		if(!mysqli_query($conn, $query)){
			header("Location: ../change-requests.php?err");
			exit();
		}
		else{
			header("Location: ../change-requests.php?update_denied");
			exit();
		}
	
	}