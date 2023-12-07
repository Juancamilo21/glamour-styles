async function getSchedulesCustomer() {
  const response = await fetch(
    "../../routes/schedule.router.php?route=calendarCustomer"
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

async function getSchedulesCustomerForDate(date) {
  document.getElementById("calendar").innerHTML = "";
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
  addElementsDetailsSchedules(data);
}

function addElementsDetailsSchedules(data) {
  data.forEach((row) => {
    const article = document.createElement("article");
    article.className = "article-info";

    const divTitle = document.createElement("div");
    divTitle.className = "box-title";
    divTitle.style.backgroundColor = `${row.color}`;
    divTitle.innerHTML = `<h4>${row.title}</h4>`;
    const divContent = document.createElement("div");
    divContent.className = "box-content";
    divContent.style.marginBottom = "1rem";

    divContent.innerHTML = `
      <p style='margin-bottom: 0.5rem'><strong>Estilita:</strong> ${
        row.employee_names
      } ${row.employee_lastnames}</p>
      <p style='margin-bottom: 0.5rem'><strong>Servicio:</strong> ${
        row.service_name
      }</p>
      <p style='margin-bottom: 0.5rem'><strong>Precio:</strong> ${formatCOP(
        row.price
      )}</p>
      <p style='margin-bottom: 0.5rem'><strong>Inicia:</strong> ${formatDate(
        `${row.date_schedules}T${row.start_time}`
      )}</p>
      <p style='margin-bottom: 0.5rem'><strong>Finaliza:</strong> ${formatDate(
        `${row.date_schedules}T${row.end_time}`
      )}</p>
    `;
    const buttonEdit = document.createElement("button");
    buttonEdit.innerText = "Editar";
    buttonEdit.className = "button";
    buttonEdit.style.backgroundColor = "#0275d8";
    buttonEdit.addEventListener("click", (e) => {
      loadForm(row);
    });

    const buttonDelete = document.createElement("button");
    buttonDelete.innerText = "Eliminar";
    buttonDelete.className = "button";
    buttonDelete.style.backgroundColor = "var(--color-danger)";
    buttonDelete.addEventListener("click", (e) => {
      confirmAlert("No podras revertir esta operación", () => {
        deleteSchedule(row.id_schedules);
      });
    });

    const currentDate = new Date();
    const startDate = new Date(`${row.date_schedules}T${row.start_time}`);

    article.append(divTitle);
    article.append(divContent);
    if (currentDate < startDate) {
      article.append(buttonEdit);
      article.append(buttonDelete);
    } else {
      const divChecked = document.createElement("div");
      divChecked.className = "box-checked";
      if (row.attendance === "1") {
        divChecked.innerHTML = `<div class='checked' style='border: 0.15rem solid #5cb85c;'></div> <p>Agenda cumplida</p>`;
      }
      if (row.attendance === "0") {
        divChecked.innerHTML = `<div class='checked' style='border: 0.15rem solid var(--color-danger);'></div> <p>Agenda no asistida</p>`;
      }
      article.append(divChecked);
    }
    document.getElementById("calendar").appendChild(article);
  });
  const a = document.createElement("a");
  a.className = "laquo";
  a.innerHTML = "&laquo; Regresar";
  a.href = "./customer.appointments.php";
  document.getElementById("calendar").appendChild(a);
}

async function deleteSchedule(id) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=delete&id=${id}`
  );
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  successAlert(data.message, "Operación Exitosa");
  await showCalendarData();
}

function loadForm(row) {
  let htmlForm = `
        <form id='form' action='' method='post'>
            <input type='hidden' name='id' id='id' required value='${row.id_schedules}'>
            <input type='hidden' name='employeeId' id='employeeId' required value='${row.employee_id}'>
            <input type='hidden' name='customerId' id='customerId' required value='${row.customer_id}'>

            <label for='title'>Titulo agenda</label>
            <input type='text' class='input' name='title' id='title' required value='${row.title}'>
                
            <label for='date'>Fecha</label>
            <input type='date' class='input' name='date' id='date' required value='${row.date_schedules}'>

            <label for='startTime'>Desde</label>
            <input type='time' class='input' name='startTime' id='startTime' required value='${row.start_time}'>

            <label for='endTime'>Hasta</label>
            <input type='time' class='input' name='endTime' id='endTime' required value='${row.end_time}'>

            <label for='color'>Selecciona un color</label>
            <input type='color' class='color' name='color' id='color' required value='${row.color}'>
        </form>
    `;
  alertForm(htmlForm, "Editar Agenda", updateSchedule, showCalendarData);
}

async function updateSchedule() {
  const formData = new FormData(document.getElementById("form"));
  if (
    formData.get("id") === "" ||
    formData.get("title") === "" ||
    formData.get("date") === "" ||
    formData.get("startTime") === "" ||
    formData.get("endTime") === "" ||
    formData.get("color") === ""
  ) {
    Swal.showValidationMessage("Todos los campos son obligatorios");
    return;
  }
  formData.append("route", "update");
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

async function showCalendarData() {
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
    dateClick: (info) => {
      location.href = `./customer.appointments.php?view=day&date=${info.dateStr}`;
    },

    eventClick: async (info) => {
      await getCalendarById(info.event._def.extendedProps._id);
    },

    events: await getSchedulesCustomer(),
  });
  calendar.render();
}

document.addEventListener("DOMContentLoaded", async () => {
  await showCalendarData();
});
