<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
  case '/save_teacher':
    $teacher = new TeacherRepository();
    $teacher->createTeacher($_POST);
    break;
  case "/update_teacher":
    $teacher = new TeacherRepository();
    $teacher->update(intval($_GET["id"]), $_POST);
    break;
  case "/save_parent":
    $parent = new ParentRepository();
    $parent->createParent($_POST);
}
