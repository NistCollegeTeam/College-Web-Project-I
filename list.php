<?php
include './includes/function.php';
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
    <title>Sharing is Caring | Helps - Search</title>
</head>

<body>
    <?php include("./nav.php") ?>
    <div class="container">
        <?php include 'message.php'; ?>
        <div class="title">
            <h1>Helps Here</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                FILTERS ARE GONNA BE HERE
                <hr>
                <form class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Search Helps">
                    <button class="btn search-btn">
                        Search
                    </button>
                </form>
            </div>
            <div class="helplist-container" autofocus>
                <?php
                $limit = $_GET['limit'] ? $_GET['limit'] : 10;
                $offset = $_GET['offset'] ? $_GET['offset'] : 0;
                $helps = getHelps($limit, $offset);
                while ($help = mysqli_fetch_array($helps)) {
                    echo "
                    <div class='help-item'>
                        <div class='help-title'>
                            <h4>" . $help['title'] . "</h4>
                        </div>
                        <div class='help-description'>
                            <p>" . $help['description'] . "</p>
                        </div>
                        <div class='help-meta'> -" . $help['location'] . "</div>
                    </div>
                    ";
                }

                ?>
            </div>
        </div>

    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>