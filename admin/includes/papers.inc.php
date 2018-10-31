<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['save_paper'])){
	$name= mysqli_real_escape_string($conn, $_POST['paper_name']);
	$marks= mysqli_real_escape_string($conn, $_POST['paper_marks']);
	$level= mysqli_real_escape_string($conn, $_POST['paper_level']);
	$type= mysqli_real_escape_string($conn, $_POST['paper_type']);
	$standard= mysqli_real_escape_string($conn, $_POST['paper_standard']);

	$date = date("d/m/Y");
	$id = 'QP'.date("d").date("m").date("Y");

	$sql = "select max(substr(qpid,11,3)) as max from papers";
	$res=mysqli_query($conn, $sql);
	$check=mysqli_num_rows($res);
	if($check < 1){
		$id .= '001';
	}
	else{
		$row=mysqli_fetch_array($res);
		$id .= str_pad($row['max'] + 1, 3, 0, STR_PAD_LEFT);
	}

	$sql = "insert into papers(qpid, qp_name, qp_fullmarks, qp_level, qp_type, qp_standard, qp_date) values('$id', '$name', $marks, '$level', '$type', '$standard', '$date')";
	if(!mysqli_query($conn, $sql)){
		header("Location: ../create_paper.php?err");	
		exit();
	}
	else{
		header("Location: ../create_paper.php?id='$id'");	
		exit();
	}
}

elseif(isset($_POST['edit_paper'])){
	$name= mysqli_real_escape_string($conn, $_POST['paper_name']);
	$marks= mysqli_real_escape_string($conn, $_POST['paper_marks']);
	$level= mysqli_real_escape_string($conn, $_POST['paper_level']);
	$standard= mysqli_real_escape_string($conn, $_POST['paper_standard']);
	$qpid= mysqli_real_escape_string($conn, $_POST['qpid']);

	echo $name;

	$sql = "update papers set qp_name='$name', qp_level='$level', qp_fullmarks=$marks, qp_standard='$standard' where qpid='$qpid'";
	if(!mysqli_query($conn, $sql)){
		header("Location: ../papers.php?err");	
		exit();
	}
	else{
		header("Location: ../papers.php?success'");	
		exit();
	}
}
//search question
elseif(isset($_POST['first'])){
	$qdir = mysqli_real_escape_string($conn, $_POST['qdir']);
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);
	$pid = mysqli_real_escape_string($conn, $_POST['pid']);
	$d='';
	$last = 0;
	$d = getdata($qtype, $qdir, $pid, 10, $conn);
	$count = getcount($qtype, $qdir, $conn);

	if($count <= 10){
		$last = 1;
	}
	$data = array(
	    "d"     => $d,
	    "count" => $count,
	    "last" => $last,
	);
	echo json_encode($data);
}

elseif(isset($_POST['addQuestion'])){
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);
	$pid = mysqli_real_escape_string($conn, $_POST['pid']);
	$qid = mysqli_real_escape_string($conn, $_POST['qid']); 
	$marks = mysqli_real_escape_string($conn, $_POST['marks']);
	$qdir = mysqli_real_escape_string($conn, $_POST['qdir']);
	$sl_no = mysqli_real_escape_string($conn, $_POST['sl_no']);

	$sql = "insert into paper_question(paper_id, question_id, question_type, marks, sl_no) values('$pid', $qid, '$qtype', $marks, '$sl_no')";
	if(!mysqli_query($conn, $sql)){
		$data = array(
	    	"d"     => "Something went Wrong. Please try again.",
		);
	}
	else{
		$d = getdata($qtype, $qdir, $pid, 10, $conn);
		$count = getcount($qtype, $qdir, $conn);

		$data = array(
	    	"d"     => $d,
	    	"msg" => "$qtype was successfully added to paper.",
	    	"count" => $count,
		);
	}
	
	echo json_encode($data);
}

elseif(isset($_POST['dataNewCount'])){
	$d='';
	$last = 0;
	$count = $_POST['dataNewCount'];
	$qdir = mysqli_real_escape_string($conn, $_POST['qdir']);
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);

	$d = getdata($qtype, $qdir, $count, $conn);
	$c = getcount($qtype, $qdir, $conn);

	if($c <= $count){
		$last = 1;
	}
	$data = array(
	    "count" => $c,
	    "last"  => $last,
	    "d"  => $d,
	);
	echo json_encode($data);
}

