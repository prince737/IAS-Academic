<?php
	session_start();
	include 'dbh.inc.php';


	if(isset($_POST['pid']) && isset($_POST['sl_no'])){

		$sl_no = mysqli_real_escape_string($conn, $_POST['sl_no']);
		$pid = mysqli_real_escape_string($conn, $_POST['pid']);
		$arr = ['A','B','C','D','E','F','G','H'];
		$response = '';


		$sql = "select * from paper_question where paper_id = '".$pid."'";
		$res = mysqli_query($conn, $sql);
		$no_of_questions = mysqli_num_rows($res);
		
		//FIRST QUESTION
		$sql = "select * from paper_question where paper_id = '".$pid."' and sl_no=".$sl_no;
		$res = mysqli_query($conn, $sql);
		$firstq = mysqli_fetch_array($res);
		$marks = $firstq['marks'];
		if($firstq['question_type'] == 'MCQ'){
			$sql = "select * from paper_question inner join mcq on question_id=mcq_id where mcq_id = ".$firstq['question_id']." and paper_id = '".$firstq['paper_id']."'";
			$res = mysqli_query($conn, $sql);
			$firstq = mysqli_fetch_array($res);
			
			//FOR RESPONSE
			$qtype = $firstq['question_type'];
			$question_data = $firstq['mcq_statement'];
			$i = 0;
			while($i < $firstq['mcq_options']){
				$response .= '
					<div class="radio">
					  	<label style="font-size: 16px;">
					    	<input type="radio" name="options" value="'.$arr[$i].'">
					    	'.$arr[$i].'
					  	</label>
					</div><br>
				';
				$i++;
			}
		}
		else if($firstq['question_type'] == 'MMC'){
			$sql = "select * from paper_question inner join mcq on question_id=mcq_id where mcq_id = ".$firstq['question_id']." and paper_id = '".$firstq['paper_id']."'";
			$res = mysqli_query($conn, $sql);
			$firstq = mysqli_fetch_array($res);

			//FOR RESPONSE
			$qtype = 'MMCQ';
			$question_data = $firstq['mcq_statement'];
			$i = 0;
			while($i < $firstq['mcq_options']){
				$response .= '
					<div class="checkbox">
					    <label>
					        <input type="checkbox" value="'.$arr[$i].'" name="option">
					        '.$arr[$i].'
					    </label>
					</div><br>
				';
				$i++;
			}
		}
		else if($firstq['question_type'] == 'NAT') {
			$sql = "select * from paper_question inner join nat on question_id=nat_id where nat_id = ".$firstq['question_id']." and paper_id = '".$firstq['paper_id']."'";
			$res = mysqli_query($conn, $sql);
			$firstq = mysqli_fetch_array($res);

			//FOR RESPONSE
			$qtype = $firstq['question_type'];
			$question_data = $firstq['nat_statement'];
			$response = '
				<div class="form-group">
			    <input style="width:250px;" type="text" name="nat_answer" class="form-control" id="nat_ans" placeholder="Answer">
				</div>
				<div class="numpad">
				<button class="btn btn-default numbtn" id="one">1</button>
					<button class="btn btn-default numbtn" id="two">2</button>
					<button class="btn btn-default numbtn" id="three">3</button><br>
					<button class="btn btn-default numbtn" id="four">4</button>
					<button class="btn btn-default numbtn" id="five">5</button>
					<button class="btn btn-default numbtn" id="six">6</button><br>
					<button class="btn btn-default numbtn" id="seven">7</button>
					<button class="btn btn-default numbtn" id="eight">8</button>
					<button class="btn btn-default numbtn" id="nine">9</button><br>
					<button class="btn btn-default numbtn" id=".">.</button>
					<button class="btn btn-default numbtn" id="zero">0</button>					
					<button class="btn btn-default numbtn" id="neg">-</button><br>
					<button class="btn btn-default numbtn" id="clear">C</button>
					<button class="btn btn-default numbtn" id="bkspc">BKSPC</button>

				</div>';
		}

		$data = array(
		    "qtype"     => $qtype,
		    "response"     => $response,
		    "question_data"  => $question_data,
		    "marks"  => $marks,
		);
		echo json_encode($data);
	}
	else if(isset($_POST['answers'])){
		$pid = mysqli_real_escape_string($conn, $_POST['pid']);
		$sid = mysqli_real_escape_string($conn, $_POST['sid']);
		$eid = mysqli_real_escape_string($conn, $_POST['eid']);
		$answers = mysqli_real_escape_string($conn, $_POST['answers']);
		$status = mysqli_real_escape_string($conn, $_POST['status']);
		$start = mysqli_real_escape_string($conn, $_POST['start']);
		$end = mysqli_real_escape_string($conn, $_POST['end']);
		$d = '';

		date_default_timezone_set("Asia/Kolkata");

		$start = intval($start) / 1000;
		$start = date('m/d/Y h:i:sa', $start);

		$end = intval($end) / 1000;
		$end = date('m/d/Y h:i:sa', $end);
		

		$sql = "select * from exams where exam_id = '$eid'";
		$res = mysqli_query($conn, $sql);
		$exam = mysqli_fetch_array($res);

		if($exam['exam_nega'] == 'Yes'){
			$nega = 1;
		}
		else{
			$nega = 0;
		}

		$ans = json_decode(stripslashes($answers));

		$sql = "select * from paper_question where paper_id = '$pid' order by sl_no";
		$res = mysqli_query($conn, $sql);
		$i = 1;
		$marks = 0.0;
		$marks_arr = [];
		while($question = mysqli_fetch_array($res)){
			if($question['question_type'] == 'MCQ'){
				$query = "select * from mcq where mcq_id =".$question['question_id'];
				$rs = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($rs);
				//IF RESPONSE EXISTS
				if(!empty($ans->{$i}))
					$user_ans =  array($ans->{$i});
				else{
					array_push($marks_arr, 0);
					$i++;
					continue;
				}
				//IF IT IS ELIGIBLE FOR EVALUATION
				if($user_ans[0][1] == 'REVIEW' || empty($user_ans[0][0])){
					array_push($marks_arr, 0);
					$i++;
					continue;
				}
				//EVALUATION
				if(strtolower($user_ans[0][0]) == $row['mcq_answer']){
					$m = $question['marks'];
					$marks += $m;
				}
				else{
					if($nega == 1){
						$m = round (($question['marks'] / 3), 2);
						$marks -= $m;
						$m = -$m;
					}
				}
				array_push($marks_arr, $m);
			}
			else if($question['question_type'] == 'MMC'){
				$query = "select * from mcq where mcq_id =".$question['question_id'];
				$rs = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($rs);
				
				//IF RESPONSE EXISTS
				if(!empty($ans->{$i})){
					$user_ans =  array($ans->{$i});
				}
				else{
					array_push($marks_arr, 0);
					$i++;
					continue;
				}

				//IF IT IS ELIGIBLE FOR EVALUATION
				if($user_ans[0][1] == 'REVIEW' || empty($user_ans[0][0])){
					array_push($marks_arr, 0);
					$i++;
					continue;
				}

				$user_ans_arr = $user_ans[0][0];
				$user_ans_arr = array_map('strtolower', $user_ans_arr);
				$valid_ans = explode(',',$row['mcq_answer']);
				$valid_ans_count = sizeof($valid_ans);

				$count = 0;
				foreach ($user_ans_arr as $answ) {
					if(in_array($answ, $valid_ans)){
						$count++;
					}
					else{
						$m = round (($question['marks'] / 3), 2);
						$marks -= $m;
						$m = -$m;
						$count = 0;
						break;
					}
				}
				if($count > 0){
					$m = round((($question['marks'] / $valid_ans_count) * $count), 2);
					$marks += $m;
				}
				array_push($marks_arr, $m);
			}
			else if($question['question_type'] == 'NAT'){
				$query = "select * from nat where nat_id =".$question['question_id'];
				$rs = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($rs);
				//IF RESPONSE EXISTS
				if(!empty($ans->{$i})){
					$user_ans =  array($ans->{$i});
				}
				else{
					array_push($marks_arr, 0);
					$i++;
					continue;
				}
				//IF IT IS ELIGIBLE FOR EVALUATION
				if($user_ans[0][1] == 'REVIEW' || empty($user_ans[0][0])){
					array_push($marks_arr, 0);
					$i++;
					continue;
				}

				//EVALUATION
				$user_ans = $user_ans[0][0];
				$valid_ans = explode('-',$row['nat_answer']);
				if(strlen($user_ans) == strlen($valid_ans[0])){
					if($user_ans >= $valid_ans[0] && $user_ans <= $valid_ans[1]){
						$m = $question['marks'];
						$marks += $m;
					}
				}
				else{
					if($nega == 1){
						$m = round (($question['marks'] / 3), 2);
						$marks -= $m;
						$m = -$m;
					}
				}
				array_push($marks_arr, $m);
			}
			$i++;
		}

		$marks = round($marks,2);
		$marks_arr = implode(",",$marks_arr);
		$sql = "insert into results(student_id, exam_id, paper_id, submission, result, marks, qwise_marks, started, ended) values($sid, '$eid', '$pid', $status, '$answers', $marks, '$marks_arr', '$start', '$end')";
		if(!mysqli_query($conn, $sql)){
			$d = 'error';
		}
		else{
			$d = 'submitted';
		}
		$data = array(
		    "response"     => $d
		);
		echo json_encode($data);
	}

?>