<?php
include "./includes/function.php";
include "./includes/authentication_required.php";
if (isset($_GET['help_id'])) :
    $help_id = $_GET['help_id'];
    $help_res = getHelpById($help_id, $_SESSION['user']['id']);
    if ($help_res->num_rows != 0) :
        while ($row = $help_res->fetch_assoc()) {
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
if (isset($_POST['update_help'])) :
    $title = $_POST['title'];
    $description = $_POST['description'];;
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $category = $_POST['category'];
    updateHelp(
        $help_id,
        $title,
        $description,
        $location,
        $contact,
        $category,
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
    <title>Sharing is Caring | Edit Help</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>Edit Help: <?= $help['title'] ?></h1>
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
                <form class="help-item" method="post" action="./update-help.php?help_id=<?= $help_id ?>" id='createHelpForm' name='createHelpForm'>
                    <label for="create-help-title">Title:</label><br>
                    <input type="text" placeholder="Help title" id='create-help-title' class='' name="title" value="<?= $help['title'] ?>" required><br>

                    <label for="create-help-category">Help Category:</label><br>
                    <select id='create-help-category' class='input' name="category" required>
                        <?php
                        $categories = getHelpCategories();
                        while ($category = mysqli_fetch_array($categories)) {
                        ?>
                            <option value="<?= $category['id'] ?>" <?php
                                                                    if ($help['category'] == $category['id']) {
                                                                        echo "selected";
                                                                    } ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select><br>

                    <label for="create-help-description">Description:</label><br>
                    <textarea id="create-help-description" placeholder="Description about help..." name='description' class='textarea' required> <?= $help["description"] ?> </textarea><br>

                    <label for="create-help-location">Location:</label><br>
                    <input type="text" placeholder="Help location" id='create-help-location' class='' name="location" required value="<?= $help["location"] ?>"><br>

                    <label for="create-help-contact">Contact:</label><br>
                    <input type="number" placeholder="Helper contact number" id='create-help-contact' class='' name="contact" required value="<?= $help["contact"] ?>"><br>

                    <button type="submit" value="submit" name="update_help" class="btn btn-edit">Update Help</button>
                </form>
            </div>
        </div>

    </div>

    <script src="./scripts/nav.js"></script>
</body>

</html>