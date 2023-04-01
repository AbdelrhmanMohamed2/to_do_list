<?php
include_once 'functions/functions.php';

session_start();
session_destroy();

redirect("login.php");
