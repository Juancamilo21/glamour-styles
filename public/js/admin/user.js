async function showUsers(roleId, showTable) {
  const response = await fetch(
    `../../routes/user.router.php?route=role&roleId=${roleId}`
  );
  const data = await response.json();
  showTable(data);
}

async function getUserById(id) {
  const response = await fetch(
    `../../routes/user.router.php?route=idUser&id=${id}`
  );
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    return;
  }
  return await response.json();
}

async function deleteUser(id, roleId, showTable) {
  const response = await fetch(
    `../../routes/user.router.php?route=delete&id=${id}`
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
  await showUsers(roleId, showTable);
}

async function showUserById(data) {
  let html = `
    <div class='box-datails'>
        <p><span>Nombres:</span> ${data.names}</p><br>
        <p><span>Apellidos:</span> ${data.lastnames}</p><br>
        <p><span>Edad:</span> ${data.age}</p><br>
        <p><span>CC:</span> ${data.dci}</p><br>
        <p><span>Dirección:</span> ${data.address}</p><br>
        <p><span>Email:</span> ${data.email}</p><br>
        <p><span>Telefono:</span> ${data.phone_number}</p><br>
    </div>
    `;
  detailsAlert(html);
}
