<?php

require './libs/Functions.php';
require './libs/Mails.php';
$functions = new Functions();
$mails = new Mails();
$common = new Common();

if (!empty($_REQUEST)) {
  $action = $_REQUEST['action'];

/*------------------------ Login ----------------------*/
if($action === 'userlogin') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $functions->logincheck($username,$password);
  if($result){
    $loginid = $result[0];
    $logintype = $result[1];
    session_start();
    $_SESSION['logintype'] = $logintype;
    $_SESSION['loginid'] = $loginid;
    echo '<script type="text/javascript">';
    echo 'alert("welcome");';
    echo 'window.location="./'.$logintype.'/index.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Username and password are not matching");';
    echo 'window.location="./index.php";';
    echo '</script>';
  }
}

if($action === 'logout') {
  session_start();
  $page = $_SESSION['logintype'];
  $_SESSION = array(); // Unset all of the session variables.
  if(empty($_SESSION)){
    session_destroy();
    echo '<script type="text/javascript">';
    echo 'alert("See you again");';
    echo 'window.location="./index.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Error");';
    echo 'window.location="./'.$page.'/index.php";';
    echo '</script>';
  }
}

/*-------------------- Passwords ------------------------*/
if($action === 'firstPasswordChange'){
    $loginid = $_POST['loginid'];
    $table = $_POST['table'];
    $newpass = $_POST['newpassword'];
    $repassword = $_POST['renewpassword'];
    if($newpass == $repassword) {
      $result = $functions->passwordChange($table,$newpass,$loginid);
      if($result){
          $functions->changeMailVerificationStatus($table,$loginid);
          $teacherdatas = $functions->getTeachersById($loginid);
          $name = $teacherdatas[0]['name'];
          $email = $teacherdatas[0]['mail'];
          $mails->notificationmail('Password Changed',$name,'Password changed',$newpass,$email);
          echo '<script type="text/javascript">';
          echo 'alert("password changed");';
          echo 'window.location="index.php"' ;
          echo '</script>';
        }
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("passwords not matching");';
        echo 'window.location="index.php"' ;
        echo '</script>';
  }
}

if($action === 'firstPasswordChangestudent'){
    $loginid = $_POST['loginid'];
    $table = $_POST['table'];
    $newpass = $_POST['newpassword'];
    $repassword = $_POST['renewpassword'];
    if($newpass === $repassword) {
      $result = $functions->passwordChange($table,$newpass,$loginid);
      if($result){
          $functions->changeMailVerificationStatus($table,$loginid);
          $teacherdatas = $functions->getStudentsById($loginid);
          $name = $teacherdatas[0]['name'];
          $email = $teacherdatas[0]['email'];
          $mails->notificationmail('Password Changed',$name,'Password changed',$newpass,$email);
          echo '<script type="text/javascript">';
          echo 'alert("password changed");';
          echo 'window.location="index.php"' ;
          echo '</script>';
        }
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("passwords not matching");';
        echo 'window.location="index.php"' ;
        echo '</script>';
  }
}



if($action === 'changepassword') {
  $userid = $_POST['userid'];
  $table = $_POST['table'];
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];
  $repass = $_POST['reenterpass'];
  $oldpasscheck = $functions->oldpasscheck($table,$userid,$oldpass);
  if($oldpasscheck){
    if($newpass === $repass){
      $result = $functions->passwordChange($table,$newpass,$userid);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Password changed");';
        echo 'window.location="index.php"' ;
        echo '</script>';
      }else {
        echo '<script type="text/javascript">';
        echo 'alert("error");';
        echo 'window.location="index.php"' ;
        echo '</script>';
      }
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("entered passwords not matching");';
      echo 'window.location="index.php"' ;
      echo '</script>';    }
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("old password not matching");';
    echo 'window.location="index.php"' ;
    echo '</script>';
  }
}

