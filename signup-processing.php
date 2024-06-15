<?php
    require "sendMail.php";
    $mysqli = require __DIR__ . "/database.php";

    // no sanitizing need bc of prepared statements below
    $userName = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // hashing the password using the bcrypt algorithm (default as of PHP 5.5.0)
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    // activation token and it's hash: useful for email verification
    $activationToken = bin2hex(random_bytes(16));
    $activeTokenHash = hash("sha256", $activationToken);

    // Prepared statement: stage 1: prepare
    $stmt = $mysqli->prepare("insert into user values(?, ?, ?, ?)");
    
    // Prepared statement: stage 2: bind & execute
    $stmt->bind_param("ssss", $userName, $email, $hashedPass, $activeTokenHash);
    $stmt->execute();
  
    // send email
    if (isset($_POST['submit'])) {
        // form has been submitted
        // will replace email field with $email once testing is finished...
        // echo "$activeTokenHash";
        $message = "Click <a href=\"http://localhost/account-activation.php?token=$activationToken\">here</a> to activate your account.";
        $response = sendMail($_ENV['EMAIL'], "Verify your account", $message);
    }

    /* redirect to signup verify page */
    header("Location: http://localhost/signup-verify.html");
    # Closing connection when finished
    $mysqli->close();
?>