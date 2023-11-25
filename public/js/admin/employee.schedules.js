async function showNamesStylist(id) {
  const response = await fetch(
    `../../routes/user.router.php?route=idEmployee&id=${id}`
  );
  const data = await response.json();
  if (!response.ok) {
    document.querySelector(".title").innerHTML = `${data.message}`;
    console.error(data.message);
    return;
  }
  document.querySelector(
    ".title"
  ).innerHTML = `Agendas de <span style='color: var(--primary-color);'>${data.names} ${data.lastnames}</span>`;
}

async function getCalendarStylist(employeeId, serviceId) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=calendarEmployee&employeeId=${employeeId}&serviceId=${serviceId}`
  );
  const data = await response.json();
  if (!response.ok) {
    document.getElementById("calendar").innerHTML = `
        <div class='alert'>
          <p>${data.message}</p>
          <img src='../../public/assets/calendar.png' alt='calendar' />
        </div>
      `;
    console.error(data.message);
    return [];
  }
  let events = data.map((event) => {
    return {
      _id: event.id_schedules,
      title: event.title,
      start: `${event.date_schedules}T${event.start_time}`,
      end: `${event.date_schedules}T${event.end_time}`,
      color: event.color,
    };
  });
  return events;
}

async function getSchedulesEmployees(srv, st, date) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=dayEmp&serviceId=${srv}&employeeId=${st}&date=${date}`
  );
  const data = await response.json();
  if (!response.ok) {
    document.getElementById("calendar").innerHTML = `
        <div class='alert'>
          <p>${data.message}</p>
          <img src='../../public/assets/calendar.png' alt='calendar' />
        </div>
      `;
    console.error(data.message);
    return;
  }
  data.forEach(row => {
    const article = document.createElement("article");
    article.className = "article-info";

    const divTitle = document.createElement("div");
    divTitle.className = "box-title";
    divTitle.style.backgroundColor = `${row.color}`
    divTitle.innerHTML = `<h4>${row.title}</h4>`;
    const divContent = document.createElement("div");
    divContent.className = "box-content";

    divContent.innerHTML = `
      <p><strong>Cliente</strong> ${row.customer_names} ${row.customer_lastnames}</p>
      <p><strong>Estilita</strong> ${row.employee_names} ${row.employee_lastnames}</p>
      <p><strong>Servicio</strong> ${row.service_name}</p>
      <p><strong>Precio</strong> ${formatCOP(row.price)}</p>
      <p><strong>Inicia:</strong> ${formatDate(`${row.date_schedules}T${row.start_time}`)}</p>
      <p><strong>Finaliza:</strong> ${formatDate(`${row.date_schedules}T${row.end_time}`)}</p>
    `;
    article.append(divTitle);
    article.append(divContent);
    document.getElementById("calendar").appendChild(article);
  });
  const a = document.createElement("a");
  a.className = "laquo";
  a.innerHTML = "&laquo; Regresar"
  a.href = `./admin.stylistSchedules.php?srv=${srv}&st=${st}`;
  document.getElementById("calendar").appendChild(a);
}

async function showDataCalendar() {
  let urlParams = new URLSearchParams(location.search);
  let employeeId = urlParams.get("st");
  let serviceId = urlParams.get("srv");
  let view = urlParams.get("view");
  let date = urlParams.get("date");
  await showNamesStylist(employeeId);
  if (view === "day"){
    getSchedulesEmployees(serviceId, employeeId, date)
    return;
  } 

  let eventsSchedules = await getCalendarStylist(employeeId, serviceId);

  if (!eventsSchedules.length) return;
  let calendarEl = document.getElementById("calendar");
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",

    dateClick: (info) => {
      location.href = `./admin.stylistSchedules.php?view=day&srv=${serviceId}&st=${employeeId}&date=${info.dateStr}`;
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
