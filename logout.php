<?php

require_once 'core/init.php';

$user = new User();
$user->logout();

Session::flash('success', 'You have successfully logged out.');
Redirect::to('index.php');