<?php
	session_start();
	
	if(isset($_SESSION['student']) || isset($_COOKIE['student'])){
		echo 'Hello';
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