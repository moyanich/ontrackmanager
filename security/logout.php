<?php
/**
 * Page : Logout
 */

// start session
session_start();

// Destroy user session
unset($_SESSION['userid']);

// Redirect to index.php page
header("Location: ../index.php");


?>

