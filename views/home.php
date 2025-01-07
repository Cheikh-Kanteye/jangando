<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}
?>


<section class="home">
  <div class="stats">
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4><?= $students->count() ?></h4>
      <p>Student</p>
    </div>
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4><?= $teachers->count() ?></h4>
      <p>Teachers</p>
    </div>
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4>12</h4>
      <p>Parents</p>
    </div>

  </div>

  <div class="diagram-container">
    <div class="students-diagram diagram">
      <div class="row row-between">
        <h5>Students</h5>
        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <canvas
        id="students-diagram"
        data-male="<?= $students->getCountByGender('MALE') ?>"
        data-female="<?= $students->getCountByGender('FEMALE') ?>"></canvas>
    </div>

    <div class="attendances-diagram diagram">
      <div class="row row-between">
        <h5>Attendances</h5>
        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>

      <canvas id="attendances-diagram"></canvas>
    </div>

    <div class="finance-diagram diagram">
      <div class="row row-between">
        <h5>Finances</h5>
        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>

      <canvas id="finance-diagram"></canvas>
    </div>
  </div>
</section>


<?php require_once "./partials/InfosSidebar.php" ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/assets/js/calendar.js"></script>
<script src="/assets/js/home.js"></script>