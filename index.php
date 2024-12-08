<?php
// Start the session at the very beginning of your script
session_start();

require_once './database/models.php';
require_once "./database/db.php";

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$app_content = './app/views/home.php';


// Check if the user is logged in
if (!isset($_SESSION['role'])) {
  require_once "./app/views/login.php";
  exit;
}

// Retrieve the user's role
$role = $_SESSION['role'];

switch ($requestUri) {
  case '/':
    $app_content = $role == 'admin' ? './app/views/home.php' : './app/views/NotAdminHome.php';
    break;

  case '/students':
    $app_content = './app/views/students.php';
    break;

  case '/teachers':
    $app_content = './app/views/teachers.php';
    break;

  case '/parents':
    $app_content = './app/views/parents.php';
    break;

  case '/subjects':
    $app_content = './app/views/subjects.php';
    break;

  case '/classes':
    $app_content = './app/views/classes.php';
    break;

  case '/lessons':
    $app_content = './app/views/lessons.php';
    break;

  case '/exams':
    $type = "Exams";
    $app_content = './app/views/evaluations.php';
    break;

  case '/assignments':
    $type = "Assignements";
    $app_content = './app/views/evaluations.php';
    break;

  case '/results':
    $app_content = './app/views/results.php';
    break;

  case '/attendance':
    $app_content = './app/views/attendance.php';
    break;

  case '/events':
    $app_content = './app/views/events.php';
    break;

  case '/announcements':
    $app_content = './app/views/announcements.php';
    break;

  case '/logout':
    require_once './app/views/logout.php';
    exit;

  default:
    http_response_code(404);
    require_once './app/views/404.php';
    exit;
}

// Include the layout after determining the content to display
require_once "./app/includes/AppLayout.php";
