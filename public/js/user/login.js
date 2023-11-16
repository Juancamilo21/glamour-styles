const form = document.getElementById("form");
const buttonLogin = document.getElementById("button-login");

async function loginUser() {
  const formData = new FormData(form);
  formData.append("route", "login");
  buttonLogin.innerHTML = "<span class='loader'></span>";
  const response = await fetch("./routes/user.router.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  if (!response.ok) {
    warningAlert(data.message, "¡Oops!");
    buttonLogin.innerText = "Acceder";
    return;
  }

  let role = data.role;
  if (role === "Admin") location.href = "./views/admin/admin.home.php";
  if (role === "Customer") location.href = "./views/customer/customer.home.php";
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  await loginUser();
});
