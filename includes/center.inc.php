<?php

session_start();
include 'dbh.inc.php';

if(isset($_POST['radio']) && !isset($_POST['center_change'])){
	$radio = mysqli_real_escape_string($conn, $_POST['radio']);
	
	header("Location: ../change_course.php?radioc=$radio#center");
	exit();	
}
elseif(isset($_POST['center_change'])){	
	$course = mysqli_real_escape_string($conn, $_POST['radio']);
	$center = mysqli_real_escape_string($conn, $_POST['center']);
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	
	
	$query="select center_id from students_courses where student_id=$id AND course_id=$course AND registration_no IS NOT NULL";
	$res=mysqli_query($conn, $query);
	$count=mysqli_num_rows($res);
	$row = mysqli_fetch_array($res);
	$oldcid=$row['center_id'];
	
	
	$query = "select * from center_change where old_center_id=$oldcid AND course_id=$course AND student_id=$id";
	$res = mysqli_query($conn,$query);
	$check = mysqli_num_rows($res);
	
	if($check > 0){
		$query = "delete from center_change where old_center_id=$oldcid AND course_id=$course AND student_id=$id";
		if(!mysqli_query($conn,$query)){
			header("Location: ../change_course.php?err1");
			exit();
		}		
	}
	
	
	$query = "insert into center_change(student_id, course_id, old_center_id, new_center_id) values($id, $course, $oldcid, $center)";
	if(!mysqli_query($conn,$query)){
		header("Location: ../change_course.php?err");
		exit();
	}
	else{
		header("Location: ../change_course.php?centerQueued=1");
		exit();
	}
	
}	

elseif(isset($_POST['rmvReq'])){
	
	$id= mysqli_real_escape_string($conn, $_POST['id']);
	$newcen =mysqli_real_escape_string($conn, $_POST['newcen']);
	$oldcen =mysqli_real_escape_string($conn, $_POST['oldcen']);
	$cor =mysqli_real_escape_string($conn, $_POST['cor']);
	
	
	$query="select center_name from centers where center_id=$oldcen";
	$res=mysqli_query($conn, $query);
	$row=mysqli_fetch_array($res);
	$name=$row['center_name'];
	
	$query="delete from center_change where student_id=$id AND old_center_id=$oldcen AND new_center_id=$newcen AND course_id=$cor";
	if(!mysqli_query($conn, $query)){
		header("Location: ../pending_changes.php?err");
		exit();
	}
	else{
		header("Location: ../pending_changes.php?centerrem=$name");
		exit();
	}
	
}