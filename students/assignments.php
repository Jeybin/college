<?php
include './includes/header.php';
$subjectdatas = $functions->getSubjectsBySemesterAndCourse($presentsem,$studentcourse);
foreach ($subjectdatas as $subjects) {
	$subjectid = $subjects['id'];
	$subjectname = $subjects['subject'];
	$assignmentdatas = $functions->getAssignmentsBySubjectIdAndSemester($subjectid,$presentsem);
	foreach($assignmentdatas as $assignments){
		$assignmentheading =$assignments['heading'];
		$assignmentdescription = $assignments['description'];
		$assignmentlastdate = $assignments['lastdate'];
		$assignmentposteddate = $assignments['posteddate'];
		$strlen = strlen($assignmentdescription);
		if($strlen > 540){
			$description = substr($assignmentdescription, 0, 540);
			$description = $description.'...';
		}else{
			$description = $assignmentdescription;
		}
?>

<div class="col-lg-6">
		<div class="card"  style="height:250px;">
				<div class="content text-capitalize">
					<span style="font-weight:700;font-size:16px;"><?=$assignmentheading?></span><br>
					<span style="font-size:12px;opacity:0.7"><?=$subjectname?></span><br>
					<span style="font-size:12px;opacity:0.7">Last Submission Date &nbsp; : <?=$assignmentlastdate?></span> &nbsp;&nbsp;
					<span style="font-size:12px;opacity:0.7">Posted On  &nbsp; : <?=$assignmentposteddate?></span><br><br>
					<span style="font-size:12px;" class="text-justify"><?=$description?></span>
				</div>
	</div>
</div>

<?php
} }
include './includes/footer.php'; ?>
