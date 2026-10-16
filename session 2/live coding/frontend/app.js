const showForm = document.querySelector("#btn-show-form");
const form = document.querySelector("form-taskStatus");
const list = document.querySelector("#list");
const divForm = document.querySelector("#section-form");

showForm.addEventListener("click", () => {
  divForm.classList.toggle("hidden");
});
fetch("../backend/api.php")
  .then((Response) => Response.json())
  .then((statuses) => {
    statuses.forEach((status) => {
      list.innerHTML += `
      <tr>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.id}</td>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.name}</td>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.description}</td>
      </tr>
    `;
    });
  });

divForm.addEventListener("submit", (e) => {
  e.preventDefault();

  fetch("../backend/api.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      name: document.querySelector("#cat-nom").value,
      description: document.querySelector("#cat-desc").value,
    }),
  })
    .then((Response) => Response.json())
    .then((status) => {
      list.innerHTML += `
      <tr>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.id}</td>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.name}</td>
      <td class="p-4 text-sm font-semibold text-gray-500 uppercase">${status.description}</td>
      </tr>
    `;

      divForm.classList.add("hidden");
    });
});
