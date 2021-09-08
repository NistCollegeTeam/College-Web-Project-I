<?php
include "includes/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/list.css">
    <title>Sharing is Caring | Change Password</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="form-container">
            <div class="form-center-on-container">
                <h2>Change Password</h2>
                <hr><br>
                <form action="./password_change.php" method="post" class="">
                    <div class="form-item">
                        <label for="old_password">Old Password:</label>
                        <input type="password" name="password" id="old_password" placeholder="your-password" required>
                        <small id='old_password-error' class='text-error'></small>
                    </div>
                    <div class="form-item">
                        <label for="password2">Confirm Password:</label>
                        <input type="password" name="password2" id="password2" placeholder="your-password-again" required>
                        <small id='password2-error' class='text-error'></small>
                    </div><br>
                    <div class="form-item">
                        <button type="submit" class="btn btn-login" name='loginBtn'>Login</button>
                    </div>
                    <small><a href="./register.php">Need an account?</a></small>
                </form>
            </div>
        </div>

    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>