<?php
    // This file will create a connection to the db and return this connection
    // multiple files will use this database connection file

    require "vendor/autoload.php"; // allows script to find and load the dotenv class
    // these 3 lines allow me to store fields in .env file
    use Dotenv\Dotenv as Dotenv; # alias
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    # db credentials stored in .env file
    $server = $_ENV['HOSTNAME'];
    $password = $_ENV['DB_PASS'];
    $user = $_ENV['DB_USER'];
    $db = $_ENV['DB_NAME'];

    $mysqli = new mysqli($server, $user, $password, $db);

    // check db connection
    if ($mysqli->connect_errno) {
        /* Use your preferred error logging method here */
        error_log('Connection error: ' . $mysqli->connect_errno);
    }

    return $mysqli; // returning db connection
?>