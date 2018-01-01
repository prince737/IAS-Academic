<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['submit'])){
	
	
	$startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
	$enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
	$heading = mysqli_real_escape_string($conn, $_POST['heading']);
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	$time = mysqli_real_escape_string($conn, $_POST['time']);
	
	if(isset($_POST['save'])){
		$query="insert into events(events_startdate, events_enddate, events_time, events_heading, events_body, events_status) values('$startdate', '$enddate', '$time', '$heading', '$body', 1)";
	}
	else{
		$query="insert into events(events_startdate, events_enddate, events_time, events_heading, events_body, events_status) values('$startdate', '$enddate', '$time', '$heading', '$body', 0)";
	}
	
	if(!mysqli_query($conn, $query)){
		header("Location: ../new_event.php?err");
		exit();
	}
	else{
		header("Location: ../new_event.php?success");
		exit();
	}
}
elseif(isset($_POST['update'])){
	$startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
	$enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
	$heading = mysqli_real_escape_string($conn, $_POST['heading']);
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	$time = mysqli_real_escape_string($conn, $_POST['time']);
	
	if(isset($_POST['save'])){
		$query="update events set events_startdate='$startdate', events_enddate='$enddate', events_time='$time', events_heading='$heading', events_body='$body', events_status=1";
	}
	else{
		$query="update events set events_startdate='$startdate', events_enddate='$enddate', events_time='$time', events_heading='$heading', events_body='$body', events_status=0";
	}
	
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_events.php?err");
		exit();
	}
	else{
		header("Location: ../active_events.php?success");
		exit();
	}
}
elseif(isset($_POST['delete'])){
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	$query="delete from events where eid='$eid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_events.php?err");
		exit();
	}
	else{
		header("Location: ../active_events.php?dlt");
		exit();
	}
}
elseif(isset($_POST['deactivate'])){
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	$query="update events set events_status=0 where eid='$eid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_events.php?err");
		exit();
	}
	else{
		header("Location: ../active_events.php");
		exit();
	}	
}
elseif(isset($_POST['activate'])){
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	$query="update events set events_status=1 where eid='$eid'";
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_events.php?err");
		exit();
	}
	else{
		header("Location: ../active_events.php");
		exit();
	}	
}
else{
	header("Location: ../../index.php");
	exit();
}
