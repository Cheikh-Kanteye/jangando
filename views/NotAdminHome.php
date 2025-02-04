<?php
if (!defined('APP_ACCESS')) {
  header("Location: /");
  exit;
}


if ($_SESSION["role"] === "student") {
  $data = $students->findByEmail($_SESSION["user"]["username"]);
  $schedule = $data["schedule"] ?? [];
} else {
  $data = $teachers->findTeacherWithClasses($_SESSION["user"]["id"]);
  $classes = $data["classes"] ?? [];
}

$segments[0] = $_SESSION["user"]["role"] . "s";
?>

<section class="home" style="height: fit-content;">
  <div class="user_infos grid grid-col-2">
    <?php renderProfile($data) ?>
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

<?php require_once "./partials/InfosSidebar.php"; ?>

<script src="/assets/js/schedule.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-button");
    const panels = document.querySelectorAll(".tab-panel");

    tabs.forEach((tab, index) => {
      tab.addEventListener("click", () => {
        // Désactiver tous les onglets et panels
        tabs.forEach((t) => t.classList.remove("active"));
        panels.forEach((p) => {
          p.classList.remove("active");
          p.style.zIndex = 0;
        });

        // Activer l'onglet et le panel courant
        tab.classList.add("active");
        const panel = document.querySelector(`.tab-panel[data-tab-index="${index}"]`);
        panel.classList.add("active");
        panel.style.zIndex = 10;
      });
    });
  });
</script>