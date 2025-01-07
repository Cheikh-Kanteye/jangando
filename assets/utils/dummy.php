<?php
$menuItems = [
  [
    "href" => "/",
    "icon" => "ri-dashboard-line",
    "text" => "Home",
    "authorized" => ["ADMIN", "STUDENT", "PARENT", "TEACHER"],
  ],
  [
    "href" => "/students",
    "icon" => "ri-group-line",
    "text" => "Students",
    "authorized" => ["ADMIN", "TEACHER"],
  ],
  [
    "href" => "/teachers",
    "icon" => "ri-presentation-line",
    "text" => "Teachers",
    "authorized" => ["ADMIN", "TEACHER"],
  ],
  [
    "href" => "/parents",
    "icon" => "ri-team-line",
    "text" => "Parents",
    "authorized" => ["ADMIN", "TEACHER"],
  ],
  [
    "href" => "/subjects",
    "icon" => "ri-book-line",
    "text" => "Subjects",
    "authorized" => ["ADMIN"],
  ],
  [
    "href" => "/classes",
    "icon" => "ri-home-2-line",
    "text" => "Classes",
    "authorized" => ["ADMIN", "TEACHER"],
  ],
  [
    "href" => "/exams",
    "icon" => "ri-file-list-line",
    "text" => "Exams",
    "authorized" => ["ADMIN", "STUDENT", "PARENT", "TEACHER"],
  ],
  [
    "href" => "/events",
    "icon" => "ri-calendar-event-line",
    "text" => "Events",
    "authorized" => ["ADMIN", "STUDENT", "PARENT", "TEACHER"],
  ],
  [
    "href" => "/announcements",
    "icon" => "ri-megaphone-line",
    "text" => "Announcements",
    "authorized" => ["ADMIN", "STUDENT", "PARENT", "TEACHER"],
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
