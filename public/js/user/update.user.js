const buttonEdit = document.getElementById("button-edit");

async function getDataUser(id) {
  const response = await fetch(
    `../../routes/user.router.php?route=idUser&id=${id}`
  );
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  loadFormUpdate(data);
}

function loadFormUpdate(row) {
  let formUpdate = `
    <div class='box-form'>
      <form id='form' action='' method='post'>
          <input type='hidden' name='id' class='input' id='id' required value='${row.id_user}'>

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
  alertForm(formUpdate, "Actualizar", updateUser, () => {});
}

async function updateUser() {
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

  formData.append("route", "updateUser");
  const response = await fetch("../../routes/user.router.php", {
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

buttonEdit.addEventListener("click", async (e) => {
  e.preventDefault();
  let id = buttonEdit.getAttribute("data-id");
  await getDataUser(id);
});
