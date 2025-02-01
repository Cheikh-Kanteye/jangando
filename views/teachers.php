<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($teachers->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'teachers');
$teachersList = $teachers->findAllPaginated($offset, $resultsPerPage);
?>

<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All Teachers</h2>
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
        <th>Subjects</th>
        <th>Classes</th>
        <th>Phone</th>
        <th>Address</th>
        <?php if ($role == "admin"): ?> actions <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($teachersList as $teacher): ?>
        <?php $teacherSubjects = array_slice($teachers->findTeacherWithSubjects($teacher["id"]), 0, 3) ?>
        <tr role="link"
          tabindex="0"
          onclick="window.location='/teachers/<?= $teacher['id'] ?>'"
          class="table-row">
          <td><?= htmlspecialchars($teacher['name']) ?> <?= htmlspecialchars($teacher['surname']) ?></td>
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
          <?php if ($role == "admin") : ?>
            <td class="row">
              <button
                class="btn edit-btn"
                data-id="<?= $teacher['id'] ?>"
                data-username="<?= htmlspecialchars($teacher['surname']) ?>"
                data-name="<?= htmlspecialchars($teacher['name']) ?>"
                data-surname="<?= htmlspecialchars($teacher['surname']) ?>"
                data-email="<?= htmlspecialchars($teacher['email']) ?>"
                data-phone="<?= htmlspecialchars($teacher['phone']) ?>"
                data-address="<?= htmlspecialchars($teacher['address']) ?>"
                data-bloodtype="<?= htmlspecialchars($teacher['bloodType'] ?? '') ?>"
                data-birthday="<?= htmlspecialchars($teacher['birthday'] ?? '') ?>">
                <i class="ri-edit-box-line"></i>
              </button>
              <a class="btn" href="/delete_teacher?id=<?= $teacher['id'] ?>"><i class="ri-delete-bin-6-line"></i></a>
            </td>
          <?php endif ?>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  <?= $paginationHtml; ?>
</div>
<div class="form-container animate-scale-in">
  <form action="/save_teacher" method="post">
    <input type="hidden" id="teacher-id" name="teacher-id">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="surname">Surname:</label>
      <input type="text" id="surname" name="surname">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone">
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address">
    </div>
    <div class="form-group">
      <label for="img">Image:</label>
      <input type="file" id="img" name="img">
    </div>
    <div class="form-group">
      <label for="bloodType">Blood Type:</label>
      <input type="text" id="bloodType" name="bloodType">
    </div>
    <div class="form-group">
      <label for="birthday">Birthday:</label>
      <input type="date" id="birthday" name="birthday">
    </div>
    <button type="submit" class="btn">Save</button>
  </form>
</div>


<script>
  document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function(e) {
      e.stopPropagation();
      document.querySelector(".form-container").classList.add("show");
      document.getElementById("teacher-id").value = this.dataset.id;
      document.getElementById("username").value = this.dataset.username;
      document.getElementById("name").value = this.dataset.name;
      document.getElementById("surname").value = this.dataset.surname;
      document.getElementById("email").value = this.dataset.email;
      document.getElementById("phone").value = this.dataset.phone;
      document.getElementById("address").value = this.dataset.address;
      document.getElementById("bloodType").value = this.dataset.bloodtype || "";
      const rawDate = this.dataset.birthday || "";
      const formattedDate = rawDate ? rawDate.split(" ")[0] : "";
      document.getElementById("birthday").value = formattedDate;
      document.querySelector("form").setAttribute("action", `/update_teacher?id=${this.dataset.id}`)
    });
  });
</script>