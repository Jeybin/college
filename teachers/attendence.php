<?php
include './includes/header.php';
$assignedsubjects = $functions->getAllSubjectsAssignedByTeacherId($loginid);
$days = array("monday","tuesday","wednesday","thursday","friday");
?>


<div class="col-lg-12" >
		<div class="card">
				<div class="content">
					<h5 class="text-center">

									 Timetable
					<a href="./prints/printtimetable.php" style="text-decoration:none;color:#2d2d2d;">
							<i class="fa fa-print pull-right"></i>
					</a>
					</h5>

						<table class='table table-bordered table-responsive'>
								<tr>
									<td></td>
									<?php for($periodno=1;$periodno<=6;$periodno++){ ?>
										<td>Period <?=$periodno?></td>
									<?php } ?>
								</tr>
							<?php
							for($x=0;$x<sizeof($days);$x++){
 							?>
								<tr>
									<td><?=$days[$x]?></td>
									<?php for($y=1;$y<=6;$y++){ ?>
											<td>
												<?php
													$day = $days[$x];
													$periodno = $y;
													foreach ($assignedsubjects as $subjectsassigned) {
															$subassignedid = $subjectsassigned['subjects'];
															$subassignedid = explode(',', $subassignedid);
															for($z=0;$z<sizeof($subassignedid);$z++){
																		$subid = $subassignedid[$z];
																		$timetabledatas = $functions->getTimeTableByDayPeriodSubjectId($days[$x],$y,$subid);
																		if($timetabledatas){
																			$timetabledatas = $timetabledatas[0];
																			$timetablesubid = $timetabledatas['subject'];
																			$subjectdatas = $functions->getSubjectsById($timetablesubid);
																			$subjectname = $subjectdatas[0]['subject'];
																			$subjectsem = $subjectdatas[0]['semester'];
																			$subjectcourse = $subjectdatas[0]['course'];
																			$coursedatas = $functions->getCourseById($subjectcourse);
																			$coursename = $coursedatas[0]['course'];
																			echo "<a href='addattendence.php?subid=".$timetablesubid."&period=".$y."&day=".$days[$x]."' style='text-decoration:none;color:#2d2d2d'>".$subjectname."<br><span style='opacity:0.7;font-size:10px'>Semester ".$subjectsem."<br><span style='opacity:0.7;font-size:10px'>Course - <br> ".$coursename."</span></a>";
																		}
																}
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
