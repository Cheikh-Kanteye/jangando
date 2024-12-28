<?php
$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($teachers->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'teachers');
$teachersList = $teachers->findAllPaginated($offset, $resultsPerPage);
?>

<div class="flex-1 table-container">
  <div class="row row-between">
    <h2>All Teachers</h2>
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
        <th>Teacher ID</th>
        <th>Subjects</th>
        <th>Classes</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($teachersList as $teacher): ?>
        <?php $teacherSubjects = array_slice($teachers->findTeacherWithSubjects($teacher["id"]), 0, 3) ?>
        <tr role="link"
          tabindex="0"
          onclick="window.location='/teachers/<?= $teacher['id'] ?>'"
          class="table-row">
          <td><?= htmlspecialchars($teacher['surname']) ?> <?= htmlspecialchars($teacher['name']) ?></td>
          <td><?= htmlspecialchars($teacher['id']); ?></td>
          <td>
            <p>
              <?php foreach ($teacherSubjects as $subject): ?>
                <?php $randomColor = $pastelColors[array_rand($pastelColors)]; ?>
                <small class="badge" style="background: <?= $randomColor ?>;"><?= $subject["subject_name"] ?></small>
              <?php endforeach ?>
            </p>
          </td>
          <td><?= htmlspecialchars($teacher['email']); ?></td>
          <td><?= htmlspecialchars($teacher['phone']); ?></td>
          <td><?= htmlspecialchars($teacher['address']); ?></td>
          <td class="row">
            <button class="btn"><i class="ri-edit-box-line"></i></button>
            <a class="btn" href="/delete_teacher?id=<?= $teacher['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  <?= $paginationHtml; ?>
</div>