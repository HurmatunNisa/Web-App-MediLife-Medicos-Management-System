var rows = 0;

//isSupplier = false;

class MedicineStock {
  constructor(name, batch_id, expiry_date, quantity, mrp, rate, min, max, product_id) {
    this.name = name;
    this.batch_id = batch_id;
    this.expiry_date = expiry_date;
    this.quantity = quantity;
    this.mrp = mrp;
    this.rate = rate;
    this.min = min;
    this.max = max;
    this.product_id = product_id;
  }
}

class NewMedicine {
  constructor(name, packing, generic_name, supplier_name) {
    this.name = name;
    this.packing = packing;
    this.generic_name = generic_name;
    this.supplier_name = supplier_name;
  }
}

function medicineOptions(text, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(id).innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=medicine_list&text=" + text.trim(), true);
  xhttp.send();
}

function fillFields(medicine_name, id) {
  fill(medicine_name, 'medicines_id_' + id, 'PRODUCT_ID');
  fill(medicine_name, 'batch_id_' + id, 'BATCH_ID');
  // if(checkExpiry(expiry_date, 'medicine_name_error_' + id) != -1)
  //   document.getElementById("medicine_name_error_" + id).style.display = "none";
  // else
  //   return;
  document.getElementById("medicine_name_" + id).blur();
}

function fill(name, field_name, column) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(field_name).value = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=fill&name=" + name + "&column=" + column, false);
  xhttp.send();
}

function isMedicine(name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=is_medicine&name=" + name, false);
  xhttp.send();
  //alert(xhttp.responseText);
  return xhttp.responseText;
}

function addRow() {
  if(typeof addRow.counter == 'undefined')
    addRow.counter = 1;
  var previous = document.getElementById("purchase_medicine_list_div").innerHTML;
  var node = document.createElement("div");
  var id = document.createAttribute("id");
  id.value = "medicine_row_" + addRow.counter;
  node.setAttributeNode(id);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      node.innerHTML = xhttp.responseText;
      document.getElementById("purchase_medicine_list_div").appendChild(node);
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=add_row&row_id=" + id.value + "&row_number=" + addRow.counter, true);
  xhttp.send();
  //alert(addRow.counter);
  addRow.counter++;
  rows++;
  //alert(rows);
}

function removeRow(row_id) {
  if(rows == 1)
    alert("Can't delete only one row is there!");
  else {
    document.getElementById(row_id).remove();
    rows--;
  }
}

function isSupplier(name, contact_number) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=is_supplier&name=" + name + "&contact_number=" + contact_number, false);
  xhttp.send();
  return xhttp.responseText;
}

function getInvoiceNumber() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById("invoice_number").value = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=current_invoice_number", true);
  xhttp.send();
}

function checkInvoice(invoice_number, error) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=is_invoice&invoice_number=" + invoice_number, false);
  xhttp.send();
  if(xhttp.responseText == "true") {
    document.getElementById(error).style.display = "block";
    document.getElementById(error).innerHTML = "already added!";
    return true;
  }
  else
    document.getElementById(error).style.display = "none";
  return false;
}

function isNewMedicine(name, packing) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=is_new_medicine&name=" + name + "&packing=" + packing, false);
  xhttp.send();
  return xhttp.responseText;
}

function getAmount(row_number) {
  var qty = document.getElementById("quantity_" + row_number).value;
  var rate = document.getElementById("rate_" + row_number).value;
  document.getElementById("amount_" + row_number).value = qty * rate;

  var parent = document.getElementById('purchase_medicine_list_div');
  var row_count = parent.childElementCount;
  var medicine_info = parent.children;
  var total = 0;
  var amount;
  for(var i = 1; i < row_count; i++) {
    amount = Number.parseFloat(medicine_info[i].children[0].children[6].children[0].children[0].value);
    total += amount;
  }
  document.getElementById("grand_total").value = total;
}

