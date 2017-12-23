Well hello there!
<?php
	session_start();
	
	if(isset($_SESSION['student_id'])){
		echo $_SESSION['student_id'];
	}
	else{
		echo 'rtr';
	}
	
	
?>