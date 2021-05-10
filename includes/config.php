<?php
/**
 * File: Database Configuration
 *
 * 
 */

$dbServer 	= 'localhost';
$dbUser 	= 'root';
$dbPassword = 'root';
$dbDatabase = 'stafflog';

$mysqli = new mysqli($dbServer, $dbUser, $dbPassword, $dbDatabase);

if($mysqli->connect_error) {
	exit('Error connecting to database'); 
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");




?>