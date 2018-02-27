<?php

	session_start();
	include_once '../../includes/dbh.inc.php';
	
	if(isset($_POST['approve_add'])){ //profile update
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$courseid = mysqli_real_escape_string($conn, $_POST['course']);
		$centerid = mysqli_real_escape_string($conn, $_POST['center']);
		
		
		
		$query="update add_course set add_status=1 where student_id=$id AND course_id=$courseid AND center_id=$centerid;";
		if(!mysqli_query($conn,$query)){
			header("Location: ../course_add_requests.php?err");
			exit();
		}
		else{
			//SETTING REGISTRATION NUMBER
			
			$regNo = '9119';
			
			//selecting center number
			
			$regNo .= '0'.$centerid;
				
							
			$date = substr_replace(date('Y'), '', 1, 1);
			$regNo .= $date;
			
			//Selecting course number
			
			$regNo .= $courseid;
				
			
			//Student registration no Generation
			$query = "select max(registration_no) as max from students_courses where center_id=$centerid and course_id = $courseid";
			$result = mysqli_query($conn, $query);
			$resultCheck = mysqli_num_rows($result);
			
			
			$row= mysqli_fetch_array($result);
			if($row['max'] != ''){
				$year = substr($row['max'], 6, 3);
				if($date > $year){
					$regNo .= '001';
				}
				else{
					$roll1 = substr($row['max'], -3);
					$roll1 = str_pad($roll1 + 1,3,"0",STR_PAD_LEFT);
					$regNo .= $roll1;
				}
			}	
			else{
				$regNo .= '001';
			}
			
			echo $regNo;
			
			$query="insert into students_courses(student_id,course_id,center_id,registration_no) values($id, $courseid, $centerid, $regNo)";
			if(!mysqli_query($conn,$query)){				
				$query="update add_course set add_status=0 where student_id=$id AND course_id=$courseid AND center_id=$centerid;";
				mysqli_query($conn,$query);
				header("Location: ../course_add_requests.php?err");
				exit();
			}
			else{
				
				//Emailing goes here
				
				header("Location: ../course_add_requests.php?success");
				exit();
			}
		}
	}
	elseif(isset($_POST['deny_add'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$courseid = mysqli_real_escape_string($conn, $_POST['course']);
		$centerid = mysqli_real_escape_string($conn, $_POST['center']);
		
		$query="update add_course set add_status=2 where student_id=$id AND course_id=$courseid AND center_id=$centerid;";
		if(!mysqli_query($conn,$query)){
			header("Location: ../course_add_requests.php?errrrr");
			exit();
		}
		else{
			
			//Emailing goes here
			
			header("Location: ../course_add_requests.php?add_denied");
			exit();
		}
	}