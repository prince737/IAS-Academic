<?php
	session_start();
	date_default_timezone_set("Asia/Kolkata");

	include_once '../../includes/dbh.inc.php';

	//Polupating paper data
	if(isset($_POST['flag'])){
		$pid= mysqli_real_escape_string($conn, $_POST['pid']);

		$sql = "select * from papers where qpid='$pid'";
		$res=mysqli_query($conn, $sql);
		$row=mysqli_fetch_array($res);
		$data = array(
		    "level"     => $row['qp_level'],
		    "marks"     => $row['qp_fullmarks']
		);
		echo json_encode($data);
	}
	else if(isset($_POST['save_exam'])){
		$title= mysqli_real_escape_string($conn, $_POST['exam_title']);
		$pid= mysqli_real_escape_string($conn, $_POST['pid']);
		$type= mysqli_real_escape_string($conn, $_POST['exam_type']);
		$time= mysqli_real_escape_string($conn, $_POST['exam_time']);
		$cal= mysqli_real_escape_string($conn, $_POST['exam_cal']);
		$nega= mysqli_real_escape_string($conn, $_POST['exam_nega']);
		$standard= mysqli_real_escape_string($conn, $_POST['exam_standard']);

		$date = date("d/m/Y");
		$id = 'EX'.date("d").date("m").date("Y");

		$sql = "select max(substr(exam_id,11,3)) as max from exams";
		$res=mysqli_query($conn, $sql);
		$check=mysqli_num_rows($res);
		if($check < 1){
			$id .= '001';
		}
		else{
			$row=mysqli_fetch_array($res);
			$id .= str_pad($row['max'] + 1, 3, 0, STR_PAD_LEFT);
		}

		$sql = "insert into exams(exam_id, exam_title, exam_type, exam_standard, exam_time, exam_nega, exam_cal, paper_id) values('$id', '$title', '$type', '$standard', '$time', '$nega', '$cal', '$pid')";
		if(!mysqli_query($conn, $sql)){
			header("Location: ../create_exam.php?err");	
			exit();
		}
		else{
			header("Location: ../create_exam.php?id='$id'");	
			exit();
		}
	}

	else if(isset($_POST['edit_exam'])){
		echo 'here';
		$title= mysqli_real_escape_string($conn, $_POST['exam_title']);
		$type= mysqli_real_escape_string($conn, $_POST['exam_type']);
		$time= mysqli_real_escape_string($conn, $_POST['exam_time']);
		$cal= mysqli_real_escape_string($conn, $_POST['exam_cal']);
		$nega= mysqli_real_escape_string($conn, $_POST['exam_nega']);
		$eid= mysqli_real_escape_string($conn, $_POST['exid']);
		$standard= mysqli_real_escape_string($conn, $_POST['exam_standard']);

		$sql = "update exams set exam_title = '$title', exam_type='$type', exam_time = '$time', exam_cal='$cal', exam_nega='$nega', exam_standard='$standard' where exam_id = '$eid'";
		if(!mysqli_query($conn, $sql)){
			header("Location: ../exams.php?err");	
			exit();
		}
		else{
			header("Location: ../exams.php?id='$id'&update=1");	
			exit();
		}
	}

	else if(isset($_POST['publish_exam'])){
		$starts= mysqli_real_escape_string($conn, $_POST['starts']);
		$eid= mysqli_real_escape_string($conn, $_POST['eid']);
		$ends= mysqli_real_escape_string($conn, $_POST['ends']);
		
		foreach ($_POST['courses'] as $selected){
			$courses[]= $selected;		
		}

		$starts = strtotime($starts);
		$starts = date('Y/m/d H:i:s', $starts);

		$ends = strtotime($ends);
		$ends = date('Y/m/d H:i:s', $ends);

		$sql = "update exams set exam_start = '$starts', exam_end='$ends', exam_status=1 where exam_id = '$eid'";
		if(!mysqli_query($conn, $sql)){
			header("Location: ../exams.php?err");	
			exit();
		}
		else{
			foreach ($courses as $course){
				$insertQuery= "insert into exam_course(exam_id, course_id) values('$eid', $course)";			
				if(!mysqli_query($conn, $insertQuery)){
					header("Location: ../exams.php?err");
					exit();
				}	
			}
			header("Location: ../exams.php?id='$id'&publish=1");	
			exit();
		}
	}

	else if(isset($_POST['delete_exam'])){
		$eid= mysqli_real_escape_string($conn, $_POST['exmid']);
		$sql = "delete from exams where exam_id = '$eid'";
		if(!mysqli_query($conn, $sql)){
			header("Location: ../exams.php?err");	
			exit();
		}
		else{
			header("Location: ../exams.php?id='$id'&delete=1");	
			exit();
		}
	}

	else if(isset($_POST['remove_exam'])){
		$eid= mysqli_real_escape_string($conn, $_POST['xmid']);

		$ends = date("Y/m/d H:i:s");

		$sql = "update exams set exam_status = 2, exam_end='$ends' where exam_id='$eid'";

		if(!mysqli_query($conn, $sql)){
			header("Location: ../exams.php?err");	
			exit();
		}
		else{
			header("Location: ../exams.php?id='$id'&remove=1");	
			exit();
		}
	}
