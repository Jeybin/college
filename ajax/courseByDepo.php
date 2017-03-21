<?php
include '../libs/Functions.php';
$functions = new Functions();

	$depoid = $_POST['depoid'];
	if(isset($depoid) && !empty($depoid)){
			$coursesbydepo = $functions->getCoursesByDepoId($depoid);
			if($coursesbydepo){
				echo '<option value="">Please Select course</option>';
				foreach ($coursesbydepo as $courses) {
					$courseid = $courses['id'];
					$coursename = $courses['course'];
					echo '<option value='.$courseid.'>'.$coursename.'</option>';
				}
			}
		}else{
			echo '<option value="">Please select department</option>';
		}





 ?>
