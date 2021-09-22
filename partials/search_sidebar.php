<div class="">
    <b>Filter Your Search</b>
    <hr>
    <form class="search-form">
        <?php
        $input_value = isset($_GET['search']) ? $_GET['search'] : "";
        echo "
            <label for='search'>Search Helps:</label>
                <input type='text' name='search' class='search-input' placeholder='Search Helps' value='" . $input_value . "'>
            <label for='category'>Select Category:</label>
            <select id='create-help-category' class='search-input input' name='category'>
            <option value=''>All Categories</option>";
        $categories = getHelpCategories();
        while ($category = mysqli_fetch_array($categories)) {
            $selected = (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "selected" : "";
            echo "<option value='" . ($category['id']) . "'" . $selected . ">" . ($category['name']) . "</option>";
        }
        echo "</select><br>";
        ?>
        <button class="btn search-btn">
            Search
        </button>
    </form>
</div>