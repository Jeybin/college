<?php
include './includes/header.php';
$teacherid = $_GET['id'];
$teacherdata = $functions->getTeachersById($teacherid);
$teacherdata = $teacherdata[0];
$name = $teacherdata['name'];
$phone = $teacherdata['phone'];
$email = $teacherdata['mail'];
$profilepic = $teacherdata['image'];
$profilepic = '.'.$profilepic;
$allsubjects = $functions->getAllSubjects('DESC');
$assignedsubjects = $functions->getAllAssignedSubjectsByTeacherId($teacherid);
$actiontype = "assignSubjects";
if($assignedsubjects){
	$actiontype = "updateAssignSubjects";
	$assignedsubjectsid = $assignedsubjects[0]['subjects'];
	$assignedsubjectsid = explode(",", $assignedsubjectsid);
	$assignedsubjectssize = sizeof($assignedsubjectsid);
}
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<div class="row">
								<div class="col-xs-3">
									<div style="height: 200px;width: 200px; background-color:#f7f7f7">

											<img src="<?=$profilepic?>" alt="">
									</div>
								</div>
								<div class="col-xs-9">
									<h3><?=$name?></h3>
									<h5 style="font-size:15px;">#Teach<?=$teacherid?></h5>
									<h5 style="font-size:15px;"><?=$email?></h5>
									<h5 style="font-size:15px;"><?=$phone?></h5>
								</div>
						</div>
				</div>
		</div>
	</div>

<form class="" action="../actions.php?action=<?=$actiontype?>" method="post">

	<input type="text" name="teacherid" value="<?=$teacherid?>" hidden>

	<?php foreach($allsubjects as $subjects) {
				$flag = 0;
				$subjectid = $subjects['id'];
				$subjectname = $subjects['subject'];
				$semester = $subjects['semester'];
				$courseid = $subjects['course'];
				$coursedata = $functions->getCourseById($courseid);
				$coursename = $coursedata[0]['course'];
				if(strlen($coursename) > 30) {
						$coursename = substr($coursename, 0 , 30);
						$coursename = $coursename."...";
				}
				if($assignedsubjects){
				for($i=0;$i<$assignedsubjectssize;$i++){
						$assignedid = $assignedsubjectsid[$i];
						if($assignedid === $subjectid){
								$flag++;
							}
					}
			}
		?>

		<div class="col-lg-4">
				<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-12 text-capitalize"><input type="checkbox" <?php if($flag !== 0){ ?>CHECKED <?php }?>  name="subjectid[]" value="<?=$subjectid?>"  > <i class="margin-left:5px;margin-right:5px"></i><?=$subjectname?></div>
								<div style="font-size:12px;opacity:0.5;padding-top:5px;padding-left:32px;" class="col-xs-12">
										<?=$coursename?>	<br>
										Semester <?=$semester?>
								</div>

							</div>
						</div>
				</div>
			</div>

<?php } ?>

		<div class="col-lg-12">
			<button type="submit" class="btn btn-success btn-fill">Assign Subjects</button>
		</div>


	</form>


<?php include './includes/footer.php'; ?>



<!-- Modal -->
