<?php

session_start();
include_once '../../includes/dbh.inc.php';

$cname=$_POST['course_name'];
$ctype=$_POST['ctype'];


if(isset($_POST['ctype']) && $ctype!=0 && !isset($_POST['upload_all'])){
	header("Location: ../add_notes.php?cname=$cname&ctype=$ctype");	
	exit();
}

if(isset($_POST['course_name']) && $ctype==0 && !isset($_POST['upload_all'])){
	
	header("Location: ../add_notes.php?$cid&cname=$cname");	
	exit();
}
if(isset($_POST['upload_all'])){
	$cid = mysqli_real_escape_string($conn, $_POST['ctype']);
	$ntype = mysqli_real_escape_string($conn, $_POST['ntype']);
	$date = mysqli_real_escape_string($conn, $_POST['date']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	foreach ($_POST['centers'] as $center){
		$centers[]= $center;		
	}
	
	$query="select * from notes where notes_name='$name'";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		header("Location: ../add_notes.php?nameError");
		exit();
	}
	
	$query="insert into notes(notes_name, course_id, notes_type,notes_date, notes_status) values('$name', $cid,'$ntype', '$date', 'Active')";
	if(!mysqli_query($conn, $query)){
		header("Location: ../add_notes.php?errrrr");
		exit();
	}
	else{
		
		
		//FILE UPLOAD
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		echo $fileActualExt;
			
		$allow = array('doc', 'pdf', 'mp4', '3gp', 'mpeg4', 'mpeg');
		
		if(in_array($fileActualExt, $allow)){
			if($fileError === 0)
			{
				
				$query="select max(nid) from notes";
				$result=mysqli_query($conn, $query);	
				$row = mysqli_fetch_array($result);
				$id=$row['max(nid)'];
				$fileNameNew = $name.'.'.$fileActualExt;
				$fileDest = '../../notes/'.$fileNameNew;
				$dest = 'notes/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDest);
				$query ="update notes set notes_location='$dest' where nid='$id';";	
				mysqli_query($conn, $query);
				foreach ($centers as $center){
					$insertQuery= "insert into notes_center(notes_id, center_id) values($id, $center)";			
					mysqli_query($conn, $insertQuery);
				}
				//header("Location: ../add_notes.php?success");
				//exit();
				
			}
			else{
				$sql= "select max(nid) from notes";
				$result=mysqli_query($conn, $sql);	
				$row = mysqli_fetch_array($result);
				$id=$row['max(nid)'];
				$query="delete from notes where nid='$id'";
				mysqli_query($conn, $query);
				echo 'Error uploading.';
			}
		}	
		else{
			$sql= "select max(nid) from notes";
			$result=mysqli_query($conn, $sql);	
			$row = mysqli_fetch_array($result);
			$id=$row['max(nid)'];
			$query="delete from notes where nid='$id'";
			mysqli_query($conn, $query);
			echo 'File type not allowed.';
		}
		
	}
}

