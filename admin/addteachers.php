<?php
include './includes/header.php';
$allteachers = $functions->getAllTeachers('DESC');
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<form action="../actions.php?action=addTeachers" method="post" enctype="multipart/form-data">
								<div class="row">

										<div class="col-md-6">
												<div class="form-group">
														<label>Teacher's Name</label>
														<input type="text" name="teachername" class="form-control" placeholder="Enter Name">
												</div>
										</div>

										<div class="col-md-6">
												<div class="form-group">
														<label>Teacher's Phone</label>
														<input type="text" name="teacherphone" class="form-control" placeholder="Enter Phone Number">
												</div>
										</div>

										<div class="col-md-6">
												<div class="form-group">
														<label>Teacher's Email</label>
														<input type="email" name="teacheremail" class="form-control" placeholder="Enter Email Id">
													</div>
										</div>

										<div class="col-md-6">
												<div class="form-group">
														<label>Teacher's Image</label>
														<input type="file" name="teacherimage" class="form-control">
													</div>
										</div>


										<div class="col-md-12">
												<div class="form-group text-center" style="padding-top:25px;">
													<button type="submit" class="btn btn-info btn-fill btn-wd">Add Teacher</button>
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
								<td>Name</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Operations</td>
							</tr>
						<?php
							$slno = 1;
						foreach ($allteachers as $teachers) {
								$teacherid = $teachers['id'];
								$teachername = $teachers['name'];
								$teacherphone = $teachers['phone'];
								$teachermail = $teachers['mail'];
							?>
					  <tr>
							 <td><?=$slno++?></td>
							 <td><?=$teachername?></td>
							 <td><?=$teachermail?></td>
							 <td><?=$teacherphone?></td>
							 <td>
								 <i class="fa fa-trash" id="deleteTeacherBtn" data-toggle="modal" data-target="#deleteTeacherModal" data-teacherid="<?=$teacherid?>"></i>
									 <span style="margin-left:5px;margin-right:5px">/</span>
								 <i class="fa fa-pencil" id="editTeacherBtn" data-toggle="modal" data-target="#editTeacherModal" data-teacherid="<?=$teacherid?>"  data-teacherphone="<?=$teacherphone?>"  data-teachername="<?=$teachername?>"></i>
							 </td>
					<?php } ?>
						</tr>
						</table>
				</div>
		</div>
	</div>
</div>



<?php include './includes/footer.php'; ?>



<!-- Modal -->
<div class="modal fade" id="deleteTeacherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deleteTeacher" method="post">
							<input type="text" name="teacherid" id="teacherIdField" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding-top:5px">
				<h5>Edit Teacher</h5>
				<form action="actions.php?action=updateTeacher" method="post">
					<input type="text" name="teacherid" class="form-control hidden" id="teacherEditIdField" >
					<input type="text" name="teachername" class="form-control" id="techerNameField">
					<br>
					<input type="text" name="teacherphone" class="form-control" id="techerPhoneField">
					<div class="btncontainer text-right">
						<button type="submit" class="btn btn-sm btn-success btn-fill">Update</button>
						<button type="button" class="btn btn-sm  btn-default btn-fill" data-dismiss="modal">Cancel</button>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>