function addPurchase() {
  var suppliers_name = document.getElementById('suppliers_name');
  var invoice_number = document.getElementById('invoice_number');
  var payment_type = document.getElementById('payment_type');
  var invoice_date = document.getElementById('invoice_date');

  if(!notNull(suppliers_name.value, "supplier_name_error"))
    suppliers_name.focus();
  else if(isSupplier(suppliers_name.value) == "false") {
    document.getElementById("supplier_name_error").style.display = "block";
    document.getElementById("supplier_name_error").innerHTML = "Supplier doesn't exists!";
    suppliers_name.focus();
  }

  //else if(checkInvoice(invoice_number.value, 'invoice_number_error'))
    //invoice_number.focus();

  else if(!checkDate(invoice_date.value, 'date_error'))
    invoice_date.focus();
  else {
    var parent = document.getElementById('purchase_medicine_list_div');
    var row_count = parent.childElementCount;
    var medicine_info = parent.children;

    var medicineStockRow = new Array(row_count-1);
    var newMedicine = new Array(row_count-1);
    //alert(newMedicine[0] == null);

    for(var i = 1; i < row_count; i++) {
      var elements_count = medicine_info[i].childElementCount;
      var elements = medicine_info[i].children;

      var medicines_name = elements[0].children[0].children[0];
      var medicines_name_error = elements[0].children[0].children[1];

      var batch_id = elements[0].children[1].children[0];
      var batch_id_error = elements[0].children[1].children[1];

      var expiry_date = elements[0].children[2].children[0];
      var expiry_date_error = elements[0].children[2].children[1];

      var quantity = elements[0].children[3].children[0];
      var quantity_error = elements[0].children[3].children[1];

      var mrp = elements[0].children[4].children[0];
      var mrp_error = elements[0].children[4].children[1];

      var rate = elements[0].children[5].children[0];
      var rate_error = elements[0].children[5].children[1];

      var amount = elements[0].children[6].children[0];

      var min_stock = elements[2].children[1].children[0];
      var min_error = elements[2].children[1].children[1];
      min_error.style.display = "none";

      var max_stock = elements[2].children[3].children[0];
      var max_error = elements[2].children[3].children[1];
      max_error.style.display = "none";

      var product_id = elements[2].children[4].children[0];

      var grand_total = document.getElementById("grand_total");

      var flag = false;
      if(!notNull(medicines_name.value, medicines_name_error.getAttribute('id')))
        medicines_name.focus();

      else if(isMedicine(medicines_name.value) == "false") {
        //alert(medicines_name.value);
        medicines_name_error.style.display = "block";
        medicines_name_error.innerHTML = "Medicine doesn't exists!";
        medicines_name.focus();
      }

      else if(!notNull(batch_id.value, batch_id_error.getAttribute('id')))
        batch_id.focus();

      else if(!checkExpiry(expiry_date.value, expiry_date_error.getAttribute('id')) || checkExpiry(expiry_date.value, expiry_date_error.getAttribute('id')) == -1)
        expiry_date.focus();

      else if(!checkQuantity(quantity.value, quantity_error.getAttribute('id')))
        quantity.focus();

      else if(quantity.value == 0) {
        quantity_error.style.display = "block";
        quantity_error.innerHTML = "Increase quantity or remove row!"
        quantity.focus();
      }

      else if(!checkValue(mrp.value, mrp_error.getAttribute('id')))
        mrp.focus();

      else if(!checkValue(rate.value, rate_error.getAttribute('id')))
        rate.focus();

      else if(Number.parseInt(mrp.value) < Number.parseFloat(rate.value)) {
        rate_error.style.display = "block";
        rate_error.innerHTML = "Rate must be less than MRP!";
        rate.focus();
      }

      else if(!notNull(min_stock.value, min_error.getAttribute('id')))
        min_stock.focus();

      else if(!notNull(max_stock.value, max_error.getAttribute('id')))
        max_stock.focus();

      //else if(isNewMedicine(medicines_name.value, batch_id.value) == "false") {
        //batch_id_error.style.display = "block";
        //batch_id_error.innerHTML = "Required for new Medicine!";
        //batch_id.focus();
      //}
      else {
        //alert("perfect");
        flag = true;
        //alert("row perfect...");
        // go ahead and store row date
        medicineStockRow[i-1] = new MedicineStock(medicines_name.value, batch_id.value, expiry_date.value, quantity.value, mrp.value, rate.value, min_stock.value, max_stock.value, suppliers_name.value, invoice_date.value, product_id.value);
        //newMedicine[i-1] = new NewMedicine(medicines_name.value, packing.value, generic_name.value, );
      }
      if(!flag)
        return false;
    }
    //alert(medicineStockRow[1].name);
    // insert data into table
    for(var i = 0; i < row_count - 1; i++) {
      addMedicineStock(medicineStockRow[i].name, medicineStockRow[i].batch_id, medicineStockRow[i].expiry_date, medicineStockRow[i].quantity, medicineStockRow[i].mrp, medicineStockRow[i].rate, suppliers_name.value, medicineStockRow[i].min_stock, medicineStockRow[i].max_stock, invoice_date.value, medicineStockRow[i].product_id);
      addNewPurchaseInvoice(suppliers_name.value, invoice_number.value, medicineStockRow[i].product_id);
      console.log(medicineStockRow[i].product_id);
    }
    addNewPurchase(suppliers_name.value, invoice_number.value, payment_type.value, invoice_date.value, grand_total.value);
  }
}

function addNewMedicine(name, generic_name, supplier_name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      alert("New medicine " + xhttp.responseText);
  };
  xhttp.open("GET", "php/add_new_medicine.php?name=" + name + "&generic_name=" + generic_name + "&suppliers_name=" + supplier_name, false);
  xhttp.send();
}

function addMedicineStock(name, batch_id, expiry_date, quantity, mrp, rate, suppliers_name, min, max, invoice_date, product_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=add_stock&name=" + name + "&batch_id=" + batch_id + "&expiry_date=" + expiry_date + "&quantity=" + quantity + "&mrp=" + mrp + "&rate=" + rate + "&min=" + min + "&max=" + max + "&suppliers_name=" + suppliers_name + "&invoice_date=" + invoice_date + "&product_id=" + product_id, true);
  xhttp.send();
  //alert(suppliers_name);
}

function addNewPurchase(suppliers_name, invoice_number, payment_type, invoice_date, grand_total, product_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('purchase_acknowledgement').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=add_new_purchase&suppliers_name=" + suppliers_name + "&invoice_number=" + invoice_number + "&payment_type=" + payment_type + "&invoice_date=" + invoice_date + "&invoice_date=" + invoice_date + "&grand_total=" + grand_total, true);
  xhttp.send();
}

function addNewPurchaseInvoice(suppliers_name, invoice_number, product_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('purchase_acknowledgement').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=add_new_purchase_invoice&suppliers_name=" + suppliers_name + "&invoice_number=" + invoice_number + "&product_id=" + product_id, true);
  xhttp.send();
}
