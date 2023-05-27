<?php

require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}

$user = new User();

if ($user->isLoggedIn()) {
    $username = escape($user->data()->username);
?>
<?php include 'header.php'; ?>

<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Welcome, <?php echo escape($user->data()->username); ?>!</h2>
          </div>
        </div>
        <div class="row justify-content-center mb-5">
          <nav class="navbar navbar-expand-lg bg-primary rounded-pill px-2">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto font-weight-semibold">
                    <li class="nav-item rounded-pill px-2">
                        <a class="nav-link" href="index.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>
                    </li>
                    <li class="nav-item rounded-pill px-2">
                        <a class="nav-link" href="index.php?update">Edit Profile</a>
                    </li>
                    <li class="nav-item rounded-pill px-2">
                        <a class="nav-link" href="index.php?changepassword">Change Password</a>
                    </li>
                    <li class="nav-item rounded-pill px-2">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
         </nav>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6">
          <?php
                if (isset($_GET['user'])) {
                    require_once 'profile.php';
                } elseif (isset($_GET['update'])) {
                    require_once 'update.php';
                } elseif (isset($_GET['changepassword'])) {
                    require_once 'changepassword.php';
                } else {
                    if (!isset($_GET['user']) || $_GET['user'] !== $username) {
                        Redirect::to("index.php?user=" . $username);
                    }
                }
            ?>
          </div>
        </div>
      </div>
    </section>
<?php
} else {
    redirect::to('login.php');
}