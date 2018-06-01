<?php
	session_start();
	require_once('../../includes/dbh.inc.php');
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	if(isset($_POST['approve']) || isset($_POST['approve_stu']))
	{
		
		
		$query = "select stu_id from students where stu_email = '$email'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){ 
			$id = $row['stu_id'];
		}
		

		$query = "select course_id from students_courses where student_id = '$id'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){ 
			$cid = $row['course_id'];
		}
		
		$query = "select center_id from students_courses where student_id = '$id'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){ 
			$centerid = $row['center_id'];
		}
		
		//Setting student id
		
		$roll='IAS/';
		$roll.=date('Y').'/';
		$sql = "select max(right(stu_roll,4)) as max_roll from students";
		$res=mysqli_query($conn,$sql);
		$num=mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		
		if($num<1){
			
			$roll.='0001';
		}
		else{
			/*$year = substr($row['max_roll'], 5, 4);
			if($year<YEAR(CURDATE())){
				$roll.='0001';
			}
			else{*/
				$roll.=str_pad($row['max_roll'] + 1,4,"0",STR_PAD_LEFT);
			//}
		}
		
		//SETTING REGISTRATION NUMBER
			
		$regNo = '9119';
		
		//selecting center number
		$query = "select center_id from centers";
		$res= mysqli_query($conn, $query);	
		while($row = mysqli_fetch_array($res)){
			if($row['center_id'] == $centerid){
				$regNo .= '0'.$centerid;
			}
		}
						
		$date = substr_replace(date('Y'), '', 1, 1);
		$regNo .= $date;
		
		//Selecting course number
		$query = "select course_id from courses";
		$res= mysqli_query($conn, $query);	
		while($row = mysqli_fetch_array($res)){
			if($row['course_id'] == $cid){
				$regNo .= $cid;
			}
		}
		
		//Student registration no Generation
		$query = "select max(registration_no) as max from students_courses where center_id=$centerid and course_id = $cid";
		$result = mysqli_query($conn, $query);
		$resultCheck = mysqli_num_rows($result);
		
		
		$row= mysqli_fetch_array($result);
		if($row['max'] != ''){
			$year = substr($row['max'], 6, 3);
			if($date > $year){
				$regNo .= '001';
			}
			else{
				$roll1 = substr($row['max'], -3);
				$roll1 = str_pad($roll1 + 1,3,"0",STR_PAD_LEFT);
				$regNo .= $roll1;
			}
		}	
		else{
			$regNo .= '001';
		}
		
		
		$date = date("Y-m-d");			
		
		$query= "Update students set stu_approvalstatus=1, stu_dateofadmission='$date', stu_roll='$roll' where stu_id = '$id'";	
		echo $query;
		
		if(mysqli_query($conn,$query)){
			
			$query="Update students_courses set registration_no=$regNo where student_id=$id AND course_id=$cid AND center_id=$centerid";
			
			if(!mysqli_query($conn,$query)){
				
				$query="Update students set stu_approvalstatus=0 where stu_id = $id";
				
				mysqli_query($conn,$query);
				if(isset($_POST['approve_stu'])){
					header("Location: ../students_all.php?err222");	
				}
				else{
					header("Location: ../admin.php?err111");	
				}
			}
			else{		
				if(isset($_POST['approve_stu'])){
					header("Location: ../students_all.php?saprv='$name'");	
				}
				else{
					header("Location: ../admin.php?saprv='$name'");	
				}
			}
		}
		else{
			if(isset($_POST['approve_stu'])){
				header("Location: ../students_all.php?err33");	
			}
			else{
				header("Location: ../admin.php?er44r");	
			}
		}
	}
	
	if(isset($_POST['deny']) || isset($_POST['deny_stu']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "Update students set stu_approvalstatus=2 where stu_email = '$email'";	
		if(mysqli_query($conn,$query))
		{
			if(isset($_POST['deny_stu'])){
				header("Location: ../students_all.php?sdny='$name'");	
			}
			else{
				header("Location: ../admin.php?sdny='$name'");	
			}
		}
		else{
			if(isset($_POST['deny_stu'])){
				header("Location: ../students.php?err");	
			}
			else{
				header("Location: ../admin.php?err");	
			}
		}
		
	}
	
	