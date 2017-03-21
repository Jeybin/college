<?php include './includes/header.php'; ?>

<div class="col-lg-12" >
		<div class="card">
				<div class="content">
					<span style="font-size:18px;font-weight:700;">Settings</span><br><br><br>
					<form class="" action="../actions.php?action=changepassword" method="post">
						<div class="form-group hidden">
							<label>Teacher id</label>
							<input type="text" name="userid" class="form-control" value="<?=$loginid?>" required>
						</div>
						<div class="form-group hidden">
							<label>Table</label>
							<input type="text" name="table" class="form-control" value="teachers" required>
						</div>
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" name="oldpass" class="form-control" placeholder="Enter Old password" required>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="newpass" class="form-control" placeholder="Enter New password" required>
						</div>
						<div class="form-group">
							<label>Re-enter New Password</label>
							<input type="password" name="reenterpass" class="form-control" placeholder="Re-Enter New password" required>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-success btn-fill">Change Password</button>
						</div>

					</form>
			</div>
	</div>
</div>

<?php include './includes/footer.php'; ?>
