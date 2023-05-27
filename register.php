<?php

require_once "core/init.php";

$user = new User();

if (!$user->isLoggedIn()) {
    if (Input::exists()) {
        if (Token::check(Input::get("token"))) {
            $validate = new Validate();
            $validate->check($_POST, [
                "name" => [
                    "name" => "Name",
                    "required" => true,
                    "min" => 2,
                    "max" => 50,
                ],
                "username" => [
                    "name" => "Username",
                    "required" => true,
                    "min" => 2,
                    "max" => 20,
                    "unique" => "users",
                ],
                "email" => [
                    "name" => "Email",
                    "required" => true,
                    "max" => 100,
                    "email" => true,
                    "unique" => "users",
                ],
                "password" => [
                    "name" => "Password",
                    "required" => true,
                    "min" => 6,
                ],
                "confirm-password" => [
                    "required" => true,
                    "matches" => "password",
                ],
            ]);
            
            if ($validate->passed()) {
                $user = new User();
                try {
                    $user->create([
                        "name" => Input::get("name"),
                        "username" => Input::get("username"),
                        "email" => Input::get("email"),
                        "password" => Hash::encryptPassword(Input::get("password")),
                        "joined" => date("Y-m-d H:i:s"),
                        "group" => 1,
                    ]);
                    Session::flash(
                        "success",
                        "Your account has been registered. You may now log in."
                    );
                    Redirect::to("login.php");
                } catch (Exception $e) {
                    echo $e->getTraceAsString(), "<br>";
                }
            } else {
                $errors = $validate->errors();
            }
        }
    } ?>

<?php include "resources.php"; ?>
<?php if (!empty($errors)): ?>
<div class="alert p-1 mt-1">
	<?php foreach ($errors as $error): ?>
	<div class="alert-danger p-2 mb-1"><?php echo $error; ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<section class="ftco-section py-3">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-2">
				<h2 class="heading-section">Register</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="login-wrap p-0">
					<h3 class="mb-4 text-center">Create an account</h3>
					<form action="" method="post">
						<div class="form-group">
							<input type="text" name="name" value="<?php echo escape(Input::get("name")); ?>" id="name" placeholder="Name" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="username" id="username" value="<?php echo escape(Input::get("username")); ?>" placeholder="Username" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="email" id="email" value="<?php echo escape(Input::get("email")); ?>" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" placeholder="Password" class="form-control">
							<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
						<div class="form-group">
							<input type="password" name="confirm-password" id="confirm-password" value="" placeholder="Confirm Password" class="form-control">
						</div>
						<div class="form-group">
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<input type="submit" class="form-control btn btn-primary submit px-3" value="Register">
						</div>
						<div class="form-group text-center">
							<p class="mb-0">Already have an account? <a href="login.php">Login</a>
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
</body>

<?php
} else {
    Redirect::to("index.php");
}