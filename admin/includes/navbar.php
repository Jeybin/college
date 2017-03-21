<div class="sidebar-wrapper">
			<div class="logo">
					<a href="index.php" class="simple-text">
							Admin
					</a>
			</div>

			<ul class="nav">
				<li class="<?php if($page === 'dashboard.php') { echo "active"; } ?>">
						<a href="dashboard.php">
							<i class="ti-pie-chart"></i>
							<p>Dashboard</p>
						</a>
				</li>
				<li class="<?php if($page === 'adddepartments.php') { echo "active"; } ?>">
						<a href="adddepartments.php">
							<i class="fa fa-university"></i>
							<p>Department</p>
						</a>
				</li>
				<li class="<?php if($page === 'addcourses.php') { echo "active"; } ?>">
						<a href="addcourses.php">
							<i class="ti-agenda"></i>
							<p>Courses</p>
						</a>
				</li>
				<li class="<?php if($page === 'addsubjects.php') { echo "active"; } ?>">
						<a href="addsubjects.php">
							<i class="ti-book"></i>
							<p>Subjects</p>
						</a>
				</li>
				<li class="<?php if($page === 'addstudents.php') { echo "active"; } ?>">
						<a href="addstudents.php">
							<i class="ti-clipboard"></i>
							<p>Students</p>
						</a>
				</li>
				<li class="<?php if($page === 'addteachers.php') { echo "active"; } ?>">
						<a href="addteachers.php">
							<i class="ti-user"></i>
							<p>Teachers</p>
						</a>
				</li>
				<li class="<?php if($page === 'classassign.php') { echo "active"; } ?>">
						<a href="classassign.php">
							<i class="fa fa-users"></i>
							<p>Assign Classes</p>
						</a>
				</li>
				<li class="<?php if($page === 'subjectassign.php') { echo "active"; } ?>">
						<a href="subjectassign.php">
							<i class="fa fa-book"></i>
							<p>Assign Subjects</p>
						</a>
				</li>
				<li class="<?php if($page === 'timetables.php') { echo "active"; } ?>">
						<a href="timetables.php">
							<i class="fa fa-calendar"></i>
							<p>Time Tables</p>
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
