<?php
require_once('database.php');
session_start();

/* register function */
function createUser($email = NULL, $password = NULL)
{
    global $conn;
    $sql = $conn->prepare('SELECT * FROM user WHERE email = ?');
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows !== 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'The email you chose is already registered.');
    else :
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $conn->prepare('INSERT INTO user (email, password) VALUES (?, ?)');
        $sql->bind_param('ss', $email, $password);
        $sql->execute();
        $sql->close();
        if (isset($_SESSION['user'])) :
            $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully added a new user');
        else :
            $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have successfully create a new user, once approved you can log in here.');
            header('Location: /login.php');
        endif;
        exit();
    endif;
}
/* login function */
function authenticate($email = NULL, $password = NULL)
{
    global $conn;
    $sql = $conn->prepare("SELECT * FROM user WHERE email = ? AND active = 1");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();
    echo $_POST['email'];
    if ($result->num_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'User with given email not found.');
    else :
        while ($row = $result->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($password, $hash)) :
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['email'] = $row['email'];
                $_SESSION['user']['role'] = $row['role'];
                $_SESSION['message'] = array('type' => 'success', 'msg' => 'You are authenticated.');
                header('Location :/');
            else :
                $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Your email or password is incorrect. Please try again.');
            endif;
        }
    endif;
    $sql->close();
}
/* logout function */
function logout()
{
    unset($_SESSION['user']);
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'You have been logged out.');
    header('Location: /');
    exit();
}

// check if user is logged in
function isAuthenticated()
{
    if (isset($_SESSION['user'])) :
        return true;
    else :
        return false;
    endif;
}

// check if user is logged in
function isAdminUser()
{
    if (isset($_SESSION['user'])) :
        return $_SESSION['user']['role'] === 0;
    else :
        return false;
    endif;
}
