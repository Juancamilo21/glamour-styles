const form = document.getElementById("form");
const buttonRegister = document.getElementById("button-register");

async function registerCustomer() {
  const formData = new FormData(form);
  formData.append("route", "createCustomer");
  buttonRegister.innerHTML = "<span class='loader'></span>";
  const response = await fetch("../../routes/user.router.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    buttonRegister.innerText = "Registrarse";
    return;
  }
  buttonRegister.innerText = "Registrarse";
  successAlert(data.message, "Registro Exitoso", () => {
    location.href = "../../index.php";
  });
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  await registerCustomer();
});
