<?php
include './includes/header.php';
$assignmentid = $_GET['assignmentid'];
$course =  $_GET['course'];
$semester = $_GET['semester'];
$assignmentdatas = $functions->getAssignmentsById($assignmentid);
$assignmentheading = $assignmentdatas[0]['heading'];
$assignmentdescription = $assignmentdatas[0]['description'];
$posteddate = $assignmentdatas[0]['posteddate'];
$lastdate = $assignmentdatas[0]['lastdate'];
$today = date("Y-m-d");
if($today > $lastdate) {
	$status = "<span class='text-danger'>Closed</span>" ;
}else{
	$status = "<span class='text-success'>Open</span>" ;
}
$studentsdatas = $functions->getStudentDataBYCourseIdOrderById($course);
//$admissionyear = $studentsdatas[0]['admissionyear'];
//$presentsem = $functions->getSemesterByAdmissionYear($admissionyear);
?>


<div class="form-group">
	<label style="font-size:12px">Assignment Name:</label><br>
	<span style="font-size: 16px;font-weight:700"> <?=$assignmentheading?> </span>
</div>
<div class="form-group">
	<label style="font-size:12px">Assignment description:</label><br>
	<span style="font-size: 16px;font-weight:700"> <?=$assignmentdescription?> </span>
</div>
<div class="form-group">
	<label style="font-size:12px">Assignment lastdate:</label><br>
	<span style="font-size: 16px;font-weight:700"> <?=$lastdate?> </span>
</div>
<div class="form-group">
	<label style="font-size:12px">Assignment Status:</label><br>
	<span style="font-size: 16px;font-weight:700"> <?=$status?> </span>
</div><br>


<div class="col-lg-12" >
		<div class="card">
			<div class="content">
				<table class='table table-bordered'>
						<tr class='text-center' style="font-weight: 700;">
							<td>Roll No</td>
							<td>Student Name</td>
							<td>Status</td>
						</tr>
						<?php foreach($studentsdatas as $students) {
							$admissionyear = $students['admissionyear'];
							$presentsem = $functions->getSemesterByAdmissionYear($admissionyear);
							if($presentsem == $semester){
								$studentid = $students['id'];
								$studentname = $students['name'];
								$assignmentssubmitted = $functions->getSubmittedAssignmentByStudentIdAndAssignmentId($studentid,$assignmentid);
								if($assignmentssubmitted){
									$assignmentpath = '../assets/assignments/test.pdf';
									$status = '<a href="'.$assignmentpath.'" target="_blank" >view assignment</a>';
								}else{
									$status = '<span class="text-danger">Not Submitted</span>';
								}
							 ?>
						<tr class='text-center'>
							<td><?=$studentid?></td>
							<td><?=$studentname?></td>
							<td><?=$status?></td>
						</tr>
						<?php  } }?>
					</table>
			</div>
		</div>
</div>




<?php include './includes/footer.php'; ?>
