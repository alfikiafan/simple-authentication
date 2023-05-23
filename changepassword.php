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
            'new_password_again' => array(
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="current_password" class="form-label mt-3">Current Password</label>
                <input type="password" class="form-control" name="current_password" id="current_password">
            </div>

            <div class="form-group">
                <label for="new_password" class="form-label mt-3">New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password">
            </div>

            <div class="form-group">
                <label for="new_password_again" class="form-label mt-3">New Password Again</label>
                <input type="password" class="form-control" name="new_password_again" id="new_password_again">
            </div>

            <input type="hidden" name="token" id="token" value="<?php echo escape(Token::generate()); ?>">
            <input type="submit" class="btn btn-primary mt-3" value="Change Password">

            <?php if (isset($errors)) : ?>
                <div class="mt-3">
                    <?php foreach ($errors as $error) : ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
