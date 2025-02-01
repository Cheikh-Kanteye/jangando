<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($parents->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'students');
$studentsList = $students->findAllPaginated($offset, $resultsPerPage);
?>


<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All Students</h2>
    <div class="row">
      <div class="row search-input">
        <i class="ri-search-line"></i>
        <input type="text" placeholder="Search..." name="search" id="search" />
      </div>
      <button class="btn"><i class="ri-equalizer-line"></i></button>
      <button class="btn"><i class="ri-sort-desc"></i></button>
      <?php if ($role == "admin"): ?>
        <button type="button" class="add-btn btn">
          <i class="ri-add-line"></i>
        </button>
      <?php endif ?>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Info</th>
        <th>Student ID</th>
        <th>Grade</th>
        <th>Field of study</th>
        <th>Phone</th>
        <th>Address</th>
        <?php if ($role == "admin"): ?>
          <th>Actions</th>
        <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($studentsList as $student): ?>
        <?php $classe = $students->findStudentWithClass($student['id']); ?>
        <tr role="link" tabindex="0" class="table-row" onclick="window.location='/students/<?= $student['id'] ?>'">
          <td><?= htmlspecialchars($student['name']) ?> <?= htmlspecialchars($student['surname']) ?></td>
          <td><?= htmlspecialchars($student['id']); ?></td>
          <td><?= htmlspecialchars($classe['className']) ?></td>
          <td><?= htmlspecialchars($student['email']); ?></td>
          <td><?= htmlspecialchars($student['phone']); ?></td>
          <td><?= htmlspecialchars($student['address']); ?></td>
          <?php if ($role == "admin"): ?>
            <td class="row" id="actions">
              <button
                class="btn edit-btn"
                data-id="<?= $student['id'] ?>"
                data-name="<?= htmlspecialchars($student['surname']) ?> <?= htmlspecialchars($student['name']) ?>"
                data-email="<?= htmlspecialchars($student['email']) ?>"
                data-level="<?= htmlspecialchars($classe['classId']) ?>"
                data-phone="<?= htmlspecialchars($student['phone']) ?>"
                <?php $parent = $parents->findById($student['parentId']) ?>
                data-parent-name="<?= htmlspecialchars($parent['name']) ?>"
                data-parent-email="<?= htmlspecialchars($parent['email']) ?>"
                data-parent-phone="<?= htmlspecialchars($parent['phone']) ?>"
                data-address="<?= htmlspecialchars($student['address']) ?>"><i class="ri-edit-box-line"></i></button>
              <a class="btn edit-btn" href="/delete_students?id=<?= $student['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
            </td>
          <?php endif ?>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

  <?= $paginationHtml; ?>
</div>

<div class="form-container animate-scale-in">
  <form>
    <!-- Informations de l'étudiant -->
    <div class="form-section">
      <input type="hidden" id="student-id" name="student-id">


      <h2>Informations de l'étudiant</h2>

      <div class="form-group">
        <label for="name">Nom complet</label>
        <input placeholder="" type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input placeholder="" type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="level">Niveau</label>
        <select id="level" name="level_id" required>
          <option value="">Sélectionnez un niveau</option>
          <?php foreach ($classes->findAll() as $classe): ?>
            <option value="<?= $classe['id'] ?>"><?= $classe['name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="form-group">
        <label for="phone">Numéro de téléphone</label>
        <input placeholder="" type="tel" id="phone" minlength="2" name="phone_number" required>
      </div>
    </div>

    <!-- Informations du parent -->
    <div class="form-section">
      <h2>Informations du parent</h2>

      <div class="form-group">
        <label for="parent_name">Nom du parent</label>
        <input placeholder="" type="text" minlength="2" id="parent_name" name="parent_name" required>
      </div>

      <div class="form-group">
        <label for="parent_email">Email du parent</label>
        <input placeholder="" type="email" id="parent_email" name="parent_email" required>
      </div>

      <div class="form-group">
        <label for="parent_phone">Téléphone du parent</label>
        <input placeholder="" type="tel" id="parent_phone" name="parent_phone" required>
      </div>

      <div class="form-group">
        <label for="address">Adresse</label>
        <textarea id="address" minlength="3" name="address" required></textarea>
      </div>
    </div>

    <button class="btn" type="submit">Soumettre</button>
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
      document.getElementById('student-id').value = this.dataset.id;
      document.getElementById('name').value = this.dataset.name;
      document.getElementById('email').value = this.dataset.email;
      document.getElementById('level').value = this.dataset.level;
      document.getElementById('phone').value = this.dataset.phone;
      document.getElementById('parent_name').value = this.dataset.parentName;
      document.getElementById('parent_email').value = this.dataset.parentEmail;
      document.getElementById('parent_phone').value = this.dataset.parentPhone;
      document.getElementById('address').value = this.dataset.address
    });
  });
</script>