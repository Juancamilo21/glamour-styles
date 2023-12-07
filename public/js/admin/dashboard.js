async function showNumbersOnCards() {
  const boxStylist = document.getElementById("box-stylist");
  const boxServices = document.getElementById("box-services");
  const boxAppoint = document.getElementById("box-appoint");
  const response = await fetch("../../routes/dashboard.router.php?route=statistic");
  const data = await response.json();
  if (!response.ok) {
    boxStylist.innerHTML = `<h4>${data.number}</h4>`;
    boxServices.innerHTML = `<h4>${data.number}</h4>`;
    boxAppoint.innerHTML = `<h4>${data.number}</h4>`;
    console.error(data.message);
    return;
  }
  boxStylist.innerHTML = `<h4>${data.number_employee}</h4>`;
  boxServices.innerHTML = `<h4>${data.number_services}</h4>`;
  boxAppoint.innerHTML = `<h4>${data.number_schedules}</h4>`;
}

document.addEventListener("DOMContentLoaded", async (e) => {
    await showNumbersOnCards();
});
