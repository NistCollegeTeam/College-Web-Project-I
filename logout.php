<?php
include("./includes/function.php");
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
    <title>Sharing is Caring | Logged Out</title>
</head>

<body>
    <?php
    include("./nav.php");
    logout();
    ?>
    <div class="container">
        <h1 class="text-white">You have been logged out. <small><a href="./login.php">Login again?</a></small></h1>
    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>