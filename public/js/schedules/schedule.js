function formatDate(dateStr) {
  const date = new Date(dateStr);
  let day = date.getDate();
  let month = date.toLocaleString("default", {
    month: "short",
  });
  let year = date.getFullYear();
  let hours = date.getHours().toString().padStart(2, '0');
  let minutes = date.getMinutes().toString().padStart(2, '0');
  let seconds = date.getSeconds().toString().padStart(2, '0');
  return `${day}, ${month}, ${year} a las ${hours}:${minutes}:${seconds}`;
}

function showCalendar(data) {
  const image = data.image_path.split("/").pop();
  let html = `
    <div class='box-datails'>
        <div class='detail-service'>
            <img src='../../upload/${image}' alt='${data.service_name}' />
            <h4>${data.service_name}</h4>
        </div>
        <p><span>Cliente:</span> ${data.customer_names} ${data.customer_lastnames}</p><br>
        <p><span>Estilista:</span> ${data.employee_names} ${data.employee_lastnames}</p><br>
        <p><span>Precio:</span> ${formatCOP(data.price)}</p><br>
        <p><span>Inicia:</span> ${formatDate(`${data.date_schedules}T${data.start_time}`)}</p><br>
        <p><span>Finaliza:</span> ${formatDate(`${data.date_schedules}T${data.end_time}`)}</p><br>
    </div>
    `;
  detailsAlert(html);
}

async function getCalendarById(id) {
  const response = await fetch(
    `../../routes/schedule.router.php?route=calendar&idSchedule=${id}`
  );
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  showCalendar(data);
}
