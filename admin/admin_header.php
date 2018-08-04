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