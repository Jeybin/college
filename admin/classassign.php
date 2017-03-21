<?php
include './includes/header.php';
$allteachers = $functions->getAllTeachers('DESC');
$alldepartments = $functions->getAllDepartments('DESC');
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<table class="table table-bordered text-center">
							<tr style="font-weight:600">
								<td>#</td>
								<td>Name</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Assigned / Not</td>
								<td>Operations</td>
							</tr>
						<?php
							$slno = 1;
						foreach ($allteachers as $teachers) {
								$teacherid = $teachers['id'];
								$teachername = $teachers['name'];
								$teacherphone = $teachers['phone'];
								$teachermail = $teachers['mail'];
								$hodchecking = $functions->getHodByTeacherId($teacherid);
								if(empty($hodchecking)){
								$checkclassassign = $functions->getAssignedClassByTeacherId($teacherid);
								if($checkclassassign){
												$assignedid = $checkclassassign[0]['id'];
												$classteacher = $checkclassassign[0]['teacher'];
												$courseid = $checkclassassign[0]['courseid'];
												$semester = $checkclassassign[0]['semester'];
												$course = $functions->getCourseById($courseid);
												$course = $course[0]['course'];
								}
							?>
							<tr>
							 <td><?=$slno++?></td>
							 <td><?=$teachername?></td>
							 <td><?=$teachermail?></td>
							 <td><?=$teacherphone?></td>
							 <td>
									<?php
									 	if(empty($checkclassassign)){?>
											<span class="text-info">Not Assigned</span><br>
										 <?php } else {?>
											 <span class="text-success"><?=$course?></span><br>
											 <span class="text-info" style="font-size:12px"><?="Semester - ".$semester?></span>
										<?php } ?>
							</td>
							 <td>
								<?php
									if($checkclassassign){?>
										<a href="#" class="removeteacherassign" data-toggle="modal" data-target="#removeAssignedClass" data-assignid="<?=$assignedid?>" data-assignedsem="<?=$semester?>" data-assignedcourse="<?=$course?>" data-tname="<?=$teachername?>" style="color:#2d2d2d;outline:none;">
	 									 <i class="fa fa-tasks"></i>
	 										 <span style="margin-left:5px;margin-right:5px"></span>
	 											Remove Assigned class
	 									</td>
	 								</a>
									 <?php } else { ?>
										 <a href="#" class="teacheridclassassignbtn" data-toggle="modal" data-target="#assignClassTeacher" data-tid="<?=$teacherid?>" data-tname="<?=$teachername?>" style="color:#2d2d2d;outline:none;">
											 <i class="fa fa-tasks"></i>
												 <span style="margin-left:5px;margin-right:5px"></span>
												 Assign class
											</td>
										</a>
									 <?php } ?>

					<?php }} ?>
						</tr>
						</table>
				</div>
		</div>
	</div>
</div>



<?php include './includes/footer.php'; ?>



<!-- Modal -->
<div class="modal fade" id="assignClassTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
		<form class="" action="../actions.php?action=assignClassTeacher" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Class Teacher</h4>
      </div>
      <div class="modal-body">
				<div class="container-fluid">
						<div class="col-xs-12" style="padding: 0">
									<div class="form-group  hidden">
										<label>Teacher Id</label>
										<input type="text" name="teacherid" class="teacheridclassassign">
									</div>
									<div class="form-group">
										<label>Department Name</label>
										<select class="form-control assignClassTeacherDepartment" name="departmentname" required>
											<option value="">Please select department</option>
											<?php foreach($alldepartments as $departments) {
															$deponame = $departments['name'];
															$depoid = $departments['id'];
														?>
												<option value="<?=$depoid?>"><?=$deponame?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Course Name</label>
										<select class="form-control assignClassTeacherCourse" required name="coursename">
											<option value="">Please select Course</option>
										</select>
									</div>
									<div class="form-group">
										<label>Semester</label>
										<select class="form-control" name="semester" required>
											<option value="">Please select Semester</option>
											<?php for($i=1;$i<=6;$i++){ ?>
												<option value="<?=$i?>">Semester <?=$i?></option>
											<?php }?>
										</select>
									</div>
						</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign </button>
      </div>
    </div>
	</form>
  </div>
</div>


<div class="modal fade" id="removeAssignedClass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to remove <span class="modalteachername"></span> as teacher of class <span class="modalclassname"></span> ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=removeassignedteacher" method="post">
							<input type="text" name="assignid" class="assignedid" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Remove</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>
