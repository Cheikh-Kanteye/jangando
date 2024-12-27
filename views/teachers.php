<?php
$results_per_page = 10;
$number_of_results = count($teachers->findAll());
$number_of_pages = ceil($number_of_results / $results_per_page);
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$this_page_first_result = ($current_page - 1) * $results_per_page;
$teachers_list = $teachers->findAllPaginated($this_page_first_result, $results_per_page);
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
      <?php foreach ($teachers_list as $teacher): ?>
        <?php $teacher_subjects = array_slice($teachers->findTeacherWithSubjects($teacher["id"]), 0, 3) ?>
        <tr role="link"
          tabindex="0"
          onclick="window.location='/teachers/<?= $teacher['id'] ?>'"
          class="table-row">
          <td><?= htmlspecialchars($teacher['surname']) ?> <?= htmlspecialchars($teacher['name']) ?></td>
          <td><?= htmlspecialchars($teacher['id']); ?></td>
          <td>
            <p>
              <?php foreach ($teacher_subjects as $subject): ?>
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
  <div class="pagination">
    <?php for ($page = 1; $page <= $number_of_pages; $page++): ?>
      <button
        onclick="window.location.href='teachers?page=<?= $page; ?>'"
        class="tab <?= $page === $current_page ? 'active' : '' ?>">
        <span><?= $page; ?></span>
      </button>
    <?php endfor; ?>
  </div>
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