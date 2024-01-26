function deleteUser(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('users_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_users.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editUser(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateUser(id) {
  var user_name = document.getElementById("user_name");
  var password = document.getElementById("password");
  var user_type = document.getElementById("usertype");
  var address = document.getElementById("address");
  var email = document.getElementById("email");
  var contact = document.getElementById("contact");

  if(!notNull(user_name.value, "user_name_error"))
    user_name.focus();
  else if(!notNull(password.value, "password_error"))
    password.focus();
  else if(!notNull(user_type.value, "usertype_error"))
    usertype.focus();
    else if(!notNull(address.value, "address_error"))
    address.focus();
    else if(!notNull(email.value, "email_error"))
    email.focus();
    else if(!notNull(contact.value, "contact_error"))
    generic_name.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('users_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_users.php?action=update&id=" + id + "&username=" + user_name.value + "&password=" + password.value + "&usertype=" + usertype.value + "&address=" + address.value + "&email=" + email.value + "&contact=" + contact.value, true); // Corrected parameter name
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=cancel", true);
  xhttp.send();
}

function searchUsers(text, tag) {
  if(tag == "username") {
    document.getElementById("by_type").value = "";
    
  }
  if(tag == "user_type") {
   
    document.getElementById("by_username").value = "";
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_users.php?action=search&text=" + text + "&tag=" + tag, true);
  xhttp.send();
}
