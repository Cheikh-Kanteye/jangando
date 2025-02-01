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
  <form id="edit-form" method="post">
    <input type="hidden" name="class_id" id="class-id" />

    <div class="form-group">
      <label for="classname">Classname</label>
      <input type="text" name="classname" id="classname" />
    </div>

    <div class="form-group">
      <label for="grade">Grade</label>
      <select name="grade" id="grade">
        <?php foreach ($grades->findAll() as $grade): ?>
          <option value="<?= $grade['id'] ?>"><?= htmlspecialchars($grade["level"]) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="capacity">Capacity</label>
      <input type="number" name="capacity" id="capacity" min="1" />
    </div>

    <div class="form-group">
      <label for="supervisor">Supervisor</label>
      <input type="text" name="supervisor" id="supervisor" />
    </div>

    <button type="submit" class="btn">Save</button>
  </form>
</div>

<script>
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      document.querySelector(".form-container").classList.add("show");

      document.getElementById('class-id').value = this.dataset.id;
      document.getElementById('classname').value = this.dataset.name;
      document.getElementById('grade').value = this.dataset.grade;
      document.getElementById('capacity').value = this.dataset.capacity;
      document.getElementById('supervisor').value = this.dataset.supervisor;
    });
  });
</script>