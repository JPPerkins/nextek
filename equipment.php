<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php $_SESSION["last_page"] = "equipment.php"; ?>
  <?php include("db_header.php"); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextek - Equipment</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
  </head>
  <body>
    <?php
      include("navbar.php");
      $conn = new mysqli($servername, $username, $password);
      if($conn->connect_error) {
        die("Connection Failed");
      }
      mysqli_close($conn);
    ?>
    <div class="container">
      <br>
      <h2>Equipment</h2>
      <br>
      <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM equipmentlist, typelist, locationlist WHERE equipmentlist.equip_location = locationlist.location_id AND equipmentlist.equip_type = typelist.type_id";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Serial Number</th>
            <th scope=col>Model Number</th>
            <th scope=col>Type</th>
            <th scope=col>Tolerance</th>
            <th scope=col>Location</th>
            <th scope=col>Pass/Fail</th>
            <th scope=col>Edit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row>" . $row["serial_number"] . "</th><td>" . $row["model_number"] . "</td><td>" . $row["type_name"] . "</td>
            <td>" . $row["type_tolerance"] * 100 . "%</td><td>" . $row["location_name"] . "</td><td>" . $row["equip_viscon"] . "</td>
            <td><a class='btn btn-outline-info btn-sm' href=\"edit_equipment.php?eid=" . $row['eid'] . "\">Edit</a></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3><br><br>";
        } ?>
        <form method="post" action="add_equipment.php">
          <fieldset>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="serial_number">Serial Number</label>
                  <input type="text" class="form-control" name="serial_number" placeholder="Serial Number">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="model_number">Model Number</label>
                  <input type="text" class="form-control" name="model_number" placeholder="Model Number">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="equip_type">Type</label>
                  <select class="form-control" name="equip_type">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from typelist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["type_id"] . "\">" . $row["type_name"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="equip_location">Location</label>
                  <select class="form-control" name="equip_location">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from locationlist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["location_id"] . "\">" . $row["location_name"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Equipment</button>     
          </fieldset>
        </form>
      <?php else:
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>ID</th>
            <th scope=col>Type</th>
            <th scope=col>Value</th>
            <th scope=col>Unit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row>" . $row["std_name"] . "</th><td>" . $row["std_type"] . "</td><td>" . $row["std_value"] . "</td><td>" 
            . $row["unit_name"] . "</td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3><br><br>";
        } 
      ?>
      <?php endif ?>
    </div>
  </body>
</html>