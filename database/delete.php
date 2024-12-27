<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
  case '/delete_students':
    $students = new StudentRepository();
    $students->delete($_GET['id']);
    break;
  case '/delete_teacher':
    $teachers = new TeacherRepository();
    $teachers->delete($_GET['id']);
    break;

  default:
    # code...
    break;
}
