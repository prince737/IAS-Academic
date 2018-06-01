<div class="col-md-3 navigation shadow" >
				<div class="img-name">
				<?php
					$row = mysqli_fetch_array($result);
						echo '
							<img class="img-thumbnail" src="'.$row['stu_imageLocation'].'" /> 
							<form action="includes/change.inc.php" method="POST" enctype="multipart/form-data">
								<input type="file" id="fileLoader" accept=".jpg, .jpeg, .png" onchange="this.form.submit();" name="image"/>
								<input type="hidden" name="id"  value="'.$row['stu_id'].'"></input>
								<input type="button" class="btn btn-default btn-sm" id="btnOpenFileDialog" value = "Change Image" onclick="openfileDialog();" />
							<p class="name">'.$row['stu_name'].'</p>
							</form>
						'; 		
				?>
				</div>
				<div class="nav-menu shadow">
					<ul> 
						<li class="link">
							<a href="admin.php">
								<i class="fa fa-home" aria-hidden="true"></i>PROFILE HOME</span>
							</a>
						</li>
						<li class="link active">
							<a href="admin.php">
								<i class="fa fa-cogs" aria-hidden="true"></i>ACCOUNT SETTINGS</span>
							</a>
						</li>
						<li class="link">
							<a href="admin.php">
								<i class="fa fa-book" aria-hidden="true"></i>CHANGE COURSE / CENTER</span>
							</a>
						</li>
						<li class="link">
							<a href="add_course.php">
								<i class="fa fa-plus-square-o" aria-hidden="true"></i>APPLY FOR ANOTHER COURSE</span>
							</a>
						</li>
						<li class="link">
							<a href="admin.php">
								<i class="fa fa-download" aria-hidden="true"></i>DOWNLOADS</span>
							</a>
						</li>
						<li class="link">
							<a href="admin.php">
								<i class="fa fa-pencil" aria-hidden="true"></i>EXAMS</span>
							</a>
						</li>
						<li class="link">
							<a href="admin.php">
								<i class="fa fa-list-alt" aria-hidden="true"></i>RESULTS</span>
							</a>
						</li>
						<li class="link logout">
							<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="logout"><span class="fa fa-sign-out"></span>LOG OUT</button>
							</form>
						</li>
						
						
					</ul>	
				</div>
				
			</div>