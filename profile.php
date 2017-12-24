<?php
	session_start();
	
	if(isset($_SESSION['student'])){
		echo 'Hello '.$_SESSION['student']['stu_name'];
		echo '
			<form class="form" action="includes/logout.inc.php" method="POST">
				<button type="submit" name="logout">Logout</button>
			</form>
		';
	}
	else{
		header("Location: login.php");
	}
	
?>