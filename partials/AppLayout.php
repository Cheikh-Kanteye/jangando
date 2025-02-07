<?php
$users = new UsersRepository();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jangando School Management System</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
  <!-- Utilisation de chemins absolus pour les fichiers CSS -->
  <link rel="stylesheet" href="/assets/css/calendar.css" />
  <link rel="stylesheet" href="/assets/css/schedule.css" />
  <link rel="stylesheet" href="/assets/css/styles.css" />
</head>

<body>
  <main class="container">
    <aside class="sidebar">
      <div class="logo">
        <a href="/" class="row" style="gap: 4px">
          <img src="/assets/images/logo.png" alt="" />
          <span style="font-size: 1.25rem; font-weight: bold; color: #01050a;">Jangando</span>
        </a>
      </div>
      <nav id="menu">
        <?php require_once "./partials/NavMenu.php" ?>
        <a href="/logout" class="link-items">
          <i class="ri-logout-circle-line"></i> <span>logout</span>
        </a>
      </nav>
    </aside>
    <div class="overlay"></div>
    <div class="flex-1">
      <header class="row row-between">
        <div class="row">
          <button class="toggle_menu-btn" id="show-menu">
            <i class="ri-menu-line"></i>
          </button>
          <div class="row search-input">
            <input
              type="text"
              placeholder="Search..."
              name="search"
              id="search" />
            <i class="ri-search-line"></i>
          </div>
        </div>

        <div class="row">
          <button><i class="ri-message-3-line"></i></button>
          <button><i class="ri-notification-3-line"></i></button>
          <div class="row profile">
            <div>
              <h5><?= explode('@', $users->findById($_SESSION["user"]["id"])["username"])[0] ?></h5>
              <small><?= $role ?></small>
            </div>
            <div class="img">
              <img src="" alt="user" />
            </div>
          </div>
        </div>
      </header>
      <section
        class="content row items-start app"
        id="content"
        style="padding-right: 16px">
        <?php require_once $app_content ?>
      </section>
    </div>
  </main>

  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/calendar.js"></script>
</body>

</html>