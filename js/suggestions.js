function showSuggestions(text, action) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(action + "_suggestions").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/suggestions.php?action=" + action + "&text=" + text, true);
  xhttp.send();
}

function clearSuggestions(id) {
  var div = document.getElementById(id + "_suggestions");
  if(div)
    div.innerHTML = "";
}

function suggestionClick(value, id) {
  document.getElementById(id + "s_name").value = value;
  if(id == "customer") {
    console.log(value + " = value & id = " + id);
    fillCustomerDetails(value);
  }

  if(id == "medicine") {
    console.log(value + " = value & id = " + id);
    fillMedicineDetails(value);
  }

  if(id == "supplier") {
    console.log(value + " = value & id = " + id);
    fillSupplierDetails(value);
  }
  clearSuggestions(id);
  notNull(value, id + '_name_error');
}

function fillCustomerDetails(name) {
  console.log(name);
  getCustomerDetail("customers_address", name);
  getCustomerDetail("customers_contact_number", name);
}

function fillMedicineDetails(name) {
  console.log(name);
  // var setName = document.getElementById("medicines_name");
  // setName.value = name;
  // console.log(setName.value);
  // getMedicineDetail("medicines_name", name);
  getMedicineDetail("medicines_id", name);
}

function fillSupplierDetails(name) {
  console.log(name);
  getSupplierDetail("suppliers_contact", name);
}

function getCustomerDetail(id, name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(id).value = xhttp.responseText;
  };
  xhttp.open("GET", "php/suggestions.php?action=" + id + "&name=" + name, true);
  xhttp.send();
}

function getMedicineDetail(id, name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      console.log("Hi", id);
      console.log("Hi", name);
      document.getElementById(id).value = xhttp.responseText;
  };
  xhttp.open("GET", "php/suggestions.php?action=" + id + "&name=" + name, true);
  xhttp.send();
}

function getSupplierDetail(id, name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(id).value = xhttp.responseText;
  };
  xhttp.open("GET", "php/suggestions.php?action=" + id + "&name=" + name, true);
  xhttp.send();
}

document.addEventListener("click", (evt) => {
    const dn1 = document.getElementById("supplier_suggestions");
    const dn2 = document.getElementById("suppliers_name");
    const dn3 = document.getElementById("customer_suggestions");
    const dn4 = document.getElementById("customers_name");
    const dn5 = document.getElementById("medicines_name");
    const dn6 = document.getElementById("medicine_suggestions");
    
    let te = evt.target;
    do {
        if (te == dn1 || te == dn2 || te == dn3 || te == dn4 || te == dn5 || te == dn6)
          return;
        te = te.parentNode;
    } while(te);
    clearSuggestions("supplier");
    clearSuggestions("customer");
    clearSuggestions("medicine");
});
