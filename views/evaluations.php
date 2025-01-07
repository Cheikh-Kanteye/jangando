<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$evaluations =  $type == "exam" ? $exams : $assigments;
$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($evaluations->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'evaluations');
$evaluationsList = $evaluations->findAllPaginated($offset, $resultsPerPage);
?>


<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All <?= $type ?></h2>
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
        <th>Title</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($evaluationsList as $evaluation): ?>
        <tr role="link" tabindex="0" class="table-row" onclick="window.location='/evaluations/<?= $evaluation['id'] ?>'">
          <td><?= htmlspecialchars($evaluation['title']) ?></td>
          <td><?= htmlspecialchars($evaluation['startTime']); ?></td>
          <td><?= htmlspecialchars($evaluation['endTime']); ?></td>
          <td class="row" id="actions">
            <button
              class="btn edit-btn"
              data-id="<?= $evaluation['id'] ?>"
              data-title="<?= htmlspecialchars($evaluation['title']) ?>"
              data-start-time="<?= htmlspecialchars($evaluation['startTime']) ?>"
              data-end-time="<?= htmlspecialchars($evaluation['endTime']) ?>"><i class="ri-edit-box-line"></i></button>
            <a class="btn edit-btn" href="/delete_evaluations?id=<?= $evaluation['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
          </td>
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
</script>