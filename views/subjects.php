<div class="subjects_container">
  <div class="departments">
    <!-- <?php $departments = $records->getDepartmentsWithSubjects(); ?>
    <?php foreach ($departments as $departmentName => $subjects): ?>
      <div class="department">
        <h2><?= $departmentName ?></h2>
        <ul class="course-list">
          <?php foreach ($subjects as $subject): ?>
            <li class="course">
              <h3><?= $subject['subject_name'] ?></h3>
              <p><?= $subject['code'] ?> - <?= $subject['credits'] ?> crédits</p>
            </li>
          <?php endforeach; ?>
          <li class="course add-items add-subjects-btn">
            <i class="ri-add-circle-line"></i>
          </li>
        </ul>
      </div>
    <?php endforeach; ?> -->
  </div>
</div>

<div class="form-container">
  <form>
    <!-- Sélection du département -->
    <div class="form-group">
      <label for="department">Département</label>
      <select id="department" name="department_id" required>
        <option value="">Sélectionnez un département</option>
      </select>
    </div>

    <!-- Informations du sujet -->
    <div class="form-group">
      <label for="subject_name">Nom du sujet</label>
      <input type="text" id="subject_name" name="name">
    </div>

    <div class="form-group">
      <label for="code">Code</label>
      <input type="text" id="code" name="code">
    </div>

    <div class="form-group">
      <label for="credits">Crédits</label>
      <input type="number" id="credits" name="credits" min="1">
    </div>

    <button class="btn" type="submit">Ajouter le sujet</button>
  </form>
</div>