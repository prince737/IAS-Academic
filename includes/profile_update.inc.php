<?php

	session_start();
	require_once('dbh.inc.php');
	
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	
	/**/
	
	
	if(isset($_POST['save_name'])){
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_name'";
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
			
			if($row['spu_newValue'] != $name && $name == $row_stu['stu_name']){
				
				$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_name'";
				mysqli_query($conn, $query);
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_name', '$name')";
				if(!mysqli_query($conn, $query)){
					echo 'err';
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Name");
					exit();
				}
			}
			else{
				$query="update student_profile_update set spu_newValue='$name' where student_id='$id' AND spu_field='stu_name'";
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
	elseif(isset($_POST['save_gname'])){
		$gname = mysqli_real_escape_string($conn, $_POST['gname']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_gurdianname'";
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
			
			if($row['spu_newValue'] != $gname && $gname == $row_stu['stu_gurdianname']){
				
				$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_gurdianname'";
				mysqli_query($conn, $query);
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_gurdianname', '$gname')";
				if(!mysqli_query($conn, $query)){
					echo 'err';
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian's Name");
					exit();
				}
			}
			else{
				$query="update student_profile_update set spu_newValue='$gname' where student_id='$id' AND spu_field='stu_gurdianname'";
				if(!mysqli_query($conn, $query)){
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Guardian's Name");
					exit();
				}
			}
		}
	}
	
	
	elseif(isset($_POST['save_dob'])){
		$dob = mysqli_real_escape_string($conn, $_POST['dob']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_dob'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $dob && $dob == $row_stu['stu_dob']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_dob'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_dob', '$dob')";
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
			$query="update student_profile_update set spu_newValue='$dob' where student_id='$id' AND spu_field='stu_dob'";
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
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_gender'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $gender && $gender == $row_stu['stu_gender']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_gender'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_gender', '$gender')";
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
			$query="update student_profile_update set spu_newValue='$gender' where student_id='$id' AND spu_field='stu_gender'";
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
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_email'";
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
			$query = "select * from students where stu_email='$email'";
			$res=mysqli_query($conn,$query);
			$emailCheck = mysqli_num_rows($res);
			if($emailCheck > 1){
				header("Location: ../profile.php?errmail");
				exit();	
			}
			
			if($row['spu_newValue'] != $email && $email == $row_stu['stu_email']){
				
				$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
				$result= mysqli_query($conn, $query);
				$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_email'";
				mysqli_query($conn, $query);
				header("Location: ../profile.php?same");
				exit();
					
			}
			
			if($check < 1){
				$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_email', '$email')";
				if(!mysqli_query($conn, $query)){
					echo 'err';
					header("Location: ../profile.php?err");
					exit();
				}
				else{
					header("Location: ../profile.php?success=Email");
					exit();
				}
			}
			else{
				$query="update student_profile_update set spu_newValue='$email' where student_id='$id' AND spu_field='stu_email'";
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
	
	elseif(isset($_POST['save_contact'])){
		$contact = mysqli_real_escape_string($conn, $_POST['contact']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_contact'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $contact && $contact == $row_stu['stu_contact']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_contact'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_contact', '$contact')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Contact");
				exit();
			}
		}
		else{
			$query="update student_profile_update set spu_newValue='$contact' where student_id='$id' AND spu_field='stu_contact'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Contact");
				exit();
			}
		}		
	}
	elseif(isset($_POST['save_gcontact'])){
		$gcontact = mysqli_real_escape_string($conn, $_POST['gcontact']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_gurdiancontact'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $gcontact && $gcontact == $row_stu['stu_gurdiancontact']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_gurdiancontact'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_gurdiancontact', '$gcontact')";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Guardian's Contact");
				exit();
			}
		}
		else{
			$query="update student_profile_update set spu_newValue='$gcontact' where student_id='$id' AND spu_field='stu_gurdiancontact'";
			if(!mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?success=Guardian's Contact");
				exit();
			}
		}		
	}
	elseif(isset($_POST['save_address'])){
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_address'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $address && $address == $row_stu['stu_address']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_address'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_address', '$address')";
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
			$query="update student_profile_update set spu_newValue='$address' where student_id='$id' AND spu_field='stu_address'";
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
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_currentinstitute'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $school && $school == $row_stu['stu_currentinstitute']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_currentinstitute'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_currentinstitute', '$school')";
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
			$query="update student_profile_update set spu_newValue='$school' where student_id='$id' AND spu_field='stu_currentinstitute'";
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
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_university'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $board && $board == $row_stu['stu_university']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_university'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_university', '$board')";
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
			$query="update student_profile_update set spu_newValue='$board' where student_id='$id' AND spu_field='stu_university'";
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
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_highestdegree'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $he && $he == $row_stu['stu_highestdegree']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_highestdegree'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_highestdegree', '$he')";
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
			$query="update student_profile_update set spu_newValue='$he' where student_id='$id' AND spu_field='stu_highestdegree'";
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
		$subject  = mysqli_real_escape_string($conn, $_POST['subject']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_subjectCombo'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $subject  && $subject  == $row_stu['stu_subjectCombo']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_subjectCombo'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_subjectCombo', '$subject')";
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
			$query="update student_profile_update set spu_newValue='$subject' where student_id='$id' AND spu_field='stu_subjectCombo'";
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
		$dept  = mysqli_real_escape_string($conn, $_POST['dept']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_dept'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $dept  && $dept  == $row_stu['stu_dept']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_dept'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_dept', '$dept')";
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
			$query="update student_profile_update set spu_newValue='$dept' where student_id='$id' AND spu_field='stu_dept'";
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
		$yop  = mysqli_real_escape_string($conn, $_POST['yop']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_yearofpass'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $yop  && $yop  == $row_stu['stu_yearofpass']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_yearofpass'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_yearofpass', '$yop')";
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
			$query="update student_profile_update set spu_newValue='$yop' where student_id='$id' AND spu_field='stu_yearofpass'";
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
		$cur  = mysqli_real_escape_string($conn, $_POST['cur']);
		$query = "select * from student_profile_update where student_id='$id' AND spu_field='stu_currentStatus'";
		$res = mysqli_query($conn, $query);
		$check = mysqli_num_rows($res);
		$row=mysqli_fetch_array($res);
		$row_stu = getRow();
		
		if($row['spu_newValue'] != $cur  && $cur  == $row_stu['stu_currentStatus']){
			
			$query = "update student_profile_update set spu_newValue='' where stu_id='$id'";
			$result= mysqli_query($conn, $query);
			$query = "delete from student_profile_update where student_id='$id' AND spu_field='stu_currentStatus'";
			mysqli_query($conn, $query);
			header("Location: ../profile.php?same");
			exit();
				
		}
		
		if($check < 1){
			$query="insert into student_profile_update(student_id, spu_field, spu_newValue) values($id, 'stu_currentStatus', '$cur')";
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
			$query="update student_profile_update set spu_newValue='$cur' where student_id='$id' AND spu_field='stu_currentStatus'";
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
	elseif(isset($_POST['remove-update'])){
		$id  = mysqli_real_escape_string($conn, $_POST['id']);
		$attr  = mysqli_real_escape_string($conn, $_POST['attr']);
		
		$query="delete from student_profile_update where student_id=$id AND spu_field='$attr' AND spu_status IN(1,2)";
		if(!mysqli_query($conn, $query)){
				header("Location: ../pending_updates.php?err");
				exit();
			}
			else{
				header("Location: ../pending_updates.php");
				exit();
			}
	}
	elseif(isset($_POST['save'])){
		$id  = mysqli_real_escape_string($conn, $_POST['id']);
		$attr  = mysqli_real_escape_string($conn, $_POST['attr']);
		$newVal= mysqli_real_escape_string($conn, $_POST['newVal']);
		
		$query="update student_profile_update set spu_newValue = '$newVal' where student_id=$id AND spu_field='$attr'";
		if(!mysqli_query($conn, $query)){
			header("Location: ../pending_updates.php?err");
			exit();
		}
		else{
			header("Location: ../pending_updates.php");
			exit();
		}
	}
	elseif(isset($_POST['rmvReq'])){
		$id  = mysqli_real_escape_string($conn, $_POST['id']);
		$attr  = mysqli_real_escape_string($conn, $_POST['attr']);
		
		$query="delete from student_profile_update where student_id=$id AND spu_field='$attr' AND spu_status=0";
		if(!mysqli_query($conn, $query)){
			header("Location: ../pending_updates.php?err");
			exit();
		}
		else{
			header("Location: ../pending_updates.php");
			exit();
		}
		
		
	}
	else{
		header("Location: ../profile.php");
		exit();
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
	
	
	
	