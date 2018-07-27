<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.8">
	<title>Create Notice | IAS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/notices.css">
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
					<li class="link">
						<a href="admin.php">
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
					<li class="link active">
						<a href="#collapse-post1" data-toggle="collapse" aria-control="collapse-post1">
							<i class="fa fa-calendar-o" aria-hidden="true"></i>
							<span class="hidden-sm hidden-xs">Notices and Events</span>
						</a>
						<ul class="collapse collapsable" id="collapse-post1" style="margin:0px; padding:0px; ">
							<li>
								<a href="#">
									<span>Create New</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>View Active</span>
								</a>
							</li>
						</ul>
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
									<a href="#" class="logout">
										<span class="fa fa-sign-out" aria-hidden="true">Log out
									</a>
								</li>
							</ul>
						</div>
					</header>
				</div>
				
				<div id="content">
					<header>
						<h2 class="page_title">Create a new Notice or Event</h2>	
					</header>	
					<div class="content-inner">
						<div class="form-wrapper">
							<form>
								<div class="form-group">
									<label class="radio-inline">
										<input type="radio" name="type" id="inlineRadio1" value="option1">Notice
									</label>
									<label class="radio-inline">
										<input type="radio" name="type" id="inlineRadio2" value="option2">Event
									</label>
									
								</div>
								<div class="form-group">
									<label class="sr-only">Heading</label>
									<input type="text" required class="form-control" id="heading" placeholder="Heading (Displayed on Notice Board)">
								</div>
								<div class="form-group">
									<label class="sr-only">Date</label>
									<input type="text" class="form-control" id="date" placeholder="Date (Format Eg - 23 Jan, 2018)">
								</div>
								<div class="form-group">
									<label class="sr-only">Body</label>
									<textarea class="form-control" name="body" placeholder="Body (Optional. Displayed only on notices page) "></textarea>
								</div>
								
								<div class="checkbox">
									<label>
										<input type="checkbox">Publish Notice when I click on save
									</label>
								
								</div>
								<div class="clearfix">
									<button type="submit" class="btn btn-primary pull-right">Save / Publish</button>
								</div>
								
							</form>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>	


	<script src="../js/jquery-3.2.1.min.js"></script>	
	<script src="../js/bootstrap.js"></script>
	<script src="js/default.js"></script>

</body>
</html>