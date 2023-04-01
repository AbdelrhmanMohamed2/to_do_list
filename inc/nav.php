<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">TO-DO List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['loged'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif ?>

                <?php if (isset($_SESSION['loged'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="handlers/mood_handler.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mood
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="handlers/mood_handler.php?mood=night">Night</a></li>
                            <li><a class="dropdown-item" href="handlers/mood_handler.php?mood=day">Day</a></li>

                        </ul>
                    </li>
            </ul>

            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active text-danger" aria-current="page" href="logout.php">Logout</a>
                </li>
            <?php endif ?>
            </ul>

        </div>
    </div>
</nav>