if(isset($_POST['upload'])){
	$id = mysqli_real_escape_string($conn, $_POST['sid']);
	$ntype = mysqli_real_escape_string($conn, $_POST['ntype']);
	$date = mysqli_real_escape_string($conn, $_POST['date']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	
	$query="select * from notes_individual where notes_name='$name'";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		header("Location: ../add_notes.php?nameError");
		exit();
	}
	
	$query="select * from students where stu_roll='$id'";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck<1){
		header("Location: ../add_notes.php?sid=invalid");
		exit();
	}
	else{
		$query="insert into notes_individual(notes_name, sid, notes_type, notes_date, notes_status) values('$name', '$id', '$ntype', '$date', 'Active')";
		if(!mysqli_query($conn, $query)){
			header("Location: ../add_notes.php?errff");
			exit();
		}
		else{
		
		
			//FILE UPLOAD
			$fileName = $_FILES['file1']['name'];
			$fileTmpName = $_FILES['file1']['tmp_name'];
			$fileSize = $_FILES['file1']['size'];
			$fileError = $_FILES['file1']['error'];
			$fileType = $_FILES['file1']['type'];
			
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			
			$allow = array('doc', 'pdf', 'mp4', '3gp', 'mpeg4', 'mpeg');
		
			if(in_array($fileActualExt, $allow)){
				if($fileError === 0)
				{
					
					$query="select max(nid) from notes_individual";
					$result=mysqli_query($conn, $query);	
					$row = mysqli_fetch_array($result);
					$id=$row['max(nid)'];
					$fileNameNew = $name.'.'.$fileActualExt;
					$fileDest = '../../notes_individual/'.$fileNameNew;
					$dest = 'notes_individual/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDest);
					$query ="update notes_individual set notes_location='$dest' where nid='$id';";	
					mysqli_query($conn, $query);					
					header("Location: ../add_notes.php?success");
					exit();
					
				}
				else{
					$sql= "select max(nid) from notes_individual";
					$result=mysqli_query($conn, $sql);	
					$row = mysqli_fetch_array($result);
					$id=$row['max(nid)'];
					$query="delete from notes_individual where nid='$id'";
					mysqli_query($conn, $query);
					echo 'Error uploading.';
				}
			}	
			else{
				$sql= "select max(nid) from notes_individual";
				$result=mysqli_query($conn, $sql);	
				$row = mysqli_fetch_array($result);
				$id=$row['max(nid)'];
				$query="delete from notes_individual where nid='$id'";
				mysqli_query($conn, $query);
				echo 'File type not allowed.';
			}
		
		}
		
	}

	

	
}
if(isset($_POST['remove'])){
	$date=date('Y-m-d', strtotime('-15 day'));
	$query="select * from notes where notes_date<='$date'";
	$res=mysqli_query($conn,$query);
	$count=mysqli_num_rows($res);
	if($count==0){
		header("Location: ../remove_notes.php?NotFound");
		exit();
	}
	while($row=mysqli_fetch_array($res)){
		$path = "../../".$row['notes_location'];
		if(!unlink($path)){
			header("Location: ../remove_notes.php?err");
			exit();
		}
		else{
			$query="delete from notes where nid=".$row['nid'];
			if(!mysqli_query($conn, $query)){
				header("Location: ../remove_notes.php?err");
				exit();
			}
			else{
				header("Location: ../remove_notes.php?date=$date&rem=1");
				exit();
			}
		}
	}	
}
if(isset($_POST['remi'])){
	$date=date('Y-m-d', strtotime('-15 day'));
	$query="select * from notes_individual where notes_date<='$date'";
	$res=mysqli_query($conn,$query);
	$count=mysqli_num_rows($res);
	if($count==0){
		header("Location: ../remi_notes.php?NotFound");
		exit();
	}
	while($row=mysqli_fetch_array($res)){
		$path = "../../".$row['notes_location'];
		if(!unlink($path)){
			header("Location: ../remi_notes.php?err");
			exit();
		}
		else{
			$query="delete from notes_individual where nid=".$row['nid'];
			if(!mysqli_query($conn, $query)){
				header("Location: ../remi_notes.php?err");
				exit();
			}
			else{
				header("Location: ../remi_notes.php?date=$date&rem=1");
				exit();
			}
		}
	}	
}
if(isset($_POST['rem_one'])){
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
	$query="select * from notes where nid='$nid'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);
	$path = "../../".$row['notes_location'];
	if(!unlink($path)){
		header("Location: ../remove_notes.php?err");
		exit();
	}
	else{
		$query="delete from notes where nid=".$row['nid'];
		if(!mysqli_query($conn, $query)){
			header("Location: ../remove_notes.php?err");
			exit();
		}
		else{
			header("Location: ../remove_notes.php?rem=1");
			exit();
		}
	}
	
}
if(isset($_POST['remi_one'])){
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
	$query="select * from notes_individual where nid='$nid'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);
	$path = "../../".$row['notes_location'];
	if(!unlink($path)){
		header("Location: ../remi_notes.php?err");
		exit();
	}
	else{
		$query="delete from notes_individual where nid=".$row['nid'];
		if(!mysqli_query($conn, $query)){
			header("Location: ../remi_notes.php?err");
			exit();
		}
		else{
			header("Location: ../remi_notes.php?rem=1");
			exit();
		}
	}
	
}









