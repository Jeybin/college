<?php
include './includes/header.php';
$depoid = 7;
$coursesbydepo = $functions->getCoursesByDepoId($depoid);
?>

<?php

foreach($coursesbydepo as $courses) {
	$cid = $courses['id'];
	$course = $courses['course'];
?>
	<a href="timetableselectcourse.php?course=<?=$cid?>">
		<div class="col-lg-4" style="height:150px;">
				<div class="card">
						<div class="content">
							<h5><?=$course?></h5>
						</div>
			</div>
		</div>
	</a>
<?php } ?>




<?php include './includes/footer.php'; ?>
