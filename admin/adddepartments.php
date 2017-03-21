<?php
include './includes/header.php';
$alldepartments = $functions->getAllDepartments('DESC');
$allteachers = $functions->getAllTeachers();
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<form action="../actions.php?action=addDepartments" method="post">
								<div class="row">
										<div class="col-md-9">
												<div class="form-group">
														<label>Department Name</label>
														<input type="text" class="form-control border-input" placeholder="Department Name" name='departmentname'>
												</div>
										</div>
										<div class="col-md-3">
												<div class="form-group text-center" style="padding-top:25px;">
													<button type="submit" class="btn btn-info btn-fill btn-wd">Add Department</button>
												</div>
										</div>
								<div class="text-center">
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
								<td>HOD</td>
								<td>Operations</td>
							</tr>
							<?php
							$slno = 1;
						 foreach ($alldepartments as $departments) {
							$deponame = $departments['name'];
							$id = $departments['id'];
							?>
							<tr>
								<td><?=$slno++?></td>
								<td><?=$deponame?></td>
								<td>
									<?php
											$hods = $functions->getHodByDepartmentId($id);
											if($hods){
														$hods = $hods[0];
														$assignid = $hods['id'];
														$teacherid = $hods['teacher'];
														$teacherdata = $functions->getTeachersById($teacherid);
														$teachername = $teacherdata[0]['name'];
														$teacherimage = $teacherdata[0]['image'];
														$teachermail = $teacherdata[0]['mail'];
														$teacherphone = $teacherdata[0]['phone'];
													?>
												<span style="cursor:pointer" class="viewAssignedHodDataBtn ">
														<?=$teachername?>
												</span><br>
												<span class="removeassignedhod text-danger"
  														style="font-size:12px;cursor:pointer"
															data-hodassignid="<?=$assignid?>"
															data-teacherid="<?=$teacherid?>"
															data-deponame="<?=$deponame?>"
															data-toggle="modal"
															data-target="#viewAssignedHODData">
															Remove Hod
												</span>
										<?php	}else{?>
												<span style="cursor:pointer"  class="assignedHod" data-depoid="<?=$id?>" data-toggle="modal" data-target="#assignHodModal">Not Assigned</span>
									<?php		}
									?>
								</td>
								<td>
									<i class="fa fa-trash" id="deleteDepoBtn" data-toggle="modal" data-target="#deleteDepartment" data-depoid="<?=$id?>"></i>
										<span style="margin-left:5px;margin-right:5px">/</span>
									<i class="fa fa-pencil" id="edtDepoBtn" data-toggle="modal" data-target="#editDepartment" data-depoid="<?=$id?>" data-deponame="<?=$deponame?>"></i>
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
<div class="modal fade" id="deleteDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deletedepo" method="post">
							<input type="text" name="depoid" id="depoIdField" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding-top:5px">
				<h5>Edit Department</h5>
				<form action="actions.php?action=editDepo" method="post">
					<input type="text" name="depoid" class="form-control hidden" id="depoEditIdField" >
					<input type="text" name="deponame" class="form-control" id="depoNameField">
					<div class="btncontainer text-right">
						<button type="submit" class="btn btn-sm btn-success btn-fill">Update</button>
						<button type="button" class="btn btn-sm  btn-default btn-fill" data-dismiss="modal">Cancel</button>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="assignHodModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body">
					<div class="btncontainer">
						<form class="" action="../actions.php?action=assignHod" method="post">

							<input type="text" name="depoid" id="assignHodDepoId">

							<div class="form-group">
								<label>Teacher's Name</label>
								<select class="form-control assignHodTeacherSelect" required name="assignHodid">
									<option value="">Please select Teacher</option>
									<?php foreach($allteachers as $teachers) {
												$tid = $teachers['id'];
												$tname = $teachers['name'];
												$hodchecking = $functions->getHodByTeacherId($tid);
												if(empty($hodchecking)){
													$assignedteacherchecking = $functions->getAssignedClassByTeacherId($tid);
													if(empty($assignedteacherchecking)){
											?>
										<option value="<?=$tid?>"><?=$tname?></option>
									<?php } } }?>
								</select>
								<div class="assignHodTeacherDataDiv" style="padding:15px 0;">

								</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-success btn-fill">Assign HOD</button>
								<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="viewAssignedHODData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want remove hod of the <span class="changeHodModaDepo"></span> ?</h5>
				<div class="showHodData">

				</div>
					<div class="btncontainer" style="padding-top:25px;">
						<form class="" action="../actions.php?action=removeHod" method="post">
							<input type="text" name="hodassignidField" id="removeAssignHodAssignId" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Remove</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>
