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
      <button><i class="ri-equalizer-line"></i></button>
      <button><i class="ri-sort-desc"></i></button>
      <button type="button" class="add-btn">
        <i class="ri-add-line"></i>
      </button>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Classname</th>
        <th>Grade</th>
        <th>Capacity</th>
        <th>Supervisor</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($classes->findAll() as $classe): ?>
        <tr class="table-row">
          <td><?= $classe['name'] ?></td>
          <td><?= $grades->findById($classe['gradeId'])["level"] ?></td>
          <td><?= $classe["capacity"] ?></td>
          <td></td>
          <td class="row">
            <button class="btn edit-btn">
              <i class="ri-edit-box-line"></i>
            </button>
            <a class="btn"><i class="ri-delete-bin-6-line"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="form-container animate-scale-in">
  <form>
    <div class="form-group">
      <label for="firstname">Firstname</label>
      <input type="text" name="firstname" id="firstname" />
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" />
    </div>
  </form>
</div>