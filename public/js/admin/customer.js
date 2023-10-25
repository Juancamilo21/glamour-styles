function showCustomersTable(data) {
  const tbody = document.getElementById("tbody");
  tbody.innerHTML = "";
  data.forEach((row, index) => {
    const tr = document.createElement("tr");

    const tdNum = document.createElement("td");
    tdNum.innerText = `${index + 1}`;

    const tdName = document.createElement("td");
    tdName.innerText = `${row.names}`;

    const tdLastnames = document.createElement("td");
    tdLastnames.innerText = `${row.lastnames}`;

    const tdAge = document.createElement("td");
    tdAge.innerText = `${row.age}`;

    const tdEmail = document.createElement("td");
    tdEmail.innerText = `${row.email}`;

    const buttonDetails = document.createElement("button");
    buttonDetails.className = "button-events";
    buttonDetails.id = "button-events-details";
    buttonDetails.innerHTML = "<i class='bi bi-eye-fill'></i>";

    actionButtonDetailCustomer(row, buttonDetails);

    const tdButton = document.createElement("td");
    tdButton.append(buttonDetails);

    tr.append(tdNum);
    tr.append(tdName);
    tr.append(tdLastnames);
    tr.append(tdAge);
    tr.append(tdEmail);
    tr.append(tdButton);
    
    tbody.appendChild(tr);
  });
}

function actionButtonDetailCustomer(row, button) {
  button.addEventListener("click", async (e) => {
    e.preventDefault();
    showUserById(row);
  });
}

document.addEventListener("DOMContentLoaded", async () => {
  await showUsers(2, showCustomersTable);
});
