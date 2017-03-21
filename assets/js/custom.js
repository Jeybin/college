$(document).ready(function(){

	/*$.ajax({
			type:'POST',
			url:'../ajax/addTimetable.php',
			data:'type=alltimetable',
			success:function(data){
			console.log(data);
		}
	});
*/


	$('.assignClassTeacherDepartment').change(function(){
			var depoid = $(this).val();
			if(depoid){
					$.ajax({
							type:'POST',
							url:'../ajax/assignClass.php',
							data:'depoid='+depoid,
							success:function(data){
									console.log(data);
								$('.assignClassTeacherCourse').html(data);
						}
					});
			}else{
					$('.assignClassTeacherCourse').html('<option value="">Select Department first</option>');
			}
		});



			$('.assignHodTeacherSelect').change(function(){
					var teacherid = $(this).val();
					if(teacherid){
							$.ajax({
									type:'POST',
									url:'../ajax/assignHod.php',
									data:'teacherid='+teacherid,
									success:function(data){
											console.log(data);
										$('.assignHodTeacherDataDiv').html(data);
								}
							});
					}else{
							$('.assignHodTeacherDataDiv').html('Please select a teacher');
					}
				});








});



$(document).on("click", ".removeassignedhod", function () {
	var $assignid = $(this).data('hodassignid');
	var teacherid = $(this).data('teacherid');
	var $deponame = $(this).data('deponame');
	$("#removeAssignHodAssignId").val($assignid);
	$(".changeHodModaDepo").text($deponame);
	if(teacherid){
			$.ajax({
					type:'POST',
					url:'../ajax/assignHod.php',
					data:'teacherid='+teacherid,
					success:function(data){
						$('.showHodData').html(data);
				}
			});
	}
});

$(document).on("click", ".addtimetable", function (e) {
	e.preventDefault();
	if (!$("input[name='subjectselect']:checked").val()) {
   alert('Please Select Any Values Given !!');
}else{
	$period = $(".periodfield").val();
	$day = $(".dayfield").val();
	$course = $(".coursefield").val();
	$semester = $(".semesterfield").val();
	$subject = $("input[name='subjectselect']:checked").val();
	$.ajax({
			type:'POST',
			url:'../ajax/addTimetable.php',
			data: {'type':'addtimetable','period': $period, 'day': $day, 'subject': $subject, 'course': $course, 'semester' : $semester},
			success:function(data){
				console.log(data);

				$idname = "#"+$day+$period;
				$($idname).html(data);
		}
	});
}

});


$(document).on("click", ".editstudentbtn", function () {
	var $student = $(this).data('studid');
	if($student){
			$.ajax({
					type:'POST',
					url:'../ajax/getStudentData.php',
					data:'studentid='+$student,
					success:function(data){
						$('.studentEditModalDataDiv').html(data);
				}
			});
	}
});



$(document).on("click", ".attendenceicons", function () {
	var $attendencedata = $(this).data('presentdata');
	var $studid = $(this).data('studid');
	var $date = $(this).data('date');
	var $teacher = $(this).data('teacher');
	var $subject = $(this).data('subject');
	var $period = $(this).data('periods')
	if($studid){
			$.ajax({
					type:'POST',
					url:'../ajax/addTimetable.php',
					data: {'type':'addattendence','attendence': $attendencedata,'studid':$studid,'date': $date,'teacher':$teacher,'subject':$subject,'period':$period},
					success:function(data){
										console.log(data);
					//	$('.studentEditModalDataDiv').html(data);
				}
			});
	}
});


$(document).on("click",".present",function(){
	var $id = $(this).data('studid');
	$('.'+$id).removeClass("absentbtn");
  $(this).addClass("presentbtn");
});
$(document).on("click",".absent",function(){
	var $id = $(this).data('studid');
		$('.'+$id).removeClass("presentbtn");
	  $(this).addClass("absentbtn");
});

$(document).on("click", ".assignedHod", function () {
	var $id = $(this).data('depoid');
	$("#assignHodDepoId").val($id);
});

$(document).on("click", ".removeteacherassign", function () {
	var $id = $(this).data('assignid');
	var $semester = $(this).data('assignedsem');
	var $course = $(this).data('assignedcourse');
	var $teachername = $(this).data('tname');
	var $classname = "Semester "+$semester+" "+$course;
	$(".assignedid").val($id);
	$(".modalteachername").text($teachername);
	$(".modalclassname").text($classname);

});


$(document).on("click", ".deletestudentbtn", function () {
	var $id = $(this).data('studid');
	$("#deleteStudentId").val($id);
});



$(document).on("click", ".teacheridclassassignbtn", function () {
	var $id = $(this).data('tid');
	$(".teacheridclassassign").val($id);
});


$(document).on("click", "#deleteDepoBtn", function () {
	var $id = $(this).data('depoid');
	$("#depoIdField").val($id);
});

$(document).on("click", "#deleteCourseBtn", function () {
	var $id = $(this).data('courseid');
	$("#courseIdField").val($id);
});


$(document).on("click", "#edtDepoBtn", function () {
	var $id = $(this).data('depoid');
	var $name = $(this).data('deponame');
	$("#depoEditIdField").val($id);
	$("#depoNameField").val($name);
});

$(document).on("click","#delSubject",function(){
	var $id = $(this).data('subid');
	$("#subIdField").val($id);
});

$(document).on("click","#deleteTeacherBtn",function(){
	var $id = $(this).data('teacherid');
	$("#teacherIdField").val($id);
});

$(document).on("click", "#editTeacherBtn", function () {
	var $id = $(this).data('teacherid');
	var $phone = $(this).data('teacherphone');
	var $name = $(this).data('teachername');
	$("#teacherEditIdField").val($id);
	$("#techerNameField").val($name);
	$("#techerPhoneField").val($phone);
});


$(document).on("click",".assignsub",function(){
	var $period = $(this).data('period');
	var $day = $(this).data('day');
	$(".periodfield").val($period);
	$(".dayfield").val($day);
});



$(document).on("click",".assignmentdeletebtn",function(){
	var $assignmentid = $(this).data('assignmentid');
	var $subjectid = $(this).data('subjectid');
	var $courseid = $(this).data('courseid');
	var $semester = $(this).data('semester');

	$("#deleteassginment").val($assignmentid);
	$("#deleteassginmentsubject").val($subjectid);
	$("#deleteassginmentcourse").val($courseid);
	$("#deleteassginmentsemester").val($semester);
});
