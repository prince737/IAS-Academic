<?php


session_start();
include_once 'dbh.inc.php';
include 'simple-crypt.inc.php';



$name = mysqli_real_escape_string($conn, $_POST['name']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$dob = mysqli_real_escape_string($conn, $_POST['date']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$gname = mysqli_real_escape_string($conn, $_POST['gname']);
$gcontact = mysqli_real_escape_string($conn, $_POST['gcontact']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$pin = mysqli_real_escape_string($conn, $_POST['pin']);
$state = mysqli_real_escape_string($conn, $_POST['state']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$he = mysqli_real_escape_string($conn, $_POST['he']);
$inst = mysqli_real_escape_string($conn, $_POST['inst']);
$yop = mysqli_real_escape_string($conn, $_POST['yop']);
$courseName = mysqli_real_escape_string($conn, $_POST['course_name']);
$courseType = mysqli_real_escape_string($conn, $_POST['course_type']);
$edu = mysqli_real_escape_string($conn, $_POST['edu']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']); 
$university = mysqli_real_escape_string($conn, $_POST['university']);
$college = mysqli_real_escape_string($conn, $_POST['college']); 
$school = mysqli_real_escape_string($conn, $_POST['school']); 
$courseName = mysqli_real_escape_string($conn, $_POST['course_name']);
$courseType = mysqli_real_escape_string($conn, $_POST['course_type']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$hidden = $_POST['hidden'];
$center = mysqli_real_escape_string($conn, $_POST['center_name']);
$he_other = mysqli_real_escape_string($conn, $_POST['he_other']);
$sub_combo = mysqli_real_escape_string($conn, $_POST['sub_combo']);
$religion = mysqli_real_escape_string($conn, $_POST['religion']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$blood = mysqli_real_escape_string($conn, $_POST['blood']);
$captcha = mysqli_real_escape_string($conn, $_POST['captcha']);
$no1 = mysqli_real_escape_string($conn, $_POST['no1']);
$no2 = mysqli_real_escape_string($conn, $_POST['no2']);
$operator = mysqli_real_escape_string($conn, $_POST['operator']);


// highest education - edu or he
// current institute - school,college,inst
//dept, stream, yop- btech mtech  

    $ans=0;
	switch($operator) {
		case "+":
		    $ans=$no1+$no2;  
			break;
		case "-":
		    $ans=$no1-$no2;  
			break;
		case "*":
		    $ans=$no1*$no2;  
			break;	
	}
if($ans!=$captcha){
	$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'),$edu, $dept, $university, $college, $school, $he_other, $sub_combo,$religion,$blood,$category,$street,$pin,$city,$state);
	$query = http_build_query($val);		
	header("Location: ../registration.php?$query&wrongcaptcha");	
	exit();
}

if(isset($_POST['register']))
{	
	$arr = array();
	
	
	
		
	$fileName = $_FILES['image']['name'];
	$fileTmpName = $_FILES['image']['tmp_name'];
	$fileSize = $_FILES['image']['size'];
	$fileError = $_FILES['image']['error'];
	$fileType = $_FILES['image']['type'];
	
	
	
	
		
	
	if(empty($name) || empty($gender) || empty($dob) || empty($email) || empty($contact) || empty($gname) || empty($gcontact) || empty($street) || empty($pin) || empty($city) || empty($state) || empty($he) ||  empty($courseType) || empty($courseName) || empty($pwd) || empty($center)) {
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
				$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'),$edu, $dept, $university, $college, $school, $he_other, $sub_combo,$religion,$blood,$category,$street,$pin,$city,$state);
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
				
				$query = "select center_id from centers where center_name='$center'";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($result)){ 
					$centerid = $row['center_id'];
				}
				
				
				
				//SETTING INSTITUTE
				$inst = $inst.$school.$college;
				
				
				if($he =='Other'){
					$he=$he_other;
				}
				
				$date = date("Y-m-d");

				$appId= date('d');	
				$appId.= date('m');	
				$appId.= date('y');	
				
				$query="select max(substr(stu_applicationId,7,5)) as max from students";
				$res=mysqli_query($conn, $query);
				$check=mysqli_num_rows($res);
				if($check < 1){
					$appId.='00001';
				}
				else{
					$row=mysqli_fetch_array($res);
					$appId .= str_pad($row['max'] + 1, 5, 0, STR_PAD_LEFT);
				}
				
				$sql = "insert into students (stu_name, stu_gender, stu_street, stu_pin, stu_city, stu_state, stu_gurdianname, stu_gurdiancontact, stu_religion, stu_category, stu_blood, stu_highestdegree, stu_yearofpass, stu_currentinstitute, stu_dept, stu_university, stu_subjectCombo, stu_currentStatus, stu_dob, stu_contact, stu_email, stu_dateofapplication, stu_applicationId, stu_password, stu_approvalstatus) values ('$name', '$gender', '$street', '$pin', '$city', '$state', '$gname', '$gcontact', '$religion', '$category', '$blood', '$he', '$yop', '$inst',  '$dept', '$university', '$sub_combo', '$edu', '$dob', '$contact', '$email', '$date', '$appId', '$hashedPwd', 0)";
				if(!mysqli_query($conn, $sql)){
					header("Location: ../registration.php?err");
					exit();
				}
				else{
					$query="select stu_id from students where stu_email='$email'";
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					
					$sql="insert into students_courses(student_id, course_id,center_id) values(".$row['stu_id'].", $cid, $centerid)";
					if(!mysqli_query($conn, $sql)){
						$query="delete from students where stu_email='$email'";
						mysqli_query($conn,$query);
						header("Location: ../registration.php?err");
						exit();
					}
					else{					
					
				
						$fileExt = explode('.', $fileName);
						$fileActualExt = strtolower(end($fileExt));
					
						$allow = array('jpg', 'jpeg', 'png');
						
						if(in_array($fileActualExt, $allow)){
							if($fileError === 0)
							{
								if($fileSize < 10050000){
									
									
									$query="select stu_id from students where stu_email='$email'";
									$result=mysqli_query($conn,$query);
									while($row=mysqli_fetch_array($result)){
										$fileNameNew = uniqid('', true).$row[stu_id].".".$fileActualExt;
									}
									$fileDest = '../StudentProfileImages/'.$fileNameNew;
									$dest= 'StudentProfileImages/'.$fileNameNew;

									move_uploaded_file($fileTmpName, $fileDest);
						
									echo $fileDest;	
												
									$query = "update students set stu_imageLocation='$dest' where stu_email = '$email'";
									if(!mysqli_query($conn, $query)){
										header("Location: ../registration.php?errsql");
										exit();
									}
									else{
										$name=simple_crypt($name,'e');
										$course=simple_crypt($courseName,'e');
										$center=simple_crypt($center,'e');
										$appid=simple_crypt($appId,'e');
										
											
										
										header("Location: ../registration.php?success=$name&&crs=$course&&cen=$center&&appid=$appid");
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
	}	
	
} 
elseif(isset($_POST['course_name']) && $hidden != 'he'){	
		
	$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'),$edu, $dept, $university, $college, $school, $he_other, $sub_combo,$religion,$blood,$category,$street,$pin,$city,$state);
	$query1 = http_build_query($val);	
	
	$courseType = $_POST['course_type'];	
	
	$query = http_build_query($arr);
	header("Location: ../registration.php?class=$he&$query1&select=$courseType&courseName=$courseName#education");
	exit();
	
	
	
}

elseif(isset($_POST['course_type']) && $hidden != 'he'){
	
		
	$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'),$edu, $dept, $university, $college, $school, $he_other, $sub_combo,$religion,$blood,$category,$street,$pin,$city,$state);
	$query1 = http_build_query($val);	
	
	$courseType = $_POST['course_type'];
	
	
	header("Location: ../registration.php?class=$he&$query1&select=$courseType#education");
	exit();
	
}

elseif(isset($_POST['he']) && $hidden == 'he'){
	 	
	$val= array(simple_crypt($name,'e'),simple_crypt($dob,'e'),simple_crypt($email,'e'),simple_crypt($contact,'e'),simple_crypt($gname,'e'),simple_crypt($gcontact,'e'),simple_crypt($address,'e'),simple_crypt($he,'e'),simple_crypt($inst,'e'),simple_crypt($yop,'e'),simple_crypt($gender, 'e'),$edu, $dept, $university, $college, $school, $he_other, $sub_combo,$religion,$blood,$category,$street,$pin,$city,$state);
	$query1 = http_build_query($val);	
	
	header("Location: ../registration.php?class=$he&$query1&#education");
	exit();	

}


else {
	header("Location: ../registration.php?");
	exit();
}
