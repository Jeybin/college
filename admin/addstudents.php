<?php
include './includes/header.php';
$alldepartments = $functions->getAllDepartments('DESC');
$allstudents = $functions->getAllStudentsOrderById('DESC');
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<form action="../actions.php?action=addstudent" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-12">

												<div class="col-xs-4">
														<div class="form-group">
																<label>Student Full Name</label>
																<input type="text" name="studentname" class="form-control" placeholder="Please enter student's full name">
														</div>
												</div>

												<div class="col-xs-4">
														<div class="form-group">
																<label>Student Admission Number</label>
																<input type="text" name="admissionnumber" class="form-control" placeholder="Please enter student's admission number">
														</div>
												</div>

												<div class="col-xs-4">
														<div class="form-group">
																<label>Student Admission Year</label>
																<select class="form-control" name="admissionyear">
																		<option value="">Please select year of admission</option>
																		<?php
																					$currentyear = date("Y");
																					for($i=0;$i<3;$i++){
																		?>
																		<option value="<?=$currentyear-$i?>"><?=$currentyear-$i?></option>
																	<?php } ?>
																</select>
														</div>
												</div>


													<div class="col-xs-4">
															<div class="form-group">
																	<label>Student Phone Number</label>
																	<input type="text" name="phonenumber" class="form-control" placeholder="Please enter student's phone number">
															</div>
													</div>


														<div class="col-xs-4">
																<div class="form-group">
																		<label>Student Email</label>
																		<input type="email" name="emailid" class="form-control" placeholder="Please enter student's email id">
																</div>
														</div>

													<div class="col-xs-4">
															<div class="form-group">
																	<label>Courses</label>
																	<select class="form-control" required name="coursename">
																		<option value="">Please select course</option>
																		<?php foreach($alldepartments as $departments) {
																					$deponame = $departments['name'];
																					$depoid = $departments['id'];
																					$coursesbydepo = $functions->getCoursesByDepoId($depoid);
																		?>
																		<option style="padding-top:5px;padding-bottom:15px;font-weight:700;font-size:16px" value="<?=$depoid?>" disabled><?=$deponame?></option>
																		<?php foreach($coursesbydepo as $courses) {
																					$courseid = $courses['id'];
																					$coursename = $courses['course'];
																				?>
																			<option value="<?=$courseid?>"><?=$coursename?></option>
																		<?php } } ?>
																	</select>
															</div>
													</div>

													<div class="col-xs-12">
															<div class="form-group">
																	<label>Student Image</label>
																	<input type="file" name="studentimage" class="form-control">
															</div>
													</div>

													<div class="col-xs-12">
															<div class="form-group">
																	<label>Student Full Address</label>
																	<textarea name="studentfulladdress" placeholder="Please enter full address" class="form-control" rows="8" cols="80"></textarea>
															</div>
													</div>



													<div class="col-md-12">
															<div class="form-group text-center" style="padding-top:25px;">
																<button type="submit" class="btn btn-info btn-fill btn-wd">Add Student</button>
															</div>
													</div>

											</div>

								<div class="clearfix"></div>
						</form>
				</div>
		</div>
	</div>
</div>

<?php

		foreach ($allstudents as $students) {
					$id = $students['id'];
					$admissionno = $students['admissionnumber'];
					$admissionyear = $students['admissionyear'];
					$studentname = $students['name'];
					$address = $students['address'];
					$phone  = $students['phone'];
					$email = $students['email'];
					$courseid = $students['course'];
					$coursedata = $functions->getCourseById($courseid);
					$coursename = $coursedata[0]['course'];
					$profpic = $students['profileimage'];
					$profpic = '.'.$profpic;
 ?>
	<div class="col-lg-6">
			<div class="card">
					<div class="content">
						<div class="row">

							<div class="col-xs-4">
									<div style="height: 145px;width: 145px;background-color: #f7f7f7">
											<img src="<?=$profpic?>" alt="">
									</div>
									<div class="col-xs-12 text-center" style="padding:5px 0 0;">
										<i class="fa fa-pencil editstudentbtn" data-toggle="modal" data-target="#editStudentModal" data-studid="<?=$id?>"></i>
										<i class="fa fa-trash deletestudentbtn" data-toggle="modal" data-target="#deleteStudentModal" data-studid="<?=$id?>"></i>
									</div>
							</div>
							<div class="col-xs-8" style="padding-left:25px;">
										<div class="col-xs-12" style="font-size: 14px;font-weight:700;padding:0;"><?=$studentname?></div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Student Id<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px">#STUD<?=$id?></div>
										</div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Admission Number<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px"><?=$admissionno?></div>
										</div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Admission Year<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px"><?=$admissionyear?></div>
										</div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Course<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px"><?=$coursename?></div>
										</div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Phone<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px"><?=$phone?></div>
										</div>
										<div class="col-xs-12" style="font-size: 11px;font-weight:400;padding:5px 0 0;">
											<div style="width:110px;float:left">Email<span class="pull-right">:</span></div>
											<div style="float:left;padding:0px 5px;width:170px"><?=$email?></div>
										</div>
							</div>
						</div>
					</div>
			</div>
		</div>

<?php } ?>

<?php include './includes/footer.php'; ?>

<!-- Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this student ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deleteStudent" method="post">
							<input type="text" name="studentid" id="deleteStudentId" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body studentEditModalDataDiv">
      </div>
    </div>
  </div>
</div>
