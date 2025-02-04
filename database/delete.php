<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
  switch ($requestUri) {
    case "/delete_teacher":
      if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID de l'enseignant manquant.");
      }
      $teacher = new TeacherRepository();
      $teacher->deleteTeacher($_GET["id"]);
      header("Location: /teachers?success=Enseignant+supprimé+avec+succès");
      exit;

    case "/delete_classe":
      if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID de la classe manquant.");
      }
      $classe = new ClasseRepository();
      $classe->delete(intval($_GET['id']));
      header("Location: /classes?success=Classe+supprimée+avec+succès");
      exit;

    case "/delete_subject":
      if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID de la matière manquant.");
      }
      $subject = new SubjectRepository();
      $subject->delete($_GET['id']);
      header("Location: /subjects?success=Matière+supprimée+avec+succès");
      exit;

    default:
      throw new Exception("Route non trouvée.");
  }
} catch (Exception $e) {
  $errorMessage = urlencode("Erreur : " . $e->getMessage());
  header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=$errorMessage");
  exit;
}
