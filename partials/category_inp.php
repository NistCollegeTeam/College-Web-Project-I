<label for='category'>Select Category:</label>
<select id='create-help-category' class='search-input input' name='category'>
    <option value=''>All Categories</option>
    <?php
    $categories = getHelpCategories();
    while ($category = $categories->fetch_assoc()) {
        $selected = (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "selected" : "";
    ?>
        <option value="<?= $category['id'] ?>" <?= $selected ?>><?= ($category['name']) ?></option>
    <?php
    }
    ?>
</select>