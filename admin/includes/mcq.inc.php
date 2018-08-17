<?php
	session_start();
	include_once '../../includes/dbh.inc.php';


	if(isset($_POST['dataNewCount']) && isset($_POST['did'])){
		$d='';
		$count=$_POST['dataNewCount'];
		$did=$_POST['did'];
		$type=$_POST['type'];

		$sql="select * from mcq where mcq_directory='$did' and mcq_type='$type' LIMIT $count";
		$res=mysqli_query($conn,$sql);
		
		$sql="select * from mcq where mcq_directory='$did' and mcq_type='$type'";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);

		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div>
					<div class="answer" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</div>
					<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
					<button class="btn btn-primary btn-sm edit" id="'.$row['mcq_id'].'">Edit</button>
		     		</div>';			
		}
		if($c <= $count){
			$last = 1;
		}
		else{
			$last = 0;
		}
		$data = array(
		    "d"     => $d,
		    "count"     => $c,
		    "last"  => $last,
		);
		echo json_encode($data);
	}
	elseif(isset($_POST['query'])){
		$d='';
		$query=$_POST['query'];
		$dir=$_POST['dir'];
		$type=$_POST['type'];

		$sql="select * from mcq where mcq_directory='$dir' and mcq_type='$type' and mcq_statement LIKE '%$query%'";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
							<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div><br>
							<b>Answer: </b><span class="answer" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</span><br><br>
							<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
							<button class="btn btn-primary btn-sm edit" id="'.$row['mcq_id'].'">Edit</button>
						</div>';			
			}
		}
		else{
			$d .= '<div class="stu-con">
				No matching records found 
		     	</div>';
		}
		$data = array(
		    "d"     => $d,
		    "count" => $c,
		);
		echo json_encode($data);
	}
	elseif (isset($_POST['code']) && isset($_POST['ans'])) {
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$ans = mysqli_real_escape_string($conn, $_POST['ans']);
		$qid = mysqli_real_escape_string($conn, $_POST['qid']);
		$opt = mysqli_real_escape_string($conn, $_POST['opt']);

		$sql = "update mcq set mcq_statement='$code', mcq_answer='$ans', mcq_options=$opt where mcq_id=$qid";
		if(!mysqli_query($conn,$sql)){
			$data = array(
			    "error"     => "something went wrong",
			);
		}else{
			$data = array(
			    "val"     => $code,
			    "ans"    => $ans,
			    "opt"    => $opt,
			);			
		}
		echo json_encode($data);
	}
	else{
		$d='';
		$dir=$_POST['dir'];
		$type=$_POST['type'];

		$sql="select * from mcq where mcq_directory='$dir' and mcq_type='$type' LIMIT 10";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
							<div class="statement" id="stmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div><br>
							<b>Answer: </b><span class="answer" id="ans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</span><br><br>
							<b><div>No. of options: </b><span class="option" id="opt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
							<button class="btn btn-primary btn-sm edit" id="'.$row['mcq_id'].'">Edit</button>
						</div>';			
			}
		}
		else{
			$d .= '<div class="stu-con">
				No matching records found 
		     	</div>';
		}
		$data = array(
		    "d"     => $d,
		    "c"     => $c,
		);
		echo json_encode($data);
	}
?>