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

function getHelpCategories()
{
    global $conn;
    $sql = $conn->prepare('SELECT * from helps_category');
    $sql->execute();
    $categories = $sql->get_result();
    $sql->close();
    return $categories;
}

function getHelps($limit = NULL, $offset = NULL, $search = NULL, $category = NULL)
{
    global $conn;
    $lim = $limit !== NULL ? $limit : 10;
    $off = $offset !== NULL ? $offset : 0;
    $active = 1;
    $search = "%" . $search . "%";
    if ($category !== "" && $category !== NULL && $category !== 0) {
        $sql = $conn->prepare("SELECT * FROM `helps` WHERE `active` = ? AND `category` = ? AND `title` LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('iisii', $active, $category, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as count FROM `helps` WHERE `active` = ? AND `category` = ? AND `title` LIKE ?");
        $count_sql->bind_param('iis', $active, $category, $search);
    } else {
        $sql = $conn->prepare("SELECT * FROM `helps` WHERE `active` = ? AND `title` LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('isii', $active, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as cou FROM `helps` WHERE `active` = ? AND `title` LIKE ?");
        $count_sql->bind_param('iis', $active, $search);
    }
    $count_sql->execute();
    $count_sql->get_result();
    $count = 1;
    $count_sql->close();
    $sql->execute();
    $helps = $sql->get_result();
    $sql->close();
    $data = array('count' => $count, 'results' => $helps);
    return $data;
}

/* create help */
function createHelp($title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL)
{
    global $conn;
    $sql = $conn->prepare('INSERT INTO helps (title, description, location, contact, helper_id, category) VALUES (?, ?, ?, ?, ? , ?)');
    $sql->bind_param('sssiii', $title, $description, $location, $contact, $_SESSION['user']['id'], $category);
    $sql->execute();
    $sql->close();
    $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have created new help!');
    header('Location: /');
    // header('Location: update.php?id=' . $mysqli->insert_id);
    // exit();
}
