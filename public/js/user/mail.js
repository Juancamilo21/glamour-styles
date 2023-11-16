const form = document.getElementById("form");
const button = document.getElementById("button");

async function recoverPassword() {
  const formData = new FormData(form);
  formData.append("route", "recoverPassword");
  button.innerHTML = "<span class='loader'></span>";

  const response = await fetch("../../routes/user.router.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();

  if (!response.ok) {
    warningAlert(data.message, "!Oops¡");
    button.innerText = "Recuperar";
    return;
  }
  button.innerText = "Recuperar";
  document.getElementById("info-mail").innerText = `${data.message}`;
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  await recoverPassword();
});
