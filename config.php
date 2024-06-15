<?php
    // The code in this file was implemented with the help of Youtuber: Digital Fox
    // Video link: https://www.youtube.com/watch?v=fSfNTACbplA
    
    require "vendor/autoload.php"; // allows script to find and load the dotenv class
    // these 3 lines allow me to store fields in .env file
    use Dotenv\Dotenv as Dotenv; # alias
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // define the gmail's smtp mail server
    define('MAILHOST', "smtp.gmail.com");

    // define as a username the email associated with ur gmail acc
    define('USERNAME', $_ENV['EMAIL']); // will change to email assoc w/ user later

    // define ur 16 digit gmail app passcode
    define('PASSWORD', $_ENV['GOOGLE_APP_PASS']);

    // define the email address from which the email is sent
    define('SEND_FROM', $_ENV['EMAIL']);

    // define the name of website from which email is sent
    define('SEND_FROM_NAME', "account-verification-team");

    // define reply-to address
    define('REPLY_TO', 'noreply@test.com');

    // define the reply-to name
    define('REPLY_TO_NAME', "Leul");




