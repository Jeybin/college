<?php

	include './includes/header.php';
	$subjectid = $_GET['subid'];
	$period = $_GET['period'];
	$day = $_GET['day'];
	$today = date("Y-m-d");
	$subjectdatas = $functions->getSubjectsById($subjectid);
	$semester = $subjectdatas[0]['semester'];
	$course = $subjectdatas[0]['course'];
	$getallstudents = $functions->getStudentDataBYCourseId($course);
?>

 <div class="col-lg-12" >
 		<div class="card">
 				<div class="content">
					<table class='table table-bordered table-responsive'>
							<tr class='text-center'>
							<td>RollNo</td>
								<td>Name</td>
								<td>Present</td>
								<td>Absent</td>
							</tr>
					<?php

							foreach($getallstudents as $students){
										$studentid = $students['id'];
										$studentname = $students['name'];
										$attendence = 'not added';
										$attendencestatus = $functions->getAttendenceDataBYStudentId($studentid);
										if($attendencestatus){
										$attendence = $attendencestatus[0]['attendence'];
										$attendenceperiod = $attendencestatus[0]['period'];
							} ?>

							<tr class='text-center'>
								<td ><?=$studentid?></td>
								<td><?=$studentname?></td>
								<td><i class='fa fa-check-circle attendenceicons present <?=$studentid?> <?php if($attendence === "present" && $attendenceperiod === $period) { echo "presentbtn" ; } ?> ' data-presentdata='present'  data-periods='<?=$period?>' data-studid='<?=$studentid?>' data-date="<?=$today?>" data-teacher="<?=$loginid?>" data-subject="<?=$subjectid?>"></td>
								<td><i class='fa fa-times-circle attendenceicons absent  <?=$studentid?> <?php if($attendence === "absent" && $attendenceperiod === $period) { echo "absentbtn" ;}?>'   data-presentdata='absent'  data-periods='<?=$period?>'  data-studid='<?=$studentid?>' data-date="<?=$today?>" data-teacher="<?=$loginid?>" data-subject="<?=$subjectid?>" ></td>
							</tr>
			<?php }  ?>
					</table>
				</div>
 		</div>
 </div>


<?php include './includes/footer.php'; ?>
