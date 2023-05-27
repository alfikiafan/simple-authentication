<?php
require_once 'core/init.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'current_password' => array(
                'required' => true,
                'min' => 6
            ),
            'new_password' => array(
                'required' => true,
                'min' => 6
            ),
            'new_confirm-password' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'new_password'
            )
        ));
    }

    if ($validate->passed()) {
        if (!Hash::isValidPassword(Input::get('current_password'), $user->data()->password)) {
            echo 'Your current password is wrong.';
        } else {
            $user->update(array(
                'password' => Hash::encryptPassword(Input::get('new_password'))
            ));

            Session::flash('home', 'Your password has been changed!');
            Redirect::to('index.php');
        }
    } else {
        $errors = $validate->errors();
    }
}
?>

    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <input id="current_password" type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
                <span toggle="#current_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group">
                <input id="new_password" type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group">
                <input type="password" name="new_confirm-password" id="new_confirm-password" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="token" id="token" value="<?php echo escape(Token::generate()); ?>">
                <input type="submit" class="form-control btn btn-primary submit px-3" value="Change Password">
            </div>
            <?php if (isset($errors)) : ?>
                <div class="alert p-1 mt-1">
                    <?php foreach ($errors as $error) : ?>
                        <div class="alert-danger p-2 mb-1"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
