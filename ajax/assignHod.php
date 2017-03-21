<?php
include '../libs/Functions.php';
$functions = new Functions();
$teacherid = $_POST['teacherid'];

	if(isset($teacherid) && !empty($teacherid)) {
			$teacherdata = $functions->getTeachersById($teacherid);
			if($teacherdata) {
					$name = $teacherdata[0]['name'];
					$phone = $teacherdata[0]['phone'];
					$mail = $teacherdata[0]['mail'];
					$image = $teacherdata[0]['image'];
					$image = '.'.$image;
					?>
					<div style="width: 100%;padding:15px;float:left">
						<div style="width:150px;height:150px;float:left">
								<img src="<?=$image?>" alt="">
						</div>
						<div style="width:380px;height:150px;padding:5px 15px;float:left">
								<div style="font-size:18px;font-weight:700;"><?=$name?></div>
								<div style="font-size:14px;line-height:24px;font-weight:500;"><?=$phone?></div>
								<div style="font-size:14px;line-height:24px;font-weight:500;"><?=$mail?></div>
						</div>
					</div>
			<?php }
  }else{ ?>
		<div style="padding:15px;opacity:0.5" class="text-center">
			Please select a teacher
		</div>
	<?php } ?>
