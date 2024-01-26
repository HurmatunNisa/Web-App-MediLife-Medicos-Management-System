function notNull(text, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(text < 0) {
    result.innerHTML = "Invalid!";
    return false;
  }
  else if(text.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  result.style.display = "none";
  return true;
}

function checkPasswordMatch() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;
  var result = document.getElementById("password_match_error"); // Corrected ID

  result.style.display = "block";
  
  if (password !== confirmPassword) {
    result.innerHTML = "Passwords do not match";
    return false;
  }

  result.style.display = "none";
  return true;
}
function validatePasswordLength() {
  var password = document.getElementById("password").value;
  var result = document.getElementById("password_error");
  result.style.display = "block";
  if (password.length < 6) {
    
    result.innerHTML = "Password must be at least 6 characters long.";
    return false;
  } else {
    result.style.display = "none";
    return true;
  }
}

function validateName(name, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(name.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  result.innerHTML = "Must contain only letters!";
  for(var i = 0; i < name.length; i++)
    if(!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z') || name[i] == ' '))
      return false;
  result.style.display = "none";
  return true;
}

function validateContactNumber(contact_number, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(contact_number.length != 11) {
    result.innerHTML = "Must contain 11 digits!";
    return false;
  }
  else
    result.style.display = "none";
  return true;
}

function validateAddress(address, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(address.trim().length < 10) {
    result.innerHTML = "Please enter more specific address!";
    return false;
  }
  else
    result.style.display = "none";
  return true;
}

function validateEmail(email, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  
  // Regular expression for email validation
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailRegex.test(email)) {
    result.innerHTML = "Please enter a valid email address!";
    return false;
  } else {
    result.style.display = "none";
    return true;
  }
}

function validateGender(gender, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  
  if (gender === "") {
    result.innerHTML = "Please select a gender!";
    return false;
  } else {
    result.style.display = "none";
    return true;
  }
}

function checkExpiry(date, error) {
  var newdate = document.getElementById("expiry_date");
  var result = document.getElementById(error);
  result.style.display = "block";
  //if(date.trim() == "" || date.trim().length != 5 || date[2] != "/")
    //result.innerHTML = "Please enter date in mm/yy format!";
  //if(date.slice(0, 2) < 2 || date.slice(0, 2) > 12)
    //result.innerHTML = "Invalid month!";
  if(new Date("20" + date.slice(3, 5), date.slice(0, 2)) < new Date()) {
    result.innerHTML = "Expired Medicine!";
    return -1;
  }
  // else if (newdate < new Date("dd/mm/yyyy")) {
  //   result.innerHTML = "Meri wali Expired Medicine!";
  //   return -1;
  // }
  else {
    result.style.display = "none";
    return true;
  }
  return false;
}

function checkQuantity(quantity, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(quantity < 0 || !Number.isInteger(parseFloat(quantity)))
    result.innerHTML = "Invalid quantity!";
  else {
    result.style.display = "none";
    return true;
  }
  return false;
}

function checkValue(value, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(value < 0 || value == "")
    result.innerHTML = "Invalid!";
  else {
    result.style.display = "none";
    return true;
  }
  return false;
}

function checkDate(date, error) {
  var result = document.getElementById(error);
  result.style.display = "block";
  if(date == "")
    result.innerHTML = "Mustn't be empty!!";
  else if(new Date(date) > new Date())
    result.innerHTML = "Mustn't be future date!";
  else {
    result.style.display = "none";
    return true;
  }
  return false;
}

function addCustomer() {
  document.getElementById("customer_acknowledgement").innerHTML = "";
  var customer_name = document.getElementById("customer_name");
  var contact_number = document.getElementById("customer_contact_number");
  var customer_address = document.getElementById("customer_address");
  var customer_email = document.getElementById("customer_email");
  var customer_gender = document.getElementById("customer_gender");
  var doctor_name = document.getElementById("customer_doctors_name");
  var doctor_address = document.getElementById("customer_doctors_address");
  if(!validateName(customer_name.value, "name_error"))
    customer_name.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(customer_address.value, "address_error"))
    customer_address.focus();
  else if(!validateName(doctor_name.value, 'doctor_name_error'))
    doctor_name.focus();
  else if(!validateAddress(doctor_address.value, 'doctor_address_error'))
    doctor_address.focus();
  else if(!validateEmail(customer_email.value, "email_error"))
    customer_email.focus();
  else if(!validateGender(customer_gender.value, "gender_error"))
    customer_gender.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState = 4 && xhttp.status == 200)
  			document.getElementById("customer_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_customer.php?name=" + customer_name.value + "&contact_number=" + contact_number.value + "&address=" + customer_address.value + "&email=" + customer_email.value + "&gender=" + customer_gender.value + "&doctor_name=" + doctor_name.value + "&doctor_address=" + doctor_address.value, true);
  	xhttp.send();
  }
  return false;
}

function addSupplier() {
  document.getElementById("supplier_acknowledgement").innerHTML = "";
  var supplier_name = document.getElementById("supplier_name");
  var supplier_email = document.getElementById("supplier_email");
  var contact_number = document.getElementById("supplier_contact_number");
  var supplier_address = document.getElementById("supplier_address");
  if(!validateName(supplier_name.value, "name_error"))
    supplier_name.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(supplier_address.value, "address_error"))
    supplier_address.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState = 4 && xhttp.status == 200)
  			document.getElementById("supplier_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_supplier.php?name=" + supplier_name.value + "&email=" + supplier_email.value + "&contact_number=" + contact_number.value + "&address=" + supplier_address.value, true);
  	xhttp.send();
  }
}

