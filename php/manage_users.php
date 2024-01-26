<?php
  require "db_connection.php";

  if($con) {
    if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
      $id = $_GET["id"];
      $query = "SELECT * FROM user WHERE ID = $id";
      $result = mysqli_query($con, $query);
  
      if ($result) {
          $row = mysqli_fetch_assoc($result);
          $username = $row['USERNAME'];
          $query1 = "DELETE FROM user WHERE ID = $id";
          $result1 = mysqli_query($con, $query1);
          if ($result1) {
              $query2 = "DELETE FROM admin_credentials WHERE username = '$username'";
              $result2 = mysqli_query($con, $query2);
              if ($result2) {
                  showUsers(0);
              } 
          } 
      } 
  }
  
    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showUsers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $username = $_GET["username"];
      $password = $_GET["password"];
      $usertype = $_GET["usertype"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact = $_GET["contact"];
      updateUser($id, $username, $password, $usertype, $address, $email,$contact);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showUsers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchUsers(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showUsers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM user";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showUserRow($seq_no, $row);
      }
    }
  }

  function showUserRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['USERNAME']; ?></td>
      <td><?php echo $row['PASSWORD']; ?></td>
      <td><?php echo $row['USER_TYPE']; ?></td>
      <td><?php echo $row['ADDRESS']; ?></td>
      <td><?php echo $row['EMAIL']; ?></td>
      <td><?php echo $row['CONTACT_NUMBER']; ?></td>
     
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['USERNAME']; ?>" placeholder="User Name" id="user_name" onblur="notNull(this.value, 'user_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="user_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['PASSWORD']; ?>" placeholder="Password" id="password" onblur="notNull(this.value, 'password_error');">
      <code class="text-danger small font-weight-bold float-right" id="password_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['USER_TYPE']; ?>" placeholder="User Type" id="usertype" onblur="notNull(this.value, 'user_type_error');" disabled>
      <code class="text-danger small font-weight-bold float-right" id="usertype_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['ADDRESS']; ?>" placeholder="address" id="address" onblur="notNull(this.value, 'address_error');">
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['EMAIL']; ?>" placeholder="Email" id="email" onblur="notNull(this.value, 'email_error');">
      <code class="text-danger small font-weight-bold float-right" id="email_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['CONTACT_NUMBER']; ?>" placeholder="Contact Number" id="contact" onblur="notNull(this.value, 'contact_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateUser(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateUser($id, $username, $password, $usertype, $address, $email, $contact) {
  require "db_connection.php";
  $query = "SELECT * FROM user WHERE ID = $id";
  $result = mysqli_query($con, $query);
  
  if ($result) {

      $row = mysqli_fetch_assoc($result);
      $username = $row['USERNAME'];
     
      $query1 = "UPDATE user SET USERNAME = '$username', PASSWORD = '$password', USER_TYPE  = '$usertype', ADDRESS = '$address' , EMAIL = '$email' , CONTACT_NUMBER = '$contact' WHERE ID = $id";
      $result1 = mysqli_query($con, $query1);

   if($result1){
   
   $query2 = "UPDATE admin_credentials SET USERNAME = '$username', PASSWORD = '$password', TYPE  = '$usertype' WHERE USERNAME  = '$username'";
   $result2 = mysqli_query($con, $query2);
    if($result2){
      
      showUsers(0);
    }
   
}
  }
 
}

function searchUsers($text, $tag) {
  require "db_connection.php";
  if($tag == "username")
    $column = "USERNAME";
  if($tag == "user_type")
    $column = "USER_TYPE";
 
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM user WHERE UPPER($column) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

?>
