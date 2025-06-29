<?php
session_start();

$secret_code = "IFRESET2024"; // 🔒 Change this to your own reset code
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_code = $_POST['reset_code'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($input_code !== $secret_code) {
        $error = "Invalid reset code.";
    } elseif ($new_pass !== $confirm_pass) {
        $error = "Passwords do not match.";
    } else {
        $usersFile = 'users.json';
        $users = json_decode(file_get_contents($usersFile), true);

        $users[0]['password'] = password_hash($new_pass, PASSWORD_DEFAULT);

        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        $success = "Password successfully reset. You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Admin Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4 text-center">🔄 Reset Admin Password</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
    <a href="login.php" class="btn btn-dark mt-3">Go to Login</a>
    <?php exit; ?>
<?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label>Secret Reset Code:</label>
      <input type="text" name="reset_code" class="form-control" required>
    </div>
   <div class="mb-3">
  <label>New Password:</label>
  <div class="input-group">
    <input type="password" name="new_password" class="form-control" id="newPassword">
    <button type="button" class="btn btn-outline-secondary" onclick="toggleVisibility('newPassword')">👁️</button>
  </div>
</div>
<div class="mb-3">
  <label>Confirm New Password:</label>
  <div class="input-group">
    <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
    <button type="button" class="btn btn-outline-secondary" onclick="toggleVisibility('confirmPassword')">👁️</button>
  </div>
</div>
    <button type="submit" class="btn btn-warning">Reset Password</button>
    <a href="login.php" class="btn btn-secondary">Back to Login</a>
  </form>
  <script>
  const toggleBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('passwordInput');

  if (toggleBtn && passwordInput) {
    toggleBtn.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggleBtn.textContent = type === 'password' ? '👁️' : '🙈';
    });
  }

  // Reusable function for reset page
  function toggleVisibility(id) {
    const input = document.getElementById(id);
    const type = input.type === "password" ? "text" : "password";
    input.type = type;
  }
</script>

</body>
</html>
