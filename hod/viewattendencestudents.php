<?php include './includes/header.php';
	$course = $_GET['course'];
	$semester = $_GET['semester'];
	$students = $functions->getStudentDataBYCourseId($course);
	$rollno = 0;
	foreach($students as $student){
		$studentid = $student['id'];
		$studentadmissionno = $student['admissionnumber'];
		$studentadmissionyear = $student['admissionyear'];
		$studentname = $student['name'];
		$studentimage = $student['profileimage'];
		$rollno++;
		$presentsem = $functions->getSemesterByAdmissionYear($studentadmissionyear);
		if($semester == $presentsem){
?>
<a href="viewattendence.php?course=<?=$course?>&semester=<?=$semester?>&studentid=<?=$studentid?>">
<div class="col-lg-4">
		<div class="card" style="font-weight:700;height: 150px;">
				<div class="content">
					<div class="row">
						<div class="col-xs-4" style="padding-top:20px;">
							<img src=".<?=$studentimage?>" alt="">
						</div>
						<div class="col-xs-8" style="padding-top:25px;">
							<table>
								<tr>
									<td>Name</td>
									<td> &nbsp; &nbsp;: &nbsp; &nbsp;</td>
									<td><?=$studentname?></td>
								</tr>
								<tr>
									<td>Admissio No</td>
									<td> &nbsp; &nbsp;: &nbsp; &nbsp;</td>
									<td><?=$studentadmissionno?></td>
								</tr>
								<tr>
									<td>Roll No</td>
									<td> &nbsp; &nbsp;: &nbsp; &nbsp;</td>
									<td><?=$rollno?></td>
								</tr>

							</table>
						</div>
					</div>
				</div>
	</div>
</div>
</a>
<?php } }?>

<?php include './includes/footer.php'; ?>
