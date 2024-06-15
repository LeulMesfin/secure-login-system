<?php
    session_start(); // start session
    session_unset(); // unset session variables
    session_destroy(); // destory session
    header("Location: login.php");
    exit;
?>