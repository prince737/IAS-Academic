<?php
	session_start();
	include_once '../../includes/dbh.inc.php';


	if(isset($_POST['dataNewCount']) && isset($_POST['did'])){
		$d='';
		$count=$_POST['dataNewCount'];
		$did=$_POST['did'];

		$sql="select * from nat where nat_directory='$did' LIMIT $count";
		$res=mysqli_query($conn,$sql);
		
		$sql="select * from nat where nat_directory='$did'";
		$result=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($result);

		
		while($row=mysqli_fetch_array($res)){
			$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['nat_id'].'">'.$row['nat_statement'].'</div>
					<div class="answer" id="ans'.$row['nat_id'].'">'.$row['nat_answer'].'</div>
					<button class="btn btn-primary btn-sm edit" id="'.$row['nat_id'].'">Edit</button>
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
		    "last"  => $last,
		);
		echo json_encode($data);
	}
	elseif(isset($_POST['query'])){
		$d='';
		$query=$_POST['query'];
		$dir=$_POST['dir'];

		$sql="select * from nat where nat_directory='$dir' and nat_statement LIKE '%$query%'";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['nat_id'].'">'.$row['nat_statement'].'</div>
					<div class="answer" id="ans'.$row['nat_id'].'">'.$row['nat_answer'].'</div>
					<button class="btn btn-primary btn-sm edit" id="'.$row['nat_id'].'">Edit</button>
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
		);
		echo json_encode($data);
	}
	else{
		$d='';
		$dir=$_POST['dir'];

		$sql="select * from nat where nat_directory='$dir'";
		$res=mysqli_query($conn,$sql);
		$c=mysqli_num_rows($res);

		if($c>0){
			while($row=mysqli_fetch_array($res)){
				$d .= '<div class="stu-con">
					<div class="statement" id="stmt'.$row['nat_id'].'">'.$row['nat_statement'].'</div>
					<div class="answer" id="ans'.$row['nat_id'].'">'.$row['nat_answer'].'</div>
					<button class="btn btn-primary btn-sm edit" id="'.$row['nat_id'].'">Edit</button>
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
		);
		echo json_encode($data);
	}
?>