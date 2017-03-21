<?php

require_once ('DbConnection.php');

class Functions extends DbConnection {

/*------------- LOGIN ------------------*/
public function logincheck($username,$password) {
	$admincheck = $this->adminLoginCheck($username,$password);
	if($admincheck){
		$loginid = $admincheck[0]['id'];
		$logintype = 'admin';
		return array($loginid,$logintype);
	}else{
		$teacherlogincheck = $this->teacherLoginCheck($username,$password);
		if($teacherlogincheck){
			$loginid = $teacherlogincheck[0]['id'];
			$logintype = 'teachers';
			return array($loginid,$logintype);
			}else{
				$studentslogincheck = $this->studentslogincheck($username,$password);
				if($studentslogincheck){
					$loginid = $studentslogincheck[0]['id'];
					$logintype = 'students';
					return array($loginid,$logintype);
				}else{
					$parentlogincheck = $this->parentlogincheck($username,$password);
					if($parentlogincheck){
						$loginid = $parentlogincheck[0]['id'];
						$logintype = 'parents';
						return array($loginid,$logintype);
					}
			}
		}
	}
	return FALSE;
}

public function adminLoginCheck($username,$password) {
	$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
	$output = $this->getData($query);
	return $output;
}
public function teacherLoginCheck($username,$password) {
	$query = "SELECT * FROM teachers WHERE mail='$username' AND password='$password'";
	$output = $this->getData($query);
	return $output;
}
public function studentslogincheck($username,$password) {
	$query = "SELECT * FROM students WHERE email='$username' AND password='$password'";
	$output = $this->getData($query);
	return $output;
}
public function parentlogincheck($username,$password) {
	$query = "SELECT * FROM parentsdetails WHERE mailid='$username' AND password='$password'";
	$output = $this->getData($query);
	return $output;
}

/*------------- Passwords -----------------*/
public function oldpasscheck($table,$userid,$oldpass) {
	$query = "SELECT * FROM $table WHERE password='$oldpass' AND id='$userid'";
	$output = $this->getData($query);
	return $output;
}


	public function passwordChange($table,$new,$loginid){
		$query  = "UPDATE $table SET password = '$new' WHERE id = '$loginid'" ;
		$output = $this->setData($query);
		return $output;
	}


/*---------- Common ---------------*/
	public function delete($table,$id) {
			$query = "DELETE FROM $table WHERE id=$id";
			$output = $this->setData($query);
			return $output;
	}

	public function checkForRegisteredEmails($email)	{
		$parentsdetails = "SELECT * FROM parentsdetails WHERE mailid='$email'";
		$output = $this->getData($parentsdetails);
		if(empty($output)){
			$studentdetails = "SELECT * FROM students WHERE email='$email'";
			$output = $this->getData($studentdetails);
			if(empty($output)){
				$teacherdetails = "SELECT * FROM teachers WHERE mail='$email'";
				$output = $this->getData($teacherdetails);
			}
		}
		return $output;
	}


	public function changeMailVerificationStatus($table,$id,$status='verified') {
	  $query  = "UPDATE $table SET mailverification = '$status' WHERE id = $id" ;
		$output = $this->setData($query);
		return $output;
	}

	public function changeToNewPassword($loginid,$table,$email,$mailverification) { ?>
		<script type="text/javascript">
	  <?php  if($mailverification === 'not verified') { ?>
	      $(document).ready(function(){
	            $('.changeNewPassword').modal({
	                backdrop: 'static',
	                keyboard: false
	            });
	              $('.changeNewPassword').modal('show');
	          });
	    <?php } ?>
	  </script>

	    <div class="modal fade changeNewPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-body">
	            <form action="../actions.php?action=firstPasswordChange" method="post">
	                <input  type="text" class="form-control hidden" name="loginid" value="<?=$loginid?>" >
									<input  type="text" class="form-control hidden" name="table" value="<?=$table?>" >
	                <input  type="text" class="form-control hidden" name="email" value="<?=$email?>" >
	                <label>New Password</label>
	                <input type="password" class="form-control" name="newpassword" >
	                <br>
	                <label>Re enter new Password</label>
	                <input type="password" class="form-control" name="renewpassword" >
	                <br>
	                <button type="submit" class="btn btn-primary">Change Password</button>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	<?php }

