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
                echo '<p class="text-danger mb-0">' . $error . '</p>';
            }
        }
    }
}
?>
<?php include 'header.php'; ?>

<section class="ftco-section">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Login</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">Have an account?</h3>
              <form action="" method="post" class="signin-form">
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group"><input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <div class="form-group">
                    <input type="submit" value="Login" class="form-control btn btn-primary submit px-3">
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50"><label class="checkbox-wrap checkbox-primary">Remember Me <input type="checkbox" name="remember" id="remember" checked><span class="checkmark"></span></label></div>
                  <div class="w-50 text-md-right"><a href="#" style="color: #fff">Forgot Password</a></div>
                </div>
                <div class="form-group text-center">
                  <p class="mb-0">Don't have an account? <a href="register.php">Register</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>