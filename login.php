<?php
    $invalid_login = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //echo "PIZZA";
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
        $stmt = $mysqli->prepare("select * from user where email = ?");

        // Prepared statement: stage 2: bind & execute
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // gets result set from the prepared statement
        $result = $stmt->get_result();
        $user = $result->fetch_assoc(); // returns an array, next row in returned sql table

        if ($user and (password_verify($pass, $user['password'])) and ($user['activation_token_hash'] == null)) {
           // user logged in successfully
           // start the session, store some vars in the session
           session_start();
           $_SESSION['name'] = $user['name']; 
           $_SESSION['email'] = $user['email'];
           header("Location: home.php");
        }

        $invalid_login = true;
    }

    # Closing connection when finished
    // $mysqli->close(); causing http server 500 error
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Login Page</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Login</h1>
        <p>No account? <a href="signup.html">Sign up</a></p>

        <?php if ($invalid_login): ?>
            <em>Invalid login</em>
        <?php endif; ?>

        <form method="POST">
            <div>
                <div>
                    <input for="email" id="email" name="email" type="email" placeholder="Email address" 
                    value="<?= htmlspecialchars($_POST['email'] ??  "") ?>"required>
                </div>
                <br>

                <!-- wrap label and password in a div,-->
                <div class="forgot-pass">
                    <label>Forgot password?</label>
                </div>
                <div>
                    <input for="password" id="password" name="password" type="password" placeholder="Password" required>
                </div>
                <br>
                <div>
                    <button for="submit" id="submit" name="submit" type="submit">Login</button>
                </div>
            </div>
        </form>
    </body>
</html>