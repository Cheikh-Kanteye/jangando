<div class="subjects_container">
  <h1>Course Subjects</h1>
  <div class="cards-grid">
    <?php foreach (getAllSubjects() as $subject): ?>
      <div class="card">
        <div class="card-icon">📚</div>
        <h2><?= $subject["nom"] ?></h2>
        <p><?= $subject["description"] ?></p>
        <span class="hours"><?= $subject["heures"] ?> hours</span>
      </div>
    <?php endforeach ?>
    <div class="card center" id="add-btn">
      <div class="card-icon"><i class="ri-add-fill"></i></div>
    </div>
  </div>
</div>