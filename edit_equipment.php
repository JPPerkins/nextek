<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "edit_equipment.php?eid=" . $_GET["eid"];
    include("db_header.php"); 
  ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo "<title>Nextek - Equipment " . $_GET["eid"] . "</title"; ?>
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
    <?php echo "<h2>Equipment</h2>"; ?>
    <br>
    <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM equipmentlist, typelist, locationlist WHERE equipmentlist.equip_location = locationlist.location_id AND equipmentlist.equip_type = typelist.type_id AND eid = " . $_GET["eid"];
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Serial Number</th>
            <th scope=col>Model Number</th>
            <th scope=col>Type</th>
            <th scope=col>Tolerance</th>
            <th scope=col>Location</th>
            <th scope=col>Visual Condition</th>
            <th scop=col>Save</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row><form method='post' action='modify_equipment.php?eid=" . $_GET['eid'] . "'>";
            echo "<input type='text' class='form-control' name='serial_number' value='" . $row["serial_number"] . "'></th>";
            echo "<td><input type='text' class='form-control' name='model_number' value='" . $row['model_number'] . "'></td>
              <td><select class='form-control' name='equip_type' value='" . $row["equip_type"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from typelist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["type_id"] . "\">" . $row2["type_name"] . "</option>";
            }
            mysqli_close($conn);

            echo "</td><td><input class='form-control' id='readOnlyInput' type='text' value=" . $row["type_tolerance"] * 100 . "% readonly='' size='2'></td>
            <td><select class='form-control' name='equip_location' value='" . $row["equip_location"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from locationlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["location_id"] . "\">" . $row2["location_name"] . "</option>";
            }
            mysqli_close($conn);

            echo "</td><td><select class='form-control' name='equip_viscon' value='" . $row["equip_viscon"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from conditionlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["cond_quality"] . "\">" . $row2["cond_quality"] . "</option>";
            }
            mysqli_close($conn);
            echo "</td><td><button class='btn btn-info' type='submit'>Save</button></form></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3><br><br>";
        } ?>
        
        <div class="container">
        <h3>Standards</h3>

        <?php $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM equipstdlist, standardlist, equipmentlist, typelist WHERE equipstdlist.equip_id = " . $_GET["eid"] . " AND equipmentlist.eid = " . $_GET["eid"] . "
           AND standardlist.std_id = equipstdlist.std_id AND equipmentlist.equip_type = typelist.type_id";
        $result = $conn->query($sql);
        mysqli_close($conn);
        $VALID = TRUE;

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Standard ID</th>
            <th scope=col>Requirement</th>
            <th scope=col>Low</th>
            <th scope=col>High</th>
            <th scope=col>Measurement</th>
            <th scope=col>Valid</th>
            <th scope=col>Edit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            $tolerance = $row["type_tolerance"];
            $lowreq = $row["std_value"] * (1 - $tolerance);
            $highreq = $row["std_value"] * (1 + $tolerance);
            echo "<tr><th scope=row>" . $row["std_name"] . "</th><td>" . $row["std_value"] . "</td><td>" . $lowreq . "</td><td>" 
            . $highreq . "</td>";
            
            echo "<td><input type='text' class='form-control' name='std_value' size='4' value=" . $row["value"] . "></td>";   

            if ($row["value"]  <= $highreq && $row["value"]  >= $lowreq) {
              echo "<td class='text-success'>PASS</td>";
            } else {
              echo "<td class='text-danger'>FAIL</td>";
              $VALID = FALSE;
            }
            // TODO
            echo "<td><button class='btn btn-outline-info btn-sm' href=\"edit_std_equip.php?=" . $row['std_id'] . "\">Save</a></td></tr>";
          }
          echo "</table>";
          echo "</br><h4>";
          if ($VALID) { 
            echo "<p class='text-success'>PASS</h4></p>";
          } else {
            echo "<p class='text-danger'>FAIL</h4></p>";
          }
        } else {
            echo "<h4>No standard data found.</h4>";
        }
        ?>
        <form method="post" action="add_std_equip.php">
          <fieldset>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="std_id">Standard</label>
                  <select class="form-control" name="std_id">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from standardlist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["std_id"] . "\">" . $row["std_name"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="std_value">Measurement</label>
                  <input type="text" class="form-control" name="std_value" placeholder="Measurement">
                  <?php echo "<input type='hidden' class='form-control' name='eid' value=" . $_GET["eid"] . ">"; ?>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Standard</button>     
          </fieldset>
        </form>
        </div>
        <?php
        /*if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT *, std_value as value FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_id = " . $_GET["std_id"] ." AND standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
        $result = $conn->query($sql);
        mysqli_close($conn);
        echo $row["value"];

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>ID</th>
            <th scope=col>Type</th>
            <th scope=col>Value</th>
            <th scope=col>Unit</th>
            <th scope=col>Save</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row><form method='post' action='modify_standard.php?std_id=" . $row['std_id'] . "'>";
            echo "<input type='text' class='form-control' name='std_name' value='" . $row["std_name"] . "'></th>";
          
            echo "<td><select class='form-control' name='std_type' value='" . $row["std_type"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from standardtypelist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["std_tid"] . "\">" . $row2["std_type"] . "</option>";
            }
            mysqli_close($conn);
            echo "</select></td>";
            echo "<td><input type='text' class='form-control' name='std_value' value=" . $row['std_value'] . "></td>";

            echo "<td><select class='form-control' name='std_unit' value='" . $row["std_unit"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from unitlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["unit_id"] . "\">" . $row2["unit_name"] . "</option>";
            }
            mysqli_close($conn);
            echo "</select></td><td><button class='btn btn-info' type='submit'>Save</button></form></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3>";
        }
        echo "</br></br></br>";
        echo "<row><a style='float: left;' class='btn btn-primary' href='standards.php'>Back to Standards</a>";
        echo "<a style='float: right;' class='btn btn-outline-danger' href=\"remove_standard.php?std_id=" . $_GET['std_id'] . "\">Remove Standard</a></row>";*/
    ?>
    <?php endif ?>
    </div>
  </body>
</html>