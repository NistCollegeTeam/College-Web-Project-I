<?php
include "./includes/function.php";
if (isAuthenticated() === false) :
    $_SESSION['message'] = array('type' => 'success', 'msg' => 'Please Login to Continue!');
    header('Location: /login.php');
endif;
if (isset($_POST['post_help'])) :
    $title = $_POST['title'];
    $description = $_POST['description'];;
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $category = $_POST['category'];
    createHelp(
        $title,
        $description,
        $location,
        $contact,
        $category
    );
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
    <link rel="shortcut icon" href="./public/favicon.png" type="image/x-icon">
    <title>Sharing is Caring | Create New Help</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>Create New Help</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                I dont know put sth here
                <hr>
                <form class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Search Helps">
                    <button class="btn search-btn">
                        Maybe Search
                    </button>
                </form>
            </div>
            <div class="helplist-container">
                <form class="help-item" method="post" action="./new-help.php" id='createHelpForm' name='createHelpForm'>
                    <label for="create-help-title">Title:</label><br>
                    <input type="text" placeholder="Help title" id='create-help-title' class='' name="title" required><br>

                    <label for="create-help-category">Help Category:</label><br>
                    <select id='create-help-category' class='' name="category" required>
                        <?php
                        $categories = getHelpCategories();
                        while ($category = mysqli_fetch_array($categories)) {
                            echo "<option value='" . ($category['id']) . "'>" . ($category['name']) . "</option>";
                        }
                        ?>
                    </select><br>

                    <label for="create-help-description">Description:</label><br>
                    <textarea id="create-help-description" placeholder="Description about help..." rows='10' cols='100' name='description' class='textarea'></textarea><br>

                    <label for="create-help-location">Location:</label><br>
                    <input type="text" placeholder="Help location" id='create-help-location' class='' name="location" required><br>

                    <label for="create-help-contact">Contact:</label><br>
                    <input type="number" placeholder="Helper contact number" id='create-help-contact' class='' name="contact" required><br>

                    <button type="submit" value="submit" name="post_help" class="btn btn-login">Post Help</button>
                </form>
            </div>
        </div>

    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>