/*REMOVE QUESTION FROM PAPER*/
elseif(isset($_POST['remQ'])){
	$qtype = mysqli_real_escape_string($conn, $_POST['qtype']);
	$qpid = mysqli_real_escape_string($conn, $_POST['qpid']);
	$qid = mysqli_real_escape_string($conn, $_POST['qid']); 
	$d = '';

	$sql = "select * from paper_question where paper_id = '$qpid' and question_id=$qid and question_type='$qtype'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($res);
	$marks = $row['marks'];

	$sql = "delete from paper_question where paper_id = '$qpid' and question_id=$qid and question_type='$qtype'";
	if(!mysqli_query($conn, $sql)){
		$data = array(
	    	"msg"     => "Something went Wrong. Please try again.",
		);
	}
	else{
		$sql = "select * from paper_question where paper_id='$qpid'";
		$res_q = mysqli_query($conn, $sql);
		$i=1;
		while($row = mysqli_fetch_array($res_q)){
			$qid = $row['question_id'];
			if($row['question_type'] == 'MCQ'){
				$sql = "select * from mcq where mcq_id=$qid  and mcq_type='MCQ'";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .= 	'<div class="stu-con">
						<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
						<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
						<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="mcq'.$row1['mcq_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="rm_sl'.$row['pq_id'].'">Edit</button>
			     	</div>';
			}
			else if($row['question_type'] == 'MMC'){
				$sql = "select * from mcq where mcq_id=$qid and mcq_type='MAMCQ'";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .= '
					<div class="stu-con">
						<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
						<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
						<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="mmc'.$row1['mcq_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="rm_sl'.$row['pq_id'].'">Edit</button>
			     	</div>
				';
			}
			elseif($row['question_type'] == 'NAT'){
				$sql = "select * from nat where nat_id=$qid";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .=	'<div class="stu-con">
						<div class="statement" id="stmt'.$row1['nat_id'].'">'.$row1['nat_statement'].'</div>
						<div class="answer" id="ans'.$row1['nat_id'].'">Correct Answer: '.$row1['nat_answer'].'</div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="NAT'.$row1['nat_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="rm_sl'.$row['pq_id'].'">Edit</button>
			    	</div>';
			}
			$i++;
		}
		$data = array(
	    	"d"     => $d,
	    	"msg" => "$qtype was successfully removed to paper.",
	    	"marks" => $marks,
		);
	}
	echo json_encode($data);
}


/*REMOVE QUESTION FROM PAPER*/
elseif(isset($_POST['editQ'])){
	$pqid = mysqli_real_escape_string($conn, $_POST['pqid']);
	$marks = mysqli_real_escape_string($conn, $_POST['marks']);
	$serial = mysqli_real_escape_string($conn, $_POST['serial']); 
	$pid = mysqli_real_escape_string($conn, $_POST['pid']); 
	$d = '';

	$sql = "update paper_question set marks=$marks, sl_no = $serial where pq_id = $pqid";
	if(!mysqli_query($conn, $sql)){
		$data = array(
	    	"msg"     => $sql,
		);
	}
	else{
		$sql = "select * from paper_question where paper_id='$pid'";
		$res_q = mysqli_query($conn, $sql);
		$i=1;
		while($row = mysqli_fetch_array($res_q)){
			$qid = $row['question_id'];
			if($row['question_type'] == 'MCQ'){
				$sql = "select * from mcq where mcq_id=$qid  and mcq_type='MCQ'";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .= 	'<div class="stu-con">
						<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
						<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
						<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="mcq'.$row1['mcq_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="mcqrm_sl'.$row['pq_id'].'">Edit</button>
			     	</div>';
			}
			else if($row['question_type'] == 'MMC'){
				$sql = "select * from mcq where mcq_id=$qid and mcq_type='MAMCQ'";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .= '
					<div class="stu-con">
						<div class="statement" id="stmt'.$row1['mcq_id'].'">'.$row1['mcq_statement'].'</div><br>
						<b><div>No. of options: </b><span class="option" id="opt'.$row1['mcq_id'].'">'.$row1['mcq_options'].'</span></div>
						<b><div>Correct Answer: </b><span class="option" id="ans'.$row1['mcq_id'].'">'.$row1['mcq_answer'].'</span></div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="mmc'.$row1['mcq_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="mmcrm_sl'.$row['pq_id'].'">Edit</button>
			     	</div>
				';
			}
			elseif($row['question_type'] == 'NAT'){
				$sql = "select * from nat where nat_id=$qid";
				$res = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_array($res);
				$d .=	'<div class="stu-con">
						<div class="statement" id="stmt'.$row1['nat_id'].'">'.$row1['nat_statement'].'</div>
						<div class="answer" id="ans'.$row1['nat_id'].'">Correct Answer: '.$row1['nat_answer'].'</div>
						<b><div>Serial No: </b><span class="option" id="sl'.$row['pq_id'].'">'.$row['sl_no'].'</span></div>
						<b><div>Marks: </b><span class="option" id="marks'.$row['pq_id'].'">'.$row['marks'].'</span></div>
						<hr>
						<button class="btn btn-danger btn-sm remq" id="NAT'.$row1['nat_id'].'">Remove from Paper</button>
						<button class="btn btn-warning btn-sm edsl" id="natrm_sl'.$row['pq_id'].'">Edit</button>
			    	</div>';
			}
			$i++;
		}
		$data = array(
	    	"d"     => $d,
	    	"msg" => "Question was successfully updated.",
	    	"marks" => $marks,
		);
	}
	echo json_encode($data);
}







