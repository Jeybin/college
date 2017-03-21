<?php
require '../libs/Functions.php';
$functions = new Functions();
$url = $_SERVER['REQUEST_URI'];
$spliturl = explode('/', $url);
$page = strtolower(end($spliturl));

session_start();
$logintype = $_SESSION['logintype'];
$loginid = $_SESSION['loginid'];
if($logintype !== 'students') {
  header('Location: ../index.php');
}

  $studentdatas = $functions->getStudentsById($loginid);
  $studentdatas = $studentdatas[0];
  $studentadmissionno = $studentdatas['admissionnumber'];
  $studentadmissionyear = $studentdatas['admissionyear'];
  $presentsem = $functions->getSemesterByAdmissionYear($studentadmissionyear);
  $studentname = $studentdatas['name'];
  $studentaddress = $studentdatas['address'];
  $studentphone = $studentdatas['phone'];
  $studentemail = $studentdatas['email'];
  $studentcourse = $studentdatas['course'];
  $studentprofileimage = $studentdatas['profileimage'];
  $studentmailverification = $studentdatas['mailverification'];
  $table = 'students';
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">

		<script src="../assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../assets/js/bootstrap-checkbox-radio.js"></script>
		<script src="../assets/js/chartist.min.js"></script>
		<script src="../assets/js/bootstrap-notify.js"></script>
		<script src="../assets/js/paper-dashboard.js"></script>
    <script src="../assets/js/demo.js"></script>
		<script src="../assets/js/custom.js"></script>
    <?php
        $functions->changeSToNewPasswordStudent($loginid,$table,$studentemail,$studentmailverification);
        $parentdetailschecking = $functions->getParentDetailsByStudentId($loginid);
    ?>
    <script type="text/javascript">
    <?php if(empty($parentdetailschecking)) {?>
        $(document).ready(function(){
              $('.addParentdetailsModal').modal({
                  backdrop: 'static',
                  keyboard: false
              });
                $('.addParentdetailsModal').modal('show');
            });
      <?php } ?>
    </script>
    <div class="modal fade addParentdetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form class="" action="../actions.php?action=addParentsDetails" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Fill out guardian's datas</h4>
            </div>
            <div class="modal-body">

              <div class="form-group hidden">
                <label>Studentid</label>
                  <input type="text" name="studentid" class="form-control" value="<?=$loginid?>">
              </div>

              <div class="form-group">
                <label>Guardian Name</label>
                  <input type="text" name="guardianname" required class="form-control" >
              </div>

              <div class="form-group">
                <label>Guardian Relation</label>
                  <input type="text" name="guardianrelation" required  class="form-control" >
              </div>

              <div class="form-group">
                <label>Guardian's Job</label>
                  <input type="text" name="guardianjob" required  class="form-control" >
              </div>

              <div class="form-group">
                  <label>Guardian's Email</label>
                  <input type="email" name="mailid" required  class="form-control" >
              </div>

              <div class="form-group">
                <label>Guaridan's Phone</label>
                  <input type="text" name="phone" required  class="form-control" >
              </div>


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-fill">Add Datas</button>
            </div>
          </div>
        </form>
      </div>
    </div>


</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
		<?php include './includes/navbar.php'; ?>
	</div>

    <div class="main-panel">
<?php include './includes/topbar.php'; ?>

        <div class="content">
            <div class="container-fluid">
