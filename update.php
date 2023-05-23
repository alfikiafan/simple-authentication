<?php
require_once 'core/init.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$errors = array();

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name' => Input::get('name')
                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $errors = $validation->errors();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>

<div class="container">
    <form action="" method="post">
        <div class="mt-3">
            <label for="name" class="form-label mt-3">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo escape($user->data()->name); ?>">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary mt-3" value="Update">

        <?php if (!empty($errors)) : ?>
            <div class="mt-3">
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </form>
</div>