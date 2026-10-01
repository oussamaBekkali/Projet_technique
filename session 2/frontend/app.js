const form = document.querySelector("#form");
const list = document.querySelector("#list");
const showForm = document.querySelector("#show-form");

// Show / hide form
showForm.addEventListener("click", () => {
  form.classList.toggle("hidden");
});

// Show data.json
fetch("backend/api.php")
  .then((response) => response.json())
  .then((statuses) => {
    statuses.forEach((status) => {
      list.innerHTML += `
                <li class="bg-white border rounded-lg p-4 shadow-sm">
                    <strong>${status.name}</strong>
                    <p class="text-sm text-gray-500">
                        ${status.description}
                    </p>
                </li>
            `;
    });
  });

// Add status
form.addEventListener("submit", (e) => {
  e.preventDefault();

  fetch("backend/api.php", {
    method: "POST",

    headers: {
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      name: document.querySelector("#name").value,
      description: document.querySelector("#description").value,
    }),
  })
    .then((response) => response.json())

    .then((status) => {
      list.innerHTML += `
            <li class="bg-white border rounded-lg p-4 shadow-sm">
                <strong>${status.name}</strong>
                <p class="text-sm text-gray-500">
                    ${status.description}
                </p>
            </li>
        `;

      form.reset();
      form.classList.add("hidden");
    });
});
