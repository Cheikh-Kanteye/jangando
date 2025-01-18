<?php
require_once "./database/UsersRepository.php";
$users = new UsersRepository();

// echo password_hash("passer123", PASSWORD_BCRYPT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = $users->login($username, $password);

  if ($user != null) {
    $_SESSION['role'] = $user['role'];
    $_SESSION['username'] = $username;
    header("Location: /");
    exit;
  } else {
    $error = "Identifiants incorrects.";
  }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body>
  <div class="login-container">
    <form class="login-form" method="POST">
      <h2>Login</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group remember">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember me</label>
      </div>
      <button type="submit">Login</button>
      <div class="links">
        <p style="color: tomato"><?= $error ?? "" ?></p>
      </div>
    </form>
  </div>
</body>

</html>