async function showServices() {
  const response = await fetch(
    "../../routes/service.router.php?route=services"
  );
  const data = await response.json();
  showServicesCard(data);
}

function showServicesCard(data) {
  const sectionServices = document.getElementById("section-service");
  sectionServices.innerHTML = "";
  data.forEach((row) => {
    const articleService = document.createElement("article");
    articleService.className = "article-service";

    const image = row.image_path.split("/").pop();
    const containerImg = document.createElement("div");
    containerImg.className = "container-img-service";
    containerImg.innerHTML = `<img src='../../upload/${image}' alt='image' />`;

    const containerContent = document.createElement("div");
    containerContent.className = "container-content-service";

    const h4 = document.createElement("h4");
    h4.innerText = `${row.service_name}`;

    const p = document.createElement("p");
    let price = formatCOP(row.price);
    p.innerText = `${price}`;

    const buttonSelected = document.createElement("button");
    buttonSelected.className = "button-card";
    buttonSelected.innerText = "Seleccionar";

    buttonSelected.addEventListener("click", (e) => {
      location.href = `./customer.stylist.php?service=${row.id_service}`;
    });

    containerContent.append(h4);
    containerContent.append(p);
    containerContent.append(buttonSelected);

    articleService.append(containerImg);
    articleService.append(containerContent);

    sectionServices.appendChild(articleService);
  });
}

document.addEventListener("DOMContentLoaded", async (e) => {
  e.preventDefault();
  await showServices();
});
