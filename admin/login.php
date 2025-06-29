<?php
session_start();
$error = '';

// ✅ Auto-login via cookie if user chose "Remember Me"
if (isset($_COOKIE['remember_user']) && !isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_COOKIE['remember_user'];
    header("Location: dashboard.php");
    exit;
}

// ✅ Manual login on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUser = $_POST['username'];
    $inputPass = $_POST['password'];
    $users = json_decode(file_get_contents('users.json'), true);

    foreach ($users as $user) {
       if ($inputUser === $user['username'] && password_verify($inputPass, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $inputUser;

            // ✅ Set cookie for "Remember Me"
            if (isset($_POST['remember'])) {
                setcookie("remember_user", $inputUser, time() + (86400 * 7), "/"); // 7 days
            } else {
                setcookie("remember_user", "", time() - 3600, "/"); // delete cookie
            }

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - InstanFurniture</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #fafafa, #e0dcdc);
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 40px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .brand {
      text-align: center;
      margin-bottom: 20px;
    }
    .brand h2 {
      color: #3d3d3d;
    }
    .brand span {
      color: #a0522d;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="brand">
      <h2><span>Instant</span>Furniture</h2>
      <small>Your Home of Comfortability and Durability</small>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required autofocus
          value="<?= isset($_COOKIE['remember_user']) ? htmlspecialchars($_COOKIE['remember_user']) : '' ?>">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="passwordInput" required>
          <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️</button>
        </div>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember"
          <?= isset($_COOKIE['remember_user']) ? 'checked' : '' ?>>
        <label class="form-check-label" for="remember">
          Remember me
        </label>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>

      <div class="text-center mt-3">
        <a href="reset.php" style="font-size: 14px;">Forgot Password?</a>
      </div>
    </form>
  </div>

  <!-- JavaScript to show/hide password -->
  <script>
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    toggleBtn.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggleBtn.textContent = type === 'password' ? '👁️' : '🙈';
    });
  </script>
</body>
</html>
