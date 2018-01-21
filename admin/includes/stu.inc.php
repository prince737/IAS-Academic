<?php
	session_start();
	require_once('../../includes/dbh.inc.php');
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	if(isset($_POST['approve']) || isset($_POST['approve_stu']))
	{
		
		
		$query = "select cid from students where stu_email = '$email'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){ 
			$cid = $row['cid'];
		}
				
		$query = "select center_id from students where stu_email = '$email'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){ 
			$centerid = $row['center_id'];
		}
		echo $cid.'<br>';
		echo $centerid.'<br>';
		
				
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
		
		//Student roll no Generation
		$query = "select max(stu_registrationNo) as max from students where center_id=$centerid and cid = $cid";
		$result = mysqli_query($conn, $query);
		$resultCheck = mysqli_num_rows($result);
		
		
		$row= mysqli_fetch_array($result);
		if($row['max'] != ''){
			$year = substr($row['max'], 6, 3);
			if($date > $year){
				$regNo .= '001';
			}
			else{
				$roll = substr($row['max'], -3);
				$roll = str_pad($roll + 1,3,"0",STR_PAD_LEFT);
				$regNo .= $roll;
			}
		}	
		else{
			$regNo .= '001';
		}
				
		
		$query= "Update students set stu_approvalstatus=1, stu_registrationNo='$regNo' where stu_email = '$email'";	
		
		
		if(mysqli_query($conn,$query)){
		
			if(isset($_POST['approve_stu'])){
				header("Location: ../students.php?saprv='$name'");	
			}
			else{
				header("Location: ../admin.php?saprv='$name'");	
			}
		}
		else{
			if(isset($_POST['approve_stu'])){
				header("Location: ../students.php?err");	
			}
			else{
				header("Location: ../admin.php?err");	
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
				header("Location: ../students.php?sdny='$name'");	
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
	
	