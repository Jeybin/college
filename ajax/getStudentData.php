<?php
include '../libs/Functions.php';
$functions = new Functions();
$alldepartments = $functions->getAllDepartments('DESC');


	$studentid = $_POST['studentid'];
	if(isset($studentid) && !empty($studentid)){
			$students = $functions->getStudentsById($studentid);
			if($students){
					$id = $students[0]['id'];
					$adno = $students[0]['admissionnumber'];
					$adyear = $students[0]['admissionyear'];
					$name = $students[0]['name'];
					$address = $students[0]['address'];
					$phone = $students[0]['phone'];
					$email = $students[0]['email'];
					$selectedcourse = $students[0]['course'];
					$image = $students[0]['profileimage'];
					$image = '.'.$image;
				?>
					<form class="" action="../actions.php?action=updatestudentdata" method="post" enctype="multipart/form-data">
						<input type="text" name="id" class="form-control hidden" value="<?=$id?>">
						<h4 class="text-center">Update Student Data</h4>
					<div class="form-group">
							<label>Name</label>
							<input class="form-control" type="text" name="studentname" value="<?=$name?>">
						</div>
						<div class="form-group">
							<label>Admission Number</label>
							<input class="form-control" type="text" name="admissionnumber" value="<?=$adno?>">
						</div>
						<div class="form-group">
								<label>Student Admission Year</label>
								<select class="form-control" required name="admissionyear">
										<option value="">Please select year of admission</option>
										<?php
													$currentyear = date("Y");
													for($i=0;$i<3;$i++){
										?>
										<option value="<?=$currentyear-$i?>" <?php if(($currentyear-$i) === $adyear) { echo "SELECTED";}?>><?=$currentyear-$i?></option>
									<?php } ?>
								</select>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name="address" class="form-control" rows="8" cols="80"><?=$address?></textarea>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input class="form-control" type="text" name="phonenumber" value="<?=$phone?>">
						</div>
						<div class="form-group">
							<label>Email Id</label>
							<input class="form-control" disabled type="text" name="emailid" value="<?=$email?>">
						</div>

						<div class="form-group">
								<label>Courses</label>
								<select class="form-control" required name="course">
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
										<option <?php if($coursename === $selectedcourse){ echo "SELECTED"; } ?>  value="<?=$courseid?>"><?=$coursename?></option>
									<?php } } ?>
								</select>
						</div>

						<div class="form-group">
							<label>Profile Image</label>
							<input class="form-control" type="file" name="profileimagenew">
							<input class="form-control hidden"  type="text" name="profileimageold" value="<?=$image?>">
						</div>

						<div class="form-group text-center">
								<button type="submit" class="btn btn-success btn-fill">Update</button>
								<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</div>

					</form>



<?php
			}
		}else{
			echo '<option value="">Please select department</option>';
		}





 ?>