		public function changeSToNewPasswordStudent($loginid,$table,$email,$mailverification) { ?>
		  <script type="text/javascript">
		  <?php
		    if($mailverification === 'not verified') {?>
		      $(document).ready(function(){
		            $('.changeNewPasswordStudent').modal({
		                backdrop: 'static',
		                keyboard: false
		            });
		              $('.changeNewPasswordStudent').modal('show');
		          });
		    <?php } ?>
		  </script>

		    <div class="modal fade changeNewPasswordStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		      <div class="modal-dialog" role="document">
		        <div class="modal-content">
		          <div class="modal-body">
		            <form action="../actions.php?action=firstPasswordChangestudent" method="post">
		                <input  type="text" class="form-control hidden" name="loginid" value="<?=$loginid?>" >
										<input  type="text" class="form-control hidden" name="table" value="<?=$table?>" >
		                <label>New Password</label>
		                <input type="password" class="form-control" name="newpassword" >
		                <br>
		                <label>Re enter new Password</label>
		                <input type="password" class="form-control" name="renewpassword" >
		                <br>
		                <button type="submit" class="btn btn-primary">Change Password</button>
		            </form>
		          </div>
		        </div>
		      </div>
		    </div>
		<?php }

public function getSemesterByAdmissionYear($year) {
	$presentyear = date("Y");
	$presentmonth = 7;//date("m");
	$completedyears = $presentyear - $year;
	if($presentmonth >= 6){
		$sem = $completedyears+1;
	}else{
		$sem = $completedyears+2;
	}
return $sem;
}

/*---------- Department -----------------*/
	public function addDepartment($department) {
		$query = "INSERT INTO departments SET name = '$department'";
		$output = $this->setData($query);
		return $output;
	}

	public function getDepartmentByName($name) {
		$query = "SELECT * FROM departments WHERE name='$name'";
		$output = $this->getData($query);
		return $output;
	}

