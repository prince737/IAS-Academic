<?php
	session_start();
	include_once 'dbh.inc.php';
	
	if(isset($_POST['change'])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$oldPwd = mysqli_real_escape_string($conn, $_POST['old-pwd']);
		$newPwd = mysqli_real_escape_string($conn, $_POST['new-pwd']);
		
		$query = "select stu_password from students where stu_id=$id";
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($res);
		$hashedPwdCheck = password_verify($oldPwd, $row['stu_password']);
		
		if(!$hashedPwdCheck)
		{						
			header("Location: ../profile.php?errPwdUnset");
			exit();
		}
		elseif($hashedPwdCheck)
		{
			$hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
			$query = "update students set stu_password='$hashedPwd' where stu_id=$id";
			if(!$res = mysqli_query($conn, $query)){
				header("Location: ../profile.php?err");
				exit();
			}
			else{
				header("Location: ../profile.php?successPwdChange");
				exit();
			}	
		}
	}
	
	elseif(isset($_FILES["image"]["tmp_name"])){
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		
		$fileName = $_FILES['image']['name'];
		$fileTmpName = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$fileError = $_FILES['image']['error'];
		$fileType = $_FILES['image']['type'];
		
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
			
		$allow = array('jpg', 'jpeg', 'png');				
		
		if(in_array($fileActualExt, $allow)){
			if($fileError === 0)
			{
				if($fileSize < 10050000){
					
							
					$query="select stu_id,stu_imageLocation from students where stu_id='$id'";
					$result=mysqli_query($conn,$query);
					while($row=mysqli_fetch_array($result)){
						$fileNameNew = uniqid('', true).$row[stu_id].".".$fileActualExt;
					}
					$fileDest = '../StudentProfileImages/'.$fileNameNew;
					$dest= 'StudentProfileImages/'.$fileNameNew;
					
					$oldfile= "../".$row['stu_imageLocation'];
					unlink($oldfile);
					
					move_uploaded_file($fileTmpName, $fileDest);
								
					$query = "update students set stu_imageLocation='$dest' where stu_id = '$id'";
					if(!mysqli_query($conn, $query)){
						header("Location: ../profile.php?err");
						exit();
					}
					else{
						header("Location: ../profile.php?successChange");
						exit();
					}		
					
				}
				else{
					header("Location: ../profile.php?errLargeFile");
					exit();
				}		
			}
			else{
				header("Location: ../profile.php?err");
				exit();
			}
		}	
		else{
			header("Location: ../profile.php?errFileType");
			exit();
		}				
	}
	
	else{
		header("Location: ../profile.php");
		exit();
	}
	
	