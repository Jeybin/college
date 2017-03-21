<?php
 	include './includes/header.php';
	$course = $_GET['course'];
	$semester = $_GET['semester'];
	$studentid = $_GET['studentid'];
	$attendencedatas = $functions->getAttendenceDataBYStudentId($studentid);

 ?>

 <div class="col-lg-12">
		 <div class="card" >
				 <div class="content">
					 <table class='table table-bordered text-center text-capitalize'>
						 	<tr style="font-weight:700">
								<td>#</td>
								<td>Subject</td>
								<td>Period</td>
								<td>Status</td>
						 		<td>Date</td>
						 	</tr>
							<?php
								$slno = 0;
							 	foreach ($attendencedatas as $attendencedata) {
									$slno++;
									$subjectid = $attendencedata['subjectid'];
									$period = $attendencedata['period'];
									$attendence = $attendencedata['attendence'];
									$date = $attendencedata['attendencedate'];
									$subjectdatas = $functions->getSubjectsById($subjectid);
									$subjectname = $subjectdatas[0]['subject'];
									 ?>
								<tr>
									<td><?=$slno?></td>
									<td><?=$subjectname?></td>
									<td><?=$period?></td>
									<td><?=$attendence?></td>
							 		<td><?=$date?></td>
							 	</tr>

								<?php } ?>
					 </table>
					 <div class="text-right">
						 <button type="button" name="button" class="btn btn-info btn-fill">Send Mail To Parent and Student</button>
						 <a href="prints/printattendence.php?studentid=<?=$studentid?>" target="_blank">
							 <button type="button" name="button" class="btn btn-info btn-fill">Take Print out</button>
						 </a>
					 </div>
				 </div>
	 </div>
 </div>

<?php
include './includes/footer.php';
?>
