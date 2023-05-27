// Counter for unique IDs
var dynamicFormCounter = 1;

function addField() {
  // Get the dynamic form container
  var dynamicForm = document.getElementById("dynamic-form");
  // Create a new card element
  var newCard = document.createElement("div");
  newCard.className = "card mb-3";
  // Generate a unique ID for the dynamic form
  var dynamicFormId = "dynamic-form-" + dynamicFormCounter;
  newCard.id = dynamicFormId;
  dynamicFormCounter++; // Increment the counter
  // Set the card content with padding left
  newCard.innerHTML = `
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <label for="barang">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang[]">
        <label for="jumlah-barang">Jumlah Barang</label>
        <input type="number" class="form-control" name="jumlah_barang[]">
        <button class="btn btn-danger" onclick="removeField(event, '${dynamicFormId}')">Delete</button>
      </li>
    </ul>
  `;
  // Append the new card after the dynamic form container
  dynamicForm.parentNode.insertBefore(newCard, dynamicForm.nextSibling);
}

function removeField(event, dynamicFormId) {
  // Get the parent dynamic form element
  var dynamicForm = document.getElementById(dynamicFormId);
  // Check the number of dynamic form elements
  var dynamicFormCount = document.querySelectorAll(".card[id^='dynamic-form']").length;
  if (dynamicFormCount > 1) {
    // Remove the dynamic form element
    dynamicForm.remove();
  } 
  else {
    // Show a message or perform any other action to indicate the minimum requirement
    alert("Setidaknya diperlukan satu barang untuk melakukan transaksi. Tidak dapat menghapus barang terakhir.");
  }
}
