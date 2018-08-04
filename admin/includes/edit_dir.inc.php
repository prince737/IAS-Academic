<?php

session_start();
include_once '../../includes/dbh.inc.php';
include '../../includes/simple-crypt.inc.php';


if(isset($_POST['edit_dir'])){
	$name= mysqli_real_escape_string($conn, $_POST['name']);
	$level= mysqli_real_escape_string($conn, $_POST['level']);
	$did= mysqli_real_escape_string($conn, $_POST['did']);

	echo $name.$level.$did;
	
	$sql = "update directories set dir_name='$name', dir_level=$level where dir_id='$did'";
	if(!mysqli_query($conn, $sql)){
		//header("Location: ../edit_dir.php?err");
		//exit();
	}
	else{
		$dname = simple_crypt($name,'e');
		$id = simple_crypt($did,'e');
		header("Location: ../edit_dir.php?nm='$dname'&lv='$level'&id='$id'");
		exit();
	}

}