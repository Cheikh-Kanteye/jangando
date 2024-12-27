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
      <div class="diagram">attendance</div>
      <div class="diagram">grade</div>
      <div class="diagram">Lessons</div>
      <div class="diagram">class name</div>
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