<?php
/**
 * Page : Logout
 */

// start session
session_start();

// Destroy user session
unset($_SESSION['superid']);

// Redirect to index.php page
header("Location: ../index.php");
//header('Location: ' . $_SERVER['HTTP_REFERER']);

?>



<?php /*
session_start(); 
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['alogin']);
session_destroy(); // destroy session
header("location:../index.php"); */
?>
