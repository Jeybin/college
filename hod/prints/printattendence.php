<?php
$studentid = $_GET['studentid'];

require '../../mpdf/mpdf.php';
require '../../libs/Functions.php';

$functions = new Functions();
$mpdf = new mPDF();

$stylesheet = file_get_contents('../../assets/css/bootstrap.min.css');
$stylesheet2 = file_get_contents('../../assets/css/pdfstyles.css');

$studentdatas = $functions->getStudentsById($studentid);
$studentname = $studentdatas[0]['name'];
$courseid = $studentdatas[0]['course'];
$admissionyear = $studentdatas[0]['admissionyear'];
$presentsem = $functions->getSemesterByAdmissionYear($admissionyear);
$coursedatas = $functions->getCourseById($courseid);
$coursename = $coursedatas[0]['course'];
$attendencedatas = $functions->getAttendenceDataBYStudentId($studentid);
$slno = 0;
$otherdatas= '
						<div class="text-center page-header">Attendence History</div>
							<table>
								<tr>
									<td>Student Name</td>
									<td>:</td>
									<td>'.$studentname.'</td>
								</tr>
								<tr>
									<td>Course</td>
									<td>:</td>
									<td>'.$coursename.'</td>
								</tr>
								<tr>
									<td>Semester</td>
									<td>:</td>
									<td>'.$presentsem.'</td>
								</tr>
							</table>';

$table = '
				<table class="table table-bordered table-responsive text-center timetabletable">
					<tr>
						<td>#</td>
						<td>Subject</td>
						<td>Period</td>
						<td>Status</td>
						<td>Date</td>
					</tr>';
foreach ($attendencedatas as $attendencedata) {
	$slno++;
	$subjectid = $attendencedata['subjectid'];
	$period = $attendencedata['period'];
	$attendence = $attendencedata['attendence'];
	$date = $attendencedata['attendencedate'];
	$subjectdatas = $functions->getSubjectsById($subjectid);
	$subjectname = $subjectdatas[0]['subject'];

$table.='
				<tr>
					<td>'.$slno.'</td>
					<td>'.$subjectname.'</td>
					<td>'.$period.'</td>
					<td>'.$attendence.'</td>
					<td>'.$date.'</td>
				</tr>
					';
}
$table.='</table>';

//$mpdf->SetHTMLHeader('<div style="border-bottom: 1px solid #000000;">My document</div>','E');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($otherdatas,2);
$mpdf->WriteHTML($table,2);


$mpdf->Output($studentname.'_'.$coursename.'_'.$presentsem.'.pdf','I');