	public function getAllDepartments($order='ASC') {
		$query = "SELECT * FROM departments ORDER BY id $order";
		$output = $this->getData($query);
		return $output;
	}

public function getDepartmentById($id) {
	$query = "SELECT * FROM departments WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}

	public function updateDepoName($id,$name) {
		$query  = "UPDATE departments SET name = '$name' WHERE id = '$id'" ;
		$output = $this->setData($query);
		return $output;
	}

/*---------- Courses -------------------*/
public function getCoursesByNameAndDepo($name,$depoid){
	$query = "SELECT * FROM courses WHERE course='$name' AND department='$depoid'";
	$output = $this->getData($query);
	return $output;
}

public function getCoursesByDepoId($depoid){
	$query = "SELECT * FROM courses WHERE department='$depoid'";
	$output = $this->getData($query);
	return $output;
}

public function addCourse($department,$coursename,$duration,$allotedseats) {
	$query = "INSERT INTO courses SET department='$department', course ='$coursename', course_duration = '$duration', allotedseats = '$allotedseats'";
	$output = $this->setData($query);
	return $output;
}

public function getAllCourses($order='ASC') {
	$query = "SELECT * FROM courses ORDER BY course $order";
	$output = $this->getData($query);
	return $output;
}

public function getCourseById($id) {
	$query = "SELECT * FROM courses WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}

public function getAllotedSeatsByCourseId($courseid) {
	$query = "SELECT * FROM courses WHERE id='$courseid' ";
	$output = $this->getData($query);
	return $output;
}


/*-------- Subjects -----------*/

public function checkForSubjectsByNameSubjectSem($course,$Semester,$subject) {
	$query = "SELECT * FROM subjects WHERE course='$course' AND semester='$Semester' AND subject='$subject'";
	$output = $this->getData($query);
	return $output;
}

public function addSubject($course,$Semester,$subject) {
	$query = "INSERT INTO subjects SET course='$course', semester ='$Semester', subject = '$subject'";
	$output = $this->setData($query);
	return $output;
}

public function getSubjectsBySemesterAndCourse($semester,$courseid) {
	$query = "SELECT * FROM subjects WHERE semester='$semester' AND course='$courseid'";
	$output = $this->getData($query);
	return $output;
}

public function getAllSubjects($order='ASC') {
	$query = "SELECT * FROM subjects ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}


public function getSubjectsByCourseId($courseid) {
	$query = "SELECT * FROM subjects WHERE course='$courseid'";
	$output = $this->getData($query);
	return $output;
}


public function getSubjectsById($id) {
	$query = "SELECT * FROM subjects WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}



public function getSubjectsByTeacherId($id) {
	$query = "SELECT * FROM subjects WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}


/*-------------  Teachers -----------------*/

public function getAllTeachers($order='ASC') {
	$query = "SELECT * FROM teachers ORDER BY name $order";
	$output = $this->getData($query);
	return $output;
}

public function getTeachersByEmail($mail) {
	$query = "SELECT * FROM teachers WHERE mail = '$mail'";
	$output = $this->getData($query);
	return $output;
}

public function getTeachersById($id) {
	$query = "SELECT * FROM teachers WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}

public function updateTeacher($id,$name,$phone) {
	$query  = "UPDATE teachers SET name = '$name', phone = '$phone' WHERE id = '$id'" ;
	$output = $this->setData($query);
	return $output;
}

public function addTeachers($name,$phone,$mail,$password,$imageupload,$mailverification){
	$query = "INSERT INTO teachers SET name='$name', phone ='$phone',mail = '$mail', password = '$password', image = '$imageupload', mailverification = '$mailverification'";
	$output = $this->setData($query);
	return $output;
}

/*-------- Assignings ----------*/
public function assignSubjects($techerid,$subjectid){
	$query = "INSERT INTO assignedsubjects SET teacherid='$techerid', subjects ='$subjectid'";
	$output = $this->setData($query);
	return $output;
}

public function setClassAssignData($teacherid,$depo,$course,$semeseter) {
	$query = "INSERT INTO assignedclasses SET teacher='$teacherid', courseid ='$course', semester ='$semeseter'";
	$output = $this->setData($query);
	return $output;
}

public function updateAssignSubjects($teacherid,$subjectid){
	$query  = "UPDATE assignedsubjects SET subjects = '$subjectid' WHERE teacherid = '$teacherid'" ;
	$output = $this->setData($query);
	return $output;
}

public function getTimeTableByDayPeriodSubjectId($days,$period,$subject){
	$query = "SELECT * FROM timetables WHERE day='$days' AND period='$period' AND subject='$subject'";
	$output = $this->getData($query);
	return $output;
}

public function getAllSubjectsAssignedByTeacherId($teacherid){
	$query = "SELECT * FROM assignedsubjects WHERE teacherid='$teacherid'";
	$output = $this->getData($query);
	return $output;
}


public function getAllAssignedSubjectsByTeacherId($teacherid) {
	$query = "SELECT * FROM assignedsubjects WHERE teacherid = '$teacherid'";
	$output = $this->getData($query);
	return $output;
}

public function getAssignedClassByTeacherId($teacherid){
	$query = "SELECT * FROM assignedclasses WHERE teacher = '$teacherid'";
	$output = $this->getData($query);
	return $output;
}

public function getAssignedTeacherByCourseAndSemester($courseid,$semester){
	$query = "SELECT * FROM assignedclasses WHERE courseid = '$courseid' AND semester = '$semester'";
	$output = $this->getData($query);
	return $output;
}

/*------- Hods --------*/
public function getHodByDepartmentId($depoid) {
	$query = "SELECT * FROM hods WHERE department = '$depoid'";
	$output = $this->getData($query);
	return $output;
}

public function setHodAssignData($depoid,$teacherid) {
	$query = "INSERT INTO hods SET department='$depoid', teacher ='$teacherid'";
	$output = $this->setData($query);
	return $output;
}

public function getHodByTeacherId($id) {
	$query = "SELECT * FROM hods WHERE teacher = '$id'";
	$output = $this->getData($query);
	return $output;
}


/*---------- Students --------------*/
public function addStudent($name,$admissionno,$admissionyear,$phone,$email,$coursename,$address,$imagefile,$password){
	$query = "Insert into students set name         		 = '$name',"
          . "                     	 admissionnumber   = '$admissionno',"
          . "                     	 admissionyear     = '$admissionyear',"
					. "                     	 address       		 = '$address',"
          . "                     	 phone     				 = '$phone',"
          . "                    	 	 email 						 = '$email',"
          . "                     	 course       		 = '$coursename',"
					. "                     	 password       	 = '$password',"
					. "                     	 profileimage      = '$imagefile',"
          . "                     	 mailverification  = 'not verified',"
          . "                     	 studentstatus  	 = 'studying'";
  $output = $this->setData($query);
  return $output;
}

public function getStudentDataByAdmissionNumber($admissionno) {
	$query = "SELECT * FROM students WHERE admissionnumber = '$admissionno'";
	$output = $this->getData($query);
	return $output;
}

public function getStudentDataByEmailId($email) {
	$query = "SELECT * FROM students WHERE email = '$email'";
	$output = $this->getData($query);
	return $output;
}

public function getStudentDataBYCourseId($courseid,$order='ASC') {
	$query = "SELECT * FROM students WHERE course = '$courseid' ORDER BY name $order";
	$output = $this->getData($query);
	return $output;
}

public function getStudentDataBYCourseIdOrderById($courseid,$order='ASC') {
	$query = "SELECT * FROM students WHERE course = '$courseid' ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}


public function getAllStudentsOrderById($order='ASC') {
	$query = "SELECT * FROM students ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}

public function getStudentsById($id) {
	$query = "SELECT * FROM students WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}



public function updateStudentData($id,$name,$adnum,$adyear,$address,$phone,$course,$imagepath) {
	$query  = "UPDATE students SET name = '$name', admissionnumber ='$adnum' ,admissionyear ='$adyear', address='$address', phone='$phone', course='$course', profileimage='$imagepath' WHERE id = '$id'" ;
	$output = $this->setData($query);
	return $output;
}

/*------------ parents -------------*/
public function getParentDetailsByStudentId($studentid) {
	$query = "SELECT * FROM parentsdetails WHERE studentid = '$studentid'";
	$output = $this->getData($query);
	return $output;
}
public function addParentDetails($studentid,$name,$relation,$job,$email,$password,$phone){
	$query = "Insert into parentsdetails set studentid 				= '$studentid',"
					. "                     				 guardianname     = '$name',"
					. "                     				 guardianrelation = '$relation',"
          . "                     	 			 guardianjob      = '$job',"
					. "                     	 			 mailid           = '$email',"
					. "                     	 			 phone            = '$password',"
          . "                     	 			 password         = '$phone',"
          . "                     	 			 mailverification = 'not verified'";
  $output = $this->setData($query);
  return $output;
}

/*------------ Time Tables -------------*/

public function addTimeTable($period,$day,$subject,$course,$semester){
	$query = "Insert into timetables set courseid = '$course',"
					. "                     	 semester = '$semester',"
          . "                     	 subject  = '$subject',"
          . "                     	 day      = '$day',"
          . "                     	 period  	= '$period'";
  $output = $this->setDataAndReturnLastInsertId($query);
  return $output;
}

public function getTimeTableById($id) {
	$query = "SELECT * FROM timetables WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}

public function getTimeTableByDayAndPeriod($day,$period) {
	$query = "SELECT * FROM timetables WHERE day = '$day' AND period = '$period'";
	$output = $this->getData($query);
	return $output;
}

public function getTimeTableByDayPeriodSemCourse($day,$period,$semester,$course) {
	$query = "SELECT * FROM timetables WHERE day = '$day' AND period = '$period' AND semester = '$semester' AND courseid = '$course'";
	$output = $this->getData($query);
	return $output;
}

public function getTimeTableByCourseId($courseid) {
	$query = "SELECT * FROM timetables WHERE courseid = '$courseid'";
	$output = $this->getData($query);
	return $output;
}

public function getAllTimetableData() {
	$query = "SELECT * FROM timetables";
	$output = $this->getData($query);
	return $output;
}

public function updateTimeTable($period,$day,$subject,$course,$semester,$id) {
	$query  = "UPDATE timetables SET courseid = '$course',semester='$semester',subject='$subject',day='$day',period='$period' WHERE id = '$id'" ;
	$output = $this->setData($query);
	return $output;
}

/*------------------- Attendence -----------------*/
public function getAttendenceDataByStudentIdSubjectIdDate($studid,$subject,$date,$period){
	$query = "SELECT * FROM attendence WHERE attendencedate = '$date' AND subjectid = '$subject' AND studentid = '$studid' AND period = '$period'";
	$output = $this->getData($query);
	return $output;
}

public function insertAttendence($attendencedata,$studid,$date,$teacher,$subject,$period){
	$query = "Insert into attendence set studentid = '$studid',"
					. "                     	 subjectid = '$subject',"
					. "                     	 period      = '$period',"
          . "                     	 attendence  = '$attendencedata',"
          . "                     	 teacher      = '$teacher',"
          . "                     	 attendencedate  	= '$date'";
	$output = $this->setData($query);
  return $output;
}

public function updateAttendenceById($attendencedata,$studid,$date,$teacher,$subject,$period,$insertedid){
	$query = "UPDATE attendence SET  studentid = '$studid',"
					. "                     	 subjectid = '$subject',"
					. "                     	 period      = '$period',"
					. "                     	 attendence  = '$attendencedata',"
          . "                     	 teacher      = '$teacher',"
          . "                     	 attendencedate  	= '$date' WHERE id = '$insertedid'";
	$output = $this->setData($query);
  return $output;
}

public function getAttendenceDataBYStudentId($studentid){
	$query = "SELECT * FROM attendence WHERE studentid = '$studentid'";
	$output = $this->getData($query);
	return $output;
}

public function getTotalClassByStudentIdAndSubjectId($studentid,$subjectid) {
	$query = "SELECT * FROM attendence WHERE studentid = '$studentid' AND subjectid = '$subjectid'";
	$output = $this->getData($query);
	return $output;
}


/*--------------- Internal Marks ----------------*/

public function getStudentInternalMarksByStudentId($id) {
	$query = "SELECT * FROM internalmarks WHERE studentid = '$id'";
	$output = $this->getData($query);
	return $output;
}

public function addInternalMarks($student,$marks,$subject,$semester){
	$query = "INSERT INTO internalmarks set studentid = '$student',"
					. "                     	 			subjectid = '$subject',"
					. "                     	 			semester  = '$semester',"
          . "                     	 			mark  		= '$marks' ";
	$output = $this->setData($query);
	return $output;
}

public function updateInternalMarks($student,$marks,$subject,$semester){
	$query = "UPDATE internalmarks set  subjectid = '$subject',"
					. "                     	  semester  = '$semester',"
          . "                     	  mark  		= '$marks' WHERE studentid = '$student'";
	$output = $this->setData($query);
  return $output;
}

/*--------------------------- Assignments -----------------------------*/
public function addAssignments($heading,$description,$lastdate,$subjectid,$course,$semester,$today,$teacher){
	$query = "INSERT INTO postedassignments set subjectid	  = '$subjectid',"
					. "                     	 					semester 	  = '$semester',"
					. "                     	 					course  	  = '$course',"
					. "                     	 					heading  	  = '$heading',"
					. "                     	 					description = '$description',"
					. "                     	 					posteddate  = '$today',"
					. "                     	 					teacherid  	= '$teacher',"
          . "                     	 					lastdate  	= '$lastdate' ";
	$output = $this->setData($query);
	return $output;
}

public function getAssignmentsBySubjectAndTeacherId($subject,$teacher){
	$query = "SELECT * FROM postedassignments WHERE subjectid = '$subject' AND teacherid = '$teacher'";
	$output = $this->getData($query);
	return $output;
}

public function getAssignmentsBySubjectIdAndSemester($subjectid,$semester){
	$query = "SELECT * FROM postedassignments WHERE subjectid = '$subjectid' AND semester = '$semester'";
	$output = $this->getData($query);
	return $output;
}


public function getAssignmentsById($id){
	$query = "SELECT * FROM postedassignments WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}

public function getSubmittedAssignmentByAssignmentId($id){
	$query = "SELECT * FROM assignmentssubmited WHERE assignmentid = '$id' ";
	$output = $this->getData($query);
	return $output;
}

public function getSubmittedAssignmentByStudentIdAndAssignmentId($id,$assignment){
	$query = "SELECT * FROM assignmentssubmited WHERE studentid = '$id' AND assignmentid = '$assignment'";
	$output = $this->getData($query);
	return $output;
}

public function deleteSubmittedAssignmentsBYassignmentId($assignmentid){
	$query = "DELETE FROM assignmentssubmited WHERE assignmentid=$assignmentid";
	$output = $this->setData($query);
	return $output;
}

} ?>
