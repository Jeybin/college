<div class="sidebar-wrapper">
			<div class="logo">
					<a href="index.php" class="simple-text">
							Admin
					</a>
			</div>

			<ul class="nav">
				<li class="<?php if($page === 'dashboard.php') { echo "active"; } ?>">
						<a href="index.php">
							<i class="ti-pie-chart"></i>
							<p>Dashboard</p>
						</a>
				</li>
				<li class="<?php if($page === 'attendence.php') { echo "active"; } ?>">
						<a href="attendence.php">
							<i class="fa fa-calendar"></i>
							<p>View Attendence</p>
						</a>
				</li>
				<li class="<?php if($page === 'viewinternals.php') { echo "active"; } ?>">
						<a href="viewinternals.php">
							<i class="fa fa-pencil-square-o"></i>
							<p>View Internals</p>
						</a>
				</li>
				<li class="<?php if($page === 'assignments.php') { echo "active"; } ?>">
						<a href="assignments.php">
							<i class="fa fa-tasks"></i>
							<p>Assignments</p>
						</a>
				</li>
				<li class="<?php if($page === 'projects.php') { echo "active"; } ?>">
						<a href="projects.php">
							<i class="fa fa-tasks"></i>
							<p>Projects</p>
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
