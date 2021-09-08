<?php
include "includes/function.php";
if (isAuthenticated() !== true) :
    Header("Location: /");
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Please Login First!');
endif;
if (isset($_POST['submitBtn'])) {
    $old_password = $_POST['old_password'];
    $new_password1 = $_POST['password'];
    $new_password2 = $_POST['password2'];
    changePassword($_SESSION['user']['id'], $old_password, $new_password1, $new_password2);
}
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
                        <label for="old_password">Old Password:</label><br>
                        <input type="password" name="old_password" id="old_password" placeholder="your-old-password" required><br>
                        <small id='old_password-error' class='text-error'></small>
                    </div>
                    <div class="form-item">
                        <label for="password">New Password:</label><br>
                        <input type="password" name="password" id="password" placeholder="your-new-password" required><br>
                        <small id='password-error' class='text-error'></small>
                    </div>
                    <div class="form-item">
                        <label for="password">Confirm New Password:</label><br>
                        <input type="password" name="password2" id="password2" placeholder="your-new-password-again" required><br>
                        <small id='password2-error' class='text-error'></small>
                    </div><br>
                    <div class="form-item">
                        <button type="submit" class="btn btn-login" id='submitBtn' name='submitBtn' disabled>Change Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>



    <script src="./scripts/nav.js"></script>
    <script>
        const password1 = document.querySelector("#password");
        const password2 = document.querySelector("#password2");
        const password2_error = document.querySelector("#password2-error");
        const submitBtn = document.querySelector("#submitBtn");

        function PasswordValidator() {
            if (password1.value !== password2.value || password1.value == "" || password2.value == "") {
                password2.classList.add('invalid');
                password2_error.innerHTML = "Both password must match!";
                submitBtn.setAttribute('disabled', true)
            } else {
                password2.classList.remove('invalid');
                password2_error.innerHTML = "";
                submitBtn.removeAttribute('disabled')
            }
        }
        password1.addEventListener('keyup', PasswordValidator);
        password2.addEventListener('keyup', PasswordValidator);
    </script>
</body>

</html>