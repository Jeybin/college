<?php
	include './includes/header.php';
	$subjectid = $_GET['subjectid'];
	$courseid = $_GET['course'];
	$semester = $_GET['semester'];
	$coursedata = $functions->getCourseById($courseid);
	$coursename = $coursedata[0]['course'];
	$subjectdatas = $functions->getSubjectsById($subjectid);
	$subjectname = $subjectdatas[0]['subject'];
	$students = $functions->getStudentDataBYCourseId($courseid);
 ?>
 <div class="col-xs-12">
	 <table>
	 		<tr>
	 			<td  style="padding: 15px 0;">Course Name &nbsp;&nbsp;</td>
				<td   style="padding: 15px 0;">&nbsp;&nbsp;:</td>
				<td   style="padding: 15px 0;">&nbsp;&nbsp;<?=$coursename?></td>
	 		</tr>
			<tr>
	 			<td  style="padding: 15px 0;">Subject Name&nbsp;&nbsp;</td>
				<td  style="padding: 15px 0;">&nbsp;&nbsp;: </td>
				<td  style="padding: 15px 0;">&nbsp;&nbsp;<?=$subjectname?></td>
	 		</tr>
			<tr>
	 			<td  style="padding: 15px 0;">Semester&nbsp;&nbsp;</td>
				<td  style="padding: 15px 0;">&nbsp;&nbsp;: </td>
				<td  style="padding: 15px 0;">&nbsp;&nbsp;<?=$semester?></td>
	 		</tr>
	 </table>
 </div>
 <div class="col-lg-12" >
		 <div class="card">
				 <div class="content">
					 <form class="" action="../actions.php?action=addinternals" method="post">
							 <table class="table table-bordered text-center">
								 	<tr style="font-weight:700;">
										<td>Roll No</td>
										<td>Name</td>
										<td>Internal Marks</td>
								 	</tr>
									<?php foreach($students as $student){
												$studentid = $student['id'];
												$studentname = $student['name'];
												$studentinternals = $functions->getStudentInternalMarksByStudentId($studentid);
												if($studentinternals){
													$studentinternalmark = $studentinternals[0]['mark'];
												}
										?>
									<tr>
										<td><?=$studentid?></td>
										<td><?=$studentname?></td>
										<td>
											<input type="text" name="course" value="<?=$courseid?>" hidden>
											<input type="text" name="semester" value="<?=$semester?>" hidden>
												<input type="text" name="subjectid" value="<?=$subjectid?>" hidden>
												<input type="text" name="studentid[]" value="<?=$studentid?>" hidden>
												<select required class="form-control text-center" name="studentinternal[]">
													<option value="">Please Select Internal Mark</option>
													<?php for($i=0;$i<=10;$i++){ ?>
													 <option value="<?=$i?>" <?php if($studentinternals){ if($i == $studentinternalmark){ ?> selected="selected" <?php } } ?>><?=$i?></option>
													 <?php } ?>
												</select>
										</td>
								 	</tr>
									<?php } ?>
							 </table>
							 	<div class="row">
							 		<div class="col-xs-12 text-right">
										<button type="submit" class="btn btn-success btn-fill">Submit</button>
							 		</div>
							 	</div>
						</form>
			 </div>
	 </div>
 </div>


 <?php
 include './includes/footer.php';
  ?>
