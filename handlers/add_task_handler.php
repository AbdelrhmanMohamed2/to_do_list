<?php
session_start();
include_once '../functions/functions.php';
include_once '../functions/validations.php';
include_once '../data/task/tasks_functions.php';
include_once '../data/user/users_functions.php';


$errors = [];
if (checkMethod('POST') && isset($_SESSION['loged']['id'])) {

    // consts
    // max task length
    define('MAX_INPUT_SIZE', 50);
    define('MIN_INPUT_SIZE', 2);

    // data sanitize
    $task = sanitize($_POST['task']);
    $user_id = $_SESSION['loged']['id'];

    // data validations
    // task validate 
    if (empty($task)) {
        $errors['task_error'] = 'task is required';
    } elseif (maxInputSize($task, MAX_INPUT_SIZE)) {
        $errors['task_error'] = 'task is too long, max size is ' . MAX_INPUT_SIZE;
    } elseif (minInputSize($task, MIN_INPUT_SIZE)) {
        $errors['task_error'] = 'task is too long, min size is ' . MIN_INPUT_SIZE;
    } elseif (is_numeric($task)) {
        $errors['task_error'] = 'task must be string not a number';
    }


    // check for erros
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        $new_task = ["user_id" => $user_id, "task" => $task];
        createNewTask($new_task);
        incrementTotalTask($user_id, 'all');
    }
    redirect('../index.php');
} else {
    $errors['method_error'] = 'wrong method';
    $_SESSION['errors'] = $errors;
    redirect('index.php');
}
