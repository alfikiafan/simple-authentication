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
        var togglePasswords = document.querySelectorAll('.toggle-password');

        togglePasswords.forEach(function(togglePassword) {
          var passwordField = document.querySelector(togglePassword.getAttribute('toggle'));

          togglePassword.addEventListener('click', function () {
            var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
          });
        });

        var errorMessages = document.querySelectorAll('.alert-danger');

        if (errorMessages) {
            errorMessages.forEach(function(message) {
                setTimeout(function() {
                    message.remove();
                }, 2000);
            });
        }

        var currentUrl = window.location.href;

        var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(function(navLink) {
          if (currentUrl === navLink.href) {
            navLink.classList.add('selectedclass');
          }
        });
      });
    </script>
  </head>
  <body style="background-image: url(images/a.jpg);">