<?php
include("./includes/function.php");
if (isset($_POST['logout-btn'])) {
    logout();
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
    <title>Sharing is Caring | Logout</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <form action="./logout.php" method="post">
            <div class="title">
                <h1>
                    Are you sure you want to logout?
                </h1>
                <button class="btn btn-delete" name='logout-btn'>Logout</button>
            </div>
        </form>
    </div>
    <script src="./scripts/nav.js"></script>
</body>

</html>