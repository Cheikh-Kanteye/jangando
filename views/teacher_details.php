<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}
?>


<?php $teacher = $teachers->findById($segments[1]); ?>

<section class="home">
  <div class="user_infos grid grid-col-2">
    <div class="profile row">
      <div class="profile_img">
        <img src="https://i.pravatar.cc/300" alt="student">
      </div>
      <div class="details">
        <h4><?= $teacher["surname"] . " " . $teacher["name"] ?></h4>
        <small class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedi</small>

        <div class="grid grid-col-2">
          <div class="row">
            <i class="ri-contrast-drop-2-line"></i>
            <small><?= $teacher["bloodType"] ?></small>
          </div>
          <div class="row">
            <i class="ri-calendar-2-line"></i>
            <small>
              <?php
              $date = new DateTime($teacher["birthday"]);
              echo $date->format('F d, Y');
              ?>
            </small>
          </div>

          <div class="row">
            <i class="ri-mail-line"></i>
            <small><?= $teacher["email"] ?></small>
          </div>
          <div class="row">
            <i class="ri-phone-line"></i>
            <small><?= $teacher["phone"] ?></small>
          </div>
        </div>
      </div>
    </div>
    <div class="grid grid-col-2">
      <div class="diagram row items-start">
        <img src="/assets/images/singleAttendance.png" alt="icon">
        <div>
          <h1 class="stats">90%</h1>
          <p class="text-light">Attendance</p>
        </div>
      </div>
      <div class="diagram row items-start">
        <img src="/assets/images/singleBranch.png" alt="icon">
        <div>
          <h1 class="stats">2</h1>
          <p class="text-light">Branches</p>
        </div>
      </div>
      <div class="diagram row items-start">
        <img src="/assets/images/singleLesson.png" alt="icon">
        <div>
          <h1 class="stats">6</h1>
          <p class="text-light">Lessons</p>
        </div>
      </div>
      <div class="diagram row items-start">
        <img src="/assets/images/singleClass.png" alt="icon">
        <div>
          <h1 class="stats">6</h1>
          <p class="text-light">Classes</p>
        </div>
      </div>
    </div>
  </div>
  <div class="diagram">
    <h2>Schedule (GL2)</h2>
    <div id='big-calendar'></div>
  </div>
</section>

<?php require_once "./partials/InfosSidebar.php" ?>


<script src="/assets/js/calendar.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src="/assets/js/big-calendar.js"></script>