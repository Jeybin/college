<?php
include './includes/header.php';
$alldepartments = $functions->getAllDepartments('DESC');
?>

<?php
		foreach($alldepartments as $departments){
		$id = $departments['id'];
		$name = $departments['name'];
?>
	<a href="timetableselectcourse.php">
	<div class="col-lg-4">
			<div class="card">
					<div class="content">
						<h4><?=$name?></h4>
					</div>
		</div>
	</div>
</a>
<?php } ?>




<?php include './includes/footer.php'; ?>