function addUser() {
  document.getElementById("user_acknowledgement").innerHTML = "";
  var username = document.getElementById("username");
  var password = document.getElementById("password");
  var confirmPassword = document.getElementById("confirm_password");
  var userType = document.getElementById("user_type");
  var address = document.getElementById("address");
  var email = document.getElementById("email");
  var contactNumber = document.getElementById("contact_number");
  
  var usernameError = "username_error";
  var passwordError = "password_error";
  var addressError = "address_error";
  var passwordMatchError = "password_match_error";
  var emailError = "email_error";
  var contactError = "contact_error";
  
  if (!notNull(username.value, usernameError))
    username.focus();
  else if (!notNull(password.value, passwordError))
    password.focus();
  else if (!notNull(confirmPassword.value, passwordMatchError))
    confirmPassword.focus();
  else if (!checkPasswordMatch()) // Validate password match
    confirmPassword.focus();
  else if (!notNull(email.value, emailError))
    email.focus();
  else if (!validateEmail(email.value, emailError)) // Validate email format
    email.focus();
  else if (!notNull(address.value, addressError))
    address.focus();
  else if (!notNull(contactNumber.value, contactError))
    contactNumber.focus();
  else if (!validateContactNumber(contactNumber.value, contactError)) // Validate contact number format
    contactNumber.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState === 4 && xhttp.status === 200)
        document.getElementById("user_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_user.php?username=" + username.value + "&password=" + password.value + "&userType=" + userType.value + "&email=" + email.value + "&address=" + address.value + "&contactNumber=" + contactNumber.value, true);
    xhttp.send();
  }
}


function addMedicine() {
  document.getElementById("medicine_acknowledgement").innerHTML = "";
  var name = document.getElementById("medicine_name");
  var packing = document.getElementById("packing");
  var generic_name = document.getElementById("generic_name");
  var product_type = document.getElementById("product_type");
  var product_strength = document.getElementById("product_strength");
  var price = document.getElementById("price");
  if(!notNull(name.value, "medicine_name_error"))
    name.focus();
  else if(!notNull(packing.value, "pack_error"))
    packing.focus();
  else if(!notNull(generic_name.value, "generic_name_error"))
    generic_name.focus();
  else if(!notNull(generic_name.value, "product_type_error"))
    product_type.focus();
  else if(!notNull(generic_name.value, "product_strength_error"))
   product_strength.focus();
  else if(!notNull(generic_name.value, "price_error"))
   price.focus();
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState == 4 && xhttp.status == 200)
  			document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_medicine.php?name=" + name.value +
     "&packing=" + packing.value + "&generic_name=" + generic_name.value + 
     "&product_type=" + product_type.value +
     "&product_strength=" + product_strength.value +
     "&price=" + price.value, true);
  	xhttp.send();
  }
}




function addStock() {
  document.getElementById("stock_acknowledgement").innerHTML = "";
  var name = document.getElementById("medicines_name");
  console.log(name.value); 
  var id = document.getElementById("medicines_id");
  var exp_date = document.getElementById("exp_date");
  var batch_id = document.getElementById("batch_id");
  var quantity = document.getElementById("quantity");
  var mrp = document.getElementById("mrp");
  var rate = document.getElementById("rate");
  var min_stock = document.getElementById("min_stock");
  var max_stock = document.getElementById("max_stock");
  var stock_in_date = document.getElementById("stock_in_date");
  var suppliers_name = document.getElementById("suppliers_name");
  if(!notNull(name.value, "medicines_name_error"))
    medicines_name.focus();
  else if(!notNull(exp_date.value, "exp_error"))
   exp_date.focus();
   else if(!notNull(batch_id.value, "batch_error"))
   batch_id.focus();
  else if(!notNull(quantity.value, "quantity_error"))
   quantity.focus();
  else if(!notNull(mrp.value, "mrp_error"))
    mrp.focus();
  else if(!notNull(rate.value, "rate_error"))
    rate.focus();
  else if(!notNull(min_stock.value, "min_stock_error"))
    min_stock.focus();
  else if(!notNull(max_stock.value, "max_stock_error"))
    max_stock.focus();
  else if(!notNull(stock_in_date.value, "date_error"))
    stock_in_date.focus();
  else if(!notNull(suppliers_name.value, "supplier_name_error"))
    suppliers_name.focus();
  else if(isSupplier(suppliers_name.value) == "false") {
    document.getElementById("supplier_name_error").style.display = "block";
    document.getElementById("supplier_name_error").innerHTML = "Supplier doesn't exists!";
    suppliers_name.focus();
  }
  else {
    var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
  		if(xhttp.readyState == 4 && xhttp.status == 200)
  			document.getElementById("stock_acknowledgement").innerHTML = xhttp.responseText;
  	};
  	xhttp.open("GET", "php/add_new_stock.php?name=" + name.value + "&id="+ id.value + "&exp_date=" + exp_date.value +"&batch_id="+batch_id.value+ "&quantity=" + quantity.value +
    "&mrp=" + mrp.value + "&rate=" + rate.value +"&min_stock=" + min_stock.value +"&max_stock="
     + max_stock.value +"&stock_in_date=" + stock_in_date.value +
     "&suppliers_name="+suppliers_name.value, true);
  	xhttp.send();
  }
}
//is supplier function to check whether or not supplier exist in pharmacy
function isSupplier(name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_purchase.php?action=is_supplier&name=" + name, false);
  xhttp.send();
  return xhttp.responseText;
}