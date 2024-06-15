<?php
    $token = $_GET['token'];
    $token_hash = hash("sha256", $token);

    $mysqli = require __DIR__ . "/database.php";

    echo "$token";
    echo "$token_hash";
    
    // Prepared statement: stage 1: prepare
    $stmt = $mysqli->prepare("select * from user where activation_token_hash = ?");
    
    // Prepared statement: stage 2: bind & execute
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();

    // gets result set from a prepared statement
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // returns an array, next row in returned sql table

    if ($user === null) {
        die("ERROR: Token NOT FOUND");
    }

    // now, we have a valid user record corresponding to activation token sent in email
    // update the activation_token_hash column to null
    // Prepared statement: stage 1: prepare
    $stmt = $mysqli->prepare("update user set activation_token_hash = null where email = ?");
    
    // Prepared statement: stage 2: bind & execute
    $stmt->bind_param("s", $user['email']);
    $stmt->execute();

    // redirect to account activation page
    header('Location: account-active.html');
?>