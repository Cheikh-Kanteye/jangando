<aside class="infos">
  <?php if (in_array($segments[0], ["students", "teachers"])): ?>
    <div class="infos-card">
      <h2>Shortcuts</h2>
      <?php
      $shortcuts = ["classes", "subjects", "lessons", "exams", "assignments", "attendance"];
      ?>
      <ul class="row" style="flex-wrap: wrap;">
        <?php foreach ($shortcuts as $shortcut): ?>
          <li>
            <p class="badge text-light" style="background: <?= $pastelColors[array_rand($pastelColors)] ?>; font-size: 14px;">
              <?= ucfirst($shortcut) ?>
            </p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php else: ?>
    <div class="wrapper infos-card">
      <div class="row row-between header">
        <p class="current-date"></p>
        <div class="row icons">
          <span id="prev" class="control-btn">
            <i class="ri-arrow-left-s-line"></i>
          </span>
          <span id="next" class="control-btn">
            <i class="ri-arrow-right-s-line"></i>
          </span>
        </div>
      </div>
      <div class="calendar">
        <ul class="weeks">
          <?php foreach ($days as $day): ?>
            <li><?= $day ?></li>
          <?php endforeach; ?>
        </ul>
        <ul class="days"></ul>
      </div>
    </div>
  <?php endif; ?>

  <div class="events infos-card">
    <div class="row row-between">
      <h2>Events</h2>
      <button>
        <i class="ri-more-fill"></i>
      </button>
    </div>
    <ul class="events">
      <?php foreach (array_slice($events->findAll(), 0, 3) as $event): ?>
        <li class="row row-between items-start">
          <p><?= htmlspecialchars($event["title"]) ?></p>
          <small><?= date("g:i A", strtotime($event["startTime"])) ?> - <?= date("g:i A", strtotime($event["endTime"])) ?></small>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="announcements infos-card">
    <div class="row row-between">
      <h2>Announcements</h2>
      <small>View All</small>
    </div>
    <ul></ul>
  </div>
</aside>