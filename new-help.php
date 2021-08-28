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
    <?php include("./nav.php") ?>
    <div class="container">
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
                <div class="help-item">
                    <div class="help-title">
                        <label for="create-help-title">Title:</label>
                        <input type="text" placeholder="Help title" id='create-help-title' class=''>
                    </div>
                    <div class="help-description">
                        <label for="create-help-description">Description:</label>
                        <textarea name="create-help-description" id="" class=" textarea" placeholder="Description about text...."></textarea>
                    </div>
                    <div class="help-meta">
                        - From Kathmandu
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="./scripts/nav.js"></script>
</body>

</html>