<?php
include "../includes/function.php";
if (isAuthenticated() === true) :
?>
    <div class="nav-item">
        <a href="../categories.php" class='nav-link'>
            Manage Categories
        </a>
    </div>
<?php
endif
?>