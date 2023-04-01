<?php
include_once '../functions/functions.php';
$cookie_name = "mood";
$cookie_value = $_GET['mood'];

setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

redirect("../index.php");
