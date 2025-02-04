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
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  $maxSize = 5 * 1024 * 1024;

  if ($file['error'] !== 0) {
    return ['error' => 'Une erreur est survenue lors de l\'upload.'];
  }

  if (!in_array($file['type'], $allowedTypes)) {
    return ['error' => 'Le fichier téléchargé n\'est pas une image valide.'];
  }

  if ($file['size'] > $maxSize) {
    return ['error' => 'Le fichier est trop volumineux. La taille maximale est de 5 Mo.'];
  }

  $uploadDir = 'assets/images/uploads';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  $imageName = uniqid('img_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

  $uploadPath = $uploadDir . $imageName;
  if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
    return ['success' => $uploadPath];
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

function renderDiagramItem($iconPath, $stat, $label)
{
?>
  <div class="diagram row items-start">
    <img src="<?= htmlspecialchars($iconPath) ?>" alt="icon">
    <div>
      <h1 class="stats"><?= htmlspecialchars($stat) ?></h1>
      <p class="text-light"><?= htmlspecialchars($label) ?></p>
    </div>
  </div>
<?php
}


function renderProfile($data)
{
?>
  <div class="profile row">
    <div class="profile_img">
      <img src="/<?= $data['img'] ?>" alt="student">
    </div>
    <div class="details">
      <h4><?= htmlspecialchars($data["surname"] . " " . $data["name"]) ?></h4>
      <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedi</p>

      <div>
        <div class="row">
          <i class="ri-contrast-drop-2-line"></i>
          <p><?= htmlspecialchars($data["bloodType"]) ?></p>
        </div>
        <div class="row">
          <i class="ri-calendar-2-line"></i>
          <p>
            <?php
            $date = new DateTime($data["birthday"]);
            echo $date->format('F d, Y');
            ?>
          </p>
        </div>
        <div class="row">
          <i class="ri-mail-line"></i>
          <p><?= htmlspecialchars($data["email"]) ?></p>
        </div>
        <div class="row">
          <i class="ri-phone-line"></i>
          <p><?= htmlspecialchars($data["phone"]) ?></p>
        </div>
      </div>
    </div>
  </div>
<?php
}
