const currentDate = document.querySelector(".current-date");
const days = document.querySelector(".days");
const controlBtn = document.querySelectorAll(".control-btn");

let date = new Date(),
  currentYear = date.getFullYear(),
  currentMonth = date.getMonth();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

const renderCalendar = () => {
  let firstDayofMonth = new Date(currentYear, currentMonth, 1).getDay();
  let lastDateofMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  let lastDayofMonth = new Date(
    currentYear,
    currentMonth,
    lastDateofMonth
  ).getDay();
  let lastDateofLastMonth = new Date(currentYear, currentMonth, 0).getDate();
  let li = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    li += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    const isToday =
      i == date.getDate() &&
      new Date().getMonth() == currentMonth &&
      currentYear == new Date().getFullYear();

    const className = isToday ? "active" : "";

    li += `<li class="${className}">${i}</li>`;
  }

  // Ajouter les jours inactifs après la fin du mois actuel
  for (let i = lastDayofMonth + 1; i <= 6; i++) {
    li += `<li class="inactive">${i - lastDayofMonth}</li>`;
  }

  days.innerHTML = li;
  currentDate.innerText = `${months[currentMonth]} ${currentYear}`;
};

renderCalendar();

controlBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (btn.id === "prev") {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
    } else {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
    }
    renderCalendar();
  });
});
