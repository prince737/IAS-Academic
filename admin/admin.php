<?php
	session_start();
	require_once('../includes/dbh.inc.php');
	
	$query ="Select * from students where stu_approvalstatus=0";
	$result =@mysqli_query($conn,$query); 
	
	$query1 ="Select * from queries order by q_id desc";
	$result1 =@mysqli_query($conn,$query1); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Administrator | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/jpg" href="../images/logo.jpg" />
</head>

<body>	

	
			
	<div class="container-fluid display-table">
		<div class="row display-table-row">
			<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="mySidebar">
				<h1 class="hidden-sm hidden-xs">Navigation</h1>				
				<ul > 
					<li class="link active">
						<a href="#">
							<i class="fa fa-th" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Dashboard</span>
						</a>
					</li>
					<li class="link">
						<a href="#collapse-post" data-toggle="collapse" aria-control="collapse-post">
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Manage Students</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post" style="margin:0px; padding:0px; ">
							<li>
								<a href="#">
									<span>Approved Students</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>Unapproved Students</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="link">
						<a href="#">
							<i class="fa fa-book" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Courses</span>
						</a>
					</li>
					<li class="link">
						<a href="#">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Notices and Events</span>
						</a>
					</li>
					<li class="link online-exam">
						<a href="#">
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
									<a href="#" class="logout">
										<span class="fa fa-sign-out" aria-hidden="true">Log out
									</a>
								</li>
							</ul>
						</div>
					</header>
				</div>
				<div id="dashboard-con">
				
				
					<div class="row">
						<div class="col-md-6 dashboard-left-cell">
							
							<div class="admin-content-con">
								<header>
									<div class="clearfix">
										<h5 class="pull-left">Pending Approval</h5>
										<a class="btn btn-xs btn-warning pull-right" href="#" role="button">Do something</a>
									</div>
								</header>
								<?php
									if($result)
									{
										echo '<table class="table table-striped">
												<thead>
													<tr>
														<th>#</th>
														<th>First Name</th>
														<th>Email</th>
														<th>Action</th>
													</tr>
												</thead>';
										$i = 1;		
										while($row = mysqli_fetch_array($result))
										{
											
											echo '<tbody>
													<tr>
														<th scope="row">'.$i.'</th>
														<td>'.$row['stu_name'].'</td>
														<td>'.$row['stu_email'].'</td>
														<td>
															<form action="includes/stu.inc.php" method="POST" id="stu_form">
																<input type="hidden" value="'.$row['stu_email'].'" name="email"></input>
																<input type="hidden" value="'.$row['stu_name'].'" id="name"></input>
																<button class="btn btn-xs btn-success" type="submit" name="approve">Approve</button>
																<button class="btn btn-xs btn-danger cntct-btn" data-target="#Modal'.$i.'" data-toggle="modal" name="deny" type="button" >Deny</button>	
																<div class="modal fade" id="Modal'.$i.'"  >
																	<div class="modal-dialog modal-sm">
																		<div class="modal-content" >
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">&times;</button>	<h4>Deny Approval</h4>				
																			</div>
																			<div class="modal-body">
																				Sure to deny '.$row['stu_name'].'?
																			</div> 
																			<div class="modal-footer">
																				<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
																					<button type="submit" class="btn btn-danger btn-xs" name="deny">Deny Request</button>
																			</div>		
																		</div>
																	</div>
																</div>
															</form>
															
															<a class="btn btn-xs btn-warning" href="students.php", role="button">Details</a>
														</td>
													</tr>
												  '; 
												  $i++;
										}											
									}
								?>	
									</tbody>
								</table>
								<div class="clearfix">
									<a class="text-link pull-right" href="students.php">View all students</a>
								</div>
							</div>
						</div>
						<div class="col-md-6 dashboard-right-cell">
							<div class="admin-content-con">
								<header>
									<h5>Queries</h5>
								</header>
				                <?php
									if($result1){
										while($row = mysqli_fetch_array($result1))
										{
											$now = date("Y-m-d");
											$date1 = new DateTime($now);
											$date2 = new DateTime($row['q_date']);
											$diff = $date2->diff($date1)->format("%a");
											
											if($diff == 0){
												$diff = 'Today';
											}
											else{
												$diff = $diff.' days ago';
											}
											
											echo '
												<div class="comment-head-dash clearfix">
													<div class="commenter-name-dash pull-left">'.$row['q_name'].'</div>
													<div class="days-dash pull-right">'.$diff.'</div>
												</div>
												<p class="comment-dash">
													 '.$row['q_message'].'
												</p>
												<small class="comment-date-dash">'.$row['q_time'].' '.$row['q_date'].'</small>
												<hr>
																							
											';
										}
									}
								?>
								<div class="clearfix">
									<a class="text-link pull-right" href="#">View all queries</a>
								</div>									
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-12">
						<div class="admin-content-con clearfix">
							<header>
								<h5>Active Tests</h5>
							</header>
							<table class="table table-bordered" >
								<thead>
									<tr>
										<th>#</th>
										<th>Demo</th>
										<th>Demo</th>
										<th>Demo</th>
										<th>Demo</th>
										<th>Demo</th>
										<th>Demo</th>				
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Jhonny Doe</td>
										<td>a@b.com</td>
										<td><div class="label label-default">Pending</div></td>
										<td>Some Text</td>
										<td>Some Text</td>
										<td><div class="label label-danger">Delete</div></td>
									</tr>
									<tr>
										<td>1</td>
										<td>Jhonny Doe</td>
										<td>a@b.com</td>
										<td><div class="label label-success">Active</div></td>
										<td>Some Text</td>
										<td>Some Text</td>
										<td><div class="label label-danger">Delete</div></td>
									</tr>
									<tr>
										<td>1</td>
										<td>Jhonny Doe</td>
										<td>a@b.com</td>
										<td><div class="label label-success">Active</div></td>
										<td>Some Text</td>
										<td>Some Text</td>
										<td><div class="label label-danger">Delete</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>

	</div>	
	
	
	
	
</div>

	
	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="admin.js"></script>
</body>
</html>