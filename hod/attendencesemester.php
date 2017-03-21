<?php
	include './includes/header.php';
	$courseid = $_GET['course'];
	$coursedatas = $functions->getCourseById($courseid);
	$courseduration = $coursedatas[0]['course_duration'];

	for($i=1;$i<=$courseduration;$i++){
?>

	<a href="viewattendencestudents.php?course=<?=$courseid?>&semester=<?=$i?>">
			<div class="col-lg-4">
					<div class="card" style="font-weight:700;height:70px;">
							<div class="content">
								Semester <?=$i?>
							</div>
				</div>
			</div>
	</a>
<?php
}
include './includes/footer.php'; ?>
