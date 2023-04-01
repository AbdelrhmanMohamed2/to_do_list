<?php

define('TASKS_URL', __DIR__ . '\tasks.json');

// ############ get All Tasks  ################
function getAllTasks()
{
    $all_tasks = file_get_contents(TASKS_URL);

    $all_tasks = json_decode($all_tasks, true);
    return $all_tasks;
}
// ############################################


// ############ get All Tasks for one user  ################
function getAllTasksForUser($user_id)
{
    $all_tasks = getAllTasks();
    $users_task = [];

    foreach ($all_tasks as $task) {
        if ($task['user_id'] == $user_id) {
            $users_task[] = $task;
        }
    }
    return $users_task;
}
// ############################################


// ############ get One Task for one user  ################
function getOneTaskForUser($user_id, $task_id)
{
    $all_tasks = getAllTasks();

    foreach ($all_tasks as $task) {
        if ($task['task_id'] == $task_id && $task['user_id'] == $user_id) {
            return $task;
        }
    }
    return false;
}
// ############################################


// ############ Put All Tasks  ################
function putAllTasks($all_tasks)
{
    $all_tasks = json_encode($all_tasks);
    file_put_contents(TASKS_URL, $all_tasks);
}
// ############################################


// ############ create task  ################
function createNewTask($new_task)
{
    $all_tasks = getAllTasks();


    // add id to the new task
    $last_task = end($all_tasks);
    $last_task_id = $last_task['task_id'] ?? 0;
    $new_task['task_id'] = $last_task_id + 1;


    // add time to new task
    $time_added = getTime();
    $new_task['time'] = $time_added;

    // add new task and save all data
    $all_tasks[] = $new_task;

    putAllTasks($all_tasks);
}
// ############################################


// ############ delete task  ################
function deleteTask($task_id, $user_id)
{
    $all_tasks = getAllTasks();

    foreach ($all_tasks as $key => $task) {
        if ($task['task_id'] == $task_id && $task['user_id'] == $user_id) {
            unset($all_tasks[$key]);
            putAllTasks($all_tasks);
            return true;
        }
    }

    return false;
}
// ############################################


// ############ done task  ################
function doneTask($task_id, $user_id)
{
    $all_tasks = getAllTasks();

    // add time to new task
    $time_done = getTime();

    foreach ($all_tasks as $key => &$task) {
        if ($task['task_id'] == $task_id && $task['user_id'] == $user_id) {
            $task['done'] = $time_done;
            putAllTasks($all_tasks);

            return true;
        }
    }

    return false;
}
// ############################################



// ############ edit task  ################
function editTask($new_task, $task_id, $user_id)
{
    $all_tasks = getAllTasks();

    foreach ($all_tasks as $key => &$task) {
        if ($task['task_id'] == $task_id && $task['user_id'] == $user_id) {

            $task['task'] = $new_task;


            putAllTasks($all_tasks);
            return true;
        }
    }
    return false;
}
// ############################################


// ################ get Time #######################
function getTime()
{

    date_default_timezone_set("Africa/Cairo");
    $t = time();
    return date("Y-m-d h:i A", $t);
}
// ############################################
