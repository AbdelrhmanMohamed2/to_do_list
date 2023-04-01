<?php

// ############ redircet ######################
function redirect($path)
{
    header("location:$path");
    die;
}
// ############################################


// ############ Method check ##################
function checkMethod($method)
{
    return $_SERVER['REQUEST_METHOD'] === $method;
}
// ############################################
