<div class="sidebar-wrapper">
			<div class="logo">
					<a href="index.php" class="simple-text">
							HOD
					</a>
			</div>

			<ul class="nav">
				<li class="<?php if($page === 'index.php' || $page === '') { echo "active"; } ?>">
						<a href="index.php">
							<i class="ti-pie-chart"></i>
							<p>Dashboard</p>
						</a>
				</li>
				<li class="<?php if($page === 'timetables.php') { echo "active"; } ?>">
						<a href="timetables.php">
							<i class="fa fa-calendar"></i>
							<p>Time tables</p>
						</a>
				</li>
				<li class="<?php if($page === 'attendences.php') { echo "active"; } ?>">
						<a href="attendences.php">
							<i class="fa fa-check-square-o"></i>
							<p>Attedences</p>
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