/*----------------------- DEPARTMENTS ------------------------*/
	if($action === 'addDepartments') {
		$department = $_POST['departmentname'];
		$checking = $functions->getDepartmentByName($department);
		if($checking){
			echo '<script type="text/javascript">';
			echo 'alert("Department Already added");';
			echo 'window.location="./admin/adddepartments.php";';
			echo '</script>';
		}else {
			$result = $functions->addDepartment($department);
			if($result) {
				echo '<script type="text/javascript">';
				echo 'alert("Department Added");';
				echo 'window.location="./admin/adddepartments.php";';
				echo '</script>';
			}else{
				echo '<script type="text/javascript">';
				echo 'alert("Department Error");';
				echo 'window.location="./admin/adddepartments.php";';
				echo '</script>';
			}
		}
	}

	if($action === 'deletedepo') {
		$id = $_POST['depoid'];
		$table = 'departments';
		$result = $functions->delete($table,$id);
		if($result) {
			echo '<script type="text/javascript">';
			echo 'alert("Department Deleted");';
			echo 'window.location="./admin/adddepartments.php";';
			echo '</script>';
		}else{
			echo '<script type="text/javascript">';
			echo 'alert("Delete Error");';
			echo 'window.location="./admin/adddepartments.php";';
			echo '</script>';
		}
	}

	if($action === 'editDepo') {
		$id = $_POST['depoid'];
		$name = $_POST['deponame'];
		$result = $functions->updateDepoName($id,$name);
		if($result) {
			echo '<script type="text/javascript">';
			echo 'alert("Department Updated");';
			echo 'window.location="./admin/adddepartments.php";';
			echo '</script>';
		}else{
			echo '<script type="text/javascript">';
			echo 'alert("Delete Error");';
			echo 'window.location="./admin/adddepartments.php";';
			echo '</script>';
		}
	}


/*------------------------- Courses ---------------------------------------*/

if($action === 'addCourse') {
  $department = $_POST['department'];
  $coursename = $_POST['coursename'];
  $duration = $_POST['duration'];
  $allotedseats = $_POST['allotedseats'];
  $checking = $functions->getCoursesByNameAndDepo($department,$coursename);
  if($checking) {
    echo '<script type="text/javascript">';
    echo 'alert("Course Already added");';
    echo 'window.location="./admin/addcourses.php";';
    echo '</script>';
  }
else{
    $result = $functions->addCourse($department,$coursename,$duration,$allotedseats);
    if($result) {
      echo '<script type="text/javascript">';
      echo 'alert("Course added");';
      echo 'window.location="./admin/addcourses.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Course adding error");';
      echo 'window.location="./admin/addcourses.php";';
      echo '</script>';
    }
  }
}

if($action === 'deletecourse') {
  $id = $_POST['courseid'];
  $table = 'courses';
  $result = $functions->delete($table,$id);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Course Deleted");';
    echo 'window.location="./admin/addcourses.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Delete Error");';
    echo 'window.location="./admin/addcourses.php";';
    echo '</script>';
  }
}


/*-------------------------- Subjects ---------------------*/

if($action === 'addsubject') {
  $course = $_POST['course'];
  $Semester = $_POST['Semester'];
  $subject = $_POST['subjectname'];
  $checking = $functions->checkForSubjectsByNameSubjectSem($course,$Semester,$subject);
  if($checking){
    echo '<script type="text/javascript">';
    echo 'alert("Subject already added");';
    echo 'window.location="./admin/addsubjects.php";';
    echo '</script>';
  }else{
    $result = $functions->addSubject($course,$Semester,$subject);
    if($result){
      echo '<script type="text/javascript">';
      echo 'alert("Subject Added");';
      echo 'window.location="./admin/addsubjects.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Error");';
      echo 'window.location="./admin/addsubjects.php";';
      echo '</script>';
    }
  }
}

if($action === 'deletesubject') {
  $id = $_POST['subid'];
  $table = 'subjects';
  $result = $functions->delete($table,$id);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Subject Deleted");';
    echo 'window.location="./admin/addsubjects.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Delete Error");';
    echo 'window.location="./admin/addsubjects.php";';
    echo '</script>';
  }
}

/*--------------------------- Teachers -----------------------------*/

