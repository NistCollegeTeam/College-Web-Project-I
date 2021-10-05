<?php
$active_opts = array(
    "Active" => 1,
    "Inactive" => 0,
);
?>
<label for='active'>Active Status:</label>
<select id='create-help-active' class='search-input input' name='active'>
    <option value=''>All</option>
    <?php
    foreach ($active_opts as $key => $value) {
        $selected = (isset($_GET['active']) && $_GET['active'] == $value) ? "selected" : "";
    ?>
        <option value='<?= $value ?>' <?= $selected ?>><?= $key ?></option>

    <?php
    }
    ?>
</select>