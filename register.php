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
            <h1>Register</h1>

            <hr>
            <form method="POST" action="handlers/register_handler.php" enctype="multipart/form-data">
                <?php if (isset($_SESSION['errors']['name_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['name_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['name_error']);
                endif ?>
                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <?php if (isset($_SESSION['errors']['email_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['email_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['email_error']);
                endif ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>



                <?php if (isset($_SESSION['errors']['password_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['password_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['password_error']);
                endif ?>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>


                <?php if (isset($_SESSION['errors']['con_password_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['con_password_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['con_password_error']);
                endif ?>
                <div class="mb-3">
                    <label for="con_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="con_password" name="con_password">
                </div>



                <?php if (isset($_SESSION['errors']['img_error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['img_error'] ?></div>

                <?php
                    unset($_SESSION['errors']['img_error']);
                endif ?>
                <div class="mb-3">
                    <label for="img" class="form-label">Choose your img</label>
                    <input class="form-control" name="img" type="file" id="img">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>