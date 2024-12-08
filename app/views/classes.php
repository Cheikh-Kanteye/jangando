<div class="subjects_container">
  <h1>School Classes</h1>
  <div class="cards-grid">
    <?php foreach (getAllClasses() as $classe): ?>
      <div class="card">
        <div class="card-icon">🎓</div>
        <h2><?= $classe["nom"] ?></h2>
        <p>Primary focus on STEM subjects with additional language arts emphasis.</p>
        <span class="hours"><?= $classe["capacite"] ?> students</span>
      </div>
    <?php endforeach ?>
  </div>
</div>