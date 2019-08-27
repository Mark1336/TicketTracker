<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php");
exit;
?>
