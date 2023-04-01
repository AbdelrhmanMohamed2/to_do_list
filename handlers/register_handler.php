<?php
session_start();

include_once '../functions/functions.php';
include_once '../functions/validations.php';
include_once '../data/user/users_functions.php';


$errors = [];
$allowed_img_types = ['jpg', 'png'];
if (checkMethod('POST') && !isset($_SESSION['loged'])) {
    // consts
    // name length
    define('MAX_NAME_SIZE', 10);
    define('MIN_NAME_SIZE', 2);
    // password length
    define('MAX_PASSWORD_SIZE', 15);
    define('MIN_PASSWORD_SIZE', 6);
    // img size
    define('MAX_IMG_SIZE', 500000);
    define('MIN_IMG_SIZE', 10000);
    // img upload path
    define('UPLOAD_IMG_PATH', "../data/user/imgs/");


    // DATA
    // data sanitize
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $con_password = sanitize($_POST['con_password']);


    // data validations 
    // user name validate
    if (empty($name)) {
        $errors['name_error'] = 'name is required';
    } elseif (is_numeric($name)) {
        $errors['name_error'] = 'name must be string';
    } elseif (maxInputSize($name, MAX_NAME_SIZE)) {
        $errors['name_error'] = 'name must is too larg, max = ' . MAX_NAME_SIZE;
    } elseif (minInputSize($name, MIN_NAME_SIZE)) {
        $errors['name_error'] = 'name must is too small, min = ' . MIN_NAME_SIZE;
    }

    // email validate
    if (empty($email)) {
        $errors['email_error'] = 'email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = 'email not valid';
    }

    // password validate
    if (empty($password)) {
        $errors['password_error'] = 'password is required';
    } elseif (maxInputSize($password, MAX_PASSWORD_SIZE)) {
        $errors['password_error'] = 'password must is too larg, max = ' . MAX_PASSWORD_SIZE;
    } elseif (minInputSize($password, MIN_PASSWORD_SIZE)) {
        $errors['password_error'] = 'password must is too small, min = ' . MIN_PASSWORD_SIZE;
    }

    // confirm password validate
    if (empty($con_password)) {
        $errors['con_password_error'] = 'confirm password is required';
    } elseif ($con_password !== $password) {
        $errors['con_password_error'] = 'password and confirm password must be the same ';
    }

    // img data 
    $img = $_FILES['img'];

    $img_name = $img['name'];
    $img_error = $img['error'];
    $img_size = $img['size'];
    $img_tmp_name = $img['tmp_name'];
    $img_extention = pathinfo($img_name, PATHINFO_EXTENSION);

    // img validations
    if ($img_name == '') {
        $errors['img_error'] = 'img is required';
    } elseif ($img_error !== 0) {
        $errors['img_error'] = 'uploading img error happend';
    } elseif ($img_size > MAX_IMG_SIZE) {
        $errors['img_error'] = 'IMG too big, max size = ' . MAX_IMG_SIZE;
    } elseif ($img_size < MIN_IMG_SIZE) {
        $errors['img_error'] = 'IMG too small, min size = ' . MIN_IMG_SIZE;
    } elseif (!in_array($img_extention, $allowed_img_types)) {
        $errors['img_error'] = 'IMG type not allowed';
    } else {
        $new_img_name = uniqid('', true) . "." . $img_extention;
        $img_new_path = UPLOAD_IMG_PATH . $new_img_name;
        if (!move_uploaded_file($img_tmp_name, $img_new_path)) {
            $errors['img_error'] = 'moving img error';
        }
    }


    // check for errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('../register.php');
    } else {
        // new user data in array
        $new_user = ['name' => $name, 'email' => $email, 'password' => $password, 'img' => $new_img_name, 'all' => 0, 'done' => 0, 'delete' => 0];
        if (createNewUser($new_user) !== false) {

            $_SESSION['success'] = 'account created successfully';
            redirect("../login.php");
        } else {
            $errors['email_error'] = 'user already used before';
            $_SESSION['errors'] = $errors;
            redirect('../register.php');
        }
    }

    // wrong method
} else {
    $errors['method_error'] = 'wrong method';
    $_SESSION['errors'] = $errors;
    redirect('../register.php');
}
