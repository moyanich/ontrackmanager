<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
  $currDir = dirname(__FILE__);

  include("{$currDir}/session.php");

  if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); 
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
	<meta name="author" content="Amoy Nicholson">
	<title>OnTrackManager - JBDC Employee Log Admin Dashboard</title>
	<!-- Favicon -->
	<link href="<?php echo PREPEND_PATH; ?>images/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<?php /*
	<!-- Icons -->
	<link href="<?php echo PREPEND_PATH; ?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
	> */?>

	<link href="<?php echo PREPEND_PATH; ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

	<!-- Argon CSS -->
	<link type="text/css" href="<?php echo PREPEND_PATH; ?>assets/css/argon.css?v=1.0.0" rel="stylesheet">

	<!-- Custom fonts for this template-->
	<link href="<?php echo PREPEND_PATH; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo PREPEND_PATH; ?>css/sb-admin-2.min.css" rel="stylesheet">

	<link href="<?php echo PREPEND_PATH; ?>vendor/dataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<!-- Core plugin JavaScript-->
	<script src="<?php echo PREPEND_PATH; ?>vendor/jquery/jquery.min.js"></script>
	
	<script src="<?php echo PREPEND_PATH; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/jquery.timepicker.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/lib/bootstrap-datepicker.css" />

	<script type="text/javascript" src="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/jquery.timepicker.js"></script>
		
	<script type="text/javascript" src="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/lib/bootstrap-datepicker.js"></script>

	<link href="<?php echo PREPEND_PATH; ?>style.css" rel="stylesheet">  

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">
		
		<?php include("{$currDir}/sidebar.php"); ?>
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<?php include("{$currDir}/topNavbar.php"); ?><!-- End of Topbar -->





