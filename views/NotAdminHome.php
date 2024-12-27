<?php $days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]; ?>

<section class="home">
  <h1><?= strtoupper($role) ?></h1>
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
    </ul>
  </div>

  <div class="annoucements infos-card">
    <div class="row row-between">
      <h2>Annoucements</h2>
      <small>View All</small>
    </div>
    <ul>
    </ul>
  </div>
</aside>

<script src="./app/assets/js/calendar.js"></script>