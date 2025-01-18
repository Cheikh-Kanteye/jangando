document.addEventListener("DOMContentLoaded", () => {
  const schedule = document.getElementById("schedule");
  const addButton = document.getElementById("addCourse");

  const pastelColors = [
    "#FFDFDF",
    "#DFFFD6",
    "#D6F0FF",
    "#FFFFD6",
    "#EAD6FF",
    "#FFECD6",
  ];

  let courses = [
    {
      id: 1,
      name: "Mathématiques",
      time: "08:00 - 09:30",
      color: pastelColors[0],
    },
    { id: 2, name: "Physique", time: "10:00 - 11:30", color: pastelColors[1] },
    {
      id: 3,
      name: "Informatique",
      time: "13:00 - 14:30",
      color: pastelColors[2],
    },
    { id: 4, name: "Anglais", time: "15:00 - 16:30", color: pastelColors[3] },
  ];

  function renderCourses() {
    schedule.innerHTML = "";
    courses.forEach((course, index) => {
      const courseElement = createCourseElement(course);
      schedule.appendChild(courseElement);
    });
  }

  function createCourseElement(course) {
    const courseCard = document.createElement("div");
    courseCard.className = "course-card";
    courseCard.style.backgroundColor = course.color;

    courseCard.innerHTML = `
            <div class="course-content">
                <div class="course-info">
                    <h3>${course.name}</h3>
                    <div class="course-time">${course.time}</div>
                </div>
                <div class="button-group">
                    <button onclick="editCourse(${course.id})" class="btn add-btn">Modifier</button>
                    <button onclick="deleteCourse(${course.id})" class="btn cancel-btn">Supprimer</button>
                </div>
            </div>
            <div class="edit-form" id="form-${course.id}">
                <input type="text" class="edit-name" value="${course.name}" placeholder="Nom du cours">
                <input type="text" class="edit-time" value="${course.time}" placeholder="Horaire (ex: 08:00 - 09:30)">
                <div class="button-group">
                    <button class="btn save-btn" onclick="saveCourse(${course.id})">Enregistrer</button>
                    <button class="btn cancel-btn" onclick="cancelEdit(${course.id})">Annuler</button>
                </div>
            </div>
        `;

    return courseCard;
  }

  // Make these functions global for the onclick events
  window.editCourse = (id) => {
    const course = courses.find((c) => c.id === id);
    const courseCard = document.querySelector(`#form-${id}`).parentElement;
    courseCard.classList.add("editing");
    document.querySelector(`#form-${id}`).classList.add("active");
  };

  window.saveCourse = (id) => {
    const form = document.querySelector(`#form-${id}`);
    const newName = form.querySelector(".edit-name").value;
    const newTime = form.querySelector(".edit-time").value;

    courses = courses.map((course) =>
      course.id === id ? { ...course, name: newName, time: newTime } : course
    );

    renderCourses();
  };

  window.cancelEdit = (id) => {
    const courseCard = document.querySelector(`#form-${id}`).parentElement;
    courseCard.classList.remove("editing");
    document.querySelector(`#form-${id}`).classList.remove("active");
  };

  window.deleteCourse = (id) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce cours ?")) {
      courses = courses.filter((course) => course.id !== id);
      renderCourses();
    }
  };

  addButton.addEventListener("click", () => {
    const newId = Math.max(...courses.map((c) => c.id)) + 1;
    const newColor = pastelColors[courses.length % pastelColors.length];

    courses.push({
      id: newId,
      name: "Nouveau Cours",
      time: "00:00 - 00:00",
      color: newColor,
    });

    renderCourses();
    editCourse(newId);
  });

  // Initial render
  renderCourses();
});
