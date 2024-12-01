<?php
$announcements = [
  [
    "title" => "Parent-Teacher Meeting",
    "date" => "2024-11-25",
    "description" => "Join us for the upcoming parent-teacher meeting to discuss student progress."
  ],
  [
    "title" => "Science Fair",
    "date" => "2024-12-01",
    "description" => "Students are invited to participate in the annual science fair. Showcase your projects!"
  ],
  [
    "title" => "Winter Break Announcement",
    "date" => "2024-12-20",
    "description" => "The school will be closed for winter break from December 20th to January 5th."
  ]
];


$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
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
      <h4>1265</h4>
      <p>Student</p>
    </div>
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4>124</h4>
      <p>Teachers</p>
    </div>
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4>960</h4>
      <p>Parents</p>
    </div>
    <div class="stats-card">
      <div class="row row-between">
        <small class="badge">2024/25</small>

        <button>
          <i class="ri-more-fill"></i>
        </button>
      </div>
      <h4>30</h4>
      <p>Staffs</p>
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

      <canvas id="students-diagram"></canvas>
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
<aside class="infos">
  <div class="wrapper infos-card">
    <div class="row row-between header">
      <p class="current-date"></p>
      <div class="row icons">
        <span id="prev" class="control-btn"><i class="ri-arrow-left-s-line"></i>
        </span>
        <span id="next" class="control-btn"><i class="ri-arrow-right-s-line"></i>
        </span>
      </div>
    </div>

    <div class="calendar">
      <ul class="weeks">
        <?php foreach ($days as $day): ?>
          <li><?= $day ?></li>
        <?php endforeach ?>
      </ul>
      <ul class="days"></ul>
    </div>
  </div>

  <div class="events infos-card">
    <div class="row row-between">
      <h2>Events</h2>
      <button>
        <i class="ri-more-fill"></i>
      </button>
    </div>
    <ul>
      <?php $events = array_slice(getAllEvents(), 0, 3) ?>
      <?php foreach ($events as $event): ?>
        <li>
          <div class="row row-between">
            <h4 class="event-title"><?= htmlspecialchars($event['titre']) ?></h4>
            <small><?= htmlspecialchars($event['date_debut']) ?></small>
          </div>
          <p class="event-descrition">
            <?= htmlspecialchars($event['description']) ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="annoucements infos-card">
    <div class="row row-between">
      <h2>Annoucements</h2>
      <small>View All</small>
    </div>
    <ul>
      <?php $announcements = array_slice(getAllAnnouncements(), 0, 3) ?>
      <?php foreach ($announcements as $announcement): ?>
        <li>
          <div class="row row-between">
            <h4 class="event-title"><?= htmlspecialchars($announcement['titre']) ?></h4>
            <small class="badge" style="text-wrap: nowrap;"><?= date('d/m/Y', strtotime($announcement['date'])) ?></small>
          </div>
          <p class="event-descrition">
            <?= htmlspecialchars($announcement['description']) ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</aside>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./app/assets/js/home.js"></script>
<script src="./app/assets/js/calendar.js"></script>