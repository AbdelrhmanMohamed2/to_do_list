<?php
session_start();
include_once 'functions/functions.php';
include_once 'data/user/users_functions.php';

if (!isset($_SESSION['loged'])) {
    redirect("login.php");
}

$loged_user = getOneUserInfo($_SESSION['loged']['id']);

include_once 'inc/header.php'; ?>
<?php include_once 'inc/nav.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Profile</h1>
            <hr>

            <div class="card">
                <img src="data/user/imgs/<?= $loged_user['img'] ?? "default.jpg" ?>" class="card-img-top" width="200" height="200">
                <div class="card-body">
                    <h5 class="card-title"><?= $_SESSION['loged']['name'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $loged_user['email'] ?></h6>
                    <p class="card-text">
                    <div class="alert alert-primary">You have <?= $loged_user['all'] ?? 0 ?> total tasks</div>
                    <div class="alert alert-success">You have <?= $loged_user['done']  ?? 0 ?> Done tasks</div>
                    <div class="alert alert-danger">You have <?= $loged_user['deleted']  ?? 0 ?> Deleted tasks</div>
                    </p>
                    <a href="index.php" class="btn btn-primary">Go to Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>