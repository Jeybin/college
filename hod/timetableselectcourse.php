<?php
		include './includes/header.php';
		$courseid = $_GET['course'];
?>

<?php
	for($i=1;$i <= 6;$i++) {
 ?>
	<a href="timetableadd.php?course=<?=$courseid?>&semester=<?=$i?>">
		<div class="col-lg-4" style="height:120px;">
				<div class="card">
						<div class="content text-center">
							<h5><?="Semester ".$i?></h5>
						</div>
			</div>
		</div>
	</a>

<?php } ?>

<?php include './includes/footer.php'; ?>
