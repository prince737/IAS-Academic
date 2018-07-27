<?php
	session_start();
	include_once '../../includes/dbh.inc.php';

	$question_desc = $_POST['question_desc'];
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);
	$qdir = mysqli_real_escape_string($conn, $_POST['qdir']);

	if($qdir=='0'){
		echo 'Please select a directory.';
		exit();
	}

	if($qtype == 'MCQ'){
		$option_no = mysqli_real_escape_string($conn, $_POST['option_no']);
		$mcq_ans = mysqli_real_escape_string($conn, $_POST['mcq_ans']);

		if(empty($option_no))
			echo 'Please Fill in the Number of options Field';
		elseif(empty($mcq_ans))
			echo 'Please Fill in the Correct option Field';
		else{
			$sql = "insert into mcq(mcq_statement, mcq_options,mcq_answer, mcq_type, mcq_directory) values('$question_desc',$option_no,'$mcq_ans','$qtype','$qdir')";
			if(!mysqli_query($conn,$sql)){
				$data = array(
	            	"msg"     => "Something went wrong, Please try again.",
	        	);
			}
			else{
				$data = array(
	            	"msg"     => "Question was successfully added to Directory.",
	        	);
			}			
		}
		echo json_encode($data);
	}
	elseif($qtype == 'NAT'){
		$nat_ans = mysqli_real_escape_string($conn, $_POST['nat_ans']);

		if(empty($nat_ans))
			echo 'Please Fill in the Correct Answer Field';
		else{
			$sql = "insert into nat(nat_statement, nat_answer, nat_directory) values('$question_desc','$nat_ans','$qdir')";
			if(!mysqli_query($conn,$sql)){
				$data = array(
	            	"msg"     => "Something went wrong, Please try again.",
	        	);
			}
			else{
				$data = array(
	            	"msg"     => "Question was successfully added to Directory.",
	        	);
			}	
		}
		echo json_encode($data);
	}
	elseif($qtype == 'CDL'){
		$sql = "insert into cdl(cdl_statement, cdl_directory) values('$question_desc','$qdir')";
		if(!mysqli_query($conn,$sql)){
			$data = array(
            	"msg"     => "Something went wrong, Please try again.",
        	);
		}
		else{
			$sql = "select * from cdl where cdl_id=(select max(cdl_id) as id from cdl)";
			$res=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($res);

			$data = array(
            	"msg"     => "CDL data was successfully added to directory. You can now proceed to adding related questions.",
            	"cdl_id" => $row['cdl_id'],
            	"cdl_statement" => $row['cdl_statement']
        	);
		}	
		echo json_encode($data);
	}
	elseif($qtype == 'MAMCQ'){
		$moption_no = mysqli_real_escape_string($conn, $_POST['moption_no']);
		$mamcq_answers = mysqli_real_escape_string($conn, $_POST['mamcq_answers']);
		if(empty($moption_no))
			echo 'Please Fill in the Number of options Field';
		elseif(empty($mamcq_answers))
			echo 'Please Fill in the Answers Field';
		else{
			$sql = "insert into mcq(mcq_statement, mcq_options,mcq_answer, mcq_type, mcq_directory) values('$question_desc',$moption_no,'$mamcq_answers','$qtype','$qdir')";
			if(!mysqli_query($conn,$sql)){
				$data = array(
	            	"msg"     => "Something went wrong, Please try again.",
	        	);
			}
			else{
				$data = array(
	            	"msg"     => "Question was successfully added to Directory.",
	        	);
			}
		}
		echo json_encode($data);
	}
