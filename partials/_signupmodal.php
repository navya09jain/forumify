<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Create an account on Forumify</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forum/partials/_handleSignup.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signupPassword" name="signupPassword">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="signupCpassword" name="signupCpassword">
                        </div>
                        <button type="submit" class="btn btn-primary" id="signupBtn" disabled>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom JavaScript to enable button when fields are filled -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var signupEmail = document.getElementById('signupEmail');
        var signupPassword = document.getElementById('signupPassword');
        var signupCpassword = document.getElementById('signupCpassword');
        var signupBtn = document.getElementById('signupBtn');

        function updateSignupButton() {
            var email = signupEmail.value.trim();
            var password = signupPassword.value.trim();
            var confirmPassword = signupCpassword.value.trim();
            signupBtn.disabled = !(email !== '' && password !== '' && confirmPassword !== '');
        }

        signupEmail.addEventListener('input', updateSignupButton);
        signupPassword.addEventListener('input', updateSignupButton);
        signupCpassword.addEventListener('input', updateSignupButton);
    });
</script>