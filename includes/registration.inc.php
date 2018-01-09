<?php


session_start();
include_once 'dbh.inc.php';
include 'simple-crypt.inc.php';


if(isset($_POST['register']))
{
	
	
	
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
	$courseName = mysqli_real_escape_string($conn, $_POST['course_name']);
	$courseType = mysqli_real_escape_string($conn, $_POST['course_type']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		
	$fileName = $_FILES['image']['name'];
	$fileTmpName = $_FILES['image']['tmp_name'];
	$fileSize = $_FILES['image']['size'];
	$fileError = $_FILES['image']['error'];
	$fileType = $_FILES['image']['type'];
	
	
	
	
		
	
	if(empty($name) || empty($gender) || empty($dob) || empty($email) || empty($contact) || empty($gname) || empty($gcontact) || empty($address) || empty($he) || empty($inst) || empty($yop) || empty($courseType) || empty($courseName) || empty($pwd)) {
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
				$val= array(simple_crypt($name,'e'), simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'));
				$query = http_build_query($val);
			header("Location: ../registration.php?$query&signup=emailtaken");	
				exit();
			} 
			else 
			{
				//Hashing the password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//Insert the user in db
				
				$query = "select course_id from courses where course_name='$courseName' and course_type='$courseType'";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($result)){ 
					$cid = $row['course_id'];
				}
				echo $cid;
				$sql = "insert into students (stu_name, cid, stu_gender, stu_address, stu_gurdianname, stu_gurdiancontact, stu_highestdegree, stu_yearofpass, stu_currentinstitute, stu_dob, stu_contact, stu_email, stu_password, stu_approvalstatus) values ('$name', $cid, '$gender', '$address', '$gname', '$gcontact', '$he', '$yop', '$inst', '$dob', '$contact', '$email', '$hashedPwd', 0)";
				mysqli_query($conn, $sql);
				
				
				$fileExt = explode('.', $fileName);
				$fileActualExt = strtolower(end($fileExt));
			
				$allow = array('jpg', 'jpeg', 'png');
				
				if(in_array($fileActualExt, $allow)){
					if($fileError === 0)
					{
						if($fileSize < 1050000){
							
							
							$query="select stu_id from students where stu_email='$email'";
							$result=mysqli_query($conn,$query);
							while($row=mysqli_fetch_array($result)){
								$fileNameNew = uniqid('', true).$row[stu_id].".".$fileActualExt;
							}
							$fileDest = '../StudentProfileImages/'.$fileNameNew;
							$dest= 'StudentProfileImages/'.$fileNameNew;
							
							move_uploaded_file($fileTmpName, $fileDest);
							
							
							
							$query = "update students set stu_imageLocation='$dest' where stu_email = '$email'";
							if(!mysqli_query($conn, $query)){
								header("Location: ../registration.php?errsql");
								exit();
							}
							else{
								header("Location: ../registration.php?signup=success");
								exit();
							}
						}
						else{
							header("Location: ../registration.php?err1");
							exit();
						}		
					}
					else{
						header("Location: ../registration.php?err2");
						exit();
					}
				}	
				else{
					header("Location: registration.php?err3");
					exit();
				}	
								
				
			}
		}
	}	
	
} 
elseif(isset($_POST['course_type'])){
	
	
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
	
	$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'));
	$query1 = http_build_query($val);
		
	
	
	
	
	$courseType = $_POST['course_type'];
	
	$query = "select course_name from courses where course_type = '$courseType'";
	$result = mysqli_query($conn, $query);
	$i=20;
	while($row = mysqli_fetch_array($result)){
		$arr[$i]= simple_crypt($row['course_name'], 'e');
		$i++;
	}
	$max = $i-20;
	$query = http_build_query($arr);
	header("Location: ../registration.php?$query&$query1&select=$courseType&limit=$max#course");
	exit();
	
}
else {
	header("Location: ../registration.php?");
	exit();
}
