<?php
include './includes/header.php';
$subjectid = $_GET['subjectid'];
$courseid = $_GET['course'];
$semester = $_GET['semester'];
$today = date("Y-m-d");
$postedassignments = $functions->getAssignmentsBySubjectAndTeacherId($subjectid,$loginid);
 ?>

<div class="col-lg-12" >
		<div class="card">
				<div class="content">
					<form class="" action="../actions.php?action=addAssignment" method="post">
							<h5 style="font-size: 14px;"class='text-center'>Add Assignment</h5>
							<div class="form-group hidden">
								<label>loginid : </label>
								<input type="text" name="teacher"  class="form-control" value="<?=$loginid?>">
							</div>
							<div class="form-group hidden">
								<label>subjectid : </label>
								<input type="text" name="subjectid"  class="form-control" value="<?=$subjectid?>">
							</div>
							<div class="form-group hidden">
								<label>course : </label>
								<input type="text" name="courseid" class="form-control" value="<?=$courseid?>">
							</div>
							<div class="form-group hidden">
								<label>semester : </label>
								<input type="text" name="semester" class="form-control" value="<?=$semester?>">
							</div>
							<div class="form-group">
								<label>Assignment Heading : </label>
								<input type="text" name="heading" class="form-control" placeholder="Assignment Heading">
							</div>
							<div class="form-group">
								<label>Assignment Description : </label>
								<textarea name="description" rows="8" cols="80" class='form-control' placeholder="Assignment Description"></textarea>
							</div>
							<div class="form-group">
								<label>Assignment Submission Date : </label>
								<input type="date" name="assignmentlastdate" min="<?=$today?>" class="form-control" placeholder="Assignment Heading">
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-success btn-fill">Submit</button>
							</div>
					</form>
				</div>
	</div>
</div>

<?php
foreach($postedassignments as $assignments){
	$assignmentsid = $assignments['id'];
	$assignmentsubjectid = $assignments['subjectid'];
	$assignmentheading = $assignments['heading'];
	$assignmentdescription = $assignments['description'];
	$assignmentposteddate = $assignments['posteddate'];
	$assignmentlastdate = $assignments['lastdate'];
	$subjectdatas = $functions->getSubjectsById($assignmentsubjectid);
	$subjectname = $subjectdatas[0]['subject'];
 ?>
<div class="col-lg-4" >
		<div class="card">
				<div class="content">
					<span>
							<i class="fa fa-trash pull-right assignmentdeletebtn"
								 data-toggle="modal"
								 data-target="#deleteStudentModal"
								 data-assignmentid="<?=$assignmentsid?>"
								 data-subjectid="<?=$subjectid?>"
								 data-courseid="<?=$courseid?>"
								 data-semester="<?=$semester?>"
								 ></i></span>
					<a href="submittedassignments.php?assignmentid=<?=$assignmentsid?>&course=<?=$courseid?>&semester=<?=$semester?>">
						<span style="font-weight:700;font-size:18px;color:#2d2d2d;"><?=$assignmentheading?></span>
						<br>
						<span style="font-weight:700;font-size:12px;color:#2d2d2d;"><?=$subjectname?></span><br>
						<span style="font-weight:700;font-size:12px;color:#2d2d2d;"><?="Last date : ".$assignmentlastdate?></span><br>
						<span style="font-weight:700;font-size:12px;color:#2d2d2d;"><?="Postedon : ".$assignmentposteddate?></span>
					</a>
				</div>
	</div>
</div>
<?php } ?>

<?php include './includes/footer.php'; ?>

<!-- Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content deleteModal">
      <div class="modal-body text-center">
				<h5>Do you really want to delete this student ?</h5>
					<div class="btncontainer">
						<form class="" action="../actions.php?action=deleteAssignment" method="post">
							<input hidden type="text" name="subjectid" id="deleteassginmentsubject" >
							<input hidden  type="text" name="course" id="deleteassginmentcourse" >
							<input hidden  type="text" name="semester" id="deleteassginmentsemester" >
							<input type="text" name="assignmentid" id="deleteassginment" hidden>
							<button type="submit" class="btn btn-danger btn-fill">Delete</button>
							<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
						</form>
					</div>
      </div>
    </div>
  </div>
</div>
