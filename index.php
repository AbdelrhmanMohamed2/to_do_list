<?php
session_start();
include_once 'functions/functions.php';
include_once 'data/task/tasks_functions.php';

if (!isset($_SESSION['loged'])) {
    redirect("login.php");
}


$data = getAllTasksForUser($_SESSION['loged']['id']);

include_once 'inc/header.php'; ?>
<?php include_once 'inc/nav.php';
?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <?php if (isset($_SESSION['errors']['method_error'])) : ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['method_error'] ?></div>

            <?php
                unset($_SESSION['errors']['method_error']);
            endif ?>
            <h1>All Tasks</h1>
            <hr>
            <?php if (isset($_SESSION['errors']['task_error'])) : ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['task_error'] ?></div>

            <?php
                unset($_SESSION['errors']['task_error']);
            endif ?>
            <?php foreach ($data as $task) : ?>
                <div class="card my-1">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-body-secondary">Added at : <?= $task['time'] ?></h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Done at : <?= $task['done'] ?? "not done yet" ?></h6>
                        <hr>
                        <p class="card-text"><?= $task['task'] ?></p>
                        <hr>
                        <?php if (!isset($task['done'])) : ?>
                            <a href="handlers/done_task.php?id=<?php echo $task['task_id'] ?>" class=" btn btn-success">Done</a>
                            <a href="edit_task.php?id=<?php echo $task['task_id'] ?>" class=" btn btn-warning">Edit</a>
                        <?php endif ?>
                        <a href="handlers/delete_task.php?id=<?php echo $task['task_id'] ?>" class=" btn btn-danger">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <hr>

            <form class="my-5" method="POST" action="handlers/add_task_handler.php">
                <div class="mb-3">
                    <label for="task" class="form-label">Add Task</label>
                    <input type="text" class="form-control" name="task" id="task">
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>