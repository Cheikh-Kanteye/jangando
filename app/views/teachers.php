<?php
$pastelColors = ['#FFB3BA', '#FFDFBA', '#FFFFBA', '#BAFFC9',   '#BAE1FF', '#D6BAFF'];
?>

<div class="flex-1 table-container">
  <div class="row row-between">
    <h2>All Teachers</h2>
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
        <th>Teacher ID</th>
        <th>Subjects</th>
        <th>Classes</th>
        <th>Phone</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (getAllTeachers() as $teacher): ?>
        <tr>
          <td><?= htmlspecialchars($teacher['prenom'] . $teacher["nom"]) ?></td>
          <td><?= htmlspecialchars($teacher['id']) ?></td>
          <td>
            <?php $subjects = array_slice(getSubjectsByTeacher($teacher["id"]), 0, 3) ?>
            <p>
              <?php foreach ($subjects as $subject): ?>
                <?php $randomColor = $pastelColors[array_rand($pastelColors)]; ?>
                <small class="badge" style="background: <?= $randomColor ?>;"><?= $subject["nom_matiere"] ?></small>
              <?php endforeach ?>
            </p>
          </td>
          <td>-----</td>
          <td><?= htmlspecialchars($teacher['telephone']) ?></td>
          <td><?= htmlspecialchars($teacher['adresse']) ?></td>
          <td class="row">
            <button><i class="ri-edit-box-line"></i></button>
            <button><i class="ri-delete-bin-6-line"></i></button>
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