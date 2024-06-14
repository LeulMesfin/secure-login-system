<?php
    // The code in this file was implemented with the help of Youtuber: Digital Fox
    // Video link: https://www.youtube.com/watch?v=fSfNTACbplA

    /* adding PHPMailer namespaces @ top of the page */
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    /* require the path to the PHPMailer classes */
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';

    // require the config.php file to use my gmail acc details
    require 'config.php';


    /* This function utilizes the PHPMailer obj to send
     * an email to the address specified.
     * $email: Where our email goes. (type string)
     * $subject: the subject of the email (type string)
     * $message: the message of the email (type string)
     * This function returns an error message or succes. (type string)
     * */
    function sendMail($email, $subject, $message) {
        // Creating a new PHPMailer obj
        $mail = new PHPMailer(true);

        // using SMTP protocol to send email
        $mail->isSMTP();

        // setting SMTPAuth property to true to use my gmail login details to send email
        $mail->SMTPAuth = true;

        // set the Host property to the MAILHOST val defined in config.php
        $mail->Host = MAILHOST;

        // set the Username property to the USERNAME val defined in config.php
        $mail->Username = USERNAME;

        // set the Password property to the PASSWORD val defined in config.php
        $mail->Password = PASSWORD;

        /* Setting SMTPSecure to PHPMailer::ENCRYPTION_STARTTLS
         * tells PHPMailer to use the STARTTLS encryption method when 
         * connecting to the SMTP server. This ensures that the communication
         * between my PHP app and SMTP server is encrypted */
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // TCP port to connect with the Gmail SMTP server
        $mail->Port = 587;

        // determine who is sending the email
        $mail->setFrom(SEND_FROM, SEND_FROM_NAME);

        // where the email goes
        $mail->addAddress($email);

        // specifies where the recipient can reply to
        $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);

        // setting isHTML to true tells PHPMailer that the email msg
        // will include HTML markup
        $mail->IsHTML(true);

        // Assigning the incoming subject to the $mail->subject property
        $mail->Subject = $subject;

        // Assigning the incoming message to the $mail->body property
        $mail->Body = $message;

        // assign the message to the alt body also
        $mail->AltBody = $message;

        // sending the email...
        if ($mail->send()) {
            return "Email sent successfully";
        } else {
            return "ERROR: Email did not send succesfully";
        }
    }


