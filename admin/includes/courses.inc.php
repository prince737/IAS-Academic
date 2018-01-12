<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['update-course'])){
	
	$course_type= mysqli_real_escape_string($conn, $_POST['ctype']);
	$course_name= mysqli_real_escape_string($conn, $_POST['cname']);
	$course_desc= mysqli_real_escape_string($conn, $_POST['cdesc']);
	$course_id= mysqli_real_escape_string($conn, $_POST['cid']);
	foreach ($_POST['classes'] as $selected){
		$classes[]= $selected;		
	}
	
	foreach ($_POST['centers'] as $selected){
		$centers[]= $selected;		
	}
	
	$query = "update courses set course_id = $course_id, course_type='$course_type', course_name='$course_name', course_description='$course_desc' where course_id='$course_id'";
	if(mysqli_query($conn, $query)){
		$del="delete from course_edu where course_id=$course_id";
		mysqli_query($conn, $del);
		foreach ($classes as $class){
			$insertQuery= "insert into course_edu(course_id, edu) values($course_id, '$class')";			
			if(!mysqli_query($conn, $insertQuery)){
				header("Location: ../update_course.php?err");
				exit();
			}	
		}
		
		$del="delete from course_center where course_id=$course_id";
		mysqli_query($conn, $del);
		foreach ($centers as $center){
			$query = "select center_id from centers where center_name='$center'";
			$res=mysqli_query($conn,$query);
			while($row = mysqli_fetch_array($res)){
				$center_id = $row['center_id'];
				$insertQuery= "insert into course_center(course_id, center_id) values($course_id, $center_id)";			
				if(!mysqli_query($conn, $insertQuery)){
					header("Location: ../update_course.php?err2");
					exit();
				}				
			}
		}
		
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
	$i=20;
	$query1;
	foreach ($_POST['classes'] as $selectedOption){
		$classes= $_POST['classes'];
		global $query1;
		$query1.= $i.'='.$selectedOption.'&';
		$i++;
	}
	
	foreach ($_POST['centers'] as $selectedOption){
		$centers= $_POST['centers'];
		
	}
	
	
	$query = "select * from courses where course_id = '$course_id'";
	$result = mysqli_query($conn,$query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		$query = http_build_query($centers);
		$limit= sizeof($centers);			
		$climit= sizeof($classes);
		global $query1;
		$query1 = rtrim($query1, '&');
		header("Location: ../add_course.php?crsExt&climit=$climit&$query1&limit=$limit&$query&tp=$course_type&nm=$course_name&id=$course_id&desc=$course_desc");
		exit();
	}
	else{
		$query= "select * from courses where course_type='$course_type'";
		$result = mysqli_query($conn,$query);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck < 1 && !isset($_POST['add-course1'])){
			$query = http_build_query($centers);
			$limit= sizeof($centers);
			
			
			$climit= sizeof($classes);
			global $query1;
			$query1 = rtrim($query1, '&');
			
			header("Location: ../add_course.php?crsTPnA&climit=$climit&$query1&limit=$limit&$query&tp=$course_type&nm=$course_name&id=$course_id&desc=$course_desc");
			exit();
		}
		else{
			$query = "insert into courses(course_id, course_name, course_type, course_description) values($course_id, '$course_name', '$course_type', '$course_desc')";
			mysqli_query($conn,$query);
			
			foreach ($_POST['centers'] as $selected){
				$query="select center_id from centers where center_name='$selected'";
				$result=mysqli_query($conn,$query);
				
				while($row = mysqli_fetch_array($result)){
					$center_id=$row['center_id'];
					$query= "insert into course_center(course_id, center_id) values($course_id, $center_id)";
					mysqli_query($conn,$query);
				}
			}
			foreach ($classes as $selected){	
				$query="insert into course_edu(course_id, edu) values($course_id, '$selected')";
				mysqli_query($conn,$query);
			}
			header("Location: ../add_course.php?success");
			exit();
			
		}
	}	
}