function deleteMedicine(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editMedicine(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateMedicine(id) {
  var medicine_name = document.getElementById("medicine_name");
  var packing = document.getElementById("packing");
  var generic_name = document.getElementById("generic_name");
  var type = document.getElementById("type");
  var strength = document.getElementById("strength");
  var price = document.getElementById("price");

  if(!notNull(medicine_name.value, "medicine_name_error"))
    medicine_name.focus();
  else if(!notNull(packing.value, "pack_error"))
    packing.focus();
  else if(!notNull(generic_name.value, "generic_name_error"))
    generic_name.focus();
    else if(!notNull(type.value, "type_error"))
    type.focus();
    else if(!notNull(strength.value, "strength_error"))
    strength.focus();
    else if(!notNull(price.value, "price_error"))
    price.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=update&id=" + id + "&name=" + medicine_name.value + "&packing=" + packing.value + "&generic_name=" + generic_name.value + "&type=" + type.value + "&strength=" + strength.value + "&price=" + price.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=cancel", true);
  xhttp.send();
}

function searchMedicine(text, tag) {
  if(tag == "name") {
    document.getElementById("by_generic_name").value = "";
    
  }
  if(tag == "generic_name") {
    document.getElementById("by_name").value = "";
   
  }
 

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_medicine.php?action=search&text=" + text + "&tag=" + tag, true);
  xhttp.send();
}
