const studentDiagram = document.getElementById("students-diagram");
const studentDiagramCtx = document
  .getElementById("students-diagram")
  .getContext("2d");

const attendancesDiagramCtx = document
  .getElementById("attendances-diagram")
  .getContext("2d");

const financeDiagramCtx = document
  .getElementById("finance-diagram")
  .getContext("2d");

const StudentData = {
  labels: ["Female", "Male"],
  datasets: [
    {
      label: "Students",
      data: [
        studentDiagram.getAttribute("data-male"),
        studentDiagram.getAttribute("data-female"),
      ],
      backgroundColor: ["#ead474", "#c4ebfc"],
      hoverOffset: 4,
    },
  ],
};

const attendancesData = {
  labels: ["Mon", "Tue", "Wed", "Thu", "Fru", "Sat"],
  datasets: [
    {
      label: "Present",
      data: [65, 59, 80, 81, 56, 55, 40],
      backgroundColor: ["#ead474"],
    },
    {
      label: "Absent",
      data: [5, 2, 8, 15, 0, 1, 1],
      backgroundColor: ["#c4ebfc"],
    },
  ],
};

const financeData = {
  labels: [
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
  ],
  datasets: [
    {
      label: "Income",
      data: [
        4500, 4200, 4800, 4700, 4900, 5000, 5300, 5200, 5100, 5300, 5500, 5600,
      ],
      fill: false,
      borderColor: "#c4ebfc",
      backgroundColor: "#c4ebfc",
      tension: 0.1,
    },
    {
      label: "Expense",
      data: [
        3000, 3200, 3100, 3300, 3400, 3200, 3100, 3500, 3400, 3600, 3700, 3900,
      ],
      fill: false,
      borderColor: "#ead474",
      backgroundColor: "#ead474",
      tension: 0.1,
    },
  ],
};

new Chart(studentDiagramCtx, {
  type: "doughnut",
  data: StudentData,
});

new Chart(attendancesDiagramCtx, {
  type: "bar",
  data: attendancesData,
});

new Chart(financeDiagramCtx, {
  type: "line",
  data: financeData,
});
