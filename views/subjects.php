<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($subjects->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'subjects');
$subjectsList = $subjects->findAllPaginated($offset, $resultsPerPage);
?>

<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All Subjects</h2>
    <div class="row">
      <div class="row search-input">
        <i class="ri-search-line"></i>
        <input type="text" placeholder="Search..." name="search" id="search" />
      </div>
      <button class="btn"><i class="ri-equalizer-line"></i></button>
      <button class="btn"><i class="ri-sort-desc"></i></button>
      <button type="button" class="add-btn btn">
        <i class="ri-add-line"></i>
      </button>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($subjectsList as $subject): ?>
        <tr class="table-row">
          <td><?= htmlspecialchars($subject['id']) ?></td>
          <td><?= htmlspecialchars($subject['name']) ?></td>
          <td class="row">
            <button class="btn edit-btn"
              data-id="<?= $subject['id'] ?>"
              data-name="<?= htmlspecialchars($subject['name']) ?>">
              <i class="ri-edit-box-line"></i>
            </button>
            <button class="btn"><i class="ri-delete-bin-6-line"></i></button>
          </td>
        </tr>
      <?php endforeach  ?>
    </tbody>
  </table>
</div>

<div class="form-container animate-scale-in">
  <form method="post" action="save_subject.php" id="subject-form">
    <input type="hidden" name="id" id="subject-id" />
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" />
    </div>
    <button type="submit" class="btn">Save</button>
  </form>
</div>

<script>
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      document.querySelector(".form-container").classList.add("show")
      document.getElementById('subject-id').value = this.dataset.id;
      document.getElementById('name').value = this.dataset.name;
    });
  });
</script>