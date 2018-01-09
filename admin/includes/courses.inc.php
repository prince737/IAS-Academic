<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['update-course'])){
	
	$course_type= mysqli_real_escape_string($conn, $_POST['ctype']);
	$course_name= mysqli_real_escape_string($conn, $_POST['cname']);
	$course_desc= mysqli_real_escape_string($conn, $_POST['cdesc']);
	$course_id= mysqli_real_escape_string($conn, $_POST['cid']);
	
	$query= "select * from courses where course_type='$course_type'";
	$result = mysqli_query($conn,$query);
	$resultCheck = mysqli_num_rows($result);
	
	$query = "update courses set course_id = $course_id, course_type='$course_type', course_name='$course_name', course_description='$course_desc' where course_id='$course_id'";
	if(mysqli_query($conn, $query)){
		header("Location: ../update_course.php?success");
		exit();
	}else{
		header("Location: ../update_course.php?err");
		exit();
	
	}
	
	
}

if(isset($_POST['add-course']) || isset($_POST['add-course1'])){
	
	$course_type= mysqli_real_escape_string($conn, $_POST['ctype']);
	$course_name= mysqli_real_escape_string($conn, $_POST['cname']);
	$course_desc= mysqli_real_escape_string($conn, $_POST['cdesc']);
	$course_id= mysqli_real_escape_string($conn, $_POST['cid']);
	
	$query = "select * from courses where course_id = '$course_id'";
	$result = mysqli_query($conn,$query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		header("Location: ../add_course.php?crsExt&tp=$course_type&nm=$course_name&id=$course_id&desc=$course_desc");
		exit();
	}
	else{
		$query= "select * from courses where course_type='$course_type'";
		$result = mysqli_query($conn,$query);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1 && !isset($_POST['add-course1'])){
			header("Location: ../add_course.php?crsTPnA&tp=$course_type&nm=$course_name&id=$course_id&desc=$course_desc");
			exit();
		}
		else{
			$query = "insert into courses(course_id, course_name, course_type, course_description) values($course_id, '$course_name', '$course_type', '$course_desc')";
			if(mysqli_query($conn, $query)){
				header("Location: ../add_course.php?success");
				exit();
			}else{
				header("Location: ../add_course.php?err");
				exit();
			}
		}
	}	
}