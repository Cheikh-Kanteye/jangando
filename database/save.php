<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
  case '/save_teacher':
    $teacher = new TeacherRepository();
    $teacher->createTeacher($_POST);
    break;
}
