<?php

	session_start();
	require_once('dbh.inc.php');
	
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	
	/**/
	
	
	if(isset($_POST['save_name'])){
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		if(!preg_match("/^[A-Za-z]*\s{1}[A-Za-z]*$/", $name))
		{
			header("Location: ../profile.php?invalid");
			exit();		
		}
		else{
			
			if($row['stu_name'] != $name && $name == $row_stu['stu_name']){
				
				$query = "update student_profile_update set stu_name='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				emptyCheck();
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(stu_id, stu_name) values($id, '$name')";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Name");
					exit();
				}
			}
			else{
				$query="update student_profile_update set stu_name='$name' where stu_id='$id'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Name");
					exit();
				}
			}
		}
	}
	elseif(isset($_POST['save_dob'])){
		$dob = mysqli_real_escape_string($conn, $_POST['dob']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_dob'] != $dob && $dob == $row_stu['stu_dob']){
			
			$query = "update student_profile_update set stu_gender='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_dob) values($id, '$dob')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Date of Birth");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_dob='$dob' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Date of Birth");
				exit();
			}
		}
			
	
	}
	elseif(isset($_POST['save_gender'])){
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_gender'] != $gender && $gender == $row_stu['stu_gender']){
			
			$query = "update student_profile_update set stu_gender='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_gender) values($id, '$gender')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Gender");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_gender='$gender' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Gender");
				exit();
			}
		}
				
		
	}
	elseif(isset($_POST['save_email'])){
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			header("Location: ../profile.php?invalid");
			exit();		
		}
		else{
			
			
						
			if($row['stu_email'] != $email && $email == $row_stu['stu_email']){
				
				$query = "update student_profile_update set stu_email='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				emptyCheck();
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(stu_id, stu_email) values($id, '$email')";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Email");
					exit();
				}
			}
			else{
				$query="update student_profile_update set stu_email='$email' where stu_id='$id'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Email");
					exit();
				}
			}
		}	
		
	}	
	elseif(isset($_POST['save_gname'])){
		$gname = mysqli_real_escape_string($conn, $_POST['gname']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		if(!preg_match("/^[A-Za-z]*\s{1}[A-Za-z]*$/", $gname))
		{
			header("Location: ../profile.php?invalid");
			exit();		
		}
		else{
			if($row['stu_gurdianname'] != $gname && $gname == $row_stu['stu_gurdianname']){
				
				$query = "update student_profile_update set stu_gurdianname='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				emptyCheck();
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(stu_id, stu_gurdianname) values($id, '$gname')";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian Name");
					exit();
				}
			}
			else{
				$query="update student_profile_update set stu_gurdianname='$gname' where stu_id='$id'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian Name");
					exit();
				}
			}
		}
	}
	elseif(isset($_POST['save_contact'])){
		$contact = mysqli_real_escape_string($conn, $_POST['contact']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		if(!preg_match("/^[0-9]{10}$/", $contact))
		{
			header("Location: ../profile.php?invalid");
			exit();		
		}
		else{
			if($row['stu_contact'] != $contact && $contact == $row_stu['stu_contact']){
				
				$query = "update student_profile_update set stu_contact='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				emptyCheck();
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(stu_id, stu_contact) values($id, '$contact')";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Contact Number");
					exit();
				}
			}
			else{
				$query="update student_profile_update set stu_contact='$contact' where stu_id='$id'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Contact Number");
					exit();
				}
			}
		}
	}
	elseif(isset($_POST['save_gcontact'])){
		$gcontact = mysqli_real_escape_string($conn, $_POST['gcontact']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		if(!preg_match("/^[0-9]{10}$/", $gcontact))
		{
			header("Location: ../profile.php?invalid");
			exit();		
		}
		else{
			if($row['stu_gurdiancontact'] != $gcontact && $gcontact == $row_stu['stu_gurdiancontact']){
				
				$query = "update student_profile_update set stu_gurdiancontact='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				emptyCheck();
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(stu_id, stu_gurdiancontact) values($id, '$gcontact')";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian's Contact Number");
					exit();
				}
			}
			else{
				$query="update student_profile_update set stu_gurdiancontact='$gcontact' where stu_id='$id'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian's Contact Number");
					exit();
				}
			}
		}
	}
	elseif(isset($_POST['save_address'])){
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_address'] != $address && $address == $row_stu['stu_address']){
			
			$query = "update student_profile_update set stu_address='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_address) values($id, '$address')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Address");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_address='$address' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Address");
				exit();
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_school'])){
		$school = mysqli_real_escape_string($conn, $_POST['school']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_currentinstitute'] != $school && $school == $row_stu['stu_currentinstitute']){
			
			$query = "update student_profile_update set stu_currentinstitute='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_currentinstitute) values($id, '$school')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=School");
					exit();
				}
				else{
					header("Location: ../profile.php?success=College");
					exit();
				}
			}
		}
		else{
			$query="update student_profile_update set stu_currentinstitute='$school' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=School");
					exit();
				}
				else{
					header("Location: ../profile.php?success=College");
					exit();
				}
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_board'])){
		$board = mysqli_real_escape_string($conn, $_POST['board']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_university'] != $board && $board == $row_stu['stu_university']){
			
			$query = "update student_profile_update set stu_university='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_university) values($id, '$board')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=Board");
					exit();
				}
				else{
					header("Location: ../profile.php?success=University");
					exit();
				}
			}
		}
		else{
			$query="update student_profile_update set stu_university='$board' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=Board");
					exit();
				}
				else{
					header("Location: ../profile.php?success=University");
					exit();
				}
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_he'])){
		$he = mysqli_real_escape_string($conn, $_POST['he']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_highestdegree'] != $he && $he == $row_stu['stu_highestdegree']){
			
			$query = "update student_profile_update set stu_highestdegree='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_highestdegree) values($id, '$he')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=Class");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Course");
					exit();
				}
				
			}
		}
		else{
			$query="update student_profile_update set stu_highestdegree='$board' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				$class = getClass();
				if($class == 'Class X' || $class == 'Class XI' || $class == 'Class XII'){
					header("Location: ../profile.php?success=Class");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Course");
					exit();
				}
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_sub'])){
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_subjectCombo'] != $subject && $subject == $row_stu['stu_subjectCombo']){
			
			$query = "update student_profile_update set stu_subjectCombo='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_subjectCombo) values($id, '$subject')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Subject Combination");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_subjectCombo='$board' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Subject Combination");
				exit();
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_dept'])){
		$dept = mysqli_real_escape_string($conn, $_POST['dept']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_dept'] != $dept && $dept == $row_stu['stu_dept']){
			
			$query = "update student_profile_update set stu_dept='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_dept) values($id, '$dept')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Department");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_dept='$dept' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Department");
				exit();
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_yop'])){
		$yop = mysqli_real_escape_string($conn, $_POST['yop']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_yearofpass'] != $yop && $yop == $row_stu['stu_yearofpass']){
			
			$query = "update student_profile_update set stu_yearofpass='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_yearofpass) values($id, '$yop')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Year of Passing");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_yearofpass='$yop' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Year of Passing");
				exit();
			}
		}
				
		
	}
	
	elseif(isset($_POST['save_cur'])){
		$cur = mysqli_real_escape_string($conn, $_POST['cur']);
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
					
		if($row['stu_currentStatus'] != $cur && $cur == $row_stu['stu_currentStatus']){
			
			$query = "update student_profile_update set stu_currentStatus='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			emptyCheck();
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(stu_id, stu_currentStatus) values($id, '$cur')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Current Status");
				exit();
			}
		}
		else{
			$query="update student_profile_update set stu_currentStatus='$cur' where stu_id='$id'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Current Status");
				exit();
			}
		}
				
		
	}
	
	function emptyCheck(){
		global $id;
		global $conn;
		$query = "select * from student_profile_update where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$row=mysqli_fetch_array($res);
		
		if(empty($row['stu_name']) && empty($row['stu_gender']) && empty($row['stu_address']) && empty($row['stu_gurdianname']) && empty($row['stu_gurdiancontact']) && empty($row['stu_highestdegree']) && empty($row['stu_yearofpass']) && empty($row['stu_currentinstitute']) && empty($row['stu_dept']) && empty($row['stu_university']) && empty($row['stu_subjectCombo']) && empty($row['stu_dob']) && empty($row['stu_contact']) && empty($row['stu_email'])){
			$query = "delete from student_profile_update where stu_id='$id'";
			$res = mysqli_query($conn, $query);
		}		
	}
	
	function getClass(){
		global $id;
		global $conn;
		$query = "select * from students where stu_id='$id'";
		$res = mysqli_query($conn, $query);
		$row=mysqli_fetch_array($res);
		
		return $row['stu_highestdegree'];
	}
	
	function getRow(){
		global $id;
		global $conn;
		$query = "select * from students where stu_id=$id;";
		$res=mysqli_query($conn, $query);
		$row= mysqli_fetch_array($res);
		return $row;
	}
	
	
	
	