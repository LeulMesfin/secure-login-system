<?php
    $mysqli = require __DIR__ . "/database.php";

    // no sanitizing need bc of prepared statements below
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // hashing the password using the bcrypt algorithm (default as of PHP 5.5.0)
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    
    /* if the hashedPass === the hashed pass stored in the db && the activation_token_hash === null
     * the user can log in
     * */
    // Prepared statement: stage 1: prepare
    $stmt = $mysqli->prepare("select * from user where password = ? and activation_token_hash = null");
    

    

    /* redirect to signup verify page */
    header("Location: http://localhost/signup-verify.html");
    # Closing connection when finished
    $mysqli->close();
?>