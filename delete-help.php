<?php
include "./includes/function.php";
include "./includes/authentication_required.php";
if (isset($_GET['help_id'])) :
    $help_id = $_GET['help_id'];
    $help_res = getHelpById($help_id, $_SESSION['user']['id']);
    if ($help_res->num_rows != 0) :
        while ($row = $help_res->fetch_object()) {
            $help = $row;
        }
    else :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Help not found!');
        header('Location: /list.php');
        exit();
    endif;
else :
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Help not found!');
    header('Location: /list.php');
    exit();
endif;
if (isset($_POST['delete_help'])) :
    deleteHelp($help_id);
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
    <link rel="stylesheet" href="./styles/list.css">
    <title>Sharing is Caring | Delete Help</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>Delete Help: <?= $help->title ?></h1>
        </div>
        <div class="data-section">
            <div class="helplist-container">
                <form class="help-item" method="post" action="./delete-help.php?help_id=<?= $help_id ?>" id='createHelpForm' name='createHelpForm'>
                    <h1>Are you sure you want to delete this help?</h1>
                    <small><i>This action is irreversable.</i></small>
                    <br>
                    <button type="submit" value="submit" name="delete_help" class="btn btn-delete">Delete Help</button>
                </form>
            </div>
        </div>

    </div>

    <script src="./scripts/nav.js"></script>
</body>

</html>