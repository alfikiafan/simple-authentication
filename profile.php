<?php
require_once 'core/init.php';

if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);

    if (!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo escape($data->username); ?></h3>
            </div>
            <div class="card-body">
                <p class="card-text">Nama: <?php echo escape($data->name); ?></p>
            </div>
        </div>
    </div>
</body>

</html>
<?php
    }
}
?>
