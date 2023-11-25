async function showEmployeeService(idService, showDataEmployees) {
  try {
    const response = await fetch(
      `../../routes/user.router.php?route=employeeService&service=${idService}`
    );
    if (!response.ok) throw new Error("Ha ocurrido un error inesperado");
    const data = await response.json();
    showDataEmployees(data);
  } catch (error) {
    console.log(error);
  }
}

function showDataEmployees(data) {
  const sectionEmployee = document.getElementById("section-stylist");
  sectionEmployee.innerHTML = "";
  data.forEach((row) => {
    const articleEmployee = document.createElement("article");
    articleEmployee.className = "article-info-styles";

    const containerInfo = document.createElement("div");
    containerInfo.className = "container-info";

    const imgDefaultUser = document.createElement("img");
    imgDefaultUser.src = "../../upload/default.png";

    const containerName = document.createElement("div");
    containerName.className = "info-stylist";

    const h4 = document.createElement("h4");
    h4.innerText = `${row.names} ${row.lastnames}`;

    const containerButtons = document.createElement("div");
    containerButtons.className = "container-button";

    const buttonSelected = document.createElement("button");
    buttonSelected.className = "button-employee";
    buttonSelected.id = "button-selected";
    buttonSelected.innerText = "Agendar";
    buttonSelected.addEventListener("click", (e) => {
      location.href = `customer.stylistSchedules.php?srv=${row.service_id}&st=${row.id_user}`;
    });

    const buttonDetails = document.createElement("button");
    buttonDetails.className = "button-employee";
    buttonDetails.id = "button-details";
    buttonDetails.innerText = "Detalles";
    buttonDetails.addEventListener("click", (e) => {
      detailsStylist(row);
    });

    containerName.append(h4);

    containerInfo.append(imgDefaultUser);
    containerInfo.append(containerName);
    containerButtons.append(buttonSelected);
    containerButtons.append(buttonDetails);

    articleEmployee.append(containerInfo);
    articleEmployee.append(containerButtons);

    sectionEmployee.appendChild(articleEmployee);
  });
}

function detailsStylist(row) {
  let html = `
    <div class='box-datails'>
        <p><span>Nombres:</span> ${row.names}</p><br>
        <p><span>Apellidos:</span> ${row.lastnames}</p><br>
        <p><span>Edad:</span> ${row.age}</p><br>
        <p><span>Telefono:</span> ${row.phone_number}</p><br>
        <p><span>Dirección:</span> ${row.address}</p><br>
        <p><span>Email:</span> ${row.email}</p><br>
    </div>
    `;
  detailsAlert(html);
}

document.addEventListener("DOMContentLoaded", (e) => {
  const urlParams = new URLSearchParams(location.search);
  let idService = urlParams.get("srv");
  showEmployeeService(idService, showDataEmployees);
});
