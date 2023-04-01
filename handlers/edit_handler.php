<?php
session_start();
include_once '../functions/functions.php';
include_once '../functions/validations.php';
include_once '../data/user/users_functions.php';
include_once '../data/task/tasks_functions.php';

$errors = [];
if (checkMethod('POST') && isset($_SESSION['loged']['id'])) {

    // consts
    // max task length
    define('MAX_INPUT_SIZE', 50);
    define('MIN_INPUT_SIZE', 2);

    // data
    $new_task = sanitize($_POST['task']);
    $task_id = sanitize($_POST['id']);
    $user_id = $_SESSION['loged']['id'];


    // task validation
    if (empty($new_task)) {
        $errors['task_error'] = 'task is required';
    } elseif (maxInputSize($new_task, MAX_INPUT_SIZE)) {
        $errors['task_error'] = 'task is too long, max size is ' . MAX_INPUT_SIZE;
    } elseif (minInputSize($new_task, MIN_INPUT_SIZE)) {
        $errors['task_error'] = 'task is too long, min size is ' . MIN_INPUT_SIZE;
    } elseif (is_numeric($new_task)) {
        $errors['task_error'] = 'task must be string not a number';
    }

    // task id validation
    if (empty($task_id)) {
        $errors['task_error'] = 'task id is missing';
    } elseif (!is_numeric($task_id)) {
        $errors['task_error'] = 'task id not valid';
    } elseif (!editTask($new_task, $task_id, $user_id)) {
        $errors['task_error'] = 'task not found';
    }

    // check for errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('../edit_task.php?id=' . $task_id);
    } else {
        redirect('../index.php');
    }

    redirect("../index.php");
} else {
    $errors['method_error'] = 'wrong method';
    $_SESSION['errors'] = $errors;
    redirect('../index.php');
}
