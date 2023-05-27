<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var togglePassword = document.querySelector('.toggle-password');
        var passwordField = document.querySelector(togglePassword.getAttribute('toggle'));

        togglePassword.addEventListener('click', function () {
          var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordField.setAttribute('type', type);
          this.classList.toggle('fa-eye');
          this.classList.toggle('fa-eye-slash');
        });
      });
    </script>
  </head>
  <body style="background-image: url(images/a.jpg);">