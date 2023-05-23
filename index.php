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

<div class="text-center my-5">
    <h1 class="display-5">Selamat datang, <span class="text-primary"><?php echo escape($user->data()->username); ?></span></h1>
</div>
<div class="container">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-md-9">
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

<?php
} else {
    redirect::to('login.php');
}
