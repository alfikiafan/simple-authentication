<!DOCTYPE html>
<html>
<head>
    <title>Sistem Autentikasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3343256dc4.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a class="navbar-brand text-white" href="">Sistem Autentikasi</a>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="btn btn-outline-light" href="logout.php">Logout</a>';
                } else {
                    echo '
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="btn btn-outline-light me-2" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light" href="login.php">Login</a>
                        </li>
                    </ul>';
                }
                ?>
            </div>
        </nav>
    </header>
</body>
</html>
