<?php
	session_start();
	
	include_once '../includes/dbh.inc.php';
	if(!isset($_SESSION['admin'])){
		header("Location: admin_login.php");
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>All Question Papers | IAS</title>
	<link rel="icon" type="image/jpg" href="../images/logo.jpg" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="css/notices.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>		
			
	<div class="container-fluid display-table">
		<div class="row display-table-row">
			<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="mySidebar">
				<h1 class="hidden-sm hidden-xs">Navigation</h1>				
				<ul > 
					<li class="link">
						<a href="admin.php">
							<i class="fa fa-th" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Dashboard</span>
						</a>
					</li>
					<li class="link">
						<a href="#collapse-poststd" data-toggle="collapse" aria-control="collapse-poststd">
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Students</span>
						</a>
						<ul class="collapse collapsable" id="collapse-poststd" style="margin:0px; padding:0px; ">
							<li>
								<a href="students_all.php">
									<span>All Students</span>
								</a>
							</li>
							<li>
								<a href="students_profile.php">
									<span>Profile Updation Requests</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="link">
						<a href="#collapse-post1c" data-toggle="collapse" aria-control="collapse-post1c">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Courses</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post1c" style="margin:0px; padding:0px; ">
							<li>
								<a href="#">
									<span>Add New</span>
								</a>
							</li>
							<li>
								<a href="update_course.php">
									<span>Update Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post1" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Notices</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post1" style="margin:0px; padding:0px; ">
							<li>
								<a href="admin_notices.php">
									<span>Create New</span>
								</a>
							</li>
							<li>
								<a href="active_events.php">
									<span>View Active</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post2" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Events</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post2" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_event.php">
									<span>Create New</span>
								</a>
							</li>
							<li>
								<a href="active_events.php">
									<span>View Active</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-pos2" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-book" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Study Material</span>
						</a>
						<ul class="collapse collapsable" id="collapse-pos2" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_notes.php">
									<span>Add New</span>
								</a>
							</li>
							<li>
								<a href="remove_notes.php">
									<span>Remove Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="#collapse-post21" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-picture-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Gallery</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post21" style="margin:0px; padding:0px; ">
							<li>
								<a href="add_image.php">
									<span>Add New Images</span>
								</a>
							</li>
							<li>
								<a href="remove_image.php">
									<span>Delete Existing</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="link">
						<a href="queries.php">
							<i class="fa fa-question-circle-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Queries</span>
						</a>
					</li>
					<li class="link">
						<a href="set.php">
							<i class="fa fa-pencil"></i>
							<span class="hidden-sm hidden-xs">Scholarship Entrance Test</span>
						</a>
					</li>
					<li class="link online-exam">
						<a href="online_exam.php">
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Online Exams</span>
						</a>
					</li>
				</ul>				
			</div>
			<div class="col-md-10 col-sm-11 display-table-cell valign-top">
				<div class="row">
					<header id="nav-header" class="clearfix">
						<div class="col-md-5">
							<nav class="navbar-default pull-left">
								<button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#mySidebar">
									<span class="sr-only">Toggle Notification</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</nav>
							<a class="navbar-brand hidden-sm hidden-xs" href="../index.php" target="_blank"><span class="brand"><span>I</span>NSTITUTE OF <span>A</span>PPLIED <span>S</span>CIENCE</span></a>
						</div>
						<div class="col-md-7">
							<ul class="pull-right">
								<li id="welcome" class="hidden-xs">Welcome to your administration area</li>
								<li class="fixed-width">
									<a href="#">
										<span class="fa fa-bell" aria-hidden="true"></span>
										<span class="label label-warning">3</span>
									</a>	
								</li>
								<li class="fixed-width">	
									<a href="#">
										<span class="fa fa-envelope" aria-hidden="true"></span>
										<span class="label label-success">3</span>
									</a>
								</li>
								<li>	
									<form action="includes/adminlogout.inc.php" method="POST">
										<button class="logout" name="alogout"><span class="fa fa-sign-out" aria-hidden="true">Log out</button>
									</form>
								</li>
							</ul>
						</div>
					</header>
				</div>

				<ol class="breadcrumb" style="margin-top:20px;">
					<li class="breadcrumb-item"><a href="online_exam.php">Online Exams</a></li>
					<li class="breadcrumb-item active">Exam Papers</li>
					<li class="breadcrumb-item active">View all Question Papers</li>
				</ol>
				
				<div id="content">				
					<header class="clearfix">
						<h2 class="page_title pull-left">All Question paper</h2>	
						<a type="button" class="new pull-right btn-primary btn-xs" href="create_exam.php">Create Exam</a>
					</header>
					
					<div class="content-inner">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Id</th>
					                <th>Title</th>
					                <th>Type</th>
					                <th>Standard</th>
					                <th>Time</th>
					                <th>Negative Marking</th>
					                <th>Calculator</th>
					                <th>Launched On</th>
					                <th>Ends</th>
					                <th>Status</th>
					                <th>Actions</th>
					            </tr>
					        </thead>
					         <tbody>

						<?php
							$sql = "select * from exams";
							$result=mysqli_query($conn, $sql);
							
							$i=1;
							while($row = mysqli_fetch_array($result)){
								$status = '';
								$action = '';
								if($row['exam_status'] == 0){
									$status = '<span class="label label-warning">Inactive</span>';
									$action = '<button id="publish'.$i.'" class="btn btn-xs btn-primary publish">Publish Exam</button>&nbsp;<button  class="btn btn-xs btn-danger delete" id="delete'.$i.'">Delete</button>';
								}
								else if($row['exam_status'] == 1){
									$status = '<span class="label label-success">Active</span>';
									$action = '<button class="btn btn-xs btn-danger remove" id="remove'.$i.'">Force Remove</button>';
								}
								else if($row['exam_status'] == 2){
									$status = '<span class="label label-danger">Completed</span>';
									$action = '<a href="#" class="btn btn-xs btn-warning">Delete</a>';
								}
								echo '
									<tr>
						                <td id="id'.$i.'">'.$row['exam_id'].'</td>
						                <td id="title'.$i.'">'.$row['exam_title'].'</td>
						                <td id="type'.$i.'">'.$row['exam_type'].'</td>
						                <td id="standard'.$i.'">'.$row['exam_standard'].'</td>
						                <td id="time'.$i.'">'.$row['exam_time'].'</td>
						                <td id="nega'.$i.'">'.$row['exam_nega'].'</td>
						                <td id="cal'.$i.'">'.$row['exam_cal'].'</td>
						                <td id="starts'.$i.'">'.$row['exam_start'].'</td>
						                <td id="ends'.$i.'">'.$row['exam_end'].'</td>
						                <td id="status'.$i.'">'.$status.'</td>
						                <td>
						                   <button id="edit'.$i.'" class="btn btn-xs btn-primary edit">Edit Exam</button>
						                    '.$action.'
						                </td>
						            </tr>						            
								';	
								$i++;
							}

						?>
					            
					    </table>
					</div>				
				</div>
			</div>
		</div>
	</div>

	<!----MODALS--->
	<div class="modal fade" id="edit_paper">
		<div class="modal-dialog">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >&times;</button>	<h3>Edit Paper</h3>		
				</div>
				<div class="modal-body">
					<form action="includes/exams.inc.php" method="POST" enctype="multipart/form-data">							
						<div class="form-group">
							<input type="text" class="form-control" name="exam_title" id="exam_title" required placeholder="Exam Title">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="exam_type" id="exam_type" required placeholder="Exam Type">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="exam_standard" id="exam_standard" required placeholder="Exam Standard">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="exam_time" id="exam_time" required placeholder="Time">
						</div>
						<div class="form-group">
							<select class="form-control" id="nega" name="exam_nega" required>
								<option selected value="">Negative Marking</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="cal" name="exam_cal" required>
								<option selected value="">Calculator</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<input type="hidden" id="exid" name="exid">
						<hr>
						<button type="submit" class="btn btn-success btn-sm" name="edit_exam">Save </button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
					</form>
				</div> 
					
			</div>
		</div>
	</div>

	<div class="modal fade" id="publish_exam">
		<div class="modal-dialog">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >&times;</button>	<h3>Publish Exam</h3>		
				</div>
				<div class="modal-body">
					<form action="includes/exams.inc.php" method="POST" enctype="multipart/form-data">							
						<div class="form-group">
							<label for="">STARTS FROM:</label>
							<input type="text" class="form-control" id="starts" name="starts" placeholder="mm/dd/yyyy hh:mm:s" required">
						</div>
						<div class="form-group">
							<label for="">ENDS AT:</label>
							<input type="text" class="form-control" id="ends" name="ends" placeholder="mm/dd/yyyy hh:mm:ss" required">
						</div>
						<div class="form-group">
							<label for="">FOR WHOM:</label>
							<select class="form-control chosen_select" id="courses" name="courses[]" multiple data-placeholder="Choose who can apply for this course">
								<option value="1">All</option>
								<?php
									$sql = 'select course_id,course_name from courses';
									$result = mysqli_query($conn, $sql);
									
									while($row = mysqli_fetch_array($result)){
										echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
									}										
										
								?>
							</select><br>
						</div>
						<input type="hidden" id="eid" name="eid">
						<hr>
						<button type="submit" class="btn btn-success btn-sm" name="publish_exam">Publish Exam</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
					</form>
				</div> 
					
			</div>
		</div>
	</div>

	<div class="modal fade" id="delete_exam">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >&times;</button>	<h4>Delete Exam</h4>		
				</div>
				<form action="includes/examsexams.inc.php" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						Sure to delete exam having id <b id="exam_id"></b>?
						<input type="hidden" id="exmid" name="exmid">
					</div> 
					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger btn-xs" name="delete_exam">Delete Exam</button>
					</div>	
				</form>				
			</div>
		</div>
	</div>

	<div class="modal fade" id="remove_exam">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >&times;</button>	<h4>Delete Exam</h4>		
				</div>
				<form action="includes/exams.inc.php" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						Sure to remove the active exam?
						<input type="hidden" id="xmid" name="xmid">
					</div> 
					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger btn-xs" name="remove_exam">Deactivate Exam</button>
					</div>	
				</form>				
			</div>
		</div>
	</div>

	<?php
		if(isset($_GET['err']))
		{
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Something went wrong, please try again.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';			
		}
		elseif(isset($_GET['update'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Exam was succesfully updated.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}
		elseif(isset($_GET['publish'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Exam was succesfully published.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}
		elseif(isset($_GET['delete'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Exam was succesfully deleted.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}
		elseif(isset($_GET['remove'])){
			echo '			    
			    <div id="success-modal">
					<div class="modalconent">
						<h3 style="color:teal;">Information</h3>
						<hr>	
						<p class="para">Exam was succesfully deactivated.</p> 
						<button id="button" class="btn btn-danger btn-sm pull-right">Close</button>
					</div>
				</div>
			';	
		}

	?>
	

	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
	<script src="../vendor/js/chosen.jquery.min.js"></script>
	<script>
		$(".chosen_select").chosen({
			disable_search_threshold: 10,
			no_results_text: "Oops, nothing found!",
			width: "100%"
		});	
	</script>

	<script>
		document.getElementById('button').onclick = function () {
			document.getElementById('success-modal').style.display = "none",
			window.location.replace('exams.php');
		};		
	
	</script>
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#example').DataTable();

		    $('.edit').click(function(){
		    	var id = this.id;
		    	id = id.substring(4,);

		    	$('#exid').val($('#id'+id).html());
		    	$('#exam_title').val($('#title'+id).html());
		    	$('#exam_standard').val($('#standard'+id).html());
		    	$('#exam_type').val($('#type'+id).html());
		    	$('#exam_time').val($('#time'+id).html());
				$('#edit_paper').modal('show'); 
		    });

		    $('.publish').click(function(){
		    	var id = this.id;
		    	id = id.substring(7,);

		    	$('#eid').val($('#id'+id).html());
				$('#publish_exam').modal('show'); 
		    });
		    $('.delete').click(function(){
		    	var id = this.id;
		    	id = id.substring(6,);
		    	$('#exmid').val($('#id'+id).html());
		    	$('#exam_id').html($('#id'+id).html());
				$('#delete_exam').modal('show'); 
		    });
		    $('.remove').click(function(){
		    	var id = this.id;
		    	id = id.substring(6,);
		    	$('#xmid').val($('#id'+id).html());
				$('#remove_exam').modal('show'); 
		    });
		} );
	</script>
	
	

</body>
</html>
				
				
				
				
				
				