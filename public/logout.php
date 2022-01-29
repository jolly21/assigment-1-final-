<?php
session_start();
session_unset();
session_destroy();
 // Redirect user
    header("Location: index.php");
    die();
?>