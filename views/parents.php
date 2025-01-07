<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}

$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalResults = count($parents->findAll());

list($offset, $paginationHtml) = paginate($totalResults, $resultsPerPage, $currentPage, 'parents');
$parentsList = $parents->findAllPaginated($offset, $resultsPerPage);
?>

<div class="flex-1 table-container animate-fade-in">
  <div class="row row-between">
    <h2>All Parents</h2>
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
        <th>Email</th>
        <th>Telephone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($parentsList as $parent): ?>
        <tr class="table-row">
          <td><?= htmlspecialchars($parent['surname']) ?> <?= htmlspecialchars($parent['name']) ?></td>
          <td><?= htmlspecialchars($parent['email']) ?></td>
          <td><?= htmlspecialchars($parent['phone']) ?></td>
          <td class="row">
            <button class="btn edit-btn"
              data-id="<?= $parent['id'] ?>"
              data-username="<?= htmlspecialchars($parent['id']) ?>"
              data-name="<?= htmlspecialchars($parent['name']) ?>"
              data-surname="<?= htmlspecialchars($parent['surname']) ?>"
              data-email="<?= htmlspecialchars($parent['email']) ?>"
              data-phone="<?= htmlspecialchars($parent['phone']) ?>"
              data-address="<?= htmlspecialchars($parent['address']) ?>">
              <i class="ri-edit-box-line"></i>
            </button>
            <button class="btn"><i class="ri-delete-bin-6-line"></i></button>
          </td>
        </tr>
      <?php endforeach  ?>
    </tbody>
  </table>
</div>

<div class="form-container animate-scale-in">
  <form method="post" action="save_parent.php" id="parent-form">
    <input type="hidden" name="id" id="parent-id" />
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" />
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" />
    </div>
    <div class="form-group">
      <label for="surname">Surname</label>
      <input type="text" name="surname" id="surname" />
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" />
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" />
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" id="address" />
    </div>
    <button type="submit" class="btn">Save</button>
  </form>
</div>

<script>
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
      document.querySelector(".form-container").classList.add("show")
      document.getElementById('parent-id').value = this.dataset.id;
      document.getElementById('username').value = this.dataset.username;
      document.getElementById('name').value = this.dataset.name;
      document.getElementById('surname').value = this.dataset.surname;
      document.getElementById('email').value = this.dataset.email;
      document.getElementById('phone').value = this.dataset.phone;
      document.getElementById('address').value = this.dataset.address;
    });
  });
</script>