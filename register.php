<?php


require_once 'core/init.php';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            'name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
        ));

        if ($validate->passed()) {
            $user = new User();

            try {
                $user->create(array(
                    'name' => Input::get('name'),
                    'username' => Input::get('username'),
                    'password' => Hash::encryptPassword(Input::get('password')),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1
                ));

                Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                Redirect::to('index.php');
            } catch(Exception $e) {
                echo $e->getTraceAsString(), '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>

<?php include 'header.php'; ?>

<!-- <body class="img js-fullheight" style="background-image: url(images/a.jpg);">
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-4">
            <h2 class="heading-section">Register</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">Create an account</h3>
              <form action="" method="post" class="signin-form">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo escape(Input::get('name')); ?>" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo escape(Input::get('username')); ?>" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input id="password" type="password" class="form-control" placeholder="Password" required>
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <input id="password_again" type="password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                  <input type="submit" class="form-control btn btn-primary submit px-3" value="Register">
                </div>
                <div class="form-group text-center">
                  <p class="mb-0">Already have an account? <a href="login.php">Sign In</a>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body> -->

<div class="text-center mt-4">
    <h1 class="display-9">Registrasi</span></h1>
</div>
<div class="container">
    <form class="mt-5" action="" method="post">
        <div class="mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name" class="form-control">
        </div>

        <div class="mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" class="form-control">
        </div>

        <div class="mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mt-3">
            <label for="password_again" class="form-label">Password Again</label>
            <input type="password" name="password_again" id="password_again" value="" class="form-control">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Register" class="btn btn-primary mt-3">
    </form>
</div>