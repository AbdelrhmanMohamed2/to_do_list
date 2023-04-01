<?php
session_start();
include_once 'functions/functions.php';

if (isset($_SESSION['loged'])) {
    redirect("profile.php");
}
include_once 'inc/header.php'; ?>
<?php include_once 'inc/nav.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Login</h1>
            <hr>
            <form method="POST" action="handlers/login_handler.php">
                <?php if (isset($_SESSION['errors']['login_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['login_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['login_error']);
                endif ?>

                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>

                <?php
                    unset($_SESSION['success']);
                endif ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>




                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>