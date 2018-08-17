<?php
	session_start();
	include_once '../../includes/dbh.inc.php';


	if(isset($_POST['dataNewCount']) && isset($_POST['did'])){
		$d='';
		$count=$_POST['dataNewCount'];
		$did=$_POST['did'];

		$sql="select * from cdl where cdl_directory='$did' LIMIT $count";
		$res=mysqli_query($conn,$sql);
		
		$sql="select * from cdl where cdl_directory='$did'";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);

		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
						<div class="statement" id="stmt'.$row['cdl_id'].'">'.$row['cdl_statement'].'</div><br>
						<button class="btn btn-primary btn-xs edit" id="'.$row['cdl_id'].'">Edit Statement</button>
						<button class="btn btn-primary btn-xs nat" id="nat'.$row['cdl_id'].'">Edit Linked NAT</button>
						<button class="btn btn-primary btn-xs mcq" id="mcq'.$row['cdl_id'].'">Edit Linked MCQ</button>
						<button class="btn btn-success btn-xs" id="add">Add Linked Question</button>
						<div id="nat_data'.$row['cdl_id'].'" class="data"></div>
						<div id="mcq_data'.$row['cdl_id'].'" class="data"></div>
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

		$sql="select * from cdl where cdl_directory='$dir' and cdl_statement LIKE '%$query%'";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
							<div class="statement" id="stmt'.$row['cdl_id'].'">'.$row['cdl_statement'].'</div><br>
							<button class="btn btn-primary btn-xs edit" id="'.$row['cdl_id'].'">Edit Statement</button>
							<button class="btn btn-primary btn-xs nat" id="nat'.$row['cdl_id'].'">Edit Linked NAT</button>
							<button class="btn btn-primary btn-xs mcq" id="mcq'.$row['cdl_id'].'">Edit Linked MCQ</button>
							<button class="btn btn-success btn-xs" id="add">Add Linked Question</button>
							<div id="nat_data'.$row['cdl_id'].'" class="data"></div>
							<div id="mcq_data'.$row['cdl_id'].'" class="data"></div>
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
	elseif (isset($_POST['code']) && !isset($_POST['flag']) && !isset($_POST['edit'])) {
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$qid = mysqli_real_escape_string($conn, $_POST['qid']);


		$sql = "update cdl set cdl_statement='$code' where cdl_id=$qid";
		if(!mysqli_query($conn,$sql)){
			$data = array(
			    "error"     => "something went wrong",
			);
		}else{
			$data = array(
			    "val"     => $code,
			);			
		}
		echo json_encode($data);
	}
	elseif (isset($_POST['del'])) {
		$qid = mysqli_real_escape_string($conn, $_POST['del']);


		$sql = "delete from cdl where cdl_id=$qid";
		if(!mysqli_query($conn,$sql)){
			$data = array(
			    "error"     => "something went wrong",
			);
		}else{
			$data = array(
			    "del"     => "Question having id "+$qid+" was successfully deleted.",
			);			
		}
		echo json_encode($data);
	}
	elseif (isset($_POST['cdl_id']) && isset($_POST['type'])) {
		$cdlid = mysqli_real_escape_string($conn, $_POST['cdl_id']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$type = strtoupper($type);

		$d='<br><h4>Linked '.$type.'</h4><hr>';

		if($type == 'NAT'){
			$sql = "select * from nat where nat_ifcdl=1 and nat_cdlid=$cdlid";
		}
		else{
			$sql = "select * from mcq where mcq_ifcdl=1 and mcq_cdlid=$cdlid and mcq_type='MCQ'";
		}		

		$res = mysqli_query($conn,$sql);

		if(mysqli_num_rows($res) <= 0){
			$d .= '<div class="stu-con">
				No data found.
		     	</div>';
		}
		else{
			while($row=mysqli_fetch_array($res)){
				if($type == 'NAT'){
					$d .= '<div class="stu-con">
					    <div class="statement" id="natstmt'.$row['nat_id'].'">'.$row['nat_statement'].'</div>
						<div class="answer" id="natans'.$row['nat_id'].'">'.$row['nat_answer'].'</div><br>
						<button class="btn btn-primary btn-xs inneredit" id="natedit'.$row['nat_id'].'">Edit</button>
						</div>';
				}
				else{
					$d .= '<div class="stu-con">
					    <div class="statement" id="mcqstmt'.$row['mcq_id'].'">'.$row['mcq_statement'].'</div>
						<b>Correct Answer: </b><span class="answer" id="mcqans'.$row['mcq_id'].'">'.$row['mcq_answer'].'</span>
						<b><div>No. of options: </b><span class="option" id="mcqopt'.$row['mcq_id'].'">'.$row['mcq_options'].'</span></div><br>
						<button class="btn btn-primary btn-xs inneredit" id="mcqedit'.$row['mcq_id'].'">Edit</button>
						</div>';
				}
		    }
		}
		$data = array(
		    "d"     => $d,
		);

		echo json_encode($data);
	}
	elseif (isset($_POST['code']) && isset($_POST['flag'])) {
		$cdlid = mysqli_real_escape_string($conn, $_POST['cdlid']);
		$cdldir = mysqli_real_escape_string($conn, $_POST['cdldir']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$ans = mysqli_real_escape_string($conn, $_POST['ans']);
		$opt = mysqli_real_escape_string($conn, $_POST['opt']);



		if($type=='nat'){
			$sql = "insert into nat(nat_statement, nat_answer, nat_directory, nat_ifcdl, nat_cdlid) values('$code','$ans','$cdldir',1,$cdlid)";
		}
		else{
			$sql = "insert into mcq(mcq_statement, mcq_options,mcq_answer, mcq_type, mcq_directory, mcq_ifcdl, mcq_cdlid) values('$code',$opt,'$ans','MCQ','$cdldir', 1, $cdlid)";
		}
		if(!mysqli_query($conn,$sql)){
			echo "Something went wrong, please try again.";
		}
		else{
			echo strtoupper($type)." question was successfully inserted for the selected cdl. Refresh the page for changes to take effect.";
		}
	}
	elseif (isset($_POST['code']) && isset($_POST['edit'])) {
		$code = mysqli_real_escape_string($conn, $_POST['code']);
		$ans = mysqli_real_escape_string($conn, $_POST['ans']);
		$opt = mysqli_real_escape_string($conn, $_POST['opt']);
		$qid = mysqli_real_escape_string($conn, $_POST['qid']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);


		if($type=='nat'){
			$sql = "update nat set nat_statement='$code', nat_answer='$ans' where nat_id=$qid";
		}
		else{
			$sql = "update mcq set mcq_statement='$code', mcq_answer='$ans', mcq_options=$opt where mcq_id=$qid";
		}
		if(!mysqli_query($conn,$sql)){
			$data = array(
			    "error"     => "something went wrong",
			);
		}
		else{
			if($type=='mcq'){
				$data = array(
				    "val"     => $code,
				    "ans"    => $ans,
				    "opt"    => $opt,
				    "success" => "MCQ was successfully updated.",
				);
			}
			else{
				$data = array(
				    "val"     => $code,
				    "ans"    => $ans,
				    "success" => "NAT was successfully updated.",
				);
			}
			echo json_encode($data);
		}
	}
	else{
		$d='';
		$dir=$_POST['dir'];

		$sql="select * from cdl where cdl_directory='$dir' LIMIT 10";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
							<<div class="statement" id="stmt'.$row['cdl_id'].'">'.$row['cdl_statement'].'</div><br>
							<button class="btn btn-primary btn-xs edit" id="'.$row['cdl_id'].'">Edit Statement</button>
							<button class="btn btn-primary btn-xs nat" id="nat'.$row['cdl_id'].'">Edit Linked NAT</button>
							<button class="btn btn-primary btn-xs mcq" id="mcq'.$row['cdl_id'].'">Edit Linked MCQ</button>
							<button class="btn btn-success btn-xs" id="add">Add Linked Question</button>
							<div id="nat_data'.$row['cdl_id'].'" class="data"></div>
							<div id="mcq_data'.$row['cdl_id'].'" class="data"></div>
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