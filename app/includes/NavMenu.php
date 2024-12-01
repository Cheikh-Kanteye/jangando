<?php
$menuItems = [
  [
    "href" => "/",
    "icon" => "ri-dashboard-line",
    "text" => "Home",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/students",
    "icon" => "ri-group-line",
    "text" => "Students",
    "authorized" => ["admin", "teacher"],
  ],
  [
    "href" => "/teachers",
    "icon" => "ri-presentation-line",
    "text" => "Teachers",
    "authorized" => ["admin", "teacher"],
  ],
  [
    "href" => "/parents",
    "icon" => "ri-team-line",
    "text" => "Parents",
    "authorized" => ["admin", "teacher"],
  ],
  [
    "href" => "/subjects",
    "icon" => "ri-book-line",
    "text" => "Subjects",
    "authorized" => ["admin"],
  ],
  [
    "href" => "/classes",
    "icon" => "ri-home-2-line",
    "text" => "Classes",
    "authorized" => ["admin", "teacher"],
  ],
  [
    "href" => "/lessons",
    "icon" => "ri-book-open-line",
    "text" => "Lessons",
    "authorized" => ["admin", "teacher"],
  ],
  [
    "href" => "/exams",
    "icon" => "ri-file-list-line",
    "text" => "Exams",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/assignments",
    "icon" => "ri-file-copy-line",
    "text" => "Assignments",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/results",
    "icon" => "ri-trophy-line",
    "text" => "Results",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/attendance",
    "icon" => "ri-user-follow-line",
    "text" => "Attendance",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/events",
    "icon" => "ri-calendar-event-line",
    "text" => "Events",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
  [
    "href" => "/announcements",
    "icon" => "ri-megaphone-line",
    "text" => "Announcements",
    "authorized" => ["admin", "student", "parent", "teacher"],
  ],
];

?>

<ul class="menu">
  <?php foreach ($menuItems as $item): ?>
    <?php if (in_array($_SESSION['role'], $item["authorized"])): ?>
      <li>
        <a href="<?= htmlspecialchars($item["href"]) ?>" class="link-items">
          <i class="<?= htmlspecialchars($item["icon"]) ?>"></i>
          <span><?= htmlspecialchars($item["text"]) ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>