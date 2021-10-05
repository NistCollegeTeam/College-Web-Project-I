<?php
include "./includes/function.php";
if (isset($_GET['help_id'])) :
    $help_id = $_GET['help_id'];
    $help_res = getHelpById($help_id);
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/list.css">
    <link rel="shortcut" href="./public/favicon.png" type="image/x-icon">
    <title><?= $help->title ?> | Sharing is caring</title>
    <style>
        #create-help-description {
            display: none;
        }
    </style>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1><?= $help->title ?></h1>
        </div>
        <div class="data-section">
            <div class="render-section">
                <div class="">
                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $help->title ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $help->description ?></p>
                        </div>
                        <div class='help-meta help-meta-category'>
                            Category: <?php echoCategoryName($help->category); ?>
                        </div>
                        <div class='help-meta help-meta-contact'>
                            Contact: <?= $help->contact ?>
                        </div>
                        <div class='help-meta help-meta-location'>
                            Address: <?= $help->location ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <h3>Related Helps</h3>
                <div class="related-helps">
                    <?php
                    $rel_helps = getRelatedHelps($cat = $help->category, $cur_help_id = $help->id);
                    foreach ($rel_helps as $help) {
                    ?>
                        <div class='help-item'>
                            <div class='help-title'>
                                <h3><?= $help['title'] ?></h3>
                            </div>
                            <div class="view-more"><a href="./help-detail.php?help_id=<?= $help['id'] ?>" class="">view help&rarr;</a></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <script src="./scripts/nav.js"></script>
</body>

</html>