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
  console.log(data)
  if (!response.ok) {
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
  data.forEach((row) => {
    const article = document.createElement("article");
    article.className = "article-info";

    const divTitle = document.createElement("div");
    divTitle.className = "box-title";
    divTitle.style.backgroundColor = `${row.color}`;
    divTitle.innerHTML = `<h4>${row.title}</h4>`;
    const divContent = document.createElement("div");
    divContent.className = "box-content";

    divContent.innerHTML = `
      <p><strong>Cliente</strong> ${row.customer_names} ${
      row.customer_lastnames
    }</p>
      <p><strong>Estilita</strong> ${row.employee_names} ${
      row.employee_lastnames
    }</p>
      <p><strong>Servicio</strong> ${row.service_name}</p>
      <p><strong>Precio</strong> ${formatCOP(row.price)}</p>
      <p><strong>Inicia:</strong> ${formatDate(
        `${row.date_schedules}T${row.start_time}`
      )}</p>
      <p><strong>Finaliza:</strong> ${formatDate(
        `${row.date_schedules}T${row.end_time}`
      )}</p>
    `;

    const divCheck1 = document.createElement("div");
    divCheck1.className = "box-check";
    const divCheck2 = document.createElement("div");
    divCheck2.className = "box-check";
    const label1 = document.createElement("label");
    const label2 = document.createElement("label");
    label1.innerText = "Asistió";
    label1.style.marginLeft = "0.8rem";
    label2.innerText = "No Asistió";
    label2.style.marginLeft = "0.8rem";

    const check1 = document.createElement("input");
    check1.type = "radio";
    check1.name = `check${row.id_schedules}`;
    check1.addEventListener("change", async (e) => {
      await attendance(row.id_schedules, 1);
    });

    const check2 = document.createElement("input");
    check2.type = "radio";
    check2.name = `check${row.id_schedules}`;
    check2.addEventListener("change", async (e) => {
      await attendance(row.id_schedules, 0);
    });

    divCheck1.append(check1);
    divCheck1.append(label1);
    divCheck2.append(check2);
    divCheck2.append(label2);

    article.append(divTitle);
    article.append(divContent);
    article.append(divCheck1);
    article.append(divCheck2);

    if (row.attendance === "1") check1.checked = row.attendance;
    if (row.attendance === "0") check2.checked = row.attendance;

    document.getElementById("calendar").appendChild(article);
  });
  const a = document.createElement("a");
  a.className = "laquo";
  a.innerHTML = "&laquo; Regresar";
  a.href = `./admin.stylistSchedules.php?srv=${srv}&st=${st}`;
  document.getElementById("calendar").appendChild(a);
}

async function attendance(id, value) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=attendace&id=${id}&attendance=${value}`
  );
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  await showDataCalendar();
}

async function showDataCalendar() {
  let urlParams = new URLSearchParams(location.search);
  let employeeId = urlParams.get("st");
  let serviceId = urlParams.get("srv");
  let view = urlParams.get("view");
  let date = urlParams.get("date");
  await showNamesStylist(employeeId);
  if (view === "day") {
    getSchedulesEmployees(serviceId, employeeId, date);
    return;
  }

  let eventsSchedules = await getCalendarStylist(employeeId, serviceId);

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
