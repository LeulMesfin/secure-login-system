<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Home</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php if (isset($_SESSION['name']) and isset($_SESSION['email'])): ?>
            <h1>Welcome <?php echo $_SESSION['name']; ?> </h1>
            <div>
                <label>Name: <?php echo $_SESSION['name']; ?></label><br>
            </div>

            <br>
            <div>
                <label>Email: <?php echo $_SESSION['email']; ?></label><br>
            </div>
            <br>

            <div>
                <button for="changePass" id="changePass" name="changePass" type="button">Change Password</button>
            </div>
            <br>

            <div>
                <button for="deleteAcc" id="deleteAcc" name="deleteAcc" type="button">Delete Account</button>
            </div>
            <br>

            <form action="logout.php">
                <button for="logout" id="logout" name="logout" type="submit">Log out</button>
        </form>

        <!-- <?php else: header("Location: login.php"); ?> -->
        <?php endif; ?>
    </body>
</html>