<div class="flex-1 table-container">
  <div class="row row-between">
    <h2>All Students</h2>
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
        <th>Info</th>
        <th>Student ID</th>
        <th>Grade</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (getAllStudents() as $student): ?>
        <?php $level = getLevelByID($student["level_id"]); ?>
        <tr class="table-row" data-id="<?= $student['id'] ?>">
          <td><?= htmlspecialchars($student['name']) ?></td>
          <td><?= htmlspecialchars($student['id']) ?></td>
          <td><?= $level ? htmlspecialchars($level["name"]) : "N/A" ?></td> <!-- Utilisation de "name" pour le niveau -->
          <td><?= htmlspecialchars($student['phone_number']) ?></td>
          <td><?= htmlspecialchars($student['address']) ?></td>
          <td class="row">
            <button><i class="ri-edit-box-line"></i></button>
            <button onclick="deleteStudent(<?= $student['id'] ?>)"><i class="ri-delete-bin-6-line"></i></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>

<div class="form-container">
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

<div class="custom-alert" id="customAlert">
  <div class="alert-message" id="alertMessage"></div>
  <button class="alert-button" onclick="closeAlert()">OK</button>
</div>