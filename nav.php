<nav>
    <div class="nav-site-title">
        <div class="">
            <a href="/" class="nav-site-title">
                <div class="logo">
                    <?php
                    include './public/logo.svg'
                    ?>
                </div>
                <div class="nav-title">Sharing is Caring</div>
            </a>
        </div>
        <div class="hamburger btn">
            =
        </div>
    </div>
    <div class="nav-links">

        <div class="nav-item">
            <a href="./list.php" class='nav-link'>
                Helps
            </a>
        </div>
        <?php
        if (isAuthenticated() === true) :
        ?>
            <div class="nav-item">
                <a href="./new-help.php" class='nav-link'>
                    Create New Help
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class='nav-link'>
                    <img src="./public/avatar.jpeg" alt="" srcset="" class='avatar'>
                </a>
            </div>
            <div class="nav-item">
                <a href="./logout.php" class='nav-link'>
                    Logout?
                </a>
            </div>
        <?php else : ?>
            <div class="nav-item">
                <a href="./login.php" class='nav-link'>
                    Sign In
                </a>
            </div>

            <div class="nav-btn nav-item">
                <a class="btn btn-login" href="./register.php">
                    Register
                </a>
            </div>
        <?php endif ?>
    </div>
</nav>