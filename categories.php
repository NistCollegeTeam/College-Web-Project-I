<?php
include "./includes/function.php";
if (isAdminUser() !== true) :
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'You do not have permission to perform this action.');
    header('Location: /');
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
    <link rel="stylesheet" href="./styles/list.css">
    <title>Sharing is Caring | Manage Categories</title>
</head>

<body>
    <?php include("./nav.php") ?>
    <div class="container">
        <h1>Categories List</h1>
        <hr>
    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>