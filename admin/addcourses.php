<?php
include './includes/header.php';
$alldepartments = $functions->getAllDepartments('DESC');
$allcourses = $functions->getAllCourses();
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<form action="../actions.php?action=addCourse" method="post">
								<div class="row">

										<div class="col-md-3">
												<div class="form-group">
														<label>Department Name</label>

													<select class="form-control" required name="department">
														<option value="">Select department</option>
														<?php
															foreach ($alldepartments as $departments) {
																$deponame = $departments['name'];
																$depoid   = $departments['id'];
														?>
														<option value="<?=$depoid?>"><?=$deponame?></option>
														<?php } ?>
													</select>
												</div>
										</div>

										<div class="col-md-3">
												<div class="form-group">
														<label>Course Name</label>
														<input type="text" name="coursename" class="form-control" placeholder="Enter Course Name">
												</div>
										</div>

										<div class="col-md-3">
												<div class="form-group">
														<label>Department Name</label>

													<select class="form-control" required name="duration">
														<option value="">Course Duration</option>
														<?php
															for($i=1;$i<=6;$i++){
														?>
														<option value="<?=$i?>"><?=$i." Semester"?></option>
														<?php } ?>
													</select>
												</div>
										</div>

										<div class="col-md-3">
												<div class="form-group">
														<label>Alloted number of seats</label>
														<input type="number" name="allotedseats"  min="1" max="70"  class="form-control" placeholder="Alloted seats">
												</div>
										</div>


										<div class="col-md-12">
												<div class="form-group text-center" style="padding-top:25px;">
													<button type="submit" class="btn btn-info btn-fill btn-wd">Add Course</button>
												</div>
										</div>
								<div class="clearfix"></div>
						</form>
				</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<table class="table table-bordered text-center">
							<tr style="font-weight:600">
								<td>#</td>
								<td>Department</td>
								<td>Course</td>
								<td>Duration</td>
								<td>Alloted seats</td>
								<td>Operations</td>
							</tr>
<?php
	$slno = 1;
	foreach ($allcourses as $course) {
		$id = $course['id'];
		$coursename = $course['course'];
		$departmentid = $course['department'];
		$duration = $course['course_duration'];
		$alloteddseats = $course['allotedseats'];
		$departmentdata = $functions->getDepartmentById($departmentid);
		$departmentname = $departmentdata[0]['name'];
 ?>
							<tr>
								<td><?=$slno++?></td>
								<td><?=$departmentname?></td>
								<td><?=$coursename?></td>
								<td><?=$duration." Semester"?></td>
								<td><?=$alloteddseats?></td>
								<td>
									<i class="fa fa-trash" id="deleteCourseBtn" data-toggle="modal" data-target="#deleteCourse" data-courseid="<?=$id?>"></i>
								</td>
							</tr>

			<?php } ?>

						</table>
				</div>
		</div>
	</div>
</div>



<?php include './includes/footer.php'; ?>



<!-- Modal -->
<div class="modal fade" id="deleteCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deletecourse" method="post">
							<input type="text" name="courseid" id="courseIdField" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>
