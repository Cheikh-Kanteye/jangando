document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("big-calendar");

  // Récupérer et parser les données des événements
  const rawEvents = calendarEl.dataset.events
    ? calendarEl.dataset.events
    : "[]";

  try {
    let events = JSON.parse(rawEvents);

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
      events: JSON.parse(events),
      eventOverlap: false,
      height: "auto",

      eventDidMount: function (info) {
        const eventDate = new Date(info.event.start).toDateString();
        const todayDate = new Date().toDateString();

        if (eventDate === todayDate) {
          // Trouver l'élément parent <td> et changer son arrière-plan
          const parentTd = info.el.closest("td");
          if (parentTd) {
            parentTd.style.backgroundColor = "#e0f5ff";
          }
        }
      },
    });

    // Afficher le calendrier
    calendar.render();
  } catch (error) {
    console.error("Erreur lors de l'analyse des événements JSON:", error);
  }
});
