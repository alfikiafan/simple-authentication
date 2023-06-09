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

    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    setTimeout(function() {
      var flashMessages = document.querySelectorAll('.alert');
      flashMessages.forEach(function(flashMessage) {
        flashMessage.remove();
      });
    }, 2000);

    var currentUrl = window.location.href;

    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(function(navLink) {
      if (currentUrl === navLink.href) {
        navLink.classList.add('selectedclass');
      }
    });
  });