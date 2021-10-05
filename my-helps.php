<?php
include "./includes/function.php";
include "./includes/authentication_required.php";
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
    <title>Sharing is Caring | My Helps</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>My helps</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                <div class="">
                    <b>Filter Your Search</b>
                    <hr>
                    <form class="search-form">
                        <?php include "./partials/search_inp.php" ?>
                        <?php include "./partials/category_inp.php" ?>
                        <?php include "./partials/active_inp.php" ?>
                        <button class=" btn search-btn">
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="helplist-container" autofocus>
                <?php
                $limit = (isset($_GET['limit']) && $_GET['limit'] != null) ? $_GET['limit'] : 10;
                $offset = (isset($_GET['offset']) && $_GET['offset'] != null) ? $_GET['offset'] : 0;
                $category = (isset($_GET['category']) && $_GET['category'] != null) ? $_GET['category'] : NULL;
                $search = (isset($_GET['search']) && $_GET['search'] != null) ? $_GET['search'] : "";
                $helps = getHelpsByUser($limit, $offset, $search, $category);
                while ($help = $helps['results']->fetch_assoc()) {
                ?>

                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $help['title'] ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $help['description'] ?></p>
                        </div>
                        <div class='help-meta'><?= $help['location'] ?></div>
                        <a href='./update-help.php?help_id=<?= $help['id'] ?>' class=''>Edit</a>
                        |
                        <a href='./delete-help.php?help_id=<?= $help['id'] ?>' class=''>Delete</a>
                    </div>
                <?php
                }
                $count = $helps['count'];
                echo (paginate($limit, $offset, $count, $category, $search));
                ?>
            </div>
        </div>

    </div>



    <script src=" ./scripts/nav.js"></script>
</body>

</html>