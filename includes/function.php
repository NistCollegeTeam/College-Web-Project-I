<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

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
                Header('Location: ./list.php');
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
    return isset($_SESSION['user']);
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
        $sql = $conn->prepare("SELECT id, location, title, description FROM helps WHERE `active` = ? AND `category` = ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('iisii', $active, $category, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `helps` WHERE `active` = ? AND `category` = ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
        $count_sql->bind_param('iis', $active, $category, $search);
    } else {
        $sql = $conn->prepare("SELECT id, location, title, description FROM helps WHERE `active` = ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('isii', $active, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `helps` WHERE `active` = ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
        $count_sql->bind_param('is', $active, $search);
    }
    $count_sql->execute();
    $count = $count_sql->get_result()->fetch_object();
    $count_sql->close();
    $sql->execute();
    $helps = $sql->get_result();
    $sql->close();
    $data = array('count' => $count->total, 'results' => $helps);
    return $data;
}

function getHelpById($help_id = NULL, $owner = NULL)
{
    global $conn;
    if ($help_id !== "" && $help_id !== NULL && $help_id !== 0) {
        if ($owner == NULL) {
            $sql = $conn->prepare("SELECT * FROM `helps` WHERE `id` = ?");
            $sql->bind_param('i', $help_id);
        } else {
            print $owner;
            $sql = $conn->prepare("SELECT * FROM `helps` WHERE `id` = ? AND `helper_id` = ?");
            $sql->bind_param('ii', $help_id, $owner);
        }
        $sql->execute();
        $help = $sql->get_result();
        $sql->close();
        return $help;
    } else {
        return NULL;
    }
}

// function getHelpsByUser($limit = NULL, $offset = NULL, $search = NULL, $category = NULL, $user_id = NULL)
// {
//     if (!isset($user_id)) {
//         try {
//             $user_id = $_SESSION['user']['id'];
//         } catch (Throwable $throwable) {
//             $_SESSION['message'] = array('type' => 'danger', 'msg' => 'No users Provided!😟');
//             header("Location: /");
//             exit();
//         }
//     }
//     global $conn;
//     $lim = $limit !== NULL ? $limit : 10;
//     $off = $offset !== NULL ? $offset : 0;
//     $search = "%" . $search . "%";
//     if ($category !== "" && $category !== NULL && $category !== 0) {
//         $sql = $conn->prepare("SELECT id, location, title, description FROM `helps` WHERE `category` = ? AND `helper_id`= ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
//         $sql->bind_param('iisii', $category, $user_id, $search, $lim, $off);
//         $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `helps` WHERE `category` = ? AND `helper_id`= ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
//         $count_sql->bind_param('iis', $category, $user_id, $search);
//     } else {
//         $sql = $conn->prepare("SELECT id, location, title, description FROM `helps` WHERE `helper_id`= ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
//         $sql->bind_param('isii', $user_id, $search, $lim, $off);
//         $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `helps` WHERE `helper_id`= ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
//         $count_sql->bind_param('is', $user_id, $search);
//     }
//     $count_sql->execute();
//     $count = $count_sql->get_result()->fetch_object();
//     $count_sql->close();
//     $sql->execute();
//     $helps = $sql->get_result();
//     $sql->close();
//     $data = array('count' => $count->total, 'results' => $helps);
//     return $data;
// }

/* create help */
function createHelp($title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL, $active = NULL)
{
    global $conn;
    $sql = $conn->prepare('INSERT INTO helps (title, description, location, contact, helper_id, category, active) VALUES (?, ?, ?, ?, ? , ?, ?)');
    $sql->bind_param('sssiiii', $title, $description, $location, $contact, $_SESSION['user']['id'], $category, $active);
    $sql->execute();
    if ($sql->affected_rows > 0) {
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have created new help!');
        $sql->close();
        header('Location: /my-helps.php');
    }
    // header('Location: update.php?id=' . $mysqli->insert_id);
    exit();
}

