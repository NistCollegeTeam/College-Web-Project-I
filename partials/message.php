<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['message']['type']; ?>" role="alert">
        <?php echo $_SESSION['message']['msg']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>