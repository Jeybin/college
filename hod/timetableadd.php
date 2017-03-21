<?php
		include './includes/header.php';
		$courseid = $_GET['course'];
		$semester = $_GET['semester'];
		$subjects = $functions->getSubjectsBySemesterAndCourse($semester,$courseid);
 ?>

<div class="col-lg-12" >
		<div class="card">
				<div class="content">
					<h5 class="text-center">

									Add Timetable
					<a href="./prints/printtimetable.php?course=<?=$courseid?>&semester=<?=$semester?>" style="text-decoration:none;color:#2d2d2d;">
							<i class="fa fa-print pull-right"></i>
					</a>
					</h5>
					<table class="table table-bordered table-responsive">
							<tr class="text-center"  style="font-weight:700">
								<td></td>
								<td>Period 1</td>
								<td>Period 2</td>
								<td>Period 3</td>
								<td>Period 4</td>
								<td>Period 5</td>
								<td>Period 6</td>
							</tr>
			<?php
					$days = array("monday","tuesday","wednesday","thursday","friday");
					for($i=0; $i<sizeof($days);$i++){ ?>
							<tr class="">
								<td style="font-weight:700" class="text-uppercase"><?=$days[$i]?></td>
								<?php for($x=1;$x<=6;$x++){ ?>
									<td data-toggle="modal" id="<?=$days[$i].$x?>" data-target=".selectSubjectModal" data-period="<?=$x?>" data-day="<?=$days[$i]?>" class="assignsub text-center" style="cursor:pointer">
										<?php
											$timetabledatas = $functions->getTimeTableByDayPeriodSemCourse($days[$i],$x,$semester,$courseid);
											if($timetabledatas){
												$timetabledatas = $timetabledatas[0];
												$timetablesubid = $timetabledatas['subject'];
												$subjectdatas = $functions->getSubjectsById($timetablesubid);
												$subjectname = $subjectdatas[0]['subject'];
												echo $subjectname;
											}else{
												echo "<span class='text-danger'>Not Assigned</span>	";
											}
										?>
									</td>

								<?php } ?>
							</tr>
				<?php } ?>

						</table>
				</div>
	</div>
</div>


<?php include './includes/footer.php'; ?>

<div class="modal fade selectSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Select Subject</h4>
		      </div>
		      <div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<input type="text" name="course" class="coursefield"  value="<?=$courseid?>" hidden>
								<input type="text" name="semester" class="semesterfield" value="<?=$semester?>" hidden>
								<input type="text" name="period" class="periodfield" hidden>
								<input type="text" name="day" class="dayfield" hidden>
							<?php
									foreach($subjects as $subject){
									$subname = $subject['subject'];
									$subid = $subject['id'];
								?>
								<div class="col-xs-6">
									<div class="col-xs-1"><input type="radio" name="subjectselect" class="subjectselectradio" value="<?=$subid?>"></div>
									<div class="col-xs-10"><?=$subname?></div>
								</div>
								<?php }  ?>
							</div>
						</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" data-dismiss="modal" class="btn btn-primary btn-fill addtimetable">Add</button>
		      </div>
		</div>
  </div>
</div>