/* update help */
function updateHelp($id = NULL, $title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL, $active = NULL)
{
    global $conn;
    $sql = $conn->prepare('UPDATE `helps` SET title= ?, description= ?, location= ?, contact= ?, category= ?, active = ? WHERE id= ?');
    $sql->bind_param('sssiiii', $title, $description, $location, $contact, $category, $active, $id);
    $sql->execute();
    if ($sql->affected_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Error updating help!');
    else :
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully update the selected help.');
    endif;
    $sql->close();
    header('Location: /update-help.php?help_id=' . $id);
    exit();
}
function deleteHelp($id = NULL)
{
    global $conn;
    $sql = $conn->prepare('DELETE FROM `helps` WHERE id= ?');
    $sql->bind_param('i', $id);
    $sql->execute();
    if ($sql->affected_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Error deleting help!');
    else :
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully deleted the selected help.');
    endif;
    $sql->close();
    header('Location: /my-helps.php');
    // header('Location: update.php?id=' . $mysqli->insert_id);
    exit();
}

function paginate($limit, $offset, $count, $category, $search)
{
    $next_icon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-right' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z' /></svg>";
    $prev_icon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-left' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z' /></svg>";
    echo "<div class='pagination-container'>";
    $static_query = "&limit=" . $limit . "&category=" . $category . "&search=" . $search;
    if ($offset > 0) :
        $prev_offset = $offset - $limit;
        echo "<a class='pagination-btn' href='/list.php?offset=" . $prev_offset . $static_query . "' >" . $prev_icon . " </a>";
    endif;
    if ($limit + $offset < $count) :
        $next_offset = $offset + $limit;
        echo "<a class='pagination-btn' href='/list.php?offset=" . $next_offset . $static_query . "'>" . $next_icon . "</a>";
    endif;
}

/* login function */
function changePassword($user_id, $old_password, $password1, $password2)
{
    global $conn;
    if ($password1 !== $password2) {
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Both password do not match!');
        return;
    }
    $sql = $conn->prepare("SELECT * FROM user WHERE id = ? AND active = 1");
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    if ($result->num_rows !== 0) :
        while ($row = $result->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($old_password, $hash) == true) :
                $password_change_sql = $conn->prepare("UPDATE user SET `password`=? WHERE id=? ");
                $password_change_sql->bind_param("si", password_hash($password1, PASSWORD_DEFAULT), $user_id);
                $password_change_sql->execute();
                if ($password_change_sql->affected_rows === 0) :
                    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'An unknown error occoured. Please try again later.');
                else :
                    $_SESSION['message'] = array('type' => 'success', 'msg' => 'User password successfully changed!');
                endif;
                $password_change_sql->close();
            else :
                $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Your old password is incorrect. Please try again.');
            endif;
        }
    endif;
}

function echoCategoryName($id = NULL)
{
    global $conn;
    $sql = $conn->prepare("SELECT `name` FROM helps_category WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();
    $res = $sql->get_result();
    if ($res->num_rows !== 0) {
        while ($cat_name = $res->fetch_assoc()) {
            echo $cat_name['name'];
        }
    } else {
        echo $id;
    }
    $sql->close();
}

function getRelatedHelps($cat = NULL, $cur_help_id = NULL)
{
    $result = array();
    global $conn;
    $sql = $conn->prepare("SELECT * FROM helps WHERE category = ? AND active = 1 ORDER BY `helps`.`id` DESC LIMIT 10 ");
    $sql->bind_param("i", $cat);
    $sql->execute();
    $rows = $sql->get_result();
    $sql->close();
    while ($row = $rows->fetch_array()) {
        if ($row['id'] == $cur_help_id) {
            continue;
        }
        array_push($result, $row);
    }
    if ($rows->num_rows < 8) {
        $sql = $conn->prepare("SELECT * FROM helps WHERE active = 1 ORDER BY `helps`.`id` DESC LIMIT 7");
        $sql->execute();
        $new_res = $sql->get_result();
        while ($row = $new_res->fetch_array()) {
            if ($row['id'] == $cur_help_id || in_array($row, $result)) {
                continue;
            }
            array_push($result, $row);
        }
        $sql->close();
    }
    return $result;
}


function getHelpsByUser($limit = NULL, $offset = NULL, $search = NULL, $category = NULL, $user_id = NULL, $active = NULL)
{
    if (!isset($user_id)) {
        try {
            $user_id = $_SESSION['user']['id'];
        } catch (Throwable $throwable) {
            $_SESSION['message'] = array('type' => 'danger', 'msg' => 'No users Provided!😟');
            header("Location: /");
            exit();
        }
    }
    global $conn;
    $lim = $limit !== NULL ? $limit : 10;
    $off = $offset !== NULL ? $offset : 0;
    $search = $conn->real_escape_string($search);
    $category = $conn->real_escape_string($category);
    $frm_q = "FROM `helps` WHERE `helper_id`= $user_id ";
    $order_q = "ORDER BY `id` DESC LIMIT $lim OFFSET $off";
    $search_q = "AND (`title` LIKE \"%$search%\" OR `description` LIKE \"%$search%\") ";
    if ($category !== "" && $category !== NULL && $category !== 0) {
        $frm_q .= "AND `category` = $category ";
    }
    if ($active !== "" && $active !== NULL) {
        $frm_q .= "AND `active` = $active ";
    }
    $query = "SELECT id, location, title, description " . $frm_q . $search_q . $order_q;
    $sql = $conn->prepare($query);
    $sql->execute();
    $helps = $sql->get_result();
    $sql->close();
    $count_sql = $conn->prepare("SELECT COUNT(id) as total " . $frm_q . $search_q);
    $count_sql->execute();
    $helps_count = $count_sql->get_result()->fetch_object();
    return array("results" => $helps, "count" => $helps_count->total);
}
