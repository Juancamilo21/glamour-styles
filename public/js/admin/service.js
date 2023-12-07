const buttonModal = document.getElementById("button-modal-add");
buttonModal.addEventListener("click", (e) => {
  e.preventDefault();
  let formRegister = `
  <form action='' method='post' enctype='multipart/form-data'>
      <label for='serviceName'>Nombre Servicio</label>
      <input type='text' name='serviceName' id='serviceName' required class='input'>
          
      <label for='price'>Precio</label>
      <input type='number' name='price' class='input' id='price' required>

      <label for='imageService'>Imágen</label>
      <input type='file' name='imageService' class='input' id='image' required accept='image/*'>
  </form>
  `;
  alertForm(formRegister, "Registrar", registerService, showServices);
});

async function registerService() {
  try {
    let serviceName = document.getElementById("serviceName").value;
    let price = document.getElementById("price").value;
    let image = document.getElementById("image").files[0];
    if (serviceName === "" || price === "" || !image) {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }
    const formData = new FormData();
    formData.append("serviceName", serviceName);
    formData.append("price", price);
    formData.append("image", image);
    formData.append("route", "create");

    const response = await fetch("../../routes/service.router.php", {
      method: "POST",
      body: formData,
    });

    if (!response.ok)
      throw new Error("Ha ocurrido un error, intente nuevamente");

    return await response.json();
  } catch (error) {
    Swal.showValidationMessage(error.message);
  }
}

async function updateService() {
  try {
    let serviceName = document.getElementById("serviceName").value;
    let price = document.getElementById("price").value;
    let id = document.getElementById("id").value;
    if (serviceName === "" || price === "") {
      Swal.showValidationMessage("Todos los campos son obligatorios");
      return;
    }
    const formData = new FormData();
    formData.append("serviceName", serviceName);
    formData.append("price", price);
    formData.append("id", id);
    formData.append("route", "update");

    const response = await fetch("../../routes/service.router.php", {
      method: "POST",
      body: formData,
    });

    if (!response.ok)
      throw new Error("Ha ocurrido un error, intente nuevamente");

    return await response.json();
  } catch (error) {
    Swal.showValidationMessage(error.message);
  }
}

async function showServices() {
  const response = await fetch(
    "../../routes/service.router.php?route=services"
  );
  const data = await response.json();
  showServicesTable(data);
}

async function getServicesById(id) {
  try {
    const response = await fetch(
      `../../routes/service.router.php?route=serviceId&id=${id}`
    );
    if (!response.ok)
      throw new Error(`Error: ${response.status} ${response.statusText}`);
    return await response.json();
  } catch (error) {
    errorAlert(error.message);
  }
}

function loadInputsFormUpdate(data) {
  let formUpdate = `
    <form action='' method='post' enctype='multipart/form-data'>
      <input type='hidden' name='id' id='id' required value='${data.id_service}'>

      <label for='serviceName'>Nombre Servicio</label>
      <input type='text' name='serviceName' id='serviceName' required class='input' value='${data.service_name}'>
            
      <label for='price'>Precio</label>
      <input type='number' name='price' class='input' id='price' required value='${data.price}'>
    </form>
  `;
  alertForm(formUpdate, "Actualizar", updateService, showServices);
}

async function deleteService(id) {
  const response = await fetch(
    `../../routes/service.router.php?route=delete&id=${id}`
  );
  if (response.status === 500) {
    errorAlert("No fue posible realizar esta operación");
    return;
  }
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  successAlert(data.message, "Operación Exitosa", () => {});
  showServices();
}

function completeOperationDelete(id) {
  confirmAlert("No podrás revertir esta operación", () => {
    deleteService(id);
  });
}

function showServicesTable(data) {
  const tbody = document.getElementById("tbody");
  tbody.innerHTML = "";
  data.forEach((row, index) => {
    const tr = document.createElement("tr");

    const tdNum = document.createElement("td");
    tdNum.innerText = `${index + 1}`;

    const tdServiceName = document.createElement("td");
    tdServiceName.innerText = `${row.service_name}`;

    const tdServicePrice = document.createElement("td");
    let price = formatCOP(row.price);
    tdServicePrice.innerText = `${price}`;

    const image = row.image_path.split("/").pop();
    const tdServiceImage = document.createElement("td");
    tdServiceImage.innerHTML = `<img src='../../upload/${image}' alt='image' />`;

    const buttonEdit = document.createElement("button");
    buttonEdit.className = "button-events";
    buttonEdit.id = "button-events-edit";
    buttonEdit.innerHTML = "<i class='bi bi-pencil-fill'></i>";

    buttonEdit.addEventListener("click", async (e) => {
      e.preventDefault();
      const data = await getServicesById(row.id_service);
      loadInputsFormUpdate(data);
    });

    const buttonDelete = document.createElement("button");
    buttonDelete.id = "button-events-delete";
    buttonDelete.className = "button-events";
    buttonDelete.innerHTML = "<i class='bi bi-trash3-fill'></i>";

    buttonDelete.addEventListener("click", (e) => {
      e.preventDefault();
      completeOperationDelete(row.id_service);
    });

    const tdServiceButton = document.createElement("td");
    tdServiceButton.append(buttonEdit);
    tdServiceButton.append(buttonDelete);

    tr.append(tdNum);
    tr.append(tdServiceName);
    tr.append(tdServiceImage);
    tr.append(tdServicePrice);
    tr.append(tdServiceButton);

    tbody.appendChild(tr);
  });
}

function formatCOP(price) {
  return new Intl.NumberFormat("es-CO", {
    currency: "COP",
    style: "currency",
    minimumFractionDigits: 2,
  }).format(price);
}

document.addEventListener("DOMContentLoaded", async () => {
  await showServices();
});
