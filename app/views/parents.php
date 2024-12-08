<div class="flex-1 table-container">
  <div class="row row-between">
    <h2>All Parents</h2>
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
        <th>Email</th>
        <th>Telephone</th>
        <th>address</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (getAllParents() as $parent): ?>
        <tr class="table-row">
          <td><?= htmlspecialchars($parent['prenom'] . " " . $parent['nom']) ?></td>
          <td><?= htmlspecialchars($parent['email']) ?></td>
          <td><?= htmlspecialchars($parent['telephone']) ?></td>
          <td><?= htmlspecialchars($parent['adresse']) ?></td>
          <td class="row">
            <button><i class="ri-edit-box-line"></i></button>
            <button><i class="ri-delete-bin-6-line"></i></button>
          </td>
        </tr>
      <?php endforeach ?>
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