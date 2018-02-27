<?php

	session_start();
	include_once '../../includes/dbh.inc.php';
	
	if(isset($_POST['approve-center'])){ 
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$oldid = mysqli_real_escape_string($conn, $_POST['oldValue']);
		$newid = mysqli_real_escape_string($conn, $_POST['newValue']);
		$cid = mysqli_real_escape_string($conn, $_POST['course']);
		
		$query ="select * from students_courses where student_id=$id AND course_id=$cid AND center_id=$oldid";
		$res=mysqli_query($conn, $query);
		$row=mysqli_fetch_array($res);
		$reg=substr_replace($row['registration_no'],$newid,5,1);
		
		$query="update center_change set cchange_status=1 where student_id=$id AND course_id=$cid AND old_center_id=$oldid"; 
		if(!mysqli_query($conn, $query)){
			header("Location: ../change_center.php?err");
			exit();
		}
		else{
			$query="update students_courses set registration_no=$reg, center_id=$newid where student_id=$id AND course_id=$cid AND center_id=$oldid;";
			if(!mysqli_query($conn, $query)){
				$query="update center_change set cchange_status=0 where student_id=$id AND course_id=$cid AND old_center_id=$oldid";
				mysqli_query($conn,$query);
				header("Location: ../center_change.php?err");
				exit();
			}
			else{
				
				//email here
				
				header("Location: ../change_center.php?update_success");
				exit();
			}
			
		}
	}
	elseif(isset($_POST['deny_center'])){ 
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$oldid = mysqli_real_escape_string($conn, $_POST['oldValue']);
		$newid = mysqli_real_escape_string($conn, $_POST['newValue']);
		$cid = mysqli_real_escape_string($conn, $_POST['course']);
		
		$query="update center_change set cchange_status=2 where student_id=$id AND course_id=$cid AND old_center_id=$oldid";
		if(!mysqli_query($conn, $query)){
			header("Location: ../change_center.php?err");
			exit();
		}
		else{
			
			//email here
			
			header("Location: ../change_center.php?change_denied");
			exit();
			
		}
	}