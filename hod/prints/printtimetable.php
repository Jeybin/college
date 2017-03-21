<?php
$courseid = $_GET['course'];
$semester = $_GET['semester'];

require '../../mpdf/mpdf.php';
require '../../libs/Functions.php';

$functions = new Functions();
$mpdf = new mPDF();

$stylesheet = file_get_contents('../../assets/css/bootstrap.min.css');
$stylesheet2 = file_get_contents('../../assets/css/pdfstyles.css');

$days = array("monday","tuesday","wednesday","thursday","friday");
$coursedata = $functions->getCourseById($courseid);
$coursename = $coursedata[0]['course'];
$heading = '<div class="pdfheadings">Time Table</div>';
$otherdatas= '
							<table>
								<tr>
									<td>Course</td>
									<td>:</td>
									<td>'.$coursename.'</td>
								</tr>
								<tr>
									<td>Semester</td>
									<td>:</td>
									<td>'.$semester.'</td>
								</tr>
							</table>';
$table = 	'<table class="table table-bordered table-responsive timetabletable">
							<tr class="text-center text-uppercase ">
								<td></td>';
						for($periodcount=1;$periodcount<=6;$periodcount++){
$table.='<td class="text-center text-capitalize timetableperiodheadings">Period '.$periodcount.'</td>';
}
$table.='</tr>	';
			for($i=0; $i<sizeof($days);$i++){
$table.='    <tr class="">
								<td class="text-capitalize tabledaysrow">'.$days[$i].'</td>';
		  						for($x=1;$x<=6;$x++){
$table.='<td class="timetabledatasubject text-capitalize">';
											$timetabledatas = $functions->getTimeTableByDayPeriodSemCourse($days[$i],$x,$semester,$courseid);
											if($timetabledatas){
												$timetabledatas = $timetabledatas[0];
												$timetablesubid = $timetabledatas['subject'];
												$subjectdatas = $functions->getSubjectsById($timetablesubid);
												$subjectname = $subjectdatas[0]['subject'];
$table.='<span>'.$subjectname.'</span>';
											}else{
$table.='<span>Not Assigned</span>';
											}
$table.='</td>';
 		}
$table.='</tr>';
 }
$table.='</table>';


//$mpdf->SetHTMLHeader('<div style="border-bottom: 1px solid #000000;">My document</div>','E');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($heading,2);
$mpdf->WriteHTML($otherdatas,2);
$mpdf->WriteHTML($table,2);


$mpdf->Output('helloworld.pdf','I');
