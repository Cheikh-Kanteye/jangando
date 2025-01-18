<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}
?>


<?php $teacher = $teachers->findById($segments[1]); ?>

<section class="home">
  <div class="user_infos grid grid-col-2">
    <?php renderProfile($teacher) ?>
    <div class="grid grid-col-2">
      <?php
      renderDiagramItem("/assets/images/singleAttendance.png", "90%", "Attendance");
      renderDiagramItem("/assets/images/singleBranch.png", "2", "Branches");
      renderDiagramItem("/assets/images/singleLesson.png", "6", "Lessons");
      renderDiagramItem("/assets/images/singleClass.png", "6", "Classes");
      ?>
    </div>
  </div>

  <?php require_once "./includes/schedule.php" ?>
</section>

<?php require_once "./partials/InfosSidebar.php" ?>


<script src="/assets/js/schedule.js"></script>