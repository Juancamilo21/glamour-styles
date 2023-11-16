const form = document.querySelector("form");
const button = document.getElementById("button");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  await updatePasswordUser();
});

async function updatePasswordUser() {
  const formData = new FormData(form);
  if (
    formData.get("password") === "" ||
    formData.get("passwordConfirm") === ""
  ) {
    warningAlert("Todos los campos son obligatorios");
    return;
  }

  if (formData.get("password") !== formData.get("passwordConfirm")) {
    warningAlert("Las contraseñas no coinciden", "¡Oops!");
    return;
  }

  formData.append("route", "updatePassword");
  button.innerHTML = "<span class='loader'></span>";
  const response = await fetch("../../routes/user.router.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();

  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    button.innerText = "Guardar cambios";
    location.href = "../../index.php";
    return;
  }
  button.innerText = "Guardar cambios";
  successAlert(
    data.message,
    "Opeación Exitosa",
    () => (location.href = "../../index.php")
  );
}

async function verifyTokenUser(token) {
  try {
    const response = await fetch(
      `../../routes/user.router.php?route=verifyToken&token=${token}`
    );
    if (!response.ok) {
      location.href = "../../index.php";
      return;
    }
    const data = await response.json();
    document.getElementById("uid").value = data.id_user;
    document.getElementById("token").value = data.token;
  } catch (error) {
    console.error(error.message);
  }
}

document.addEventListener("DOMContentLoaded", (e) => {
  e.preventDefault();
  const params = new URLSearchParams(location.search);
  let token = params.get("token");
  if (!token) {
    location.href = "../../index.php";
    return;
  }
  verifyTokenUser(token);
});
