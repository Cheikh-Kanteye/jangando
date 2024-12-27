<div class="flex-1 table-container">
  <div class="row row-between">
    <h2>All Students</h2>
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
        <th>Info</th>
        <th>Student ID</th>
        <th>Grade</th>
        <th>Field of study</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students->findAll() as $student): ?>
        <?php $classe = $students->findStudentWithClass($student['id']); ?>
        <tr role="link" tabindex="0" class="table-row" onclick="window.location='/students/<?= $student['id'] ?>'">
          <td><?= htmlspecialchars($student['surname']) ?> <?= htmlspecialchars($student['name']) ?></td>
          <td><?= htmlspecialchars($student['id']); ?></td>
          <td><?= htmlspecialchars($classe['className']) ?></td>
          <td><?= htmlspecialchars($student['email']); ?></td>
          <td><?= htmlspecialchars($student['phone']); ?></td>
          <td><?= htmlspecialchars($student['address']); ?></td>
          <td class="row" id="actions">
            <button class="btn"><i class="ri-edit-box-line"></i></button>
            <a class="btn" href="/delete_students?id=<?= $student['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>
</div>

<div class="form-container">
  <form>
    <!-- Informations de l'étudiant -->
    <div class="form-section">
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