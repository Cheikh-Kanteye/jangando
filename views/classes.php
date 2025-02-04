<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}
?>

<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All Classes</h2>
    <div class="row">
      <div class="row search-input">
        <i class="ri-search-line"></i>
        <input type="text" placeholder="Search..." name="search" id="search" />
      </div>
      <button class="btn"><i class="ri-equalizer-line"></i></button>
      <button class="btn"><i class="ri-sort-desc"></i></button>
      <?php if ($role == "admin"): ?>
        <button type="button" class="btn add-btn">
          <i class="ri-add-line"></i>
        </button>
      <?php endif; ?>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Classname</th>
        <th>Grade</th>
        <th>Capacity</th>
        <th>Supervisor</th>
        <?php if ($role == "admin"): ?><th>Actions</th><?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($classes->findAll() as $classe): ?>
        <tr class="table-row">
          <td><?= htmlspecialchars($classe['name']) ?></td>
          <td><?= htmlspecialchars($grades->findById($classe['gradeId'])["level"]) ?></td>
          <td><?= htmlspecialchars($classe["capacity"]) ?></td>
          <?php $supervisor = $classes->getSupervisor($classe["supervisorId"]) ?>
          <td><?= $supervisor["surname"] ?> <?= $supervisor["name"] ?></td>
          <?php if ($role == "admin"): ?>
            <td class="row">
              <button class="btn edit-btn"
                data-id="<?= $classe['id'] ?>"
                data-name="<?= htmlspecialchars($classe['name']) ?>"
                data-grade="<?= $classe['gradeId'] ?>"
                data-capacity="<?= htmlspecialchars($classe['capacity']) ?>"
                data-supervisor="<?= $supervisor["id"] ?>">
                <i class="ri-edit-box-line"></i>
              </button>
              <a href="#" class="btn delete-btn" data-id="<?= $classe['id'] ?>">
                <i class="ri-delete-bin-6-line"></i>
              </a>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- FORMULAIRE D'ÉDITION -->
<div class="form-container animate-scale-in">
  <form id="/save_classe" method="post">
    <input type="hidden" name="id" id="class-id" />

    <div class="form-group">
      <label for="name">Classname</label>
      <input type="text" name="name" id="classname" class="form-control" />
    </div>

    <div class="form-group">
      <label for="grade">Grade</label>
      <select name="gradeId" id="grade" class="form-control">
        <?php foreach ($grades->findAll() as $grade): ?>
          <option value="<?= htmlspecialchars($grade['id']) ?>"><?= htmlspecialchars($grade["level"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="capacity">Capacity</label>
      <input type="number" name="capacity" id="capacity" min="1" class="form-control" />
    </div>

    <div class="form-group">
      <label for="supervisor">Supervisor</label>
      <select name="supervisorId" id="supervisor" class="form-control" data-live-search="true">
        <option value="">-- Sélectionner un enseignant --</option>
        <?php foreach ($teachers->findAll() as $teacher): ?>
          <option value="<?= htmlspecialchars($teacher['id']) ?>"><?= htmlspecialchars($teacher["surname"] . " " . $teacher["name"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      document.querySelector(".form-container").classList.add("show");

      document.getElementById('class-id').value = this.dataset.id;
      document.getElementById('classname').value = this.dataset.name;
      document.getElementById('grade').value = this.dataset.grade;
      document.getElementById('capacity').value = this.dataset.capacity;
      document.getElementById('supervisor').value = this.dataset.supervisor;
      document.querySelector("form").setAttribute("action", `/update_classe?id=${this.dataset.id}`)

    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    // Active la recherche dans le select
    $('#supervisor').selectpicker();
  });
</script>