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
            ),
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
            ),
            'email' => array(
                'required' => true,
                'max' => 100,
                'email' => true,
            )
        ));

        if ($validate->passed()) {
            try {
                $user->update(array(
                    'name' => Input::get('name'),
                    'username' => Input::get('username')
                ));
                
                Session::flash('success', 'Your details have been updated.');
                Redirect::to("index.php?user=" . $username);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $errors = $validate->errors();
        }
    }
}
?>
    <div class="container">
        <form action="" method="post">
            <div class="form-group mb-2">
                <label for="username" class="form-label text-white">Username</label>
                <input type="text" id="username" name="username" value="<?php echo escape($user->data()->username); ?>" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" id="name" name="name" value="<?php echo escape($user->data()->name); ?>" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group mb-4">
                <label for="email" class="form-label text-white">Email</label>
                  <input type="text" name="email" id="email" value="<?php echo escape($user->data()->email); ?>" placeholder="Email" class="form-control">
                </div>
            <div class="form-group mb-2">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" class="form-control btn btn-primary submit px-3" value="Update">
            </div>
        </form>

        <?php if (!empty($errors)) : ?>
        <div class="alert p-1 mt-1">
            <?php foreach ($errors as $error) : ?>
                <div class="alert-danger p-2 mb-1"><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
