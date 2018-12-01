<?php
	session_start();
	include_once '../../includes/dbh.inc.php';
	if(isset($_POST['initial'])){
		$exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
		$d = getData($exam_id, $conn);

		$data = array(
	    	"d"     => $d,
		);
		echo json_encode($data);
	}

	else if(isset($_POST['delete'])){
		$exam_id = mysqli_real_escape_string($conn, $_POST['eid']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$d = '';

		$sql = "delete from results where student_id = $id and exam_id = '$exam_id'";
		if(!mysqli_query($conn, $sql)){
			$delete = '0';
		}
		else{
			$d = getData($exam_id, $conn);
			$delete = '1';
		}
		$data = array(
	    	"d"     => $d,
	    	'delete' => $delete,
		);
		echo json_encode($data);
	}

	else if(isset($_POST['search'])){
		$exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
		$searchq = mysqli_real_escape_string($conn, $_POST['searchq']);

		$i=1;
		$d='';
		$sql = "select * from results, students, exams where results.exam_id='$exam_id' and stu_id = student_id and results.exam_id = exams.exam_id and (stu_name like '%$searchq%' or stu_roll like '%$searchq%')";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		while($result = mysqli_fetch_array($res)){
			$sql = "select course_name, center_name from students_courses, courses, centers, students where stu_id=student_id and students_courses.course_id = courses.course_id and students_courses.center_id = centers.center_id and student_id=".$result['stu_id'];
			$res1 = mysqli_query($conn, $sql);
			$stu = mysqli_fetch_array($res1);

			$sql = "select count(*) qcount, qp_fullmarks FROM paper_question,papers where paper_id = qpid and paper_id='".$result['paper_id']."'";
			$res2 = mysqli_query($conn, $sql);
			$qcount = mysqli_fetch_array($res2);

			$marks = explode(',', $result['qwise_marks']);
			$an=0; $corr=0; $wr=0; $fullmarks=0;
			foreach($marks as $m)
			{
				if($m != 0)
				{
					$an++;
				}
				if($m>0){
					$corr++;
				}
				else if($m < 0){
					$wr++;
				}

				$fullmarks += $m;
 			}

			$d .= '<h3>'.$count.' result/s found</h3><div class="row stu-con">
					<div class="col-md-2" style="text-align:center;">
						<img style="display:inline-block; margin: 0 auto;" src="../'.$result['stu_imageLocation'].'" height="150" width="150" class="img-thumnail" /> 
					</div>
					<div class="col-md-3">		
						<table>	
							<h4>Student\'s Information</h4>	
							<tr>
								<td>Name:</td>
								<td class="data">'.$result['stu_name'].'</td>
							</tr>
							<tr>
								<td>Roll No.:</td>
								<td class="data">'.$result['stu_roll'].'</td>
								<td class="data" id="id'.$i.'" style="display: none;">'.$result['stu_id'].'</td>
							</tr>
							<tr>
								<td>Course:</td>
								<td class="data">'.$stu['course_name'].'</td>
							</tr>
							<tr>
								<td>Center:</td>
								<td class="data">'.$stu['center_name'].'</td>
							</tr>	
						</table>
					</div>	
					
					<div class="col-md-3">
						<table>		
							<h4>Result</h4>
							<tr>
								<td>Test Started At:</td>
								<td class="data">'.$result['started'].'</td>
							</tr>
							<tr>
								<td>No. of Questions:</td>
								<td class="data">'.$qcount['qcount'].'</td>
							</tr>
							<tr>
								<td>Correct:</td>
								<td class="data">'.$corr.'</td>
							</tr>
							<tr>
								<td>Full Marks:</td>
								<td class="data">'.$qcount['qp_fullmarks'].'</td>
							</tr>										
						</table>
					</div>
					<div class="col-md-3">
						<table>	
							<br>	
							<tr>
								<td>Test Ended At:</td>
								<td class="data">'.$result['ended'].'</td>
							</tr>
							<tr>
								<td>Attempted:</td>
								<td class="data">'.$an.'</td>
							</tr>
							<tr>
								<td>Wrong:</td>
								<td class="data">'.$wr.'</td>
							</tr>
							<tr>
								<td>Marks Obtained:</td>
								<td class="data">'.$fullmarks.'</td>
							</tr>										
						</table>
					</div>

					<div class="col-md-1" style="text-align:center;">
						<table>
							<h4>Actions</h4>
							<tr>
								<td><a href="../result_details.php?exam='.$exam_id.'&id='.$result['stu_id'].'" target="_blank" class="btn btn-xs btn-warning ">Print</a></td>
								<td><button id="delete'.$i.'" class="btn btn-xs btn-danger delete">Delete</button></td>
							</tr>
						</table>
					</div>
				</div>';
			$i++;
		}

		$data = array(
	    	"d"     => $d,
		);
		echo json_encode($data);

	}

	else if(isset($_POST['exmid'])){
		$exmid = mysqli_real_escape_string($conn, $_POST['exmid']);

		echo 'here';

		$sql = "delete from results where exam_id='$exmid'";	
		echo $sql;
		if(!mysqli_query($conn, $sql)){
			//header("Location: ../results.php?err");
			//exit();
		}
		else{
			//header("Location: ../results.php");
			//exit();
		}
		
	}




	function getData($exam_id, $conn){
		$i=1;
		$d='';
		$sql = "select * from results, students, exams where results.exam_id='$exam_id' and stu_id = student_id and results.exam_id = exams.exam_id";
		$res = mysqli_query($conn, $sql);
		while($result = mysqli_fetch_array($res)){
			$sql = "select course_name, center_name from students_courses, courses, centers, students where stu_id=student_id and students_courses.course_id = courses.course_id and students_courses.center_id = centers.center_id and student_id=".$result['stu_id'];
			$res1 = mysqli_query($conn, $sql);
			$stu = mysqli_fetch_array($res1);

			$sql = "select count(*) qcount, qp_fullmarks FROM paper_question,papers where paper_id = qpid and paper_id='".$result['paper_id']."'";
			$res2 = mysqli_query($conn, $sql);
			$qcount = mysqli_fetch_array($res2);

			$marks = explode(',', $result['qwise_marks']);
			$an=0; $corr=0; $wr=0; $fullmarks=0;
			foreach($marks as $m)
			{
				if($m != 0)
				{
					$an++;
				}
				if($m>0){
					$corr++;
				}
				else if($m < 0){
					$wr++;
				}

				$fullmarks += $m;
 			}

			$d .= '<div class="row stu-con">
					<div class="col-md-2" style="text-align:center;">
						<img style="display:inline-block; margin: 0 auto;" src="../'.$result['stu_imageLocation'].'" height="150" width="150" class="img-thumnail" /> 
					</div>
					<div class="col-md-3">		
						<table>	
							<h4>Student\'s Information</h4>	
							<tr>
								<td>Name:</td>
								<td class="data">'.$result['stu_name'].'</td>
							</tr>
							<tr>
								<td>Roll No.:</td>
								<td class="data">'.$result['stu_roll'].'</td>
								<td class="data" id="id'.$i.'" style="display: none;">'.$result['stu_id'].'</td>
							</tr>
							<tr>
								<td>Course:</td>
								<td class="data">'.$stu['course_name'].'</td>
							</tr>
							<tr>
								<td>Center:</td>
								<td class="data">'.$stu['center_name'].'</td>
							</tr>	
						</table>
					</div>	
					
					<div class="col-md-3">
						<table>		
							<h4>Result</h4>
							<tr>
								<td>Test Started At:</td>
								<td class="data">'.$result['started'].'</td>
							</tr>
							<tr>
								<td>No. of Questions:</td>
								<td class="data">'.$qcount['qcount'].'</td>
							</tr>
							<tr>
								<td>Correct:</td>
								<td class="data">'.$corr.'</td>
							</tr>
							<tr>
								<td>Full Marks:</td>
								<td class="data">'.$qcount['qp_fullmarks'].'</td>
							</tr>										
						</table>
					</div>
					<div class="col-md-3">
						<table>	
							<br>	
							<tr>
								<td>Test Ended At:</td>
								<td class="data">'.$result['ended'].'</td>
							</tr>
							<tr>
								<td>Attempted:</td>
								<td class="data">'.$an.'</td>
							</tr>
							<tr>
								<td>Wrong:</td>
								<td class="data">'.$wr.'</td>
							</tr>
							<tr>
								<td>Marks Obtained:</td>
								<td class="data">'.$fullmarks.'</td>
							</tr>										
						</table>
					</div>

					<div class="col-md-1" style="text-align:center;">
						<table>
							<h4>Actions</h4>
							<tr>
								<td><a href="../result_details.php?exam='.$exam_id.'&id='.$result['stu_id'].'" target="_blank" class="btn btn-xs btn-warning ">Print</a></td>
								<td><button id="delete'.$i.'" class="btn btn-xs btn-danger delete">Delete</button></td>
							</tr>
						</table>
					</div>
				</div>';
			$i++;
		}
		return $d;
	}