<?php
session_start();

require_once "./autoload.php";


checkSession();
define('APP_ACCESS', true);


$students =  new StudentRepository();
$grades = new GradeRepository();
$classes = new ClasseRepository();
$teachers = new TeacherRepository();
$events = new EventRepository();
$parents = new ParentRepository();
$subjects = new SubjectRepository();
$exams = new ExamRepository();
$assigments = new AssignmentRepository();


$role = strtolower($_SESSION['user']["role"]);
$isAdmin = $role == "admin";
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode("/", trim($requestUri, "/"));

// var_dump($segments);

// Gérer les routes avec paramètres dynamiques
if (count($segments) === 2 && !empty($segments[1])) {
  switch ($segments[0]) {
    case 'students':
      $app_content = './views/student_details.php';
      break;
    case 'teachers':
      $app_content = './views/teacher_details.php';
      break;
    default:
      http_response_code(404);
      require_once './views/404.php';
      exit;
  }
} elseif (array_key_exists($requestUri, $routes)) {
  $type = $requestUri === '/exams' ? 'exam' : 'assignment';
  $app_content = $routes[$requestUri];
} else {
  http_response_code(404);
  require_once './views/404.php';
  exit;
}

// Charger la mise en page principale
require_once "./partials/AppLayout.php";
