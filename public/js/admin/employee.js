const buttonModal = document.getElementById("button-modal-add");

buttonModal.addEventListener("click", async (e) => {
  e.preventDefault();
  const selectServices = await getselectServices();
  let formRegister = `
      <div class='box-form'>
        <form id='form' action='' method='post'>
            <label for='names'>Nombres</label>
            <input type='text' name='names' class='input' id='names' required>
                
            <label for='lastnames'>Apellidos</label>
            <input type='text' name='lastnames' class='input' id='lastnames' required>
      
            <label for='age'>Edad</label>
            <input type='number' name='age' class='input' id='age' required>

            <label for='dci'>Cedula</label>
            <input type='number' name='dci' class='input' id='dci' required>

            <label for='phoneNumber'>Telefono</label>
            <input type='number' name='phoneNumber' class='input' id='phone' required>

            <label for='address'>Dirección</label>
            <input type='text' name='address' class='input' id='address' required>

            <label for='Salary'>Salario</label>
            <input type='number' name='salary' class='input' id='salary' required>

            <label for='email'>Email</label>
            <input type='email' name='email' class='input' id='email' required>

            <label for='services'>Selecciona el servicio que realiza</label>
            ${selectServices.outerHTML}
        </form>
      </div>
      `;
  alertForm(formRegister, "Registrar", registerEmployee, () => {
    showUsers(3, showEmployeTable);
  });
});

async function registerEmployee() {
  try {
    const formData = new FormData(document.getElementById("form"));
    if (
      formData.get("names") === "" ||
      formData.get("lastnames") === "" ||
      formData.get("age") === "" ||
      formData.get("dci") === "" ||
      formData.get("phoneNumber") === "" ||
      formData.get("address") === "" ||
      formData.get("salary") === "" ||
      formData.get("email") === "" ||
      formData.get("service") === ""
    ) {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }

    formData.append("route", "createEmployee");
    const response = await fetch("../../routes/user.router.php", {
      method: "POST",
      body: formData,
    });
    if (!response.ok) {
      const data = await response.json();
      throw new Error(`${data.message}`);
    }
    return await response.json();
  } catch (error) {
    Swal.showValidationMessage(error.message);
  }
}

async function getselectServices() {
  const selectServices = document.createElement("select");
  selectServices.name = "service";
  selectServices.innerHTML = "";

  const response = await fetch(
    "../../routes/service.router.php?route=services"
  );

  if (!response.ok) return selectServices;

  const data = await response.json();
  data.forEach((row) => {
    const option = document.createElement("option");
    option.value = row.id_service;
    option.innerText = `${row.service_name}`;

    selectServices.appendChild(option);
  });

  return selectServices;
}

function showEmployeTable(data) {
  const tbody = document.getElementById("tbody");
  tbody.innerHTML = "";
  data.forEach((row, index) => {
    const tr = document.createElement("tr");

    const tdNum = document.createElement("td");
    tdNum.innerText = `${index + 1}`;

    const tdName = document.createElement("td");
    tdName.innerText = `${row.names}`;

    const tdLastnames = document.createElement("td");
    tdLastnames.innerText = `${row.lastnames}`;

    const tdAge = document.createElement("td");
    tdAge.innerText = `${row.age}`;

    const tdEmail = document.createElement("td");
    tdEmail.innerText = `${row.email}`;

    const buttonDetails = document.createElement("button");
    buttonDetails.className = "button-events";
    buttonDetails.id = "button-events-details";
    buttonDetails.innerHTML = "<i class='bi bi-eye-fill'></i>";

    actionButtonDetails(buttonDetails, row.id_user);

    const buttonEdit = document.createElement("button");
    buttonEdit.className = "button-events";
    buttonEdit.id = "button-events-edit";
    buttonEdit.innerHTML = "<i class='bi bi-pencil-fill'></i>";

    actionButtonEdit(row, buttonEdit);

    const buttonDelete = document.createElement("button");
    buttonDelete.className = "button-events";
    buttonDelete.id = "button-events-delete";
    buttonDelete.innerHTML = "<i class='bi bi-trash3-fill'></i>";

    actionButtonDelete(row, buttonDelete);

    const buttonCalendar = document.createElement("button");
    buttonCalendar.className = "button-events";
    buttonCalendar.id = "button-events-calendar";
    buttonCalendar.innerHTML = "<i class='bi bi-calendar-week-fill'></i>";
    buttonCalendar.addEventListener("click", (e) => {
      e.preventDefault();
      location.href = `./admin.stylistSchedules.php?srv=${row.service_id}&st=${row.id_user}`;
    });

    const tdButton = document.createElement("td");
    tdButton.append(buttonEdit);
    tdButton.append(buttonDetails);
    tdButton.append(buttonCalendar);
    tdButton.append(buttonDelete);

    tr.append(tdNum);
    tr.append(tdName);
    tr.append(tdLastnames);
    tr.append(tdAge);
    tr.append(tdEmail);
    tr.append(tdButton);

    tbody.appendChild(tr);
  });
}