/*FUNCTIONS*/
function getdata($qtype, $qdir, $pid, $count, $conn){
	$d = '';
	if($qtype=='MCQ'){
		$sql = "select * from mcq where mcq_directory = '$qdir' and mcq_type='MCQ' and mcq_ifcdl=0 and mcq_id not in (select question_id from paper_question where question_type='MCQ' and paper_id = '$pid') LIMIT $count";
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div><br>
					<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div>
					<b><div>Correct Answer: </b><span class="option" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</span></div>
					<hr>
					<div class="row">
						<input type="number" class="marks" placeholder="Sl No." id="sl_no'.$row['mcq_id'].'"></input>
						<input type="number" class="marks" placeholder="Marks" id="marks'.$row['mcq_id'].'"></input>
						<button class="btn btn-primary btn-sm addq" id="'.$row['mcq_id'].'">Add to Paper</button>
					</div>
		     		</div>';			
		}	
	}
	elseif($qtype=='MMC'){
		$sql = "select * from mcq where mcq_directory = '$qdir' and mcq_type='MAMCQ' and mcq_ifcdl=0 and mcq_id not in (select question_id from paper_question where question_type='MMC' and paper_id = '$pid')";
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div>
					<div class="answer" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</div>
					<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
					<hr>
					<div class="row">
						<input type="number" class="marks" placeholder="Sl No." id="sl_no'.$row['mcq_id'].'"></input>
						<input type="number" class="marks" placeholder="Marks" id="marks'.$row['mcq_id'].'"></input>
						<button class="btn btn-primary btn-sm addq" id="'.$row['mcq_id'].'">Add to Paper</button>
					</div>
		     		</div>';			
		}
	}
	elseif($qtype=='NAT'){
		$sql = "select * from nat where nat_directory = '$qdir' and nat_ifcdl=0 and nat_id not in (select question_id from paper_question where question_type='NAT' and paper_id = '$pid') LIMIT $count";
		$res=mysqli_query($conn,$sql);		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['nat_id'].'">'.$row['nat_statement'].'</div>
					<div class="answer" id="ans'.$row['nat_id'].'">'.$row['nat_answer'].'</div>
					<hr>
					<div class="row">
						<input type="number" class="marks" placeholder="Sl No." id="sl_no'.$row['nat_id'].'"></input>
						<input type="number" class="marks" placeholder="Marks" id="marks'.$row['nat_id'].'"></input>
						<button class="btn btn-primary btn-sm addq" id="'.$row['nat_id'].'">Add to Paper</button>
					</div>
		     		</div>';	
		}
	}
	/*else{
		$sql = "select * from cdl where cdl_directory='$qdir'";
		$res=mysqli_query($conn,$sql);
		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
						<div class="statement" id="stmt'.$row['cdl_id'].'">'.$row['cdl_statement'].'</div><br>
						<div id="nat_data'.$row['cdl_id'].'" class="data"></div>
						<div id="mcq_data'.$row['cdl_id'].'" class="data"></div>
					</div>';			
		}	
	}*/

	if(!$d){
		$d = '<div class="stu-con">No matching records found..</div>';
	}
	return $d;
}


function getcount($qtype, $qdir, $conn){

	if($qtype=='MCQ'){
		$sql="select * from mcq where mcq_directory = '$qdir' and mcq_type='MCQ' and mcq_ifcdl=0 and mcq_id not in (select question_id from paper_question where question_type='MCQ')";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);
	}
	elseif($qtype=='MAMCQ'){
		$sql = "select * from mcq where mcq_directory = '$qdir' and mcq_type='MAMCQ' and mcq_ifcdl=0 and mcq_id not in (select question_id from paper_question where question_type='MAMCQ')";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);
	}
	elseif($qtype=='NAT'){
		$sql = "select * from nat where nat_directory = '$qdir' and nat_ifcdl=0 and nat_id not in (select question_id from paper_question where question_type='NAT')";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);
	}
	else{
		$c=0;
	}

	if(!$c)
		$c=0;

	return $c;

	
}
