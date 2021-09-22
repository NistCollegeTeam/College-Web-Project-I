<?php
require_once('function.php');
if (isAuthenticated() === false) :
    $_SESSION['message'] = array('type' => 'success', 'msg' => 'Please Login to Continue!');
    header('Location: /login.php');
    exit();
endif;
