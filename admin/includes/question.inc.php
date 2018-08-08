<?php
	session_start();
	include_once '../../includes/dbh.inc.php';

	$question_desc = mysqli_real_escape_string($conn, $_POST['question_desc']);
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);
	$qdir = mysqli_real_escape_string($conn, $_POST['qdir']);


	if($qtype=='0'){
		$cdltype = mysqli_real_escape_string($conn, $_POST['cdltype']);
		$cdlid = mysqli_real_escape_string($conn, $_POST['cdlid']);
		$cdldir = mysqli_real_escape_string($conn, $_POST['cdldir']);

		if($cdltype=='mcq'){
			$cdlmcq_option = mysqli_real_escape_string($conn, $_POST['cdlmcq_option']);
			$cdlmcq_ans = mysqli_real_escape_string($conn, $_POST['cdlmcq_ans']);

			if(empty($cdlmcq_option)){
				$data = array(
		        	"msg"     => "Please Fill in the Number of options Field".$cdlid,
		    	);
			}
			elseif(empty($cdlmcq_ans)){
				$data = array(
		        	"msg"     => "Please Fill in the Correct answer Field".$cdlid,
		    	);
			}
			else{
				$sql = "insert into mcq(mcq_statement, mcq_options,mcq_answer, mcq_type, mcq_directory, mcq_ifcdl, mcq_cdlid) values('$question_desc',$cdlmcq_option,'$cdlmcq_ans','MCQ','$cdldir', 1, $cdlid)";
				if(!mysqli_query($conn,$sql)){
					$data = array(
		            	"msg"     => "Something wwrong, Please try again.",
		            	"cdlquestion"  => "true",
		        	);
				}
				else{
					$data = array(
		            	"msg"     => "Mcq was successfully added for cdl data.",
		            	"cdlquestion"  => "true",
		        	);
				}
			}			
		}
		elseif($cdltype=='nat'){
			$cdlnat_ans = mysqli_real_escape_string($conn, $_POST['cdlnat_ans']);
			if(empty($cdlnat_ans)){
				$data = array(
		        	"msg"     => "Please Fill in the Correct Answer Field".$cdlid,
		    	);
			}
			else{
				$sql = "insert into nat(nat_statement, nat_answer, nat_directory, nat_ifcdl, nat_cdlid) values('$question_desc','$cdlnat_ans','$cdldir',1,$cdlid)";
				if(!mysqli_query($conn,$sql)){
					$data = array(
		            	"msg"     => "Something wwrong, Please try again.",
		            	"cdlquestion"  => "true",
		        	);
				}
				else{
					$data = array(
		            	"msg"     => "NAT was successfully added for cdl data.",
		            	"cdlquestion"  => "true",
		        	);
				}
			}
			
		}
		
	    echo json_encode($data);
	}
	elseif($qtype == 'MCQ'){
		if($qdir=='0'){
			$data = array(
	           	"msg"     => "Something went wrong, Please try again.",
	        );
			exit();
		}
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
	            	"msg"     => "Question was successfully added to Directory having Id ",
	        	);
			}			
		}
		echo json_encode($data);
	}
	elseif($qtype == 'NAT'){
		if($qdir=='0'){
			$data = array(
	           	"msg"     => "Something went wrong, Please try again.",
	        );
			exit();
		}
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
	            	"msg"     => "Question was successfully added to Directory having Id ",
	        	);
			}	
		}
		echo json_encode($data);
	}
	elseif($qtype == 'CDL'){
		if($qdir=='0'){
			$data = array(
	           	"msg"     => "Something went wrong, Please try again.",
	        );
			exit();
		}
		$sql = "insert into cdl(cdl_statement, cdl_directory) values('$question_desc','$qdir')";
		if(!mysqli_query($conn,$sql)){
			$data = array(
            	"msg"     => " went wrong, Please try again.".mysqli_error($conn),
        	);
		}
		else{
			$sql = "select * from cdl where cdl_id=(select max(cdl_id) as id from cdl)";
			$res=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($res);

			$data = array(
            	"msg"     => "CDL data was successfully added to directory. You can now proceed to adding related questions.",
            	"cdl_id" => $row['cdl_id'],
            	"cdl_dir" => $row['cdl_directory'],
            	"cdl_statement" => $row['cdl_statement']
        	);
		}
		echo json_encode($data);
	}
	elseif($qtype == 'MAMCQ'){
		if($qdir=='0'){
			$data = array(
	           	"msg"     => "Something went wrong, Please try again.",
	        );
			exit();
		}
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
	            	"msg"     => "Question was successfully added to Directory having Id ",
	        	);
			}
		}
		echo json_encode($data);
	}
