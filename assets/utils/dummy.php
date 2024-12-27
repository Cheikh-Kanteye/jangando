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

$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

$pastelColors = [
  '#FFB3BA',
  '#FFDFBA',
  '#FFFFBA',
  '#BAFFC9',
  '#BAE1FF',
  '#D6BAFF',
  '#FFD1DC',
  '#C1FFD7',
  '#FFF4C1',
  '#D5E8FF',
  '#E3CFFF',
  '#FFEBE1',
  '#DFFFD6',
  '#FCE1FF',
  '#F1FFE3',
  '#E5F7FF',
  '#FFE7E7',
  '#E9FFD8'
];
