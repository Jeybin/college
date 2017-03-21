<?php
include '../libs/Functions.php';
$functions = new Functions();

$type = $_POST['type'];

if($type === 'addtimetable'){
	$period = $_POST['period'];
	$day = $_POST['day'];
	$subject = $_POST['subject'];
	$course = $_POST['course'];
	$semester = $_POST['semester'];
	$checking = $functions->getTimeTableByDayAndPeriod($day,$period);
	if($checking){
		$checkingid = $checking[0]['id'];	
		$result = $functions->updateTimeTable($period,$day,$subject,$course,$semester,$checkingid);
		$lastinsertid = $checkingid;
	}else{
		$results = $functions->addTimeTable($period,$day,$subject,$course,$semester);
		$result = $results[0];
		$lastinsertid = $results[1];
	}
	if($result){
		$getdatas = $functions->getTimeTableById($lastinsertid);
		$subjectid = $getdatas[0]['subject'];
		$subjectdata = $functions->getSubjectsById($subjectid);
		$subjectname = $subjectdata[0]['subject']; ?>
		<span style="font-size:14px"><?=$subjectname?></span>
	<?php }
}

if($type === 'addattendence') {
	$attendencedata = $_POST['attendence'];
	$studid = $_POST['studid'];
	$date = $_POST['date'];
	$teacher = $_POST['teacher'];
	$subject = $_POST['subject'];
	$period = $_POST['period'];
	$checking = $functions->getAttendenceDataByStudentIdSubjectIdDate($studid,$subject,$date,$period);
	if($checking){
			$insertedid = $checking[0]['id'];
			$updateattendence = $functions->updateAttendenceById($attendencedata,$studid,$date,$teacher,$subject,$period,$insertedid);
		}else{
			$insertattendence = $functions->insertAttendence($attendencedata,$studid,$date,$teacher,$subject,$period);
	}
}




?>
