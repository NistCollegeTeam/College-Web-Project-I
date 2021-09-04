<div class="">
    Filter Your Search
    <hr>
    <form class="search-form">
        <?php
        echo "
        <label for='search'>Search Helps:</label>
        <input type='text' name='search' class='search-input' placeholder='Search Helps' value='" . $_GET['search'] . "'>
        <label for='category'>Select Category:</label>
        <select id='create-help-category' class='' name='category' value='" . $_GET['category'] . "'>
        <option value=''>All Categories</option>";
        $categories = getHelpCategories();
        while ($category = mysqli_fetch_array($categories)) {
            $selected = $category['id'] == $_GET['category'] ? "selected" : "";
            echo "<option value='" . ($category['id']) . "'" . $selected . ">" . ($category['name']) . "</option>";
        }
        echo "</select><br>";
        ?>
        <button class="btn search-btn">
            Search
        </button>
    </form>
</div>