<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$currentSort = isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'desc' : 'asc';

$evaluations =  $type == "exam" ? $exams : $assigments;
$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($evaluations->findAll());
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, $type);
$evaluationsList = $evaluations->findAllPaginated($offset, $resultsPerPage, $search);
?>


<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All <?= $type ?></h2>
    <div class="row">
      <div class="row search-input">
        <i class="ri-search-line"></i>
        <form id="searchFom"><input type="text" placeholder="Search..." name="search" id="search" /></form>
      </div>
      <button class="btn"><i class="ri-equalizer-line"></i></button>
      <button class="btn" id="sortToggle"><i class="ri-sort-desc"></i></button>
      <?php if ($isAdmin) { ?>
        <button class="btn" id="sortToggle">
          <i class="ri-sort-<?= $currentSort ?>"></i>
        </button>
      <?php } ?>

    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Start Time</th>
        <th>End Time</th>
        <?php if ($isAdmin) { ?><th>Actions</th><?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($evaluationsList as $evaluation): ?>
        <tr class="table-row">
          <td><?= htmlspecialchars($evaluation['title']) ?></td>
          <td>
            <?= htmlspecialchars((new DateTime($evaluation['startTime']))->format('d/m/Y - H:i')); ?>
          </td>
          <td>
            <?= htmlspecialchars((new DateTime($evaluation['endTime']))->format('d/m/Y - H:i')); ?>
          </td>

          <?php if ($isAdmin) { ?>
            <td class="row" id="actions">
              <button
                class="btn edit-btn"
                data-id="<?= $evaluation['id'] ?>"
                data-title="<?= htmlspecialchars($evaluation['title']) ?>"
                data-start-time="<?= htmlspecialchars($evaluation['startTime']) ?>"
                data-end-time="<?= htmlspecialchars($evaluation['endTime']) ?>"><i class="ri-edit-box-line"></i></button>
              <a class="btn edit-btn" href="/delete_evaluations?id=<?= $evaluation['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
            </td>
          <?php } ?>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

  <?= $paginationHtml; ?>
</div>

<div class="form-container animate-scale-in">
  <form>
    <!-- Evaluation Information -->
    <div class="form-section">
      <input type="hidden" id="evaluation-id" name="evaluation-id">

      <h2>Evaluation Information</h2>

      <div class="form-group">
        <label for="title">Title</label>
        <input placeholder="" type="text" id="title" name="title" required>
      </div>

      <div class="form-group">
        <label for="start-time">Start Time</label>
        <input placeholder="" type="datetime-local" id="start-time" name="start_time" required>
      </div>

      <div class="form-group">
        <label for="end-time">End Time</label>
        <input placeholder="" type="datetime-local" id="end-time" name="end_time" required>
      </div>
    </div>

    <button class="btn" type="submit">Submit</button>
  </form>
</div>

<div class="custom-alert" id="customAlert">
  <div class="alert-message" id="alertMessage"></div>
  <button class="btn" onclick="closeAlert()">OK</button>
</div>


<script>
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function(e) {
      e.stopPropagation();
      document.querySelector('.form-container').classList.add('show');
      document.getElementById('evaluation-id').value = this.dataset.id;
      document.getElementById('title').value = this.dataset.title;
      document.getElementById('start-time').value = this.dataset.startTime;
      document.getElementById('end-time').value = this.dataset.endTime;
    });
  });

  document.getElementById("sortToggle").addEventListener("click", () => {
    const url = new URL(window.location);
    const currentSort = url.searchParams.get("sort") || "asc";
    const nextSort = currentSort === "asc" ? "desc" : "asc";

    url.searchParams.set("sort", nextSort);
    window.location = url;
  });

  console.log(document.getElementById("search"))

  document.getElementById("search").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
      alert("pressed")
      event.preventDefault();

      const url = new URL(window.location);
      url.searchParams.set("search", this.value);

      window.location = url;
    }
  });
</script>