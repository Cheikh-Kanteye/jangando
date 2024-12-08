<?php

// =============================
// Récupération des Étudiants
// =============================

function getAllStudents()
{
  global $conn;

  $sql = 'SELECT * FROM students';
  $result = mysqli_query($conn, $sql);

  $students = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $students[] = $row;
    }
  }

  return $students;
}

function getStudentByID($id)
{
  global $conn;

  $sql = 'SELECT * FROM students WHERE id = ?';

  // Préparation et exécution de la requête
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  // Récupération du résultat
  $result = mysqli_stmt_get_result($stmt);
  $student = mysqli_fetch_assoc($result);

  mysqli_stmt_close($stmt); // Fermer le statement
  return $student;
}

function deleteStudent($conn, $id)
{
  // Commence par supprimer l'utilisateur associé à l'étudiant
  $stmtUser = $conn->prepare("DELETE FROM users WHERE id = (SELECT user_id FROM students WHERE id = ?)");
  $stmtUser->bind_param("i", $id);

  if (!$stmtUser->execute()) {
    return ["status" => "failed", "message" => "Erreur lors de la suppression de l'utilisateur : " . $stmtUser->error];
  }

  // Ensuite, supprime l'étudiant
  $stmtStudent = $conn->prepare("DELETE FROM students WHERE id = ?");
  $stmtStudent->bind_param("i", $id);

  if ($stmtStudent->execute()) {
    return ["status" => "success", "message" => "L'étudiant avec l'ID $id et son utilisateur associé ont été supprimés."];
  } else {
    return ["status" => "failed", "message" => "Erreur lors de la suppression de l'étudiant : " . $stmtStudent->error];
  }
}


// =============================
// Récupération des Enseignants
// =============================

function getAllTeachers()
{
  global $conn;

  $sql = 'SELECT * FROM teachers';
  $result = mysqli_query($conn, $sql);

  $teachers = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $teachers[] = $row;
    }
  }

  return $teachers;
}

function getTeacherByID($id)
{
  global $conn;

  $sql = 'SELECT * FROM teachers WHERE id = ?';

  // Préparation et exécution de la requête
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  // Récupération du résultat
  $result = mysqli_stmt_get_result($stmt);
  $teacher = mysqli_fetch_assoc($result);

  mysqli_stmt_close($stmt); // Fermer le statement
  return $teacher;
}

// =============================
// Récupération des Parents
// =============================

function getAllParents()
{
  global $conn;

  $sql = 'SELECT * FROM parents';
  $result = mysqli_query($conn, $sql);

  $parents = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $parents[] = $row;
    }
  }

  return $parents;
}

function getParentByID($id)
{
  global $conn;
  $sql = 'SELECT * FROM parents WHERE id = ?';

  // Préparation et exécution de la requête
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  // Récupération du résultat
  $result = mysqli_stmt_get_result($stmt);
  return mysqli_fetch_assoc($result);
}

// =============================
// Récupération des Matières
// =============================

function getAllSubjects()
{
  global $conn;

  $sql = 'SELECT * FROM subjects';
  $result = mysqli_query($conn, $sql);

  $subjects = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $subjects[] = $row;
    }
  }

  return $subjects;
}

function getSubjectByID($id)
{
  global $conn;

  $sql = 'SELECT * FROM subjects WHERE id = ?';

  // Préparation et exécution de la requête
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  // Récupération du résultat
  return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

// =============================
// Récupération des Leçons
// =============================

function getAllLessons()
{
  global $conn;

  $sql = 'SELECT * FROM lessons';
  $result = mysqli_query($conn, $sql);

  $lessons = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $lessons[] = $row;
    }
  }

  return $lessons;
}

function getLessonByID($id)
{
  global $conn;
}

// =============================
// Récupération des Examens
// =============================

function getAllExams()
{
  global $conn;
}

function getExamByID($id)
{
  global $conn;
}

// =============================
// Récupération des Devoirs
// =============================

function getAllAssignments()
{
  global $conn;
}

function getAssignmentByID($id)
{
  global $conn;
}

// =============================
// Récupération des Résultats
// =============================

function getAllResults()
{
  global $conn;
}

function getResultByID($id)
{
  global $conn;
}

// =============================
// Récupération de l'Assiduité
// =============================

function getAllAttendance()
{
  global $conn;
}

function getAttendanceByID($id)
{
  global $conn;
}

// =============================
// Récupération des Événements
// =============================

function getAllEvents()
{
  global $conn;
  return [];
}

function getEventByID($id)
{
  global $conn;
}

// =============================
// Récupération des Annonces
// =============================

function getAllAnnouncements()
{
  global $conn;
  return [];
}

function getAnnouncementByID($id)
{
  global $conn;
}

// =============================
// Récupération des Niveaux
// =============================

function getAllLevels()
{
  global $conn;

  $sql = 'SELECT * FROM levels';
  $result = mysqli_query($conn, $sql);

  // Récupère tous les niveaux sous forme de tableau associatif
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getLevelByID($id)
{
  global $conn;

  $sql = 'SELECT * FROM levels WHERE id = ?';

  // Préparation et exécution de la requête
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  // Récupération du résultat
  $result = mysqli_stmt_get_result($stmt);

  // Retourne le niveau sous forme de tableau associatif
  return mysqli_fetch_assoc($result);
}
