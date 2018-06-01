<?php
	session_start();
	include_once '../../includes/dbh.inc.php';
	if(isset($_POST['save'])){
		
		
		$caption = mysqli_real_escape_string($conn, $_POST['caption']);
		$folder = mysqli_real_escape_string($conn, $_POST['folder']);
		
		
		$fileName = $_FILES['image']['name'];
		$fileTmpName = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$fileError = $_FILES['image']['error'];
		$fileType = $_FILES['image']['type'];
		
		print_r($fileName);
		
		for($i = 0; $i< count($fileName); $i++){
			
			$fileExt = explode('.', $fileName[$i]);
			$fileActualExt = strtolower(end($fileExt));
			
			$allow = array('jpg', 'jpeg', 'png', 'gif');
			
			if(in_array($fileActualExt, $allow)){
				if($fileError[$i] === 0)
				{
					if($fileSize[$i] < 50000000){
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDest = '../../gallery/'.$folder.'/'.$fileNameNew;
						$dest= 'gallery/'.$folder.'/'.$fileNameNew;
						$fileDestAll = '../../gallery/All/'.$fileNameNew;
						move_uploaded_file($fileTmpName[$i], $fileDest);
						copy($fileDest, $fileDestAll);
						$query = "insert into gallery(gallery_folder, gallery_caption, gallery_location) values('$folder', '$caption', '$dest')";
						if(!mysqli_query($conn, $query)){
							header("Location: ../add_image.php?errsql");
							exit();
						}
						else{
							header("Location: ../add_image.php?success");
							exit();
						}
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
	}
	elseif(isset($_POST['delete'])){
		$location=  mysqli_real_escape_string($conn, $_POST['location']);
		$gid= mysqli_real_escape_string($conn, $_POST['gid']);
		
		$f= explode('/', $location);
		$folder = $f[1];
		
		$path = "../../".$location;
		
		if(!unlink($path)){
			header("Location: ../remove_image.php?err&folder=$folder");
			exit();
		}
		else{
			$query= "delete from gallery where gid=$gid";
			if(!mysqli_query($conn,$query)){
				header("Location: ../remove_image.php?err&folder=$folder");
				exit();
			}
			else{
				header("Location: ../remove_image.php?success&folder=$folder");
				exit();
			}
		}
	}
	else
	{
		header("Location: ../add_image.php");
		exit();
	}