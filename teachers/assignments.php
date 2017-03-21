<?php
include './includes/header.php';
$assignedsubjects = $functions->getAllSubjectsAssignedByTeacherId($loginid);
$subjectsassigned = $assignedsubjects[0]['subjects'];
$subjectsassignedexplode = explode(',', $subjectsassigned);
$sizeofsubjectsassigned = sizeof($subjectsassignedexplode);
for($i=0;$i<$sizeofsubjectsassigned;$i++){
	$subjectdatas = $functions->getSubjectsById($subjectsassignedexplode[$i]);
	$subjectname = $subjectdatas[0]['subject'];
	$semester = $subjectdatas[0]['semester'];
	$subjectid = $subjectdatas[0]['id'];
	$subjectcourse = $subjectdatas[0]['course'];
	$coursedatas = $functions->getCourseById($subjectcourse);
	$courseid = $coursedatas[0]['id'];
	$coursename = $coursedatas[0]['course'];
?>
	<a href="viewassignments.php?subjectid=<?=$subjectid?>&course=<?=$courseid?>&semester=<?=$semester?>">
		<div class="col-lg-4" >
				<div class="card">
						<div class="content">
							<span style="font-size:18px;font-weight:700;"><?=$subjectname?></span><br>
							<span style="opacity:0.5;font-size:12px">
								<span><?="Semester ".$semester?></span><br>
								<span><?="Course - <br>".$coursename?></span><br>
							</span>
					</div>
			</div>
		</div>
</a>
<?php }
include './includes/footer.php'; ?>
