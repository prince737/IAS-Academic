<?php
session_start();
include 'dbh.inc.php';

if((isset($_POST['type']) || isset($_POST['type1'])) && !isset($_POST['request']) && !isset($_POST['name']) && !isset($_POST['request_change'])){
	if(isset($_POST['type'])){	
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		
		header("Location: ../add_course.php?type=$type");
		exit();	
	}
	if(isset($_POST['type1'])){	
		$type1 = mysqli_real_escape_string($conn, $_POST['type1']);
		$radio = mysqli_real_escape_string($conn, $_POST['optradio']);
		
		header("Location: ../change_course.php?radio=$radio&type=$type1");
		exit();	
	}
}
elseif(isset($_POST['name']) && !isset($_POST['request']) ){
	
	$type = mysqli_real_escape_string($conn, $_POST['type']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
		
	header("Location: ../add_course.php?type=$type&name=$name");
	exit();
	
	
}
elseif(isset($_POST['request'])){
	$type = mysqli_real_escape_string($conn, $_POST['type']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$center = mysqli_real_escape_string($conn, $_POST['center']);
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	
	
	$query="select course_id from courses where course_name='$name' AND course_type='$type'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);
	$cid=$row['course_id'];
	echo $cid;
	
	
	$query="select center_id from centers where center_name='$center'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);
	$cenid=$row['center_id'];
	echo $cenid;
	
	$query="insert into add_course(student_id, course_id, center_id) values($id, $cid, $cenid)";
	if(!mysqli_query($conn,$query)){
		header("Location: ../add_course.php?err");
		exit();
	}
	else{
		header("Location: ../add_course.php?courseQueued=1");
		exit();
	}
}
elseif(isset($_POST['request_change'])){
	$type = mysqli_real_escape_string($conn, $_POST['type1']);
	$name = mysqli_real_escape_string($conn, $_POST['name1']);
	$radio = mysqli_real_escape_string($conn, $_POST['optradio']);
	$id = mysqli_real_escape_string($conn, $_POST['id']);	
	
	//FINDING COURSE ID
	$query = "select course_id from courses where course_name = '$name' AND course_type = '$type'";
	$res=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($res);
	$cid=$row['course_id'];
	
	//FINDING CENTER ID OF THE COURSE
	
	$query="select center_id from students_courses where student_id=$id and course_id=$radio AND registration_no IS NOT NULL";
	$res1=mysqli_query($conn, $query);
	$count=mysqli_num_rows($res1);
	$row1 = mysqli_fetch_array($res1);
	$cenid=$row1['center_id'];
	
	echo $cenid;
		
	//ERASING PREVIOUS RECORDS IF ANY	
	$query = "select * from course_change where new_course_id=$cid AND student_id=$id";
	$res = mysqli_query($conn,$query);
	$check = mysqli_num_rows($res);
	
	if($check > 0){
		$query = "delete from course_change where new_course_id=$cid AND student_id=$id";
		if(!mysqli_query($conn,$query)){
			header("Location: ../change_course.php?err");
			exit();
		}		
	}
	
	//INSERTING INTO TABLE
	$query="insert into course_change(student_id, center_id, new_course_id, old_course_id) values($id, $cenid, $cid, $radio)";
	if(!mysqli_query($conn,$query)){
		/*header("Location: ../change_course.php?erreeeee");
		exit();*/
	}
	else{
		/*header("Location: ../change_course.php?courseQueued=1");
		exit();*/
	}
}

elseif(isset($_POST['delete_req'])){
	$scid = mysqli_real_escape_string($conn, $_POST['sc_id']);
	
	$query="delete from students_courses where sc_id=$scid ";
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	if(!mysqli_query($conn, $query)){
		header("Location: ../add_course.php?err");
		exit();
	}
	else{
		header("Location: ../add_course.php?courserem=YUD");
		exit();
	}
}
elseif(isset($_POST['remove'])){
	$scid = mysqli_real_escape_string($conn, $_POST['sc_id']);
	$scstatus = mysqli_real_escape_string($conn, $_POST['sc_status']);
	$query;
	
	if($scstatus == 1){
		$query="update students_courses set sc_status=4 where sc_id=$scid ";
		
	}
	elseif($scstatus == 2){
		$query="delete from students_courses where sc_id=$scid ";
	}
	
	if(!mysqli_query($conn, $query)){
		header("Location: ../add_course.php?err");
		exit();
	}
	else{
		header("Location: ../add_course.php?courseclear=bhnJRTkmP");
		exit();
	}
	
}
elseif(isset($_POST['rmvReq'])){
	$id= mysqli_real_escape_string($conn, $_POST['id']);
	$newcor =mysqli_real_escape_string($conn, $_POST['newcor']);
	$oldcor =mysqli_real_escape_string($conn, $_POST['oldcor']);
	
	$query="select course_name from courses where course_id=$oldcor";
	$res=mysqli_query($conn, $query);
	$row=mysqli_fetch_array($res);
	$name=$row['course_name'];
	
	$query="delete from course_change where student_id=$id AND old_course_id=$oldcor AND new_course_id=$newcor";
	if(!mysqli_query($conn, $query)){
		header("Location: ../pending_changes.php?err");
		exit();
	}
	else{
		header("Location: ../pending_changes.php?courserem=$name");
		exit();
	}
	
}

elseif(isset($_POST['delete_list'])){
	$id= mysqli_real_escape_string($conn, $_POST['id']);
	$newcor =mysqli_real_escape_string($conn, $_POST['newcor']);
	$oldcor =mysqli_real_escape_string($conn, $_POST['oldcor']);
	
	$query = "delete from course_change where student_id=$id AND old_course_id=$oldcor AND new_course_id=$newcor";
	if(!mysqli_query($conn, $query)){
		header("Location: ../change-requests.php?err");
		exit();
	}
	else{
		header("Location: ../pending_changes.php?rem-list");
		exit();
	}
	
}