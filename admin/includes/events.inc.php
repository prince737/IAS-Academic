<?php

session_start();
include_once '../../includes/dbh.inc.php';

if(isset($_POST['submit'])){	
	$startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
	$enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
	$heading = mysqli_real_escape_string($conn, $_POST['heading']);
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	$stime = mysqli_real_escape_string($conn, $_POST['stime']);
	$etime = mysqli_real_escape_string($conn, $_POST['etime']);
	
	if($_POST['courses'][0]=='all'){
		$query= "select * from courses";
		$res=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($res)){
			$courses[] = $row['course_id'];
		}
	}
	else{
		foreach($_POST['courses'] as $course){
			$courses[] = $course;
		}
	}
	
	
	if(isset($_POST['save'])){
		$query="insert into events(events_startdate, events_enddate, events_starttime, events_endtime, events_heading, events_body, events_status) values('$startdate', '$enddate', '$stime', '$etime', '$heading', '$body', 1)";
	}
	else{
		$query="insert into events(events_startdate, events_enddate, events_starttime, events_endtime, events_heading, events_body, events_status) values('$startdate', '$enddate', '$stime', '$etime', '$heading', '$body', 0)";
	}
	
	if(!mysqli_query($conn, $query)){
		header("Location: ../new_event.php?err");
		exit();
	}
	else{
		$query="select max(eid) as max from events";
		$res=mysqli_query($conn,$query);
		$row=mysqli_fetch_array($res);
		foreach($courses as $course){
			$courses[] = $course;			
			$query="insert into event_for values(".$row['max'].",$course)";
			mysqli_query($conn,$query);
		}
		
		header("Location: ../new_event.php?success");
		exit();
	}
}
elseif(isset($_POST['update'])){
	$startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
	$enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
	$heading = mysqli_real_escape_string($conn, $_POST['heading']);
	$body = mysqli_real_escape_string($conn, $_POST['body']);
	$stime = mysqli_real_escape_string($conn, $_POST['stime']);
	$etime = mysqli_real_escape_string($conn, $_POST['etime']);
	$eid = mysqli_real_escape_string($conn, $_POST['eid']);
	
	if($_POST['courses'][0]=='all'){
		$query= "select * from courses";
		$res=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($res)){
			$courses[] = $row['course_id'];
		}
	}
	else{
		foreach($_POST['courses'] as $course){
			$courses[] = $course;
		}
	}
	
	
	if(isset($_POST['save'])){
		$query="update events set events_startdate='$startdate', events_enddate='$enddate', events_starttime='$stime', events_endtime='$etime', events_heading='$heading', events_body='$body', events_status=1 where eid=$eid";
	}
	else{
		$query="update events set events_startdate='$startdate', events_enddate='$enddate', events_starttime='$stime', events_endtime='$etime', events_heading='$heading', events_body='$body', events_status=0 where eid=$eid";
	}
	if(!mysqli_query($conn, $query)){
		header("Location: ../active_events.php?err");
		exit();
	}
	else{		
		$q1="delete from event_for where event_id=$eid";
		mysqli_query($conn,$q1);
		foreach($courses as $course){
			$courses[] = $course;			
			$query="insert into event_for values($eid,$course)";
			mysqli_query($conn,$query);
		}
		
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
