<?php


session_start();


if(isset($_POST['register']))
{
	
	include_once 'dbh.inc.php';
	
	$arr = array();
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$dob = mysqli_real_escape_string($conn, $_POST['date']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$gname = mysqli_real_escape_string($conn, $_POST['gname']);
	$gcontact = mysqli_real_escape_string($conn, $_POST['gcontact']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$he = mysqli_real_escape_string($conn, $_POST['he']);
	$inst = mysqli_real_escape_string($conn, $_POST['inst']);
	$yop = mysqli_real_escape_string($conn, $_POST['yop']);
	$course = mysqli_real_escape_string($conn, $_POST['course']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	
	
	if(empty($name) || empty($gender) || empty($dob) || empty($email) || empty($contact) || empty($gname) || empty($gcontact) || empty($address) || empty($he) || empty($inst) || empty($yop) || empty($course) || empty($pwd)) {
		$arr['emp'] = '1';	
		$query = http_build_query($arr);
		header("Location: ../registration.php?$query");	
	} 
	else 
	{
		//check if input characters are valid		
		
		if(!preg_match("/^[A-Za-z]*\s{1}[A-Za-z]*$/", $name))
		{
			$arr['nm'] = '1';		
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$arr['em'] = '1';			
		}
		
		if(!preg_match("/^[A-Za-z]*\s{1}[A-Za-z]*$/", $gname))
		{
			$arr['gnm'] = '1';		
		}
		
		if(!preg_match("/^[0-9]{10}$/", $contact))
		{
			$arr['ct'] = '1';		
		}
		
		if(!preg_match("/^[0-9]{10}$/", $gcontact))
		{
			$arr['gct'] = '1';		
		}
		
		if(count($arr) != 0)
		{
			$query = http_build_query($arr);
			header("Location: ../registration.php?$query");				
		}
		else
		{
			$sql = "select * from students where stu_email='$email'" ;
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0) 
			{
				header("Location: ../registration.php?signup=emailtaken");
				$val= array($name,$dob,$email,$contact,$gname,$gcontact,$address,$he,$inst,$yop);
				$query = http_build_query($val);
			header("Location: ../registration.php?$query&signup=emailtaken");	
				exit();
			} 
			else 
			{
				//Hashing the password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//Insert the user in db
				
				$sql = "insert into students (stu_name, stu_gender, stu_address, stu_gurdianname, stu_gurdiancontact, stu_highestdegree, stu_yearofpass, stu_currentinstitute, stu_course, stu_dob, stu_contact, stu_email, stu_password, stu_approvalstatus, stu_image) values ('$name', '$gender', '$address', '$gname', '$gcontact', '$he', '$yop', '$inst', '$course', '$dob', '$contact', '$email', '$hashedPwd', 0, '$file')";
				mysqli_query($conn, $sql);
				header("Location: ../registration.php?signup=success");
				exit();
			}
		}
	}	
	
} 
else {
	header("Location: ../registration.php");
	exit();
}
