async function getSchedulesCustomer() {
  const response = await fetch(
    "../../routes/schedule.router.php?route=calendarCustomer"
  );
  const data = await response.json();
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

async function getSchedulesCustomerForDate(date) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=dayCustom&date=${date}`
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
    divTitle.style.backgroundColor = `${row.color}`;
    divTitle.innerHTML = `<h4>${row.title}</h4>`;
    const divContent = document.createElement("div");
    divContent.className = "box-content";

    divContent.innerHTML = `
      <p><strong>Estilita:</strong> ${row.employee_names} ${row.employee_lastnames}</p>
      <p><strong>Servicio:</strong> ${row.service_name}</p>
      <p><strong>Precio:</strong> ${formatCOP(row.price)}</p>
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
  a.href = "./customer.appointments.php";
  document.getElementById("calendar").appendChild(a);
}

document.addEventListener("DOMContentLoaded", async () => {
  let urlParams = new URLSearchParams(location.search);
  let view = urlParams.get("view");
  let date = urlParams.get("date");
  if (view === "day") {
    await getSchedulesCustomerForDate(date);
    return;
  }
  let calendarEl = document.getElementById("calendar");
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",
    eventClick: async (info) => {
      await getCalendarById(info.event._def.extendedProps._id);
    },
    dateClick: (info) => {
      location.href = `./customer.appointments.php?view=day&date=${info.dateStr}`;
    },
    events: await getSchedulesCustomer(),
  });
  calendar.render();
});
