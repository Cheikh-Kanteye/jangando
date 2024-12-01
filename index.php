<?php
// Start the session at the very beginning of your script
session_start();

require_once './app/models.php';
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
    $students = getAllStudents();
    $app_content = './app/views/students.php';
    break;

  case '/teachers':
    $app_content = './app/views/teachers.php';
    break;

  case '/parents':
    $parents = getAllParents();
    $app_content = './app/views/parents.php';
    break;

  case '/subjects':
    $subjects = getAllSubjects();
    $app_content = './app/views/subjects.php';
    break;

  case '/classes':
    $classes = getAllClasses();
    $app_content = './app/views/classes.php';
    break;

  case '/lessons':
    $lessons = getAllLessons();
    $app_content = './app/views/lessons.php';
    break;

  case '/exams':
    $type = "Exams";
    $evaluations = getAllEvaluations("examen");
    $app_content = './app/views/evaluations.php';
    break;

  case '/assignments':
    $type = "Assignements";
    $evaluations = getAllEvaluations("devoir");
    $app_content = './app/views/evaluations.php';
    break;

  case '/results':
    $results = getAllResults();
    $app_content = './app/views/results.php';
    break;

  case '/attendance':
    $attendances = getAttendanceRecords();
    $app_content = './app/views/attendance.php';
    break;

  case '/events':
    $events = getAllEvents();
    $app_content = './app/views/events.php';
    break;

  case '/announcements':
    $announcements = getAllAnnouncements();
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
