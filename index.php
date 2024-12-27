<?php
require_once "./includes/functions.php";

session_start();
checkSession();


require_once "./assets/utils/dummy.php";
require_once "./includes/routes.php";
require_once "./database/DatabaseConnection.php";
require_once "./database/StudentRepository.php";
require_once "./database/ParentRepository.php";
require_once "./database/ClasseRepository.php";
require_once "./database/GradeRepository.php";
require_once "./database/GradeRepository.php";
require_once "./database/SubjectRepository.php";
require_once "./database/TeacherRepository.php";
require_once "./database/AttendanceRepository.php";
require_once "./database/ExamRepository.php";
require_once "./database/AssignmentRepository.php";
require_once "./database/LessonRepository.php";
require_once "./database/EventRepository.php";





$students =  new StudentRepository();
$grades = new GradeRepository();
$classes = new ClasseRepository();
$teachers = new TeacherRepository();
$events = new EventRepository();

$role = $_SESSION['role'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode("/", trim($requestUri, "/"));


// var_dump($segments);

// Gérer les routes avec paramètres dynamiques
if (count($segments) === 2 && !empty($segments[1])) {
  switch ($segments[0]) {
    case 'students':
      $app_content = './views/student_detail.php';
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
