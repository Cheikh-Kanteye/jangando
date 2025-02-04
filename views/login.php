<?php
require_once "./database/UsersRepository.php";
$users = new UsersRepository();

// echo password_hash("passer123", PASSWORD_BCRYPT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $users->login($email, $password);

  if ($user != null) {
    $_SESSION['role'] = $user['role'];
    $_SESSION['user'] = $user;
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
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
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