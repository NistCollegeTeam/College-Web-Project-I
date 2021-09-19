<div class="">
    Filter Your Search
    <hr>
    <form class="search-form">
        <?php
        $input_value = isset($_GET['search']) ? $_GET['search'] : "";
        ?>
        <label for='search'>Search Helps:</label>
        <input type='text' name='search' class='search-input' placeholder='Search Helps' value="<?= $input_value ?>">
        <label for='category'>Select Category:</label>
        <select id='create-help-category' class='search-input' name='category'>
            <option value=''>All Categories</option>
            <?php
            $categories = getHelpCategories();
            while ($category = mysqli_fetch_array($categories)) {
                $selected = (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "true" : "false";
            ?>
                <option value="<?= $category['id'] ?>" selected="<?= $selected ?>"><?= ($category['name']) ?></option>
            <?php
            }
            ?>
        </select><br>
        <button class=" btn search-btn">
            Search
        </button>
    </form>
</div>