<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
  switch ($requestUri) {
    case '/save_teacher':
      $teacher = new TeacherRepository();
      $teacher->createTeacher($_POST);
      header("Location: /teachers?success=Enseignant+ajouté+avec+succès");
      exit;

    case "/update_teacher":
      $teacher = new TeacherRepository();
      $teacher->update(intval($_GET["id"]), $_POST);
      header("Location: /teachers?success=Enseignant+mis+à+jour+avec+succès");
      exit;

    case "/save_parent":
      $parent = new ParentRepository();
      $parent->createParent($_POST);
      header("Location: /parents?success=Parent+ajouté+avec+succès");
      exit;

    case "/save_classe":
      $classe = new ClasseRepository();
      $classe->create($_POST);
      header("Location: /classes?success=Classe+ajoutée+avec+succès");
      exit;

    case "/update_classe":
      $classe = new ClasseRepository();
      $classe->update($_GET["id"], $_POST);
      header("Location: /classes?success=Classe+mise+à+jour+avec+succès");
      exit;

    case "/update_subject":
      $subject = new SubjectRepository();
      $subject->update(intval($_GET["id"]), $_POST);
      header("Location: /subjects?success=Matière+mise+à+jour+avec+succès");
      exit;

    default:
      throw new Exception("Route non trouvée.");
  }
} catch (Exception $e) {
  $errorMessage = urlencode("Erreur : " . $e->getMessage());
  header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=$errorMessage");
  exit;
}
