<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['submit'])){
	
	
	$date = mysqli_real_escape_string($conn, $_POST['date']);
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	
	if(isset($_POST['save'])){
		$query="insert into notices(notices_content, notices_date, notices_status) values('$body', '$date', 1)";
	}
	else{
		$query="insert into notices(notices_content, notices_date, notices_status) values('$body', '$date', 0)";
	}
	
	if(!mysqli_query($conn, $query)){
		header("Location: ../admin_notices.php?err");
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
			
		$allow = array('doc', 'pdf');
		
		if(in_array($fileActualExt, $allow)){
			if($fileError === 0)
			{
				if($fileSize < 50000000){
					$query="select max(nid) from notices";
					$result=mysqli_query($conn, $query);	
					$row = mysqli_fetch_array($result);
					$id=$row['max(nid)'];
					$fileNameNew = "notices".$id.'.'.$fileActualExt;
					$fileDest = '../../notices/'.$fileNameNew;
					$dest = 'notices/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDest);
					$query ="update notices set notices_location='$dest' where nid='$id';";	
					mysqli_query($conn, $query);
					header("Location: ../admin_notices.php?success");
					exit();
				}
				else{
					$sql= "select max(nid) from notices";
					$result=mysqli_query($conn, $sql);	
					$row = mysqli_fetch_array($result);
					$id=$row['max(nid)'];
					$query="delete from notices where nid='$id'";
					mysqli_query($conn, $query);
					echo 'File too large.';
				}		
			}
			else{
				$sql= "select max(nid) from notices";
				$result=mysqli_query($conn, $sql);	
				$row = mysqli_fetch_array($result);
				$id=$row['max(nid)'];
				$query="delete from notices where nid='$id'";
				mysqli_query($conn, $query);
				echo 'Error uploading.';
			}
		}	
		else{
			$sql= "select max(nid) from notices";
			$result=mysqli_query($conn, $sql);	
			$row = mysqli_fetch_array($result);
			$id=$row['max(nid)'];
			$query="delete from notices where nid='$id'";
			mysqli_query($conn, $query);
			echo 'File type not allowed.';
		}
		
		
	}
	
}
elseif(isset($_POST['update'])){ //Notice Updating
	$date = $_POST['date'];
	$file = $_FILES['files'];
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	
	$nid= mysqli_real_escape_string($conn, $_POST['nid']);
	if(isset($_POST['save'])){
		$query="update notices set notices_date='$date', notices_content='$body', notices_status='1' where nid='$nid'";
	}
	else{
		$query="update notices set notices_date='$date', notices_content='$body', notices_status='0' where nid='$nid'";
	}
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_notices.php?err");
		exit();
	}
	else{
		if(empty($file)){
			header("Location: ../active_notices.php?success");
			exit();
		}
		else{
			$fileName = $_FILES['files']['name'];
			$fileTmpName = $_FILES['files']['tmp_name'];
			$fileSize = $_FILES['files']['size'];
			$fileError = $_FILES['files']['error'];
			$fileType = $_FILES['files']['type'];
				
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			$path = '../../'.$location;
			echo $path;
			if(!unlink($path)){
				header("Location: ../active_notices.php?err");
				exit();
				echo 'error';
			}
			else{
				
					
				$allow = array('doc', 'pdf');
				
				if(in_array($fileActualExt, $allow)){
					if($fileError === 0)
					{
						if($fileSize < 500000000){
							$fileNameNew = uniqid("", true).'.'.$fileActualExt;
							$fileDest = '../../notices/'.$fileNameNew;
							echo $fileDest;
							$dest = 'notices/'.$fileNameNew;
							move_uploaded_file($fileTmpName, $fileDest);
							$query ="update notices set notices_location='$dest' where nid='$nid';";	
							mysqli_query($conn, $query);
							header("Location: ../admin_notices.php?success");
							exit();
						}
						else{
							echo 'File too large.';
						}		
					}
					else{
						echo 'Error uploading.';
					}
				}	
				else{
					echo 'File type not allowed.';
				}
			}
		}
	}
}
elseif(isset($_POST['delete'])){
	$nid= mysqli_real_escape_string($conn, $_POST['nid']);
	$query="delete from notices where nid='$nid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_notices.php?err");
		exit();
	}
	else{
		header("Location: ../active_notices.php?dlt");
		exit();
	}
}
elseif(isset($_POST['deactivate'])){
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
	$query="update notices set notices_status=0 where nid='$nid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_notices.php?err");
		exit();
	}
	else{
		header("Location: ../active_notices.php");
		exit();
	}	
}
elseif(isset($_POST['activate'])){
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
	$query="update notices set notices_status=1 where nid='$nid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_notices.php?err");
		exit();
	}
	else{
		header("Location: ../active_notices.php");
		exit();
	}	
}

else{
	header("Location: ../../index.php");
	exit();
}