<?php
//start session
session_start();
require_once('../model/database.php');
require_once('../model/admin_db.php');

// Get the action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action == NULL){
        $action = 'show_login';
    }
}

// if user isn't logged in, force them to log in
if (!isset($_SESSION['is_valid_admin'])){
    $action = 'login';
}

// action cases
switch($action){
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($username, $password)){
            $_SESSION['is_valid_admin'] = true;
            header("Location: .?action=list_vehicles");
        } else {
            $login_message = 'You must login to view this page.';
            include('../view/login.php');
        }
        break;
    case 'show_login':
        include('../view/login.php');
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('../view/login.php');
        break;
    case 'register':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');
        include('../util/valid_register.php');
        $errors = valid_registration($username, $password, $confirm_password);
        if($errors){
            include('../view/register.php');
        } else {
            add_admin($username, $password);
            $_SESSION['is_valid_admin'] = true;
            header("Location: .?action=list_vehicles");
        }
        break;
    case 'show_register':
        include('../view/register.php');
        break;
}
