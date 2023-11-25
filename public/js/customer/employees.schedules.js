function loadForm(dateStr, st, srv) {
  let htmlForm = `
        <form id='form' action='' method='post'>
              
            <label for='title'>Titulo agenda</label>
            <input type='text' class='input' name='title' id='title' required>
                
            <label for='date'>Fecha</label>
            <input type='date' class='input' name='date' id='date' required value='${dateStr}'>

            <label for='startTime'>Desde</label>
            <input type='time' class='input' name='startTime' id='startTime' required>

            <label for='endTime'>Hasta</label>
            <input type='time' class='input' name='endTime' id='endTime' required>

            <label for='color'>Selecciona un color</label>
            <input type='color' class='color' name='color' id='color' required>

            <input type='hidden' class='input' name='employeeId' id='employeeId' value='${st}' required>
            <input type='hidden' class='input' name='serviceId' id='serviceId' value='${srv}' required>
        </form>
    `;
  alertForm(htmlForm, "Agendar", createSchedule, showDataCalendar);
}

async function createSchedule() {
  const formData = new FormData(document.getElementById("form"));
  if (
    formData.get("title") === "" ||
    formData.get("date") === "" ||
    formData.get("startTime") === "" ||
    formData.get("endTime") === "" ||
    formData.get("color") === ""
  ) {
    Swal.showValidationMessage("Todos los campos son obligatorios");
    return;
  }

  formData.append("route", "createSchedule");
  const response = await fetch("../../routes/schedule.router.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  if (!response.ok) {
    Swal.showValidationMessage(data.message);
    return;
  }
  return data;
}

async function showNamesStylist(id) {
  const response = await fetch(`../../routes/user.router.php?route=idEmployee&id=${id}`);
  const data = await response.json();
  if(!response.ok) {
    document.querySelector(".title").innerHTML = `${data.message}`;
    console.error(data.message);
    return;
  }
  document.querySelector(".title").innerHTML = `Crea una nueva agenda con <span style='color: var(--primary-color);'>${data.names} ${data.lastnames}</span>`;
}

async function getCalendarStylist(employeeId, serviceId) {
  const response = await fetch(`../../routes/schedule.router.php?route=calendarEmployee&employeeId=${employeeId}&serviceId=${serviceId}`);
  const data = await response.json();
  if(!response.ok) {
    document.getElementById("calendar").innerHTML = `
      <div class='alert'>
        <p>${data.message}</p>
        <img src='../../public/assets/calendar.png' alt='calendar' />
      </div>
    `
    console.error(data.message);
    return [];
  }
  let events = data.map((event) => {
    return {
      _id: event.id_schedules,
      title: event.title,
      start: `${event.date_schedules}T${event.start_time}`,
      end: `${event.date_schedules}T${event.end_time}`,
      color: event.color
    }
  });
  return events;
}

async function showDataCalendar() {
  let urlParams = new URLSearchParams(location.search);
  let employeeId = urlParams.get("st");
  let serviceId = urlParams.get("srv");
  let eventsSchedules = await getCalendarStylist(employeeId, serviceId);
  await showNamesStylist(employeeId);
  if(!eventsSchedules.length) return;
  let calendarEl = document.getElementById("calendar");
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",

    dateClick: (info) => {
      loadForm(info.dateStr, employeeId, serviceId);
    },
    eventClick: async (info) => {
      await getCalendarById(info.event._def.extendedProps._id);
    },
    events: eventsSchedules,
  });
  calendar.render();

}

document.addEventListener("DOMContentLoaded", async () => {
  await showDataCalendar();
});

