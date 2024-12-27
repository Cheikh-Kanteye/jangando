document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("big-calendar");
  const events = [
    {
      title: "TP C++",
      start: "2024-12-09T08:00:00",
      end: "2024-12-09T12:00:00",
      backgroundColor: "#e1f8fe", // Bleu pastel
    },
    {
      title: "Anglais",
      start: "2024-12-09T14:00:00",
      end: "2024-12-09T16:00:00",
      backgroundColor: "#fefbe7", // Beige pastel
    },
    {
      title: "PHP/MySQL",
      start: "2024-12-10T08:00:00",
      end: "2024-12-10T10:00:00",
      backgroundColor: "#ffe9e9", // Rose pastel
    },
    {
      title: "C Algo",
      start: "2024-12-10T10:00:00",
      end: "2024-12-10T12:00:00",
      backgroundColor: "#e9ffe9", // Vert pastel
    },
    {
      title: "UML",
      start: "2024-12-11T08:00:00",
      end: "2024-12-11T10:00:00",
      backgroundColor: "#fff2e9", // Orange clair pastel
    },
    {
      title: "POO C++",
      start: "2024-12-11T10:00:00",
      end: "2024-12-11T12:00:00",
      backgroundColor: "#f1e9ff", // Violet pastel
    },
    {
      title: "Coaching",
      start: "2024-12-12T13:00:00",
      end: "2024-12-12T15:00:00",
      backgroundColor: "#e9fdff", // Cyan pastel
    },
    {
      title: "Programmation Python 1",
      start: "2024-12-12T15:00:00",
      end: "2024-12-12T18:00:00",
      backgroundColor: "#fffce9", // Jaune clair pastel
    },
    {
      title: "Fondamentaux Réseaux",
      start: "2024-12-13T08:00:00",
      end: "2024-12-13T10:00:00",
      backgroundColor: "#e9e9ff", // Bleu clair pastel
    },
    {
      title: "Coaching",
      start: "2024-12-13T13:00:00",
      end: "2024-12-13T15:00:00",
      backgroundColor: "#ffe9f6", // Rose clair pastel
    },
    {
      title: "Langage SQL",
      start: "2024-12-13T15:00:00",
      end: "2024-12-13T16:00:00",
      backgroundColor: "#e9fff6", // Vert menthe pastel
    },
    {
      title: "S33 (Statistiques)",
      start: "2024-12-14T08:00:00",
      end: "2024-12-14T12:00:00",
      backgroundColor: "#fef3e1", // Abricot pastel
    },
    {
      title: "TP Algo",
      start: "2024-12-14T14:00:00Z",
      end: "2024-12-14T16:00:00Z",
      backgroundColor: "#fefbe7", // Beige pastel (déjà défini)
    },
  ];

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
    slotLabelFormat: {
      hour: "2-digit",
      minute: "2-digit",
      meridiem: false,
      hour12: false,
    },
    slotMinTime: "08:00:00",
    slotMaxTime: "18:00:00",
    allDaySlot: false,
    events: events,
  });

  calendar.render();
});
