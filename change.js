const clientSelect = document.getElementById("client_name");
const clientName = document.getElementById("add_new_client");

clientSelect.addEventListener("change", function() {
  if (this.value === "add_new") {
    clientName.style.display = "block";
  } else {
    clientName.style.display = "none";
  }
});
