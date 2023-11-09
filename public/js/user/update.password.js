const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  await updatePasswordUser();
});

async function updatePasswordUser() {
  try {
    const formData = new FormData(form);
    if (
      formData.get("password") === "" ||
      formData.get("passwordConfirm") === ""
    ) {
      warningAlert("Todos los campos son obligatorios");
      return;
    }

    if (formData.get("password") !== formData.get("passwordConfirm")) {
      warningAlert("Las contraseñas no coinciden", "Oops");
      return;
    }

    formData.append("route", "updatePassword");
    const response = await fetch("../../routes/user.router.php", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    if (!response.ok) throw new Error(`${data.message}`);
    successAlert(
      data.message,
      "Opeación Exitosa",
      () => (location.href = "../../index.php")
    );
  } catch (error) {
    warningAlert(error.message);
  }
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
    console.log(data);
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
