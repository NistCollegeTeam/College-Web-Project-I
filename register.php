<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Sharing is Caring | Register</title>
</head>
<body>
    <?php include("./nav.php") ?>
    <div class="container">
    <div class="form-container">
    <div class="form-center-on-container">
        <h2>Register</h2>
        <hr><br>
        <form action="." method="get" class="">
            <div class="form-item">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="example@email.com">
                <small class='text-error'>Email not verified!</small>
            </div>
            <div class="form-item">
                <label for="password1">Password:</label>
                <input type="password" name="password1" id="password1" placeholder="your-password">
                <small id='password1-error'></small>
            </div>
            <div class="form-item">
                <label for="password2">Confirm Password:</label>
                <input type="password" name="password2" id="password2" placeholder="your-password-again">
                <small id='password2-error'></small>
            </div><br>
            <div class="form-item">
                <button type="submit" class="btn">Sign Up</button>
            </div>
            <small><a href="./login.php">Already Have an account?</a></small>
        </form>
    </div>
</div>

    
    </div>
    
    
    
</body>
</html>