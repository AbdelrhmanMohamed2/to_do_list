<?php

define('USERS_URL', __DIR__ . '\users.json');


// ############ get All Users  ################
function getAllUsers()
{
    $all_users = file_get_contents(USERS_URL);
    $all_users = json_decode($all_users, true);
    return $all_users;
}
// ############################################

// ############ Put All Users  ################
function putAllUsers(&$all_users)
{
    $all_users = json_encode($all_users);
    file_put_contents(USERS_URL, $all_users);
}
// ############################################


// ############ increment total task  ################
function incrementTotalTask($user_id, $type)
{
    $all_users = getAllUsers();
    foreach ($all_users as &$user) {
        if ($user['id'] == $user_id) {
            $user[$type] += 1;

            putAllUsers($all_users);

            return true;
        }
    }

    return false;
}
// ############################################

// ############ get One User info  ################
function getOneUserInfo($user_id)
{
    $all_users = getAllUsers();

    foreach ($all_users as $user) {
        if ($user['id'] == $user_id) {
            return $user;
        }
    }
    return false;
}
// ############################################


// ############ create new user  ################
function createNewUser($new_user)
{
    $all_users = getAllUsers();
    // check if user already exists
    foreach ($all_users as $user) {
        if ($new_user['email'] == $user['email']) {
            return false;
        }
    }
    // add id to the new user
    $last_user = end($all_users);
    $last_user_id = $last_user['id'] ?? 0;
    $new_user['id'] = $last_user_id + 1;

    // add new task and save all data
    $all_users[] = $new_user;

    putAllUsers($all_users);
}
// ############################################


// ############ create new user  ################
function login($email, $password)
{
    $all_users = getAllUsers();


    foreach ($all_users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {

            return $user;
        }
    }
    return false;
}
// ############################################
