<?php
	session_start();
	include 'dbh.inc.php';

	$date = date("d/m/Y");
	$sql = "update results set publish_status = 1, publish_date= '$date' where publish_status = 0";
	mysqli_query($conn, $sql);

	exit();

?>