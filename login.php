<?php

require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validate->passed()) {
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login) {
                Redirect::to("index.php?user=" . escape($user->data()->username));
            } else {
                echo '<p>Nama pengguna atau password tidak sesuai</p>';
            }            
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>
<?php include 'header.php'; ?>
<div class="text-center mt-4">
    <h1 class="display-9">Masuk</span></h1>
</div>
<div class="container">
<form class="mt-5" action="" method="post">
    <div class="mt-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>

    <div class="mt-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="mt-3 form-check">
        <input type="checkbox" name="remember" id="remember" class="form-check-input">
        <label class="form-check-label" for="remember">Ingat saya</label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Login" class="btn btn-primary mt-3">
</form>
</div>