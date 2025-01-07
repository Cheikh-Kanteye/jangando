<?php
$days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
$cstudent = $students->findById($segments[1]); ?>

<section class="home">
  <div class="user_infos grid grid-col-2">
    <div class="profile row">
      <div class="profile_img">
        <img src="https://i.pravatar.cc/300" alt="student">
      </div>
      <div class="details">
        <h4><?= $cstudent["surname"] . " " . $cstudent["name"] ?></h4>
        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedi</p>

        <div>
          <div class="row">
            <i class="ri-contrast-drop-2-line"></i>
            <p><?= $cstudent["bloodType"] ?></p>
          </div>
          <div class="row">
            <i class="ri-calendar-2-line"></i>
            <p>
              <?php
              $date = new DateTime($cstudent["birthday"]);
              echo $date->format('F d, Y');
              ?>
            </p>
          </div>

          <div class="row">
            <i class="ri-mail-line"></i>
            <p><?= $cstudent["email"] ?></p>
          </div>
          <div class="row">
            <i class="ri-phone-line"></i>
            <p><?= $cstudent["phone"] ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="grid grid-col-2">
      <?php
      $stats = [
        ["icon" => "/assets/images/singleAttendance.png", "value" => "90%", "label" => "Attendance"],
        ["icon" => "/assets/images/singleBranch.png", "value" => "2", "label" => "Branches"],
        ["icon" => "/assets/images/singleLesson.png", "value" => "6", "label" => "Lessons"],
        ["icon" => "/assets/images/singleClass.png", "value" => "6", "label" => "Classes"]
      ];

      foreach ($stats as $stat) : ?>
        <div class="diagram row items-start">
          <img src="<?= $stat['icon'] ?>" alt="icon">
          <div>
            <h1 class="stats"><?= $stat['value'] ?></h1>
            <p class="text-light"><?= $stat['label'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="diagram">
    <h2>Schedule (GL2)</h2>
    <?php
    $classe = $classes->findById($cstudent["classId"]);
    $schedule = htmlspecialchars(json_encode($classe["schedule"]), ENT_QUOTES, 'UTF-8');
    ?>
    <div id='big-calendar' data-events='<?= $schedule ?>'></div>
  </div>
</section>

<?php require_once "./partials/InfosSidebar.php" ?>