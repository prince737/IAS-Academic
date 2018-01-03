<?php

	if(isset($_POST['upload'])){
		include_once '../../includes/dbh.inc.php';
		
		
		$folder = mysqli_real_escape_string($conn, $_POST['folder']);
		
		$fileName = $_FILES['image']['name'];
		$fileTmpName = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$fileError = $_FILES['image']['error'];
		$fileType = $_FILES['image']['type'];
		
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		
		$allow = array('jpg', 'jpeg', 'png', 'gif');
		
		if(in_array($fileActualExt, $allow)){
			if($fileError === 0)
			{
				if($fileSize < 50000000){
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDest = '../../gallery/'.$folder.'/'.$fileNameNew;
					$fileDestAll = '../../gallery/All/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDest);
					copy($fileDest, $fileDestAll);
					header("Location: ../add_image.php?success");
					exit();
				}
				else{
					header("Location: ../add_image.php?err1");
					exit();
				}		
			}
			else{
				header("Location: ../add_image.php?err2");
				exit();
			}
		}	
		else{
			header("Location: add_image.php?err3");
			exit();
		}
	}
	else
	{
		header("Location: ../add_image.php");
		exit();
	}