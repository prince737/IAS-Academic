<?php
	session_start();
	include 'includes/dbh.inc.php';
	$result;
	
	if(isset($_SESSION['student']) ){
		$email = $_SESSION['student'];
		$query = "select * from students where stu_email = '$email'";
		global $result;
		$result = mysqli_query($conn, $query);
		profile();	
	}
	elseif(isset($_COOKIE['student'])){
		$email = $_COOKIE['student'];
		$query = "select * from students where stu_email = '$email'";
		global $result;
		$result = mysqli_query($conn, $query);
		profile();
	}
	else{
		
		header("Location: login.php");
	}
	

	function profile(){
		global $result;
		$row = mysqli_fetch_array($result);
		echo 'Hello'.$row['stu_name'];
		echo '
			<form class="form" action="includes/logout.inc.php" method="POST">
				<button type="submit" name="logout">Logout</button>
			</form>
		';
	}
		
?>