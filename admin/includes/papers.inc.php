<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['save_paper'])){
	$name= mysqli_real_escape_string($conn, $_POST['paper_name']);
	$marks= mysqli_real_escape_string($conn, $_POST['paper_marks']);
	$level= mysqli_real_escape_string($conn, $_POST['paper_level']);
	$standard= mysqli_real_escape_string($conn, $_POST['paper_standard']);

	$date = date("d/m/Y");
	$id = 'QP'.date("d").date("m").date("Y");

	$sql = "select max(substr(qpid,11,3)) as max from question_paper";
	$res=mysqli_query($conn, $sql);
	$check=mysqli_num_rows($res);
	if($check < 1){
		$id .= '001';
	}
	else{
		$row=mysqli_fetch_array($res);
		$id .= str_pad($row['max'] + 1, 3, 0, STR_PAD_LEFT);
	}

	$sql = "insert into question_paper(qpid, qp_name, qp_fullmarks, qp_level, qp_standard, qp_date) values('$id', '$name', $marks, '$level', '$standard', '$date')";
	if(!mysqli_query($conn, $sql)){
		header("Location: ../create_paper.php?err");	
		exit();
	}
	else{
		header("Location: ../create_paper.php?id='$id'");	
		exit();
	}
}

if(isset($_POST['edit_paper'])){
	$name= mysqli_real_escape_string($conn, $_POST['paper_name']);
	$marks= mysqli_real_escape_string($conn, $_POST['paper_marks']);
	$level= mysqli_real_escape_string($conn, $_POST['paper_level']);
	$standard= mysqli_real_escape_string($conn, $_POST['paper_standard']);
	$qpid= mysqli_real_escape_string($conn, $_POST['qpid']);

	echo $name;

	$sql = "update question_paper set qp_name='$name', qp_level='$level', qp_fullmarks=$marks, qp_standard='$standard' where qpid='$qpid'";
	if(!mysqli_query($conn, $sql)){
		header("Location: ../papers.php?err");	
		exit();
	}
	else{
		header("Location: ../papers.php?success'");	
		exit();
	}
}