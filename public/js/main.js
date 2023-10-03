const buttonMenu = document.querySelector(".button-menu");
const navbar = document.querySelector(".navbar");

buttonMenu.addEventListener("click", () => {
  navbar.classList.toggle("open-menu");
});
