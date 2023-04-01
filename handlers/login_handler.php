<?php
session_start();

include_once '../functions/functions.php';
include_once '../functions/validations.php';
include_once '../data/user/users_functions.php';


$errors = [];
if (checkMethod('POST') && !isset($_SESSION['loged'])) {


    // data sanitize
    // user data 
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    // data validations
    // data validate 
    if (empty($email)) {
        $errors['login_error'] = 'please enter your email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['login_error'] = 'invaild email';
    } elseif (empty($password)) {
        $errors['login_error'] = 'please enter your password';
    } else {
        $login = login($email, $password);
        if ($login == false) {
            $errors['login_error'] = 'invalid email or password';
        }
    }


    // check for erros
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('../login.php');
    } else {
        $_SESSION['loged'] = $login;
        $_SESSION['success'] = 'account created successfuly';
        redirect('../index.php');
    }
} else {
    $errors['method_error'] = 'wrong method';
    $_SESSION['errors'] = $errors;
    redirect('../index.php');
}
