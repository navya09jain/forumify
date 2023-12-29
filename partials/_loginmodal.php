<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login to Forumify</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partials/_handleLogin.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="loginPass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPass" name="loginPass">
                    </div>
                    <button type="submit" class="btn btn-primary" disabled id="loginBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loginEmail = document.getElementById('loginEmail');
        var loginPassword = document.getElementById('loginPass'); // Corrected variable name
        var loginBtn = document.getElementById('loginBtn');

        function updateLoginButton() {
            var email = loginEmail.value.trim();
            var password = loginPassword.value.trim();
            loginBtn.disabled = !(email !== '' && password !== '');
        }

        loginEmail.addEventListener('input', updateLoginButton);
        loginPassword.addEventListener('input', updateLoginButton);
    });
</script>