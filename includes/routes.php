<?php
$routes = [
  '/' => $_SESSION["role"] === 'admin' ? './views/home.php' : './views/NotAdminHome.php',
  '/students' => './views/students.php',
  '/teachers' => './views/teachers.php',
  '/parents' => './views/parents.php',
  '/subjects' => './views/subjects.php',
  '/classes' => './views/classes.php',
  '/lessons' => './views/lessons.php',
  '/exams' => './views/evaluations.php',
  '/assignments' => './views/evaluations.php',
  '/results' => './views/results.php',
  '/attendance' => './views/attendance.php',
  '/events' => './views/events.php',
  '/announcements' => './views/announcements.php',
  '/logout' => './views/logout.php',
  '/delete_students' => './database/delete.php',
  '/delete_teacher' => './database/delete.php',
];
