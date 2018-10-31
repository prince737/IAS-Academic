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
					<button class="btn btn-default numbtn" id="bkspc"><</button>
					<button class="btn btn-default numbtn" id="zero">0</button>
					<button class="btn btn-default numbtn" id=".">.</button>
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

?>