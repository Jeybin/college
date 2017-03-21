<?php
require '../libs/Functions.php';
$functions = new Functions();
$url = $_SERVER['REQUEST_URI'];
$spliturl = explode('/', $url);
$page = strtolower(end($spliturl));

session_start();
$logintype = $_SESSION['logintype'];
$loginid = $_SESSION['loginid'];
if($logintype !== 'teachers') {
  header('Location: ../index.php');
}

$hodcheck = $functions->getHodByTeacherId($loginid);
if($hodcheck) {
  header('Location: ../hod/index.php');
}

$teacherdatas = $functions->getTeachersById($loginid);
$teacherdatas = $teacherdatas[0];
$techername = $teacherdatas['name'];
$teacherphone = $teacherdatas['phone'];
$teachermail = $teacherdatas['mail'];
$teacherpassword = $teacherdatas['password'];
$teacherimage = $teacherdatas['image'];
$teachermailverification = $teacherdatas['mailverification'];
$table = 'teachers';
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
        $functions->changeToNewPassword($loginid,$table,$teachermail,$teachermailverification);
    ?>

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
