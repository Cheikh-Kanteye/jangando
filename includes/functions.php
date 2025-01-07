<?php
function checkSession()
{
  if (!isset($_SESSION['role'])) {
    require "./views/login.php";
    exit;
  }
}


function paginate($totalResults, $resultsPerPage = 10, $currentPage = 1, $baseUrl = '')
{
  // Calculate the total number of pages
  $totalPages = ceil($totalResults / $resultsPerPage);

  // Ensure current page is within the valid range
  $currentPage = max(1, min($currentPage, $totalPages));

  // Calculate the offset for fetching results
  $offset = ($currentPage - 1) * $resultsPerPage;

  // Generate the pagination buttons HTML
  $paginationHtml = '<div class="pagination">';
  for ($page = 1; $page <= $totalPages; $page++) {
    $activeClass = $page === $currentPage ? 'active' : '';
    $paginationHtml .= sprintf(
      '<button onclick="window.location.href=\'%s?page=%d\'" class="tab %s"><span>%d</span></button>',
      $baseUrl,
      $page,
      $activeClass,
      $page
    );
  }
  $paginationHtml .= '</div>';

  return [$offset, $paginationHtml];
}

function uploadImage($file)
{
  // Définir les types de fichiers autorisés et la taille maximale (en octets)
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  $maxSize = 5 * 1024 * 1024;  // 5 Mo max

  // Vérifier si le fichier a été téléchargé sans erreur
  if ($file['error'] !== 0) {
    return ['error' => 'Une erreur est survenue lors de l\'upload.'];
  }

  // Vérifier le type MIME de l'image
  if (!in_array($file['type'], $allowedTypes)) {
    return ['error' => 'Le fichier téléchargé n\'est pas une image valide.'];
  }

  // Vérifier la taille de l'image
  if ($file['size'] > $maxSize) {
    return ['error' => 'Le fichier est trop volumineux. La taille maximale est de 5 Mo.'];
  }

  // Définir le répertoire d'upload
  $uploadDir = 'assets/images/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  // Générer un nom unique pour le fichier
  $imageName = uniqid('img_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

  // Déplacer le fichier téléchargé dans le répertoire d'upload
  $uploadPath = $uploadDir . $imageName;
  if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
    return ['success' => $uploadPath];  // Retourner le chemin de l'image
  } else {
    return ['error' => 'Une erreur est survenue lors de l\'upload.'];
  }
}

function generateUniqueId($name, $surname, $otherData)
{
  // Combine les données pour créer un identifiant unique
  $data = $name . $surname . $otherData . uniqid('', true);

  // Générer un hachage (SHA-1) et limiter la longueur à 36 caractères
  $uniqueId = substr(sha1($data), 0, 36);

  return $uniqueId;
}
