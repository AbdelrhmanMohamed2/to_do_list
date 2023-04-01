<?php
session_start();
include_once 'functions/functions.php';
include_once 'data/task/tasks_functions.php';

if (!isset($_SESSION['loged'])) {
    redirect("login.php");
}

$data = getOneTaskForUser($_SESSION['loged']['id'], $_GET['id']);

if ($data == 'false') {

    redirect("index.php");
}



include_once 'inc/header.php'; ?>
<?php include_once 'inc/nav.php';
?>
<div class="container">
    <div class="row">
        <div class="col-10">

            <h1>Edit Task :</h1>
            <?php if (isset($_SESSION['errors']['task_error'])) : ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['task_error'] ?></div>

            <?php
                unset($_SESSION['errors']['task_error']);
            endif ?>


            <form class="my-5" method="POST" action="handlers/edit_handler.php">
                <div class="mb-3">
                    <label for="task" class="form-label">Edit Task</label>
                    <input type="text" value="<?php echo ($data['task']) ?>" class="form-control" name="task" id="task">
                </div>
                <div class="mb-3">
                    <input type="text" name="id" value="<?php echo ($_GET['id']) ?>" hidden>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>

        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>