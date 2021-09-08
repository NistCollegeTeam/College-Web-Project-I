<?php
include './includes/function.php';
if (isset($_POST['registerBtn'])) :
    $email = $_POST['email'];
    $password = $_POST['password'];
    createUser($email, $password);
endif
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
    <title>Sharing is Caring | Register</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="form-container">
            <div class="form-center-on-container">
                <h2>Register</h2>
                <hr><br>
                <form action="./register.php" method="post" class="">
                    <div class="form-item">
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" id="email" placeholder="example@email.com" autofocus required><br>
                        <!-- <small class='text-error'>Email not verified!</small> -->
                    </div>
                    <div class="form-item">
                        <label for="password1">Password:</label><br>
                        <input type="password" name="password" id="password1" placeholder="your-password" required><br>
                        <small id='password1-error' class='text-error'></small>
                    </div>
                    <div class="form-item">
                        <label for="password2">Confirm Password:</label><br>
                        <input type="password" name="password2" id="password2" placeholder="your-password-again" required><br>
                        <small id='password2-error' class='text-error'></small>
                    </div>
                    <br>
                    <div class="form-item">
                        <button type="submit" name='registerBtn' id='registerBtn' class="btn btn-login" disabled>Sign Up</button>
                    </div>
                    <small><a href="./login.php">Already Have an account?</a></small>
                </form>
            </div>
        </div>


    </div>


    <script src="./scripts/nav.js"></script>
    <script>
        const password1 = document.querySelector("#password1");
        const password2 = document.querySelector("#password2");
        const password2_error = document.querySelector("#password2-error");
        const register_btn = document.querySelector("#registerBtn");

        function PasswordValidator() {
            if (password1.value !== password2.value || password1.value == "" || password2.value == "") {
                password2.classList.add('invalid');
                password2_error.innerHTML = "Both password must match!";
                register_btn.setAttribute('disabled', true)
            } else {
                password2.classList.remove('invalid');
                password2_error.innerHTML = "";
                register_btn.removeAttribute('disabled')
            }
        }
        password1.addEventListener('keyup', PasswordValidator);
        password2.addEventListener('keyup', PasswordValidator);
    </script>
</body>

</html>