// Funciones para realizar los eventos de los  botones detalles, editar y eliminar
function actionButtonDetails(button, id) {
  button.addEventListener("click", async (e) => {
    e.preventDefault();
    await getEmployee(id);
  });
}

async function getEmployee(id) {
  try {
    const response = await fetch(
      `../../routes/user.router.php?route=employee&roleId=3&idUser=${id}`
    );
    if (!response.ok) throw new Error("Ha ocurrido un error inesperado");
    const row = await response.json();
    let html = `
    <div class='box-datails'>
        <p><span>Nombres:</span> ${row.names}</p><br>
        <p><span>Apellidos:</span> ${row.lastnames}</p><br>
        <p><span>Edad:</span> ${row.age}</p><br>
        <p><span>CC:</span> ${row.dci}</p><br>
        <p><span>Telefono:</span> ${row.phone_number}</p><br>
        <p><span>Dirección:</span> ${row.address}</p><br>
        <p><span>Email:</span> ${row.email}</p><br>
        <p><span>Servicio que realiza:</span> ${row.service_name}</p><br>
        <p><span>Salario:</span> ${formatCOP(row.salary)}</p><br>
    </div>
    `;
    detailsAlert(html);
  } catch (error) {}
}

function loadInputsForm(row) {
  let formUpdate = `
    <div class='box-form'>
      <form id='form' action='' method='post'>
          <input type='hidden' name='id' id='id' required value='${row.id_user}'>

          <label for='names'>Nombres</label>
          <input type='text' name='names' class='input' id='names' required value='${row.names}'>
              
          <label for='lastnames'>Apellidos</label>
          <input type='text' name='lastnames' class='input' id='lastnames' required value='${row.lastnames}'>
    
          <label for='age'>Edad</label>
          <input type='number' name='age' class='input' id='age' required value='${row.age}'>

          <label for='dci'>Cedula</label>
          <input type='number' name='dci' class='input' id='dci' required value='${row.dci}'>

          <label for='phoneNumber'>Telefono</label>
          <input type='number' name='phoneNumber' class='input' id='phone' required value='${row.phone_number}'>

          <label for='address'>Dirección</label>
          <input type='text' name='address' class='input' id='address' required value='${row.address}'>

          <label for='Salary'>Salario</label>
          <input type='number' name='salary' class='input' id='salary' required value='${row.salary}'>

          <label for='email'>Email</label>
          <input type='email' name='email' class='input' id='email' readonly required value='${row.email}'>
      </form>
    </div>
      `;
  alertForm(formUpdate, "Actualizar", updateEmployee, () => {
    showUsers(3, showEmployeTable);
  });
}

async function updateEmployee() {
  try {
    const formData = new FormData(document.getElementById("form"));
    if (
      formData.get("names") === "" ||
      formData.get("lastnames") === "" ||
      formData.get("age") === "" ||
      formData.get("dci") === "" ||
      formData.get("phoneNumber") === "" ||
      formData.get("address") === "" ||
      formData.get("salary") === "" ||
      formData.get("email") === ""
    ) {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }

    formData.append("route", "updateEmployee");
    const response = await fetch("../../routes/user.router.php", {
      method: "POST",
      body: formData,
    });
    if (!response.ok) {
      const data = await response.json();
      throw new Error(`${data.message}`);
    }
    return await response.json();
  } catch (error) {
    Swal.showValidationMessage(error.message);
  }
}

function actionButtonEdit(row, button) {
  button.addEventListener("click", async (e) => {
    e.preventDefault();
    loadInputsForm(row);
  });
}

function actionButtonDelete(row, button) {
  button.addEventListener("click", async (e) => {
    e.preventDefault();
    confirmAlert("No podras revertir esta operación", () => {
      deleteUser(row.id_user, row.role_id, showEmployeTable);
    });
  });
}

document.addEventListener("DOMContentLoaded", async (e) => {
  await showUsers(3, showEmployeTable);
});
