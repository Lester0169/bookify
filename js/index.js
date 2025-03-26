document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit();
});

document.getElementById('signin-form').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit();
});

// Script to handle modal switching
document.getElementById('openSigninModal').addEventListener('click', function() {
    var signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
    var signinModal = new bootstrap.Modal(document.getElementById('loginModal'));
    signupModal.hide();
    signinModal.show();
});