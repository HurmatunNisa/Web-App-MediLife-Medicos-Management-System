<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "SELECT * FROM medicines WHERE PRODUCT_ID = $id";
      $result = mysqli_query($con, $query);
      if ($result) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['NAME'];
        $query1 = "DELETE FROM medicines WHERE PRODUCT_ID= $id";
        $result1 = mysqli_query($con, $query1);
        if ($result1) {
            $query2 = "DELETE FROM medicines_stock WHERE NAME = '$name'";
            $result2 = mysqli_query($con, $query2);
            if ($result2) 
            {
              showMedicines(0);
            } 
        } 
      
      }
    }
    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showMedicines($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $packing = strtoupper($_GET["packing"]);
      $generic_name = ucwords($_GET["generic_name"]);
      $type = $_GET["type"];
      $strength = $_GET["strength"];
      $price = $_GET["price"];
      updateMedicine($id, $name, $packing, $generic_name, $type, $strength, $price);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showMedicines(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchMedicine(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showMedicines($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM medicines";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['PRODUCT_ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showMedicineRow($seq_no, $row);
      }
    }
  }

  function showMedicineRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['PACKING']; ?></td>
      <td><?php echo $row['GENERIC_NAME']; ?></td>
      <td><?php echo $row['PRODUCT_TYPE']; ?></td>
      <td><?php echo $row['STRENGTH']; ?></td>
      <td><?php echo $row['PRICE']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editMedicine(<?php echo $row['PRODUCT_ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteMedicine(<?php echo $row['PRODUCT_ID']; ?>);">
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
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Medicine Name" id="medicine_name" onblur="notNull(this.value, 'medicine_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="medicine_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['PACKING']; ?>" placeholder="Packing" id="packing" onblur="notNull(this.value, 'pack_error');">
      <code class="text-danger small font-weight-bold float-right" id="pack_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['GENERIC_NAME']; ?>" placeholder="Generic Name" id="generic_name" onblur="notNull(this.value, 'generic_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="generic_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['PRODUCT_TYPE']; ?>" placeholder="Product Type" id="type" onblur="notNull(this.value, 'type_error');">
      <code class="text-danger small font-weight-bold float-right" id="type_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['STRENGTH']; ?>" placeholder="Strength" id="strength" onblur="notNull(this.value, 'strength_error');">
      <code class="text-danger small font-weight-bold float-right" id="strength_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['PRICE']; ?>" placeholder="Price" id="price" onblur="notNull(this.value, 'price_error');">
      <code class="text-danger small font-weight-bold float-right" id="price_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicine(<?php echo $row['PRODUCT_ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateMedicine($id, $name, $packing, $generic_name, $type, $strength, $price) {
  require "db_connection.php";
  $query = "SELECT * FROM medicines WHERE PRODUCT_ID = $id";
  $result = mysqli_query($con, $query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
    $oldname = $row['NAME'];

  $query1 = "UPDATE medicines SET NAME = '$name', PACKING = '$packing', GENERIC_NAME = '$generic_name', PRODUCT_TYPE = '$type' ,STRENGTH = '$strength', PRICE = '$price' WHERE PRODUCT_ID = $id";
  $result1 = mysqli_query($con, $query1);
  if($result1)
  {
    updateMedicineNamesInStock($oldname, $name);
  }
}
}

function updateMedicineNamesInStock($oldName, $newName) {
  require "db_connection.php";
  
  $query = "UPDATE medicines_stock SET NAME = '$newName' WHERE NAME = '$oldName'";
  
  if (mysqli_query($con, $query)) {
    showMedicines(0);
  } else {
    echo "Error updating names: " . mysqli_error($con);
  }
  
  mysqli_close($con);
}


function searchMedicine($text, $tag) {
  require "db_connection.php";
  if($tag == "name")
    $column = "NAME";
  if($tag == "generic_name")
    $column = "GENERIC_NAME";
  
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM medicines WHERE UPPER($column) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showMedicineRow($seq_no, $row);
    }
  }
}

?>
