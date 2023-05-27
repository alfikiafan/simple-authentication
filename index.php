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
            <h2 class="heading-section">Manajemen Akun</h2>
          </div>
        </div>
        <div class="row justify-content-center mb-5">
          <div class="col- mx-3">
          <div class="text-center">
            <a href="index.php?user=<?php echo escape($user->data()->username); ?>" class="btn btn-primary px-3 py-2">Lihat Profil</a>
          </div>
          </div>
          <div class="col- mx-3">
            <div class="text-center">
              <a href="index.php?update" class="btn btn-primary px-3 py-2">Edit Profil</a>
            </div>
          </div>
          <div class="col- mx-3">
            <div class="text-center">
              <a href="index.php?changepassword" class="btn btn-warning px-3 py-2">Ganti Password</a>
            </div>
          </div>
          <div class="col- mx-3">
            <div class="text-center">
              <a href="logout.php" class="btn btn-danger px-3 py-2">Logout</a>
            </div>
          </div>          
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