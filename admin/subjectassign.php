<?php
include './includes/header.php';
$allteachers = $functions->getAllTeachers('DESC');
?>

<div class="col-lg-12">
		<div class="card">
				<div class="content">
						<table class="table table-bordered text-center">
							<tr style="font-weight:600">
								<td>#</td>
								<td>Name</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Operations</td>
							</tr>
						<?php
							$slno = 1;
						foreach ($allteachers as $teachers) {
								$teacherid = $teachers['id'];
								$teachername = $teachers['name'];
								$teacherphone = $teachers['phone'];
								$teachermail = $teachers['mail'];
							?>
					  <tr>
							 <td><?=$slno++?></td>
							 <td><?=$teachername?></td>
							 <td><?=$teachermail?></td>
							 <td><?=$teacherphone?></td>
							 <td>
								<a href="assignsubjecttoteacher.php?id=<?=$teacherid?>" style="color:#2d2d2d">
									 <i class="fa fa-book"></i>
										 <span style="margin-left:5px;margin-right:5px"></span>
										Assign Subjects
									</td>
								</a>
					<?php } ?>
						</tr>
						</table>
				</div>
		</div>
	</div>
</div>



<?php include './includes/footer.php'; ?>



<!-- Modal -->