if($action === 'addTeachers') {
$name = $_POST['teachername'];
$phone = $_POST['teacherphone'];
$mail = $_POST['teacheremail'];
$mailverification = 'not verified';
$imagefile = 'teacherimage' ;
$dest = './assets/img/teachers/profile/';
$checking = $functions->getTeachersByEmail($mail);
  if($checking){
    echo '<script type="text/javascript">';
    echo 'alert("Teacher already added");';
    echo 'window.location="./admin/addteachers.php";';
    echo '</script>';
  }else{
        $imageupload = $common->uploads($imagefile,$dest);
        if($imageupload){
          $password = $mails->SendPasswordByMail($name,$mail);
          if($password){
            $result = $functions->addTeachers($name,$phone,$mail,$password,$imageupload,$mailverification);
            if($result) {
              echo '<script type="text/javascript">';
              echo 'alert("Teacher added");';
              echo 'window.location="./admin/addteachers.php";';
              echo '</script>';
            }else{
              echo '<script type="text/javascript">';
              echo 'alert("Teacher adding error");';
              echo 'window.location="./admin/addteachers.php";';
              echo '</script>';
          }
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Password sending failed");';
        echo 'window.location="./admin/addteachers.php";';
        echo '</script>';
      }
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Image upload error");';
      echo 'window.location="./admin/addteachers.php";';
      echo '</script>';
    }

  }

}

if($action === 'deleteTeacher') {
      $id = $_POST['teacherid'];
      $table = 'teachers';
      $teacherdata = $functions->getTeachersById($id);
      $teacherimage = $teacherdata[0]['image'];
      unlink($teacherimage);
      $result = $functions->delete($table,$id);
      if($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Teacher Deleted");';
        echo 'window.location="./admin/addteachers.php";';
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Delete Error");';
        echo 'window.location="./admin/addteachers.php";';
        echo '</script>';
      }
}

if($action === 'updateTeacher') {
  $id = $_POST['teacherid'];
  $name = $_POST['teachername'];
  $phone = $_POST['teacherphone'];
  $result = $functions->updateTeacher($id,$name,$phone);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Teacher updated");';
    echo 'window.location="./admin/addteachers.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Delete Error");';
    echo 'window.location="./admin/addteachers.php";';
    echo '</script>';
  }
}


/*---------------------------  Subject Assigning ----------------------*/

if($action === 'assignSubjects') {
    $teacherid = $_POST['teacherid'];
    $subjectid = $_POST['subjectid'];
    $subjectid = implode(',', $subjectid);
    $result = $functions->assignSubjects($teacherid,$subjectid);
    if($result) {
      echo '<script type="text/javascript">';
      echo 'alert("Assigned");';
      echo 'window.location="./admin/assignsubjecttoteacher.php?id='.$teacherid.'";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("failed");';
      echo 'window.location="./admin/assignsubjecttoteacher.php?id='.$teacherid.'";';
      echo '</script>';
    }
}

if($action === 'updateAssignSubjects') {
  $teacherid = $_POST['teacherid'];
  $subjectid = $_POST['subjectid'];
  $subjectid = implode(',', $subjectid);
  $result = $functions->updateAssignSubjects($teacherid,$subjectid);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Assigned");';
    echo 'window.location="./admin/assignsubjecttoteacher.php?id='.$teacherid.'";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("failed");';
    echo 'window.location="./admin/assignsubjecttoteacher.php?id='.$teacherid.'";';
    echo '</script>';
  }
}

/*--------------------------------- Class Teacher Assigning ------------------*/

if($action === 'assignClassTeacher') {
  $teacherid = $_POST['teacherid'];
  $depo = $_POST['departmentname'];
  $course = $_POST['coursename'];
  $semester = $_POST['semester'];
  $checking = $functions->getAssignedTeacherByCourseAndSemester($course,$semester);
  if($checking){
    echo '<script type="text/javascript">';
    echo 'alert("Another teacher has already assigned for this class");';
    echo 'window.location="./admin/classassign.php";';
    echo '</script>';
  }else{
    $result = $functions->setClassAssignData($teacherid,$depo,$course,$semester);
    if($result) {
      echo '<script type="text/javascript">';
      echo 'alert("Teacher Assigned");';
      echo 'window.location="./admin/classassign.php";';
      echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/classassign.php";';
        echo '</script>';
    }
  }
}

if($action === 'removeassignedteacher') {
  $assignid = $_POST['assignid'];
  $table = "assignedclasses";
  $result = $functions->delete($table,$assignid);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Removed Assigned Teacher");';
    echo 'window.location="./admin/classassign.php";';
    echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Failed");';
      echo 'window.location="./admin/classassign.php";';
      echo '</script>';
  }
}

