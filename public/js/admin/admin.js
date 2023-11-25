const buttonModal = document.getElementById("button-modal-add");

buttonModal.addEventListener("click", (e) => {
  e.preventDefault();
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

          <label for='email'>Email</label>
          <input type='email' name='email' class='input' id='email' required>

          <label for='password'>Contraseña</label>
          <input type='password' name='password' class='input' id='password' required>
      </form>
    </div>
      `;
  alertForm(formRegister, "Registrar", registerAdmin, () => {
    showUsers(1, showEmployeTable);
  });
});

async function registerAdmin() {
  try {
    const formData = new FormData(document.getElementById("form"));
    if (
      formData.get("names") === "" ||
      formData.get("lastnames") === "" ||
      formData.get("age") === "" ||
      formData.get("dci") === "" ||
      formData.get("phoneNumber") === "" ||
      formData.get("address") === "" ||
      formData.get("email") === "" ||
      formData.get("password") === ""
    ) {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }

    formData.append("route", "createAdmin");
    const response = await fetch("../../routes/user.router.php", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    if (!response.ok) {
        throw new Error(`${data.message}`);
    }
    return data;
  } catch (error) {
    Swal.showValidationMessage(error.message);
  }
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

    actionButtonDetails(row, buttonDetails);

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

    const tdButton = document.createElement("td");
    tdButton.append(buttonEdit);
    tdButton.append(buttonDelete);
    tdButton.append(buttonDetails);

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
function actionButtonDetails(row, button) {
  let html = `
    <div class='box-datails'>
        <p><span>Nombres:</span> ${row.names}</p><br>
        <p><span>Apellidos:</span> ${row.lastnames}</p><br>
        <p><span>Edad:</span> ${row.age}</p><br>
        <p><span>CC:</span> ${row.dci}</p><br>
        <p><span>Telefono:</span> ${row.phone_number}</p><br>
        <p><span>Dirección:</span> ${row.address}</p><br>
        <p><span>Email:</span> ${row.email}</p><br>
    </div>
    `;
  button.addEventListener("click", async (e) => {
    e.preventDefault();
    detailsAlert(html);
  });
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

          <label for='email'>Email</label>
          <input type='email' name='email' class='input' id='email' readonly required value='${row.email}'>
      </form>
    </div>
      `;
  alertForm(formUpdate, "Actualizar", updateAdmin, () => {
    showUsers(1, showEmployeTable);
  });
}

async function updateAdmin() {
  try {
    const formData = new FormData(document.getElementById("form"));
    if (
      formData.get("names") === "" ||
      formData.get("lastnames") === "" ||
      formData.get("age") === "" ||
      formData.get("dci") === "" ||
      formData.get("phoneNumber") === "" ||
      formData.get("address") === "" ||
      formData.get("email") === ""
    ) {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }

    formData.append("route", "updateUser");
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
  await showUsers(1, showEmployeTable);
});
