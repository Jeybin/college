<div class="sidebar-wrapper">
			<div class="logo">
					<a href="index.php" class="simple-text">
							Teachers
					</a>
			</div>

			<ul class="nav">

				<li class="<?php if($page === 'index.php') { echo "active"; } ?>">
						<a href="index.php">
							<i class="fa fa-dashboard"></i>
							<p>Dashboard</p>
						</a>
				</li>


				<li class="<?php if($page === 'attendence.php') { echo "active"; } ?>">
						<a href="attendence.php">
							<i class="fa fa-calendar"></i>
							<p>Mark Attendence</p>
						</a>
				</li>

				<li class="<?php if($page === 'internals.php') { echo "active"; } ?>">
						<a href="internals.php">
							<i class="fa fa-pencil-square-o"></i>
							<p>Internals</p>
						</a>
				</li>

					<li class="<?php if($page === 'assignments.php') { echo "active"; } ?>">
							<a href="assignments.php">
								<i class="fa fa-tasks"></i>
								<p>Assignments</p>
							</a>
					</li>

						<li class="<?php if($page === 'settings.php') { echo "active"; } ?>">
								<a href="settings.php">
									<i class="fa fa-cogs"></i>
									<p>Settings</p>
								</a>
						</li>

					<li>
							<a href="../actions.php?action=logout">
								<i class="fa fa-sign-out"></i>
								<p>Logout</p>
							</a>
					</li>



		</ul>

</div>
