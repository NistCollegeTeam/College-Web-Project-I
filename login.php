<?php
include './includes/function.php';
if (isset($_POST['loginBtn'])) :
    $email = $_POST['email'];
    $password = $_POST['password'];
    authenticate($email, $password);
    header('Location : /list.php');
endif;
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
    <title>Sharing is Caring | Login</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>

        <div class="form-container">
            <div class="form-center-on-container">
                <h2>Login</h2>
                <hr><br>
                <form action="./login.php" method="post" class="">
                    <div class="form-item">
                        <label for="email">Email:</label><br>
                        <input class='' type="email" name="email" id="email" placeholder="example@email.com" autofocus>
                        <!-- <small class='text-error'>Email not verified!</small> -->
                    </div>
                    <div class="form-item">
                        <label for="password">Password:</label><br>
                        <input type="password" name="password" id="password" placeholder="your-password"><br>
                        <small id='password-error'></small>
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