<?php

session_start();


// Remove all admin session data

unset($_SESSION["admin_id"]);
unset($_SESSION["admin_name"]);


// Destroy the session

session_destroy();


// Send back to login page

header("Location: login.php");

exit();

?>