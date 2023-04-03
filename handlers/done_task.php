<?php
session_start();
include_once '../functions/functions.php';
include_once '../functions/validations.php';
include_once '../data/user/users_functions.php';
include_once '../data/task/tasks_functions.php';

$errors =  [];
if (checkMethod('GET') && isset($_SESSION['loged']['id'])) {
    $task_id = sanitize($_GET['id']);
    $user_id = $_SESSION['loged']['id'];

    if (empty($task_id)) {
        $errors['task_error'] = 'id to delete is missing';
    } elseif (!is_numeric($task_id)) {
        $errors['task_error'] = 'id to delete is invalied';
    } elseif (!doneTask($task_id, $user_id)) {
        $errors['task_error'] = 'invalid task to delete';
    } else {
        incrementTotalTask($user_id, 'done');
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    }
    redirect("../index.php");
} else {
    $errors['method_error'] = 'wrong method';
    $_SESSION['errors'] = $errors;
    redirect('../index.php');
}
