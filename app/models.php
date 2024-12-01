<?php

// Connexion à la base de données
require_once './database/db.php';

// ---------------------------
// 1. Administrateurs
function getAllAdministrators()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM administrateurs");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 2. Annonces
function getAllAnnouncements()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM annonces");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 3. Classes 
function getAllClasses()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM classes");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getClassById($groupId)
{
  global $conn;

  $sql = "SELECT * FROM classes WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);

  if (!$stmt) {
    return false;
  }

  mysqli_stmt_bind_param($stmt, "s", $groupId);
  if (!mysqli_stmt_execute($stmt)) {
    return false;
  }

  $result = mysqli_stmt_get_result($stmt);
  if (!$result) {
    return false;
  }

  $data = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);

  return $data;
}

function getAllSubjects()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM matieres");
  return $result->fetch_all(MYSQLI_ASSOC);
}


// ---------------------------
// 4. Enseignants et Matières
function getAllTeachers()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM enseignants");

  return $result->fetch_all(MYSQLI_ASSOC);
}


function getSubjectsByTeacher($teacherId)
{
  global $conn;
  $sql = "SELECT DISTINCT m.nom AS nom_matiere
          FROM enseignants_matieres em
          JOIN matieres m ON em.matiere_id = m.id
          WHERE em.enseignant_id = ?";

  $stmt = mysqli_prepare($conn, $sql);
  if (!$stmt) {
    return false;
  }

  mysqli_stmt_bind_param($stmt, "s", $teacherId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (!$result) {
    return false;
  }

  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_stmt_close($stmt);

  return $data;
}


// ---------------------------
// 5. Étudiants et Parents
function getAllStudents()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM etudiants");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getParentsByStudent($studentId)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM etudiants_parents WHERE etudiant_id = $studentId");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getAllParents()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM parents");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 6. Évaluations
function getAllEvaluations($type)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM evaluations");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getEvaluationsByType($type)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM evaluations WHERE type = '$type'");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 7. Événements
function getAllEvents()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM evenements");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 8. Leçons et Matières de Leçons
function getAllLessons()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM lecons");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getSubjectsByLesson($lessonId)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM lecons_matieres WHERE lecon_id = $lessonId");
  return $result->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------
// 9. Présences et Résultats
function getAttendanceRecords()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM presences");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function getAllResults()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM resultats");
  return $result->fetch_all(MYSQLI_ASSOC);
}
