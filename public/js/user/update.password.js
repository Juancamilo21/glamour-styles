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
    const data = await response.json();
    if (!response.ok) {
      messageError(data.message)
      return;
    }
    document.getElementById("uid").value = data.id_user;
    document.getElementById("token").value = data.token;
  } catch (error) {
    console.error(error.message);
  }
}

function messageError(message) {
  document.querySelector(".container-form").innerHTML = `
   <div style='text-align: center; margin-top: 4rem'>
      <h2 style='margin-bottom: 2rem;'>${message}</h2>
      <a href='../../index.php' style='padding: 0.8rem; background-color: var(--primary-color); color: var(--color-white); font-size: var(--font-size-menu); font-weight: 600; border-radius: 0.5rem'>Continuar</a>
   </div>
  `
}

document.addEventListener("DOMContentLoaded", (e) => {
  e.preventDefault();
  const params = new URLSearchParams(location.search);
  let token = params.get("token");
  verifyTokenUser(token);
});
