<?php
session_start();
// Destroy session data
session_destroy();
// Redirect to index page
header("Location: index.php");
exit;
?>