/*-------------------------------- Assign HOD --------------------------*/

  if($action === 'assignHod') {
      $depoid = $_POST['depoid'];
      $teacherid = $_POST['assignHodid'];
      $result = $functions->setHodAssignData($depoid,$teacherid);
      if($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Hod Assigned");';
        echo 'window.location="./admin/adddepartments.php";';
        echo '</script>';
        }else{
          echo '<script type="text/javascript">';
          echo 'alert("Failed");';
          echo 'window.location="./admin/adddepartments.php";';
          echo '</script>';
      }
  }
if($action === 'removeHod') {
  $hodassignid = $_POST['hodassignidField'];
  $table = "hods";
  $result = $functions->delete($table,$hodassignid);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Removed Assigned Teacher");';
    echo 'window.location="./admin/adddepartments.php";';
    echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Failed");';
      echo 'window.location="./admin/adddepartments.php";';
      echo '</script>';
  }
}

/*------------------------------------ Students ----------------------------*/

if($action === 'addstudent') {
    $name = $_POST['studentname'];
    $admissionno = $_POST['admissionnumber'];
    $admissionyear = $_POST['admissionyear'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['emailid'];
    $courseid = $_POST['coursename'];
    $address = $_POST['studentfulladdress'];
    $imagefile = 'studentimage' ;
    $dest = './assets/img/students/profilepic/';
    $seatavailablitychecking = $functions->getAllotedSeatsByCourseId($courseid);
    $allotedseats = $seatavailablitychecking[0]['allotedseats'];
    $totalstudents = $functions->getStudentDataBYCourseId($courseid);
    $totalstudents = sizeof($totalstudents);
    $balanceseats = $allotedseats - $totalstudents;
    if($balanceseats !== 0){
      $admissionnochecking = $functions->getStudentDataByAdmissionNumber($admissionno);
      if($admissionnochecking){
        echo '<script type="text/javascript">';
        echo 'alert("Student already added");';
        echo 'window.location="./admin/addstudents.php";';
        echo '</script>';
      }else{
        $emailidcheck = $functions->getStudentDataByEmailId($email);
        if($emailidcheck){
          echo '<script type="text/javascript">';
          echo 'alert("Student already registered with this mail id");';
          echo 'window.location="./admin/addstudents.php";';
          echo '</script>';
          }
        else{
          $imageupload = $common->uploads($imagefile,$dest);
          if($imageupload){
            $password = $mails->SendPasswordByMail($name,$email);
            if($password){
              $result = $functions->addStudent($name,$admissionno,$admissionyear,$phone,$email,$courseid,$address,$imageupload,$password);
              if($result){
                echo '<script type="text/javascript">';
                echo 'alert("Student Added");';
                echo 'window.location="./admin/addstudents.php";';
                echo '</script>';
              }else{
                echo '<script type="text/javascript">';
                echo 'alert("Student adding error");';
                echo 'window.location="./admin/addstudents.php";';
                echo '</script>';
              }
            }else{
              echo '<script type="text/javascript">';
              echo 'alert("Password sending error");';
              echo 'window.location="./admin/addstudents.php";';
              echo '</script>';
            }
          }else{
            echo '<script type="text/javascript">';
            echo 'alert("File upload error");';
            echo 'window.location="./admin/addstudents.php";';
            echo '</script>';
          }
        }
      }
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("All seats for this course are full");';
    echo 'window.location="./admin/addstudents.php";';
    echo '</script>';
  }
}

if($action === 'deleteStudent') {
  $id = $_POST['studentid'];
  $table = "students";
  $result = $functions->delete($table,$id);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Student deleted");';
    echo 'window.location="./admin/addstudents.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("error");';
    echo 'window.location="./admin/addstudents.php";';
    echo '</script>';
  }

}

if($action === 'updatestudentdata') {
$id = $_POST['id'];
$name = $_POST['studentname'];
$adnum = $_POST['admissionnumber'];
$adyear = $_POST['admissionyear'];
$address = $_POST['address'];
$phone = $_POST['phonenumber'];
$course = $_POST['course'];

  if($_FILES['profileimagenew']['size'] !== 0) {
      $image = 'profileimagenew';
      $dest = './assets/img/students/profilepic/';
      $imagepath = $common->uploads($image,$dest);
  }else{
    $imagepath = $_POST['profileimageold'];
  }
  $result = $functions->updateStudentData($id,$name,$adnum,$adyear,$address,$phone,$course,$imagepath);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Student deleted");';
    echo 'window.location="./admin/addstudents.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("error");';
    echo 'window.location="./admin/addstudents.php";';
    echo '</script>';
  }
}


/*----------------- Internal Marks -----------------------*/

if($action === 'addinternals') {
  $semester = $_POST['semester'];
  $course = $_POST['course'];
  $subject = $_POST['subjectid'];
  $studentid = $_POST['studentid'];
  $internalmarks = $_POST['studentinternal'];
  $studentidsize = sizeof($studentid);
  for($i=0;$i<$studentidsize;$i++){
    $student = $studentid[$i];
    $marks = $internalmarks[$i];
    $checking = $functions->getStudentInternalMarksByStudentId($student);
    if($checking){ $result = $functions->updateInternalMarks($student,$marks,$subject,$semester); }
    else { $result = $functions->addInternalMarks($student,$marks,$subject,$semester); }
  }
  if($result){
    echo '<script type="text/javascript">';
    echo 'alert("Marks added");';
    echo 'window.location="teachers/addinternalmarks.php?subjectid='.$subject.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("error");';
    echo 'window.location="teachers/addinternalmarks.php?subjectid='.$subject.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }

}

if($action === 'addAssignment') {
  $heading = $_POST['heading'];
  $teacher = $_POST['teacher'];
  $description = $_POST['description'];
  $lastdate = $_POST['assignmentlastdate'];
  $subjectid = $_POST['subjectid'];
  $course = $_POST['courseid'];
  $semester = $_POST['semester'];
  $today = date("Y-m-d");
  $result = $functions->addAssignments($heading,$description,$lastdate,$subjectid,$course,$semester,$today,$teacher);
  if($result){
    echo '<script type="text/javascript">';
    echo 'alert("Assignment Added");';
    echo 'window.location="teachers/viewassignments.php?subjectid='.$subjectid.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("error");';
    echo 'window.location="teachers/viewassignments.php?subjectid='.$subjectid.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }
}

if($action === 'deleteAssignment') {
  $assignment = $_POST['assignmentid'];
  $table = 'postedassignments';
  $subject = $_POST['subjectid'];
  $course = $_POST['course'];
  $semester = $_POST['semester'];
  $submitedassignments = $functions->getSubmittedAssignmentByAssignmentId($assignment);
  if($submitedassignments){
      $delteassignments = $functions->deleteSubmittedAssignmentsBYassignmentId($assignment);
  }
  $result = $functions->delete($table,$assignment);
  if($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Assignment Deleted");';
    echo 'window.location="teachers/viewassignments.php?subjectid='.$subject.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Delete Error");';
    echo 'window.location="teachers/viewassignments.php?subjectid='.$subject.'&course='.$course.'&semester='.$semester.'";';
    echo '</script>';
  }
}

/*--------------------------- Parent Details ------------*/
if($action === 'addParentsDetails') {
  $studentid = $_POST['studentid'];
  $name = $_POST['guardianname'];
  $relation = $_POST['guardianrelation'];
  $job = $_POST['guardianjob'];
  $email = $_POST['mailid'];
  $phone = $_POST['phone'];
  $emailidcheck = $functions->checkForRegisteredEmails($email);
  if($emailidcheck){
    echo '<script type="text/javascript">';
    echo 'alert("Email Already Used");';
    echo 'window.location="index.php";';
    echo '</script>';
  }else{
    $password = $mails->SendPasswordByMail($name,$email);
    if($password){
    $result = $functions->addParentDetails($studentid,$name,$relation,$job,$email,$password,$phone);
    if($result){
      echo '<script type="text/javascript">';
      echo 'alert("Parent details added");';
      echo 'window.location="index.php";';
      echo '</script>';
    }else{
      echo '<script type="text/javascript">';
      echo 'alert("Error");';
      echo 'window.location="index.php";';
      echo '</script>';
      }
    }
    else{
      echo '<script type="text/javascript">';
      echo 'alert("Password sending failed");';
      echo 'window.location="index.php";';
      echo '</script>';
    }
  }
}


}
