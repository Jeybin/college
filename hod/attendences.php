<?php
	include './includes/header.php';
	$hoddatas = $functions->getHodByTeacherId($loginid);
	$depoid = $hoddatas[0]['department'];
	$depodatas = $functions->getDepartmentById($depoid);
	$deponame = $depodatas[0]['name'];
	$coursedatas = $functions->getCoursesByDepoId($depoid);
	foreach($coursedatas as $courses) {
		$cid = $courses['id'];
		$course = $courses['course'];
	?>
		<a href="attendencesemester.php?course=<?=$cid?>">
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
