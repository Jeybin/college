<?php
include './includes/header.php';
$allcourses = $functions->getAllCourses('DESC');
//$alldepartments = $functions->getAllDepartments();
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<form action="../actions.php?action=addsubject" method="post">
								<div class="row">

										<div class="col-md-3">
												<div class="form-group">
														<label>Course Name</label>
													<select class="form-control" required name="course">
														<option value="">Select Course</option>
														<?php
															foreach ($allcourses as $courses) {
																$coursename = $courses['course'];
																$courseid   = $courses['id'];
														?>
														<option value="<?=$courseid?>"><?=$coursename?></option>
														<?php } ?>
													</select>
												</div>
										</div>

										<div class="col-md-3">
												<div class="form-group">
														<label>Semester</label>

													<select class="form-control" required name="Semester">
														<option value="">Select Semester</option>
														<?php
															for($i=1;$i<=6;$i++){
														?>
														<option value="<?=$i?>"><?=$i."st Semester"?></option>
														<?php } ?>
													</select>
												</div>
										</div>

										<div class="col-md-3">
												<div class="form-group">
														<label>Subject Name</label>
														<input type="text" name="subjectname" class="form-control" placeholder="Enter Subject Name">
												</div>
										</div>
										<div class="col-md-3">
												<div class="form-group text-center" style="padding-top:25px;">
													<button type="submit" class="btn btn-info btn-fill btn-wd">Add Subject</button>
												</div>
										</div>
								<div class="clearfix"></div>
						</form>
				</div>
		</div>
	</div>
</div>

<?php
foreach ($allcourses as $courses) {
	$coursename = $courses['course'];
	$courseid = $courses['id'];
 ?>
<div class="col-lg-12">
		<div class="card">
				<div class="content">
					<h5><?=$coursename?></h5>
					<?php for($i=1;$i<=6;$i++){ ?>
						<div class="row"  style="padding: 15px 15px 5px;">
								<div class="col-xs-12"><h6><?="Semester - ".$i?></h6></div>
								<div class="col-xs-12" style="padding:10px 3px;">
									<ul>
										<?php
												$subjects = $functions->getSubjectsBySemesterAndCourse($i,$courseid);
												foreach($subjects as $subject){
													$subname = $subject['subject'];
													$subid = $subject['id'];
												?>
												<li class="text-capitalize">
														<?=$subname?>
														<i class="fa fa-trash pull-right" id="delSubject" data-subid="<?=$subid?>" data-toggle="modal" data-target="#deleteSubject"></i>
												</li>
												<?php }  ?>
												<?php if(empty($subjects)){ ?>
													<h5 style="opacity:0.5">No subjects added</h5>
												<?php	} ?>
									</ul>
								</div>
							</div>
					<?php } ?>
		</div>
		</div>
	</div>

<?php
		}
 ?>

<?php include './includes/footer.php'; ?>


<!-- Modal -->
<div class="modal fade" id="deleteSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deletesubject" method="post">
							<input type="text" name="subid" id="subIdField" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>
