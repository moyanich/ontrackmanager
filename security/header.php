<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  $currDir = dirname(__FILE__);

  include("session.php");

  if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); 
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
	<meta name="author" content="Amoy Nicholson">
	<title>OnTrackManager - JBDC Employee Log Dashboard</title>
	<!-- Favicon -->
	<link href="<?php echo PREPEND_PATH; ?>images/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- Icons -->
	<link href="<?php echo PREPEND_PATH; ?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
	<link href="<?php echo PREPEND_PATH; ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<!-- Argon CSS -->
	<link type="text/css" href="<?php echo PREPEND_PATH; ?>assets/css/argon.css?v=1.0.0" rel="stylesheet">

	<link href="<?php echo PREPEND_PATH; ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<link href="<?php echo PREPEND_PATH; ?>vendor/dataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	
	<!--<link href="<?php echo PREPEND_PATH; ?>vendor/flexdata/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">-->

	<link href="<?php echo PREPEND_PATH; ?>style.css" rel="stylesheet">  

	<script src="<?php echo PREPEND_PATH; ?>assets/vendor/jquery/dist/jquery.min.js"></script>

	<!-- TimePicker-->

	<!--<link rel="stylesheet" type="text/css" href="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/lib/bootstrap-datepicker.css" />-->

	<link rel="stylesheet" type="text/css" href="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/jquery.timepicker.css" />

	<script type="text/javascript" src="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/jquery.timepicker.js"></script>
		
	<!--<script type="text/javascript" src="<?php echo PREPEND_PATH; ?>vendor/jonthornton-jquery-timepicker/lib/bootstrap-datepicker.js"></script>-->

	<!-- DatePicker-->
	<link href="<?php echo PREPEND_PATH; ?>vendor/datepicker/datepicker.min.css" rel="stylesheet">
	<script src="<?php echo PREPEND_PATH; ?>vendor/datepicker/datepicker.min.js"></script>
</head>





	

